<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = false;

    const IS_PUBLISHED = 1;
    const NOT_PUBLISHED = 0;

    static function getPublished()
    {
        return [
            self::IS_PUBLISHED => 'Yes',
            self::NOT_PUBLISHED => 'No',
        ];
    }
    public function getPublishedAttribute()
    {
        return self::getPublished()[$this->is_published];
    }
    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
    public function colors() {
        return $this->belongsToMany(Color::class);
    }
}
