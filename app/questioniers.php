<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class questioniers extends Model
{
	protected $table = 'questioniers';

	protected $attributes = [
		'resumeable' => false,
		'published' => false,
	];

	protected $fillable = ['user_id','name','duration','resumeable','published'];


	public function SavedBy(){
		return $this->hasOne('App\User', 'id', 'user_id');
	}

	public function Questions(){
		return $this->hasMany('App\questions', 'questionier_id', 'id');
	}  
}
