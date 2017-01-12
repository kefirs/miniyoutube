<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

	public function category()
	{
		return $this->belongsTo('App\\Category');
	}
	public function user()
	{
		return $this->belongsTo('App\\User');
	}
	public function comments()
	{
		return $this->hasMany('App\\Comment');
	}
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'path',
    ];

}
