@extends('layout.main')

@section('css')
    <link rel="stylesheet" href="{{ url('assets/css/adicionarUsuario.css') }}">
@endsection

@section('title', 'Lista de usuários')
@php
    $page = 'Lista de usuários';
@endphp


@section('content')
  @auth
    @if (auth()->user()->admin === "admin")
      <section class="pt-4 mt-5">
        @foreach ($usuarios as $usuario)
          <div class="card">
            <div class="card-body">
              <p>Nome: <span>{{ $usuario->nome }}</span></p>
              <p>Email: {{ $usuario->email }}</p>
              <p>Quantidade de apostas: </p>
              <p>Criação:</p>
            </div>
          </div>
        @endforeach
      @endif
    </section>

  @endauth
@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
@endsection