@extends('adminlte::page')

@section('title', 'Registrar')

@section('content_header')
    <h1>Registrar quadras</h1>
@stop

@section('content')

    <form action="/admin/quadras" method="POST" >
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" placeholder="Nome da quadra">
        </div>
        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" class="form-control" id="telefone" placeholder="+55 XX XXXXX XXXX">
        </div>
        <div class="form-group">
            <label for="endereco">Endereço</label>
            <input type="text" class="form-control" id="endereco" placeholder="Av, Rua, Travessa...">
        </div>
        <div class="form-group">
        <label for="proprietario">Proprietário</label>
        <select class="form-control" id="proprietario">
            @foreach($clientes as $cliente)
                <option value='{{ $cliente->id }}'> {{  $cliente->nome }} </option>
            @endforeach
        </select>
        </div>
        <div class="form-group">
        <label for="tipos">Tipos de quadras</label>
        <select multiple class="form-control" id="tipos">
            @foreach($tipos as $tipo)
            <option value='{{ $tipo->id }}'> {{  $tipo->tipo }} </option>
            @endforeach
        </select>
        </div>
        <div class="form-group">
            <label for="foto">Imagem da quadra</label>
            <input type="file" name="foto" class="form-control" id="tipos">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
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