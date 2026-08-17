<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'email', 'password', 'subscribe'];

    protected $hidden = ['password'];

    protected function casts(): array
    {
        return ['subscribe' => 'boolean'];
    }
}