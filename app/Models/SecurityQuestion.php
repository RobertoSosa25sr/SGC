<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecurityQuestion extends Model
{
    protected $fillable = ['question'];
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class, 'security_question_id');
    }
} 