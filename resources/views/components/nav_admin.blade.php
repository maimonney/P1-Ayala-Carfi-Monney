<div>
    <nav class="navbar navbar-expand-lg cont_nav">
        <div class="container-fluid">
            <div class="cont_navegacion">
                <a class="navbar-brand" href="{{ route('admin.index') }}">Nova</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                    <span class="navbar-toggler-icon"> </span>
                </button>
                <div class="collapse navbar-collapse" id="navMain">
                    <ul class="navbar-nav">
                        <li class="nav-link"><a href="{{ route('admin.services.index') }}">Servicios</a></li>
                        <li class="nav-link"><a href="{{ route('admin.users.index') }}">Usuarios</a></li>
                        <li class="nav-link"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
                        <li class="nav-link"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    </ul>

                </div>
            </div>
            <div>
                <ul class="navbar-nav">
                    <li class="nav-link nombre_nav"><a href="{{ route('home') }}">Inicio público</a></li>
                    @if (auth()->check())
                    <li class="nav-link nombre_nav">Hola, <strong>{{ auth()->user()->name }}</strong>!</li>
                    @endif
                    @auth
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="cerrar nav-link">Cerrar Sesión</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <x-nav-link route="login">Inicio de Sesión</x-nav-link>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
</div>