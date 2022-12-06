@extends('layout.main')

@section('css')
    <link rel="stylesheet" href="{{ url('assets/css/adicionarUsuario.css') }}">
@endsection

@section('title', 'Adicionar usuário')
@php
    $page = 'Adicionar usuário';
@endphp


@section('content')
  @auth
    @if (auth()->user()->admin === "admin")
      <div id="formAdicionar" class="d-flex justify-content-center pt-4 mt-5">
        <div class="col-12 col-md-6">
            <div class="p-5">
                <form action="{{ route('cadastrar') }}" method="POST">
                    <div class="d-flex flex-column align-items-center">
                        <p class="fs-3">Cadastrar</p>
                        @csrf
                        <div class="col-12">
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
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
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
  @endauth
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
@endsection