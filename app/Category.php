<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	public function videos()
	{
		return $this->hasMany('App\\Video');
	}
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
    ];

}
