@extends('adminlte::page')

@section('title', 'Registrar')

@section('content_header')
    @if ($acao == 1)
    <h1>Registrar quadras</h1>
    @elseif ($acao == 2)
    <h3>Alteração de quadras</h3>
    @else
    <h3>Consulta de quadras</h3>
    @endif 
@stop

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    @if ($acao == 1)
    <form method="post" action="{{ route('quadras.store') }}" enctype="multipart/form-data">

    @elseif ($acao == 2)
    <form method="post" action="{{ route('quadras.update', $quadra->id) }}" enctype="multipart/form-data">
    {{ method_field('put') }} 

    @endif 
        {{ csrf_field() }}
        <div class="form-group">
            <label for="nome">Nome</label>
            <input {{ $acao == 3 ? "disabled" : null }} type="text" class="form-control" name="nome" id="nome" value="{{$quadra->nome or old('nome')}}" placeholder="Nome da quadra">
        </div>
        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input {{ $acao == 3 ? "disabled" : null }} type="text" class="form-control" name="telefone" id="telefone" value="{{$quadra->telefone or old('telefone')}}" placeholder="XX XXXXX XXXX">
        </div>
        <div class="form-group">
            <label for="endereco">Endereço</label>
            <input {{ $acao == 3 ? "disabled" : null }} type="text" class="form-control" name="endereco" id="endereco" value="{{$quadra->endereco or old('endereco')}}" placeholder="Av, Rua, Travessa...">
        </div>
        <div class="form-group">
        <label for="proprietario">Proprietário</label>
        <select {{ $acao == 3 ? "disabled" : null }} class="form-control" name="proprietario_id" id="proprietario">
            @foreach($clientes as $cliente)
                @if(is_array($quadra))
                <option value='{{ $cliente->id }}'> {{  $cliente->nome }} </option>
                @else
                <option {{ $cliente->id == $quadra->proprietario_id ? "selected": null}} value='{{ $cliente->id }}'> {{  $cliente->nome }} </option>
                @endif
            @endforeach
        </select>
        </div>
        <div class="form-group">
            <label for="foto">Imagem da quadra</label>
            <input {{ $acao == 3 ? "disabled" : null }} type="file" name="imagem" class="form-control" id="imagem">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea {{ $acao == 3 ? "disabled" : null }} class="form-control" name="descricao" id="exampleFormControlTextarea1" value="" rows="4">{{$quadra->descricao or old('descricao')}}</textarea>
        </div>
        @if ($acao == 1 or $acao == 2)
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
        @else
        <div class="text-right">
            <a href="{{ url()->previous() }}" class="btn btn-success btn-sm" role="button">Voltar</a>
          </div>
          @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script src="/js/jquery.mask.min.js"></script>

<script>
  $(document).ready(function() {
    $('#telefone').mask('00 00000-0000', {reverse: true});
  });
</script>  
@stop