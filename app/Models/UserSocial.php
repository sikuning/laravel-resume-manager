<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSocial extends Model
{
    use HasFactory;

    protected $table = 'user_social';

    protected $fillable = [
        'title',
        'url',
        'icon',
        'status',
    ];
}
