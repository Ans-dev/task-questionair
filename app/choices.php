<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class choices extends Model
{
    protected $table = 'choices';

    protected $attributes = [
		'correct' => false,
	];

	protected $fillable = ['user_id','question_id','choice','correct'];

	public function SavedBy(){
		return $this->hasOne('App\User', 'id', 'user_id');
	}

	public function Question(){
		return $this->hasOne('App\questions', 'id', 'question_id');
	}
}
