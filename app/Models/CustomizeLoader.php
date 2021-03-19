<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomizeLoader extends Model
{
    protected $table = 'customizeloader';
    protected $fillable = array(
        'html',
        'css',
        'js',
        'loaderFor',
        'status'
    );
}
