<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\SeoPage; // замени на свою модель блога
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Lunar\Models\Collection;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemaps extends Command
{
    protected $signature = 'sitemaps:generate';
    protected $description = 'Generate sitemap index and section sitemaps';

    public function handle(): int
    {
        $baseDir = public_path('sitemaps');
        File::ensureDirectoryExists($baseDir);

        $pages = Sitemap::create();

        $staticRouteNames = [
            'about.view',
            'b2b.view',
            'blogs.view',
            'work.view',
            'warranty.view',
            'collection.view.all', // оставь, если это отдельная страница-список
            'maps',
        ];

        foreach ($staticRouteNames as $name) {
            if (!app('router')->has($name)) { continue; }
            $pages->add(
                Url::create(route($name))
                    ->setLastModificationDate(now()->subDay())
            );
        }

        SeoPage::query()
            ->lazy()
            ->each(function ($post) use ($pages) {
                $pages->add(
                    Url::create(route('blog.view', $post->slug))
                        ->setLastModificationDate($post->updated_at ?? $post->created_at ?? now())
                );
            });

        $pagesPath = $baseDir . '/sitemap-pages.xml';
        $pages->writeToFile($pagesPath);

        $store = Sitemap::create();

        Collection::query()
            ->where('id', '>=', 53)
            ->with('defaultUrl')
            ->lazy()
            ->each(function ($c) use ($store) {
                if (!$c->defaultUrl) return;
                $store->add(
                    Url::create(route('collection.view', $c->defaultUrl->slug))
                        ->setLastModificationDate($c->updated_at ?? now())
                );
            });

        Product::query()
            ->where('status', 'active')
            ->with('defaultUrl')
            ->lazy()
            ->each(function ($p) use ($store) {
                if (!$p->defaultUrl) return;
                $store->add(
                    Url::create(route('product.view', $p->defaultUrl->slug))
                        ->setLastModificationDate($p->updated_at ?? now())
                );
            });

        $storePath = $baseDir . '/sitemap-store.xml';
        $store->writeToFile($storePath);

        SitemapIndex::create()
            ->add(url('sitemaps/sitemap-pages.xml'))
            ->add(url('sitemaps/sitemap-store.xml'))
            ->writeToFile(public_path('sitemap.xml'));

        $this->info('Generated: /sitemap.xml, /sitemaps/sitemap-pages.xml, /sitemaps/sitemap-store.xml');
        return self::SUCCESS;
    }
}
