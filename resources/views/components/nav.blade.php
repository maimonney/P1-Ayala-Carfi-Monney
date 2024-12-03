<div>
    <nav class="navbar navbar-expand-lg cont_nav">
        <div class="container-fluid">
            <div class="cont_navegacion">
                <a class="navbar-brand" href="#">Nova</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                    <span class="navbar-toggler-icon"> </span>
                </button>
                <div class="collapse navbar-collapse" id="navMain">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <x-nav-link route="home"> Inicio </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link route="about"> Conocenos </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link route="contact"> Contacto </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link route="servicios.vista">Servicios</x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link route="blogs.vista">Blogs</x-nav-link>
                        </li>

                    </ul>

                </div>
            </div>
            <div>
                <ul class="navbar-nav">

                    @if (auth()->check())
                        <li class="nav-link nombre_nav">
                            Hola, <strong>
                                @if (auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.index') }}">{{ auth()->user()->name }}</a>
                                @else
                                    <a href="{{ route('perfil.user') }}">{{ auth()->user()->name }}</a>
                                @endif
                            </strong>!
                        </li>
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