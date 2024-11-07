<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reserva';

    protected $fillable = ['user_id', 'service_id', 'status'];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(Users::class);
    }
    
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
