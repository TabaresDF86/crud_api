<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class task extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'tasks';

    protected $fillable = [
        'user_id',
        'name_task',
        'description'
    ];

    public $timestamps = false;

}
