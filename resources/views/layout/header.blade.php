<header>
    <nav class="navbar navbar-expand-lg bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Bolão do IF</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ $page == 'welcome' ? 'active' : ''}}" aria-current="page" href="{{ route('welcome') }}">Home</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ $page == 'apostas' ? 'active' : ''}}" href="{{ route('apostas') }}">Minhas Apostas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $page == 'config' ? 'active' : ''}}" href="{{ route('config') }}">Configurações</a>
                        </li>
                        @if (auth()->user()->admin === "admin")
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Usuários
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-light">
                                        <li><a class="dropdown-item" href="{{ route('adicionarUser') }}">Adicionar usuários</a></li>
                                        <li><a class="dropdown-item" href="{{ route('listarUsuario') }}">Listar usuários</a></li>
                                    </ul>
                                </li>
                            </ul>
                    
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Jogos
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-light">
                                        <li><a class="dropdown-item" href="{{ route('adicionarJogos') }}">Adicionar jogos</a></li>
                                        <li><a class="dropdown-item" href="{{ route('listarJogos') }}">Listar Jogos</a></li>
                                    </ul>
                                </li>
                            </ul>
                        @endif
                    @endauth
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                @auth
                    <form class="d-flex ms-3" action="{{ route('logout') }}" method="GET">
                        @csrf
                        <button class="btn btn-outline-success" type="submit">Sair</button>
                    </form>
                @endauth

            </div>
        </div>
    </nav>
</header>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>