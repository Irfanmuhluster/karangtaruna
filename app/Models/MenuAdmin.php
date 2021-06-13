<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAdmin extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'role_id',
        'title',
        'url',
        'icon_class',
        'parent_id',
        'order',
    ];

    public function children() 
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('order', 'asc');
    }

    public function parent() 
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
}
