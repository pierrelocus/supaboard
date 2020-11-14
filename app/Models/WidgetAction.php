<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WidgetAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'widget_id',
        'data',
        'x',
        'y',
        'width',
        'height',
        'auto_position',
        'text',
        'type',
    ];
}
