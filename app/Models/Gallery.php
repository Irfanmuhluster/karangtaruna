<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
    	'category_id', 'images', 'caption', 'caption_en', 'publish', 'orderby'
    ];

    // eager
    protected $with = ['category'];

    protected $appends = ['image_url'];

    // relation
    public function category()
    {
        return $this->belongsTo(GalleryCategory::class, 'category_id');
    }

    public function scopeSearch($query)
    {
        $filter = request()->query();

        return $query
            ->when(@$filter['search'], function ($query, $keyword) {
                return $query->where(function ($query) use ($keyword) {
                    return $query
                        ->where('caption', 'like', "%{$keyword}%");
                });
            }) ->when(@$filter['cat'], function ($query, $keyword) {
                return $query->where(function ($query) use ($keyword) {
                    return $query
                            ->where('category_id', 'like', "%{$keyword}%");
                });
            });
 
    }
}
