<?php
namespace App\Http\Controllers\Admin;

use App\Models\Reserva;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = Users::count(); 
        $totalNormalUsers = Users::where('role', 'user')->count();
        $totalAdmins = Users::where('role', 'admin')->count();
        
        // Reservas pendientes y completadas
        $reservasPendientes = Reserva::where('status', 'pendiente')->count();
        $reservasCompletadas = Reserva::where('status', 'completada')->count();
        
        // Pasar todas las variables necesarias a la vista
        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalNormalUsers', 
            'totalAdmins', 
            'reservasPendientes',
            'reservasCompletadas'
        ));
    }
}

