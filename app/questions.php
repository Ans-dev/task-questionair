<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class questions extends Model
{
	protected $table = 'questions';

	protected $fillable = ['user_id','questionier_id','type','question','answer'];

	public function SavedBy(){
		return $this->hasOne('App\User', 'id', 'user_id');
	}

	public function Questionair(){
		return $this->hasOne('App\questioniers', 'id', 'questionier_id');
	}

	public function Choices(){
		return $this->hasMany('App\choices', 'question_id', 'id');
	}

	protected static function boot() 
	{
		parent::boot();

		static::deleting(function($questions) {
			foreach ($questions->choices()->get() as $choice) {
				$choice->delete();
			}
		});
	}

}
