<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    public $incrementing = false;

    protected $primaryKey = 'token';
    public $timestamps = false;
    protected $keyType = 'string';
}
