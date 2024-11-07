<?php

namespace App\Models;

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
    ];

    public function users()
    {
        return $this->belongsToMany(Users::class, 'reserva')
                    ->withPivot('status');
    }

    public function reservas()
{
    return $this->hasMany(Reserva::class);
}
}
