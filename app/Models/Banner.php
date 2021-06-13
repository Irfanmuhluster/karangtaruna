<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    public function scopeSearch($query)
    {
        $filter = request()->query();

        $filter['position'] = $filter['position'] ?? 'top';
        // dd($filter['position']);
        return $query
            ->when(@$filter['search'], function ($query, $keyword) {
                return $query->where(function ($query) use ($keyword) {
                    return $query
                        ->where('title', 'like', "%{$keyword}%");
                });
            })->when(@$filter['position'], function ($query, $keyword) {
                return $query->where(function ($query) use ($keyword) {
                    return $query
                        ->where('position', "{$keyword}");
                });
            });
    }
}
