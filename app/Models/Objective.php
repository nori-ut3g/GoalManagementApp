<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;

    public function tasks()
    {
        return $this->hasMany('app\Models\Task');
    }
}
