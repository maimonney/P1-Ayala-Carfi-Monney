<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'role'];

    public function isAdmin()
    {
        return $this->role === 'admin'; 
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'author_id');
    }
}
