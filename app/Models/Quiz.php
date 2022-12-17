<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quiz';

    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = 'token';
    protected $keyType = 'string';
}
