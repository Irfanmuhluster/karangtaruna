<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metadata extends Model
{
    use HasFactory;

    const TYPE_STRING = 0;
    const TYPE_JSON = 1;
    const TYPE_ARRAY = 1;
    const TYPE_SERIALIZE = 2;

    const WELCOME_MESSAGE = "setting::welcome_message";
    const GENERAL = "setting::general";
    const SOSIAL_MEDIA = "setting::social_media";
    // const THEME = "setting::general";

    protected $fillable = [
    	'meta_key',
    	'meta_value',
    	'type'
    ];

        /**
     * accessor meta value
     * @param  string $meta_value
     * @return mixed
     */
    public function getMetaValueAttribute($meta_value)
    {
    	return $this->decodeValue($meta_value, $this->attributes['type']);
    }

    /**
     * accessor value
     *
     * @return mixed
     */
    public function getValueAttribute()
    {
    	return $this->getMetaValueAttribute($this->attributes['meta_value']);
    }

    /**
     * muttator meta value
     * @param mixed $meta_value
     */
    public function setMetaValueAttribute($meta_value)
    {
    	$this->attributes['meta_value'] = $this->encodeValue($meta_value, $this->attributes['type']);
    }


    /**
     * muttator value
     * @param mixed $meta_value
     */
    public function setValueAttribute($value)
    {
    	$this->setMetaValueAttribute($value);
    }


    /**
     * encode meta value
     * @param  mixed $value
     * @param  string $type
     * @return string
     */
    public function encodeValue($value, $type)
    {
    	switch ($type) {
    		case self::TYPE_JSON:
    		case self::TYPE_ARRAY:
    			$value = json_encode($value);
    			break;
    		case self::TYPE_SERIALIZE:
    			$value = serialize($value);
    			break;
    	}

    	return $value;
    }

    /**
     * decode meta value
     * @param  string $value
     * @param  string $type
     * @return mixed
     */
    public function decodeValue($value, $type)
    {
    	switch ($type) {
    		case self::TYPE_JSON:
    		case self::TYPE_ARRAY:
    			$value = json_decode($value); //note: parameter assoc parameter kedua json_decode jangan dihidupkan, ndak yang lain jadi ga jalan.
    			break;
    		case self::TYPE_SERIALIZE:
    			$value = unserialize($value);
    			break;
    	}

    	return $value;
    }

    /**
     * find value
     * @param  [type] $query
     * @param  string $key
     * @return mixed        [description]
     */
    public static function findByKey($key)
    {
    	return self::where('meta_key', $key)->first();
    }

    /**
     * mendapatakan nilai data dari kunci
     * @param  string $key
     * @return mixed
     */
    public static function getValueByKey($key)
    {
    	$meta = self::findByKey($key);
    	return isset($meta) ? $meta->value : null;
    }
}
