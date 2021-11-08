<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDelet;

class UserRole extends model
{
	//use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $fillable = [
        'name'
    ];
}