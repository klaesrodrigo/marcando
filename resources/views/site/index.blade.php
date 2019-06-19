@extends('modelo') 
@section('conteudo')

<div class="row">
  <div class="col-sm-10">
     <h2>Marcando!</h2>
     <h4>Plataforma para aluguel de quadras esportivas</h4>
  </div>  
</div>


@if (session('status'))
  <div class="alert alert-success">
    {{ session('status') }}
  </div>
  @endif
<table class="table table-hover">
  <thead>
    <tr>
      <th>Nome</th>
      <th>foto</th>
      <th>Descrição</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @forelse($quadras as $quadra)
    <tr>
      <td>{{ $quadra->nome }}</td>
      <td> <img src="{{ asset('storage/'.$quadra->imagem)}}" style='width: 120px; height: 80px;'> </td>
      <td>{{ $quadra->descricao }}</td>
      <td>
          <a href="{{ route('quadras.ver', [$quadra->id]) }}" class="btn btn-info btn-sm" role="button"><i class="fas fa-eye"></i></a>&nbsp;
      </td>
    </tr>
    @empty
    <p>Não há quadras cadastradas</p>
    @endforelse
  </tbody>
</table>
@endsection