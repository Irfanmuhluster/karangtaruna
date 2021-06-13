<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;

    protected $fillable = [
    	'category_name', 'publish'
    ];

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function($query, $keyword){
            return $query->where('name', 'like', "%{$keyword}%");
        });
    }

    public function product() 
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
