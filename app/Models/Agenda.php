<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $dates = ['event_date'];

    public function scopeSearch($query)
    {
        $filter = request()->query();
        // dd($filter['position']);
        return $query
            ->when(@$filter['search'], function ($query, $keyword) {
                return $query->where(function ($query) use ($keyword) {
                    return $query
                        ->where('title', 'like', "%{$keyword}%");
                });
            })->when(@$filter['agendatype'], function ($query, $keyword) {
                return $query->where(function ($query) use ($keyword) {
                    return $query
                        ->where('agendatype', "{$keyword}");
                });
            });
    }
}
