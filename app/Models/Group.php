<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = "groups";
    protected $guarded = false;
    
    public function product()
    {
        return $this->hasMany(Product::class);
    }

}
