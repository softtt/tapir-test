<?php

namespace App\Models;



use Backpack\CRUD\CrudTrait;

class Model extends \Illuminate\Database\Eloquent\Model
{
    use CrudTrait;

    protected $table = 'models';

    protected $fillable = ['make_id', 'name'];

    public function make()
    {
        return $this->belongsTo(Make::class, 'make_id', 'id');
    }

    public function cars()
    {
        return $this->hasMany(Car::class, 'model_id');
    }
}

