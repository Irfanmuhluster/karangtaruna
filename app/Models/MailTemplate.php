<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailTemplate extends Model
{
    use HasFactory;

    public function scopeSearch($query)
    {
        $filter = request()->query();

        return $query
            ->when(@$filter['search'], function ($query, $keyword) {
                return $query->where(function ($query) use ($keyword) {
                    return $query
                        ->where('subject', 'like', "%{$keyword}%")
                        ->where('template_name', 'like', "%{$keyword}%")
                        ->where('template_description', 'like', "%{$keyword}%");
                });
            });
    }
}
