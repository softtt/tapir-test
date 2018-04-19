<?php


namespace App\Models;


use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Make extends Model
{
    use CrudTrait;

    protected $table = 'makes';

    protected $fillable = ['name'];

    public function models()
    {
        return $this->hasMany(\App\Models\Model::class, 'make_id');
    }

}

