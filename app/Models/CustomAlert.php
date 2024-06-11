<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomAlert extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'status', 'type', 'banner', 'link', 'description', 'background_color', 'text_color'
    ];
}
