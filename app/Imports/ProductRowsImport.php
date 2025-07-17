<?php

namespace App\Imports;

use App\Models\ProductCharacteristic;
use Illuminate\Support\Str;
use Lunar\FieldTypes\Text;
use Lunar\FieldTypes\TranslatedText;
use Lunar\Models\Brand;
use Lunar\Models\Collection;
use Lunar\Models\Price;
use Lunar\Models\Product;
use Lunar\Models\ProductVariant;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductRowsImport implements ToModel, WithChunkReading, ShouldQueue, WithStartRow, WithBatchInserts
{
    use RemembersRowNumber, Importable;

    public function __construct(protected string $defaultCategory,protected array $firstRow)
    {
    }

    public function model(array $row)
    {
        info('ass1');
        if($row[0]!=''){
            $name = $row[0];
            $collection_father = Collection::whereRaw(
                "JSON_UNQUOTE(JSON_EXTRACT(attribute_data, '$.name.value')) = ?",
                [$name]
            )->first();
            if (!$collection_father) {
                $collectionGroup = \Lunar\Models\CollectionGroup::updateOrCreate(
                    [
                        'name' => $name,
                        'handle' => Str::slug($name, '_').'321'
                    ]
                );
                $collection_father = Collection::updateOrCreate(
                    [
                        'attribute_data' => [
                            'name' => new \Lunar\FieldTypes\Text($name),
                        ],
                        'collection_group_id' => $collectionGroup->id,
                    ]
                );
            }
            $name = $row[2];
            $collection = Collection::whereRaw(
                "JSON_UNQUOTE(JSON_EXTRACT(attribute_data, '$.name.value')) = ?",
                [$name]
            )->first();
            if (!$collection) {
                $collection = Collection::updateOrCreate(
                    [
                        'attribute_data' => [
                            'name' => new \Lunar\FieldTypes\Text($name),
                        ],
                        'collection_group_id' => $collection_father->collection_group_id,
                        'parent_id' => $collection_father->id,
                    ]
                );
            }
            $brand = null;
            if($row[1]!=''){
                $brand = Brand::firstOrCreate(['name' => $row[1]]);
            }
            $guid = $row[3];
            $sku = $row[3];
            $name = $row[4];
            $description = isset($row[18]) ? $row[18] : $row['17'];

            $product = Product::updateOrCreate(
                ['external_id' => $guid],
                [
                    'product_type_id' => 1,
                    'status' => 'published',
                    'brand_id' => $brand->id,
                    'attribute_data' => collect([
                        'name' => new TranslatedText(collect([
                            'en' => new Text($name),
                        ])),
                        'description' => new TranslatedText(collect([
                            'en' => new Text($description),
                        ])),
                    ]),
                ]
            );
            info('ass');
            info($product->id);
            $variant = $product->variants()->firstOrCreate(
                ['sku' => $sku],
                [
                    'tax_class_id' => 1,
                    'stock' => 0,
                ]
            );
            $price = Price::where(['priceable_id' => $variant->id]);
            if($price->exists()){
                Price::updateOrCreate(
                    ['priceable_id' => $variant->id],
                    [
                        'customer_group_id' => 1,
                        'currency_id' => 1,
                        'priceable_type' => 'product_variant'
                    ]
                );
            }else{
                Price::updateOrCreate(
                    ['priceable_id' => $variant->id],
                    [
                        'price' => 0,
                        'compare_price' => 0,
                        'customer_group_id' => 1,
                        'currency_id' => 1,
                        'priceable_type' => 'product_variant'
                    ]
                );
            }
            for ($i=5;$i<=17;$i++){
                if(isset($row[$i]) and $this->firstRow[$i]!='' and $this->firstRow[$i]!=null){
                    if (isset($row[$i]) and $row[$i]!=''){
                        ProductCharacteristic::updateOrCreate(
                            [
                                'product_id' => $product->id,
                                'key' => $this->firstRow[$i],
                            ],
                            [
                                'value' => $row[$i],
                            ]
                        );
                    }
                }
            }
            $product->collections()->syncWithoutDetaching([$collection->id]);
        }
    }

    public function chunkSize(): int
    {
        return 5000;
    }

    public function batchSize(): int
    {
        return 5000;
    }

    public function startRow(): int
    {
        return 2;
    }
}
