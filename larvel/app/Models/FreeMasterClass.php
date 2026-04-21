<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreeMasterClass extends Model
{

    protected $table = 'free_masterclass';
    protected $fillable = [
        'name',
        'email',
    ];
}
