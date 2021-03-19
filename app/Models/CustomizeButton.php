<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomizeButton extends Model
{
    protected $table = 'customizebutton';
    protected $fillable = array('btnIcon', 'backColor', 'textColor', 'backHoverColor', 'textHoverColor', 'btnFor', 'status');
}
