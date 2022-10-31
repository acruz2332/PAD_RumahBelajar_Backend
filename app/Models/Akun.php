<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    protected $table = 'akun';

    public $incrementing = false;

    protected $primaryKey = 'username';
    protected $keyType = 'string';
}
