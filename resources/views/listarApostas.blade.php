@extends('layout.main')

@section('css')
    <link rel="stylesheet" href="{{ url('assets/css/listaJogos.css') }}">
@endsection

@section('title', 'Lista de Apostas')
@php
    $page = 'Lista de Apostas';
@endphp


@section('content')
  <div id="modal-aposta" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('listarAposta.update') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Apostas do usuário</h5>
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
    @if (auth()->user()->admin === "admin")
      <section class="container pt-4 mt-5 d-flex flex-column align-items-center">
        <h1 class="m-5">Apostas {{$id}}</h1>
        @foreach ($jogos as $jogo)
          @if ($jogo->id == $id)
            <div class="d-flex mb-5 gap-5">
              <div class="d-flex flex-column align-items-center">
                <div>
                  <img src='{{ url('assets/img/bandeiras/') . '/' . $jogo->bandeira_1 }}'>
                </div>
                {{ $jogo->time_1 }}
              </div>

              <div class="d-flex flex-column align-items-center">
                <div>
                  <img src='{{ url('assets/img/bandeiras/') . '/' . $jogo->bandeira_2 }}'>
                </div>
                {{ $jogo->time_2 }}
              </div>
            </div>
          @endif
        @endforeach
        <table class="table">
          <thead>
            <tr class="text-center">
              <th scope="col">id</th>
              <th scope="col">Nome do usuário</th>
              <th scope="col">Palpite 1</th>
              <th scope="col">Palpite 2</th>
  
              <th scope="col">Realização da aposta</th>
            </tr>
          </thead>
          @foreach ($apostas as $aposta)
              <tbody >
                @if ($aposta->jogo_id == $id)
                  <tr class="text-center ">
                    <th scope="row" class="align-middle">{{ $aposta->id }}</th>
                    @foreach ($usuarios as $usuario)
                      @if ($usuario->id == $aposta->user_id)
                        <td class="align-middle">{{$usuario->nome}}</td>
                      @endif
                    @endforeach
                    
                    <td class="align-middle">{{$aposta->palpite_1}}</td>

                    <td class="align-middle">{{$aposta->palpite_2}}</td>

                    <td class="align-middle">{{$aposta->created_at}}</td>

               
                    <td class="align-middle"><a href="#" onclick="editar_aposta({{ $aposta }})"title="editar"><i class="bi bi-pencil-square"></i></a></td>

                    <td class="align-middle">
                      <form class="d-flex justify-content-center" id="form-deletar" action="{{route('listarApostas.destroy', $aposta->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-link" type="submit"><i class="bi bi-trash"></i></button>
                      </form>
                    </td>
                  </tr>
                @endif
              </tbody>
          @endforeach
          </table>  
      </section>
    @endif
  @endauth
@endsection
@section('script')
    <script>
        const editar_aposta = (aposta) => {
            let content = `<div class="col-12">
                              <input type="hidden" name="id" value="${aposta.id}"/>
                              

                              <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Palpite 1</label>
                                <input type="number" min="0" value="${aposta.palpite_1}" name="palpite_1" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                              </div>


                              <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Palpite 2</label>
                                <input type="number" min="0" value="${aposta.palpite_2}" name="palpite_2" class="form-control" id="exampleInputEmail1"
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