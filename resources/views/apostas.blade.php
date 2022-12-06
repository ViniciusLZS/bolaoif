@extends('layout.main')

@section('css')
<link rel="stylesheet" href="{{ url('assets/css/apostas.css') }}">
@endsection

@section('title', 'Apostas')
@php
    $page = 'apostas';
@endphp

@section('content')
    <div id="modal-aposta" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('apostas.update') }}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Aposta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div id="modal-aposta-content">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <section id="jogos">
        <div class="container pt-4 mt-5">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card my-3 flex-column align-items-center d-flex p-3">
                                <img src="{{ url('assets/img/perfil.png') }}" alt="Perfil" class="perfil">
                                <p class="text-center fs-3 mb-2">{{ Auth::user()->nome }}</p>
                                <p class="text-center fs-6">Número de apostas: {{ Auth::user()->apostas()->count() }}</p>
                                <p class="text-center fs-6 credito">Créditos: R${{ Auth::user()->credito }}</p>
                            </div>
                        </div>
                    </div>
                    <p class="titulo fs-4 mb-1 text-center fw-bold light-text">Minhas Apostas</p>
                    <div id="minhas-apostas" class="row p-3">
                        @forelse ($apostas as $aposta)
                            <div class="col-12">
                                <div class="card p-3 mb-3">
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
                                        <div class="d-flex flex-column">
                                            <a href="#" onclick="editar_aposta({{ $aposta }})"
                                                title="editar"><i class="bi bi-pencil-square"></i></a>
                                            <form id="form-deletar" action="{{route('apostas.destroy', [$aposta->id])}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="javascript:{}" onclick="document.getElementById('form-deletar').submit();" title="deletar"><i class="bi bi-trash"></i></a>
                                            </form>
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
                    <div class="row p-3">
                        @if ($errors->all())
                            @foreach ($errors->all() as $message)
                                <div class="col-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        @foreach ($jogos as $jogo)
                            <div class="col-12">
                                <div class="card p-3 mb-3">
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
                                                class="btn-apostar btn btn-light w-30 mx-auto">Apostar R${{env('VALOR_APOSTA')}},00</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        <div class="row px-3">
                            <div class="col-12 d-flex flex-column align-items-center">
                                {{ $jogos->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        const editar_aposta = (aposta) => {
            console.log("aposta", aposta);
            let content = `<div class="col-12">
                                <div class="card p-3 mb-3">
                                    <div class=" d-flex justify-content-evenly align-items-center h-100">
                                        <input type="hidden" name="id" value="${aposta.id}"/>
                                        <div class="time d-flex flex-column align-items-center">
                                            <img src='assets/img/bandeiras/${aposta.jogo.bandeira_1}'
                                                alt="${aposta.jogo.time_1 }">
                                            <span class="text-center fw-semibold">${aposta.jogo.time_1}</span>
                                        </div>

                                        <span class="fs-3 text-secondary text-center fw-bold">
                                            <input type="number" name="palpite_1" min="0"
                                                    value="${aposta.palpite_1}" style="width:50px">
                                                <span class="fs-3 text-secondary text-center fw-bold"> x </span>
                                                <input type="number" name="palpite_2" min="0"
                                                    value="${aposta.palpite_2}"   style="width:50px">
                                            </span>

                                        <div class="time d-flex flex-column align-items-center">
                                            <img src='assets/img/bandeiras/${aposta.jogo.bandeira_2 }'
                                                alt="${aposta.jogo.time_1}">
                                            <span class="text-center fw-semibold">${aposta.jogo.time_2}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
            $("#modal-aposta-content").html(content);
            $("#modal-aposta").modal("show");
        }
    </script>
@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>

