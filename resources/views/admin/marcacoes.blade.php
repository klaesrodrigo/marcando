@extends('adminlte::page')

@section('title', 'Registrar')

@section('content_header')
    <h1>Lista de marcações</h1>
@stop

@section('content')
  
  @if (session('status'))
  <div class="alert alert-success">
    {{ session('status') }}
  </div>
  @endif
<h2>{{ $marcacoes[0]->quadra}}</h2>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Telefone</th>
        <th>Data</th>
        <th>tipo</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
  
      @foreach ($marcacoes as $marcacao)
      <tr class="d-flex align-items-middle">
        <td> {{ $marcacao->nome }} </td>
        <td> {{ $marcacao->email }} </td>
        <td> {{ $marcacao->telefone }} </td>
        <td> {{ $marcacao->data }} </td>
        <td> {{ $marcacao->tipo }} </td>
        <td> 
          <form method="post" action="{{ route('marcacao.destroy', $marcacao->id)}}" style="display: inline-block" onsubmit="return confirm('Confirma Exclusão deste agendamento??')">          
            {{ method_field('delete') }}
            {{ csrf_field() }}
            <input type="submit" class="btn btn-danger btn-sm" value="Excluir">
          </form>
        </td>
      </tr>
  
      @endforeach
  
    </tbody>
  </table>
  {{ $marcacoes->links() }}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop