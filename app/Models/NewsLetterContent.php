<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLetterContent extends Model
{
    use HasFactory;

    public $sortable = ['id'];

    protected $fillable = [
    	'id', 'subject', 'content', 'from_name', 'from_email', 'total', 'queue', 'sent', 'failed', 'publish', 'created_by_id', 'updated_by_id', 'created_at', 'updated_at'
    ];

    public function scopeSearch($query)
    {
        $request = request();

        if (! is_null($request->filter)) {
            $query->when($request->filter == 'publish', function($query){
                return $query->wherePublish(1);
            });

            $query->when($request->filter == 'unpublish', function($query){
                return $query->wherePublish(0);
            });
        }

    	return $query->when($request->search, function($query, $keyword){
    		return $query->where('subject', 'like', "%{$keyword}%")
    			->orWhere('content', 'like', "%{$keyword}%")
    			->orWhere('from_name', 'like', "%{$keyword}%")
    			->orWhere('from_email', 'like', "%{$keyword}%");
    	});
    }
}
