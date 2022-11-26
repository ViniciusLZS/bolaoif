<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ url('assets/css/apostas.css') }}">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
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
                        <a class="nav-link active" aria-current="page" href="{{ route('welcome') }}">Home</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('apostas') }}">Minhas Apostas</a>
                        </li>
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


    <section id="jogos">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card my-3 flex-column align-items-center d-flex p-3">
                                <img src="{{ url('assets/img/perfil.png') }}" alt="Perfil" class="perfil">
                                <p class="text-center fs-3 mb-2">{{ Auth::user()->nome }}</p>
                                <p class="text-center fs-6">Número de apostas: 5</p>
                            </div>
                        </div>
                    </div>
                    <p class="titulo fs-4 mb-1 text-center fw-bold light-text">Minhas Apostas</p>
                    <div id="minhas-apostas" class="row">
                        @forelse ($apostas as $aposta)
                            <div class="col-12 mb-3">
                                <div class="card p-3">
                                    <div class=" d-flex justify-content-evenly align-items-center h-100">
                                        <div class="time d-flex flex-column align-items-center">
                                            <img src='{{ url('assets/img/bandeiras/') . '/' . $aposta->jogo->bandeira_1 }}'
                                                alt="{{ $aposta->jogo->time_1 }}">
                                            <span class="text-center fw-semibold">{{ $aposta->jogo->time_1 }}</span>
                                        </div>

                                        <span class="fs-3 text-secondary text-center fw-bold"><span
                                                class="palpite">{{ $aposta->palpite_1 }}</span>x<span
                                                class="palpite">{{ $aposta->palpite_2 }}</span></span>

                                        <div class="time d-flex flex-column align-items-center">
                                            <img src='{{ url('assets/img/bandeiras/') . '/' . $aposta->jogo->bandeira_2 }}'
                                                alt="{{ $aposta->jogo->time_1 }}">
                                            <span class="text-center fw-semibold">{{ $aposta->jogo->time_2 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center fs-6">Nenhuma aposta realizada.</p>
                        @endforelse
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="row">
                        @foreach ($jogos as $jogo)
                            <div class="col-12">
                                <div class="card p-3 m-3">
                                    <form action="{{ route('apostas.store') }}" method="POST">
                                        <div class="card-body d-flex flex-column justify-content-center">
                                            @csrf
                                            <div class="d-flex justify-content-evenly align-items-center h-100">
                                                <div class="time d-flex flex-column align-items-center">
                                                    <img src='{{ url("assets/img/bandeiras/$jogo->bandeira_1") }}'
                                                        alt="Tunísia">
                                                    <span class="text-center fw-semibold">{{ $jogo->time_1 }}</span>
                                                </div>
                                                <input type="hidden" name="id" value="{{ $jogo->id }}">
                                                <input type="number" name="palpite_1" min="0"
                                                    value="{{ $jogo->palpite_1 ?? '' }}">
                                                <span class="fs-3 text-secondary text-center fw-bold">7:00</span>
                                                <input type="number" name="palpite_2" min="0"
                                                    value="{{ $jogo->palpite_2 ?? '' }}">
                                                <div class="time d-flex flex-column align-items-center">
                                                    <img src='{{ url("assets/img/bandeiras/$jogo->bandeira_2") }}'
                                                        alt="Austrália">
                                                    <span class="text-center fw-semibold">{{ $jogo->time_2 }}</span>
                                                </div>
                                            </div>
                                            <button type="submit"
                                                class="btn-apostar btn btn-primary w-30 mx-auto">Apostar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="rodape">
        <div class="row h-100">
            <div class="col-12 d-flex flex-column justify-content-center">
                <p class="text-center">Desenvolvido pelo IF - {{ date('Y') }}</p>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
