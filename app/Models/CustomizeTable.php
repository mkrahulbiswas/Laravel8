<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomizeTable extends Model
{
    protected $table = 'customizetable';
    protected $fillable = array(
        'headBackColor',
        'headTextColor',
        'headHoverBackColor',
        'headHoverTextColor',
        'bodyBackColor',
        'bodyTextColor',
        'bodyHoverBackColor',
        'bodyHoverTextColor',
        'headTableStyle',
        'bodyTableStyle',
        'status'
    );
}
