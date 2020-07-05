<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	//cause  of adding name field in category_tbl
   protected $fillable=['name'];
}
