@extends('layout.main')

@section('css')
    <link rel="stylesheet" href="{{ url('assets/css/listaUsuarios.css') }}">
@endsection

@section('title', 'Configurações')
@php
    $page = 'Configurações';
@endphp


@section('content')
  <div id="modal-aposta" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('config.update') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Usuario</h5>
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
  <div class="erro">
   
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
    @if (session('sucess'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('sucess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif
  </div>
  @auth
      <section class="container pt-4 mt-5">
        <table class="table">
          <thead>
            <tr class="text-center">
              <th scope="col">id</th>
              <th scope="col">Nome</th>
              <th scope="col">Email</th>
              <th scope="col">Qtd. de apostas</th>
              <th scope="col">Criação</th>
            </tr>
          </thead>
          
              <tbody >
                <tr class="text-center ">
                  <th scope="row">{{ Auth::user()->id }}</th>
                  <td>{{ Auth::user()->nome }}</td>
                  <td>{{ Auth::user()->email}}</td>

                  <td>{{ Auth::user()->apostas()->count() }}</td>


                  <td class="align-middle"><a href="#" onclick="editar_aposta({{ Auth::user() }})"title="editar"><i class="bi bi-pencil-square"></i></a></td>

                  <td class="align-middle">
                    <form class="d-flex justify-content-center" id="form-deletar" action="{{route('configuracao.destroy', Auth::user()->id )}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-link" type="submit"><i class="bi bi-trash"></i></button>
                    </form>
                  </td>
                </tr>
              </tbody>
          
          </table>  
      </section>
  @endauth
@endsection
@section('script')
    <script>
        const editar_aposta = (usuario) => {
            let content = `<div class="col-12">
                              <input type="hidden" name="id" value="${usuario.id}"/>
                              <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nome</label>
                                <input type="text" value="${usuario.nome}" name="nome" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                              </div>

                              <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">E-mail</label>
                                <input type="email" value="${usuario.email}" name="email" class="form-control" id="exampleInputEmail1"
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
                            `;
            $("#modal-aposta-content").html(content);
            $("#modal-aposta").modal("show");
        }
    </script>
@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>