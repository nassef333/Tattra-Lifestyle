<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stories extends Model
{
    use HasFactory;

    protected $fillable = [
        'story_img',
        'video',
        'post_id',
        'title',
        'see_more',
        'is_add',
        'pub_number',
        'slot_number',
        'ads_script',
    ];

    public function post(){
        return $this->belongsTo(Posts::class);
    }
}
