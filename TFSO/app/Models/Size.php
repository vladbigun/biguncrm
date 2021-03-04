<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
	public function product()
    {
    return $this->belongsTo('App\User');
	}
}
