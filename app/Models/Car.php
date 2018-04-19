<?php


namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use CrudTrait;

    protected $table = 'cars';

    protected $guarded = ['id'];

}