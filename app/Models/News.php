<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    public function scopeSearch($query)
    {
        $filter = request()->query();

        return $query
            ->when(@$filter['search'], function ($query, $keyword) {
                return $query->where(function ($query) use ($keyword) {
                    return $query
                        ->where('title', 'like', "%{$keyword}%");
                });
            });
    }

    protected $with = ['category', 'createdby', 'updatedby'];


    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }

    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }
}
