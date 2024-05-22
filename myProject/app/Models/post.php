<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_category_id',
        'post_name',
        'post_desc',
        'post_image',
    ];


   public function categoryHas(){
    return $this->belongsTo('App\Models\postCategory','post_category_id','id');
   }
}
