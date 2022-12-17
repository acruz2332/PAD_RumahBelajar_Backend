<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Murid extends Model
{
    protected $table = 'murid';

    public $incrementing = false;

    protected $primaryKey = 'token';
    
    protected $keyType = 'string';
}
