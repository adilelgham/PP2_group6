<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    //protected $primaryKey = 'my_string_key';

    public function appointments(){

        return $this->hasMany(Appointment::class);
    }

    protected $fillable = ['firstName','lastName','email','flagCounter','isFlagged','hasRight'];
}


