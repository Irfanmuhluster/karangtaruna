<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    use HasFactory;

     /**
     *  filter searching
    */

    public function scopeSearch($query)
    {
        $filter = request()->query();

        return $query
            ->when(@$filter['search'], function ($query, $keyword) {
                return $query->where(function ($query) use ($keyword) {
                    return $query
                        ->where('categoryname', 'like', "%{$keyword}%");
                });
            });
    }

    public function gallery() 
    {
        return $this->hasMany(Gallery::class, 'category_id');
    }
}
