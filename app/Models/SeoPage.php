<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoPage extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'meta_description',
        'og_image',
        'content',
        'content_blocks',
    ];
}
