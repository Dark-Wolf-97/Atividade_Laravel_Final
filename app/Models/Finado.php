<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Finado extends Model
{
    use HasFactory;
    protected $fillable = ['finado_nome', 'finado_certidao'];

    protected $primaryKey = 'id'; 

    public $timestamps = false;
}
