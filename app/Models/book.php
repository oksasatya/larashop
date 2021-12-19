<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class book extends Model
{
    use HasFactory, SoftDeletes;

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function orders(){
        return $this->belongsToMany(order::class);
    }
}
