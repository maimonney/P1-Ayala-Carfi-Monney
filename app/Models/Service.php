<?php

namespace App\Models;

use App\Http\Controllers\UsersController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',       
        'description',  
        'price', 
        'duration',
        'category',
        'image', 
        'user_id',    
    ];

    public function user()
    {
        return $this->belongsTo(UsersController::class);
    }
}
