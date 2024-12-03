@extends('layouts.main')

@section('title', 'Dashboard de Administrador')

@section('content')

<div>
    <x-nav_admin></x-nav_admin>

    <div class="container mt-5">
        <h1 class="text-center">Dashboard de Administrador</h1>
        <div class="row">
            <!-- Sección de usuarios -->
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Total de Usuarios</h4>
                    </div>
                    <div class="card-body">
                        <table class="table_cont">
                            <thead>
                                <tr>
                                    <th>Tipo de Usuario</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Total</td>
                                    <td>{{ $totalUsers }}</td>
                                </tr>
                                <tr>
                                    <td>Usuarios Normales</td>
                                    <td>{{ $totalNormalUsers }}</td>
                                </tr>
                                <tr>
                                    <td>Administradores</td>
                                    <td>{{ $totalAdmins }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sección de reservas -->
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Reservas</h4>
                    </div>
                    <div class="card-body">
                        <table class="table_cont">
                            <thead>
                                <tr>
                                    <th>Estado</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Reservas Pendientes</td>
                                    <td>{{ $reservasPendientes }}</td>
                                </tr>
                                <tr>
                                    <td>Reservas Completadas</td>
                                    <td>{{ $reservasCompletadas }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer></x-footer>
</div>

@endsection
