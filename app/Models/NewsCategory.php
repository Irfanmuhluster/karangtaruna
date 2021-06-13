<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
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
                        ->where('category_name', 'like', "%{$keyword}%");
                });
            });
    }

    public function news() 
    {
        return $this->hasMany(News::class, 'category_id');
    }
}
