<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
	use HasFactory;
	public function size()
 	{
   		return $this->hasMany('App\Models\Size');
 	}
 	public function category()
 	{
   		return $this->hasMany('App\Models\Category');
 	}
  
}
