<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class postCategory extends Model
{
    use HasFactory;
    protected $fillable=['post_cat_name'];

    public function postBelongs(){
        return $this->hasMany(post::class,'post_category_id','id');
        }
}
