@extends('modelo') 
@section('conteudo')

<div class="row">
    <div class="col-md-5">
        <img src="{{ asset('storage/'.$quadra->imagem)}}" style='width: 100%;'>
    </div>
    <div class="col-md-6">
        <h2><b>{{ $quadra->nome }}</b></h2>
        <h4>Fone: <b>{{ $quadra->telefone }}</b></h4>
        <h4>Endereço: <b>{{ $quadra->endereco }}</b></h4>
        <p>Descrição: <b>{{ $quadra->descricao }}</b></p>
        <br />
        <h4>Tipos de quadras disponíveis</h4>    
        <ul>
            @foreach($tipos as $tipo)
                <li>{{ $tipo->tipo }} - R$ {{ number_format($tipo->valor,2,',','.') }}</li>
            @endforeach
        </ul>   
    </div>
</div>
<hr>
@if (session('status'))
  <div class="alert alert-success">
    {{ session('status') }}
  </div>
  @endif
<div class="container" style="padding: 25px;">

        <form method="post" action="{{ route('marcacoes.store') }}" enctype="multipart/form-data">
    
            {{ csrf_field() }}
            <div class="form-group">
                <label for="nome">Nome</label>
                <input  type="text" class="form-control" name="nome" id="nome" value="{{old('nome')}}" placeholder="Nome Completo">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input  type="text" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="E-mail">
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" name="telefone" id="telefone" value="{{old('telefone')}}" placeholder="XX XXXXX XXXX">
            </div>
            <div class="form-group">
                <label for="telefone">Data</label>
                <input type="date" class="form-control" name="data" id="data" value="{{old('data')}}">
            </div>
            <div class="form-group">
                <label for="telefone">Hora</label>
                <select name="hora" id="hora">
                    <option value="15:00">15:00</option>
                    <option value="16:00">16:00</option>
                    <option value="17:00">17:00</option>
                    <option value="18:00">18:00</option>
                    <option value="19:00">19:00</option>
                    <option value="20:00">20:00</option>
                    <option value="21:00">21:00</option>
                    <option value="22:00">22:00</option>
                    <option value="23:00">23:00</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tipo">Escolha a quadra</label>
                    <select name="tipo" id="tipo">
                        @foreach($tipos as $tipo)
                        <option value="{{ $tipo->id . ";" . $tipo->valor }}">{{ $tipo->tipo }} - R$ {{ number_format($tipo->valor,2,',','.') }}</option>
                        @endforeach
                    </select>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <a href="{{ url()->previous() }}" class="btn btn-warning" role="button">Voltar</a>
            </div>
        </form>

</div>
@endsection