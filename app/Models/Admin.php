<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'admin';
    protected $fillable = [
        'name',
        'password',
    ];
    protected $hidden = [
        'password',
    ];
}
