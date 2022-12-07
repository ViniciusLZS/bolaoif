@extends('layout.main')

@section('css')
    <link rel="stylesheet" href="{{ url('assets/css/welcome.css') }}">
@endsection

@section('title', 'Home page')
@php
    $page = 'welcome';
@endphp


@section('content')

    <div id="carouselExampleControls" class="carousel slide pt-4 mt-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ url('assets/img/banner1.webp') }}" class="d-block w-100" alt="banner 1">
            </div>
            <div class="carousel-item">
                <img src="{{ url('assets/img/banner2.jpg') }}" class="d-block w-100" alt="banner 2">
            </div>
            <div class="carousel-item">
                <img src="{{ url('assets/img/banner3.jpg') }}" class="d-block w-100" alt="banner 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <section>
        <div class="container p-3">
            @if (auth()->check())
                <div class="row">
                    <div class="col-12 d-flex flex-column justify-content-center">
                        <p class="text-center fs-1">Bem vindo, {{ Auth::user()->nome }}</p>
                        <p class="text-center fs-4">Faça a sua aposta!</p>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="p-5">
                            <form action="{{ route('login') }}" method="POST">
                                <p class="fs-3">Login</p>
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">E-mail</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                </div>
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </form>
                            @if ($errors->first('login'))
                                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                    {{ $errors->first('login') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="p-5">
                            <form action="{{ route('cadastrar') }}" method="POST">
                                <p class="fs-3">Cadastre-se</p>
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nome</label>
                                    <input type="text" name="nome" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">E-mail</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Senha</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Confirmar Senha</label>
                                    <input type="password" name="confirma_senha" class="form-control"
                                        id="exampleInputPassword1">
                                </div>
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </form>
                            @if ($errors->first('cadastro'))
                                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                    {{ $errors->first('cadastro') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('cadastro'))
                                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                    {{ session('cadastro') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>

    <section id="jogos">
        <div class="container p-5">
            <div class="row">
                @foreach ($jogos as $jogo)
                    <div class="col-xl-4 col-lg-6 col-md-12 d-flex justify-content-around align-items-center">
                        <div class="card p-3 m-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-around align-items-center h-100">
                                    <div class="time d-flex flex-column align-items-center">
                                        <img src='{{ url("assets/img/bandeiras/$jogo->bandeira_1") }}' alt="Tunísia">
                                        <span class="text-center fw-semibold">{{ $jogo->time_1 }}</span>
                                    </div>
                                    <span class="fs-3 text-secondary text-center fw-bold">7:00</span>
                                    <div class="time d-flex flex-column align-items-center">
                                        <img src='{{ url("assets/img/bandeiras/$jogo->bandeira_2") }}' alt="Austrália">
                                        <span class="text-center fw-semibold">{{ $jogo->time_2 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            @auth
                <div class="row mt-5">
                    <div class="col-12 d-flex justify-content-center">
                        <a class="btn btn-apostar apostar btn-light" href="{{ route('apostas') }}" role="button">
                            APOSTAR
                        </a>
                    </div>
                </div>
            @endauth

        </div>
    </section>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
@endsection
