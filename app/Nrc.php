<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nrc extends Model
{
     use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nrc_code',
        'nrc_township',
        'nrc_code_mm',
        'nrc_township_mm'
    ];
    public function user()
    {
        return $this->belongsTo('App\User'); 
    }
}
