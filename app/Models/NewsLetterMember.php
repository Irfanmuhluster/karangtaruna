<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLetterMember extends Model
{
    use HasFactory;
    
    protected $fillable = [
    	'id', 'email', 'unsubscribe', 'created_at', 'updated_at'
    ];


    public function scopeSearch($query)
    {
        $request = request();

        if (! is_null($request->filter)) {
            $query->when($request->filter == 'subscribe', function($query){
                return $query->whereUnsubscribe(1);
            });

            $query->when($request->filter == 'unsubscribe', function($query){
                return $query->whereUnsubscribe(0);
            });
        }
        return $query->when($request->search, function($query, $keyword){
            return $query->where('email', 'like', "%{$keyword}%");
        });

    }

    public function scopeTotal($query)
    {
    	return $query->where('unsubscribe', 0)->count();
    }
}
