<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDelet;

class Customer extends model
{
	//use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $tables = ['customers'];

    protected $fillable = [
        'name',
        'address',
        'email',
        'join_date',
        'nrc',
        'position'
    ];
}