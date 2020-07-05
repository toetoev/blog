<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   protected $fillable = ['title', 'body', 'image', 'category_id', 'user_id'];

  	public function category($value=''){
   		return $this->belongsTo('App\Category'); //relationship of 1 to many between post and category
   	}

   	public function comment($value=''){
   		return $this->hasMany('App\Comment');
   	}

   	public function user($value=''){
   		return $this->belongsTo('App\User'); //relationship of 1 to many between post and category
   	}

}
