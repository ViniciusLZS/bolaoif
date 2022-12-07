@extends('layout.main')

@section('css')
    <link rel="stylesheet" href="{{ url('assets/css/listaJogos.css') }}">
@endsection

@section('title', 'Lista de Jogos')
@php
    $page = 'Lista de Jogos';
@endphp


@section('content')
  <div id="modal-aposta" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('listaJogos.update') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Apostas</h5>
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
  <div class="position-fixed top-20 start-0">
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
    @if (auth()->user()->admin === "admin")
      <section class="container pt-4 mt-5">
        <h1 class="m-5">Lista de jogos</h1>
        <table class="table">
          <thead>
            <tr class="text-center">
              <th scope="col">id</th>
              <th scope="col">Time</th>
              <th scope="col">Time</th>
              <th scope="col">Placar</th>
              <th scope="col">Qtd. de apostas</th>
              <th scope="col">Criação da aposta</th>
              <th scope="col">Lista de Aposta</th>
              <th scope="col">Editar</th>
              <th scope="col">Deletar</th>
            </tr>
          </thead>
          @foreach ($jogos as $jogo)
              <tbody >
                <tr class="text-center ">
                  <th scope="row" class="align-middle">{{ $jogo->id }}</th>
                  <td>
                    <div>
                      <img src='{{ url('assets/img/bandeiras/') . '/' . $jogo->bandeira_1 }}'>
                    </div>
                    {{ $jogo->time_1 }}
                  </td>

                  <td>
                    <div>
                      <img src='{{ url('assets/img/bandeiras/') . '/' . $jogo->bandeira_2 }}'>
                    </div>
                    {{ $jogo->time_2 }}
                  </td>

                  <td class="align-middle">{{ $jogo->placar_1 }} x {{ $jogo->placar_2 }}</td>

                  <td class="align-middle">{{ $jogo->apostas()->count() }}</td>

                  <td class="align-middle">{{ $jogo->created_at }}</td>

                  <td class="align-middle">
                    <form class="d-flex justify-content-center" id="form-deletar" action="{{route('listarApostas.edit', $jogo->id)}}" method="GET">
                      @csrf
                      <button class="btn btn-link" type="submit"><i class="bi bi-list-check"></i></i></button>
                    </form>
                  </td>

                  <td class="align-middle"><a href="#" onclick="editar_aposta({{ $jogo }})"title="editar"><i class="bi bi-pencil-square"></i></a></td>

                  <td class="align-middle">
                    <form class="d-flex justify-content-center" id="form-deletar" action="{{route('listaUsuario.destroy', $jogo->id)}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-link" type="submit"><i class="bi bi-trash"></i></button>
                    </form>
                  </td>
                </tr>
              </tbody>
          @endforeach
          </table>  
      </section>
    @endif
  @endauth
@endsection
@section('script')
    <script>
        const editar_aposta = (jogo) => {
            let content = `<div class="col-12">
                              <input type="hidden" name="id" value="${jogo.id}"/>
                              <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Time 1</label>
                                <input type="text" value="${jogo.time_1}" name="time_1" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                              </div>

                              <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Time 2</label>
                                <input type="text" value="${jogo.time_2}" name="time_2" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                              </div>


                              <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Bandeira 1</label>
                                <input type="text" value="${jogo.bandeira_1}" name="bandeira_1" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                              </div>

                              <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Bandeira 2</label>
                                <input type="text" value="${jogo.bandeira_2}" name="bandeira_2" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                              </div>


                              <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">placar 1</label>
                                <input type="text" value="${jogo.placar_1}" name="placar_1" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                              </div>

                              <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Placar 2</label>
                                <input type="text" value="${jogo.placar_2}" name="placar_2" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
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