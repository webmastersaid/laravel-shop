<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_image';
    protected $guarded = false;

    public function getImageUrlAttribute()
    {
        return '/storage/'.$this->file_path;
    }
}
