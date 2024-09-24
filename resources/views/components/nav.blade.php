<div>
    <nav class="navbar navbar-expand-lg bg-info-subtle">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle= "collapse" data-bs-target = "#navMain">
                <span class="navbar-toggler-icon"> </span>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav">
                    <li class="nav-item" >
                        <x-nav-link route="home"> Inicio </x-nav-link>

                    </li>
                    <li class="nav-item" >
                        <x-nav-link route="about"> Acerca de  </x-nav-link>
                    </li>
                    <li class="nav-item" >
                        <x-nav-link route="contact"> Contacto  </x-nav-link>
                    </li>
                    <li class="nav-item" >
                        <x-nav-link route="movies.index"> Peliculas </x-nav-link>
                    </li>
                </ul>

            </div>

        </div>
</div>
