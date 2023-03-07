<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'img',
    ];

    public function posts(){
        return $this->hasMany(Posts::class, 'category_id');
    }

    public function blogs(){
        return $this->hasMany(Blogs::class, 'category_id');
    }
}
