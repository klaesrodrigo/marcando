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

    @if ($acao == 1)
    <form method="post" action="{{ route('quadras.store') }}" enctype="multipart/form-data">

    @elseif ($acao == 2)
    <form method="post" action="{{ route('quadras.update', $reg->id) }}" enctype="multipart/form-data">
    {{ method_field('put') }} 

    @endif 
        {{ csrf_field() }}
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome da quadra">
        </div>
        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" class="form-control" name="telefone" id="telefone" placeholder="+55 XX XXXXX XXXX">
        </div>
        <div class="form-group">
            <label for="endereco">Endereço</label>
            <input type="text" class="form-control" name="endereco" id="endereco" placeholder="Av, Rua, Travessa...">
        </div>
        <div class="form-group">
        <label for="proprietario">Proprietário</label>
        <select class="form-control" name="proprietario_id" id="proprietario">
            @foreach($clientes as $cliente)
                <option value='{{ $cliente->id }}'> {{  $cliente->nome }} </option>
            @endforeach
        </select>
        </div>
        <div class="form-group">
        <label for="tipos">Tipos de quadras</label>
        <select multiple class="form-control" name="tipos[]" id="tipos">
            @foreach($tipos as $tipo)
            <option value='{{ $tipo->id }}'> {{  $tipo->tipo }} </option>
            @endforeach
        </select>
        </div>
        <div class="form-group">
            <label for="foto">Imagem da quadra</label>
            <input type="file" name="imagem" class="form-control" id="imagem">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" name="descricao" id="exampleFormControlTextarea1" rows="4"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Registar</button>
        </div>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop