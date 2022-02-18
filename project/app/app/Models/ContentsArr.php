<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentsArr extends Model
{
    use HasFactory;

    protected $fillable = ['arr_text1', 'arr_text2',];

    protected $casts = [
        'arr_text1' => 'array',
        'arr_text2' => 'array'
    ];
}
