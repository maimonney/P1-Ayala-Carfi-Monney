@extends('layouts.main')

@section('title', 'Integración Mercado Pago')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-3">Integración Mercado Pago</h2>
            <table class="table table-bordered table-striped mb-3">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($servicios as $service)
                        <tr>
                            <td>{{ $service->title }}</td>
                            <td>${{ $service->price }}</td>
                            <td>1</td>
                            <td>${{ $service->price }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3"><b>TOTAL:</b></td>
                        <td><b>${{ $servicios->sum('price') }}</b></td>
                    </tr>
                </tbody>
            </table>

            <!-- Botón de Mercado Pago -->
            <div id="mercadopago-button"></div>

            <script src="https://sdk.mercadopago.com/js/v2"></script>
            <script>
                const mp = new MercadoPago('{{ $mpPublicKey }}');
                mp.bricks().create('wallet', 'mercadopago-button', {
                    initialization: {
                        preferenceId: '{{ $preference['id'] }}',
                    }
                });
            </script>
        </div>
    </div>
</div>

@endsection
