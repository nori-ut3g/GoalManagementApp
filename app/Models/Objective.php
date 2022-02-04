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
        return $this->hasMany(Task::class);
    }

    public function task(){
        return $this->hasOne(Task::class);
    }

    public function sharedObjectives(){
        return $this->hasMany(SharedObjective::class);
    }
}
