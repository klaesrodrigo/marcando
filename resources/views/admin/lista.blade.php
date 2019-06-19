@extends('adminlte::page')

@section('title', 'Registrar')

@section('content_header')
    <h1>Lista de quadras</h1>
@stop

@section('content')
<div class="row">
    <div class="col-sm-2">
      <a href="{{ route('quadras.create') }}" class="btn btn-primary btn-sm" style="margin-top:24px" role="button">Nova</a>
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
        <th>Proprietário</th>
        <th>Endereço</th>
        <th>Foto</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
  
      @foreach ($quadras as $quadra)
      <tr class="d-flex align-items-middle">
        <td> {{ $quadra->nome }} </td>
        <td> {{ $quadra->cliente }} </td>
        <td> {{ $quadra->endereco }} </td>
        <td> <img src="{{ asset('storage/'.$quadra->imagem)}}" style='width: 120px; height: 80px;'> </td>
        @if($acao == 1)
        <td> <a href="{{ route('quadras.edit', $quadra->id) }}" class="btn btn-info btn-sm" role="button">Alterar</a>&nbsp;
          <a href="{{ route('quadras.show', $quadra->id) }}" class="btn btn-success btn-sm" role="button">Consultar</a>&nbsp;
          <form method="post" action="{{ route('quadras.destroy', $quadra->id)}}" style="display: inline-block" onsubmit="return confirm('Confirma Exclusão desta Quadra?')">          
            {{ method_field('delete') }}
            {{ csrf_field() }}
            <input type="submit" class="btn btn-danger btn-sm" value="Excluir">
          </form>
        </td>
        @else
        <td>
            {{-- <button name="quadra_id" type="submit" class="btn btn-info btn-sm" value="{{ $quadra->id }}">Configurar</button> --}}
            <a href="{{ route('quadras.config', [$quadra->id,$quadra->cid]) }}" class="btn btn-primary btn-sm" role="button">Configurar</a>&nbsp;
            <a href="{{ route('marcacao.index', [$quadra->id])}}" class="btn btn-info btn-sm" role="button">Marcações</a>&nbsp;
        </td>
        @endif
      </tr>
  
      @endforeach
  
    </tbody>
  </table>
  {{ $quadras->links() }}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop