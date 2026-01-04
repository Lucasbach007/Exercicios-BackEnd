<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table= 'pessoa';
    protected $filltable= ['nome', 'email','senha','foto'];

     protected $hidden = [
        'senha'
    ];
}
