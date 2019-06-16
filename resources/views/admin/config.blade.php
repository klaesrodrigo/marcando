@extends('adminlte::page')

@section('title', 'Registrar')

@section('content_header')
    @if(!isset($acao))
    <h1>Configurar quadra</h1>
    @else
    <h1>Atualizar quadra</h1>
    @endif
@stop

@section('content')
    @if(!isset($acao))
    <form method="post" action="{{ route('quadras.insereTipo', [$quadra[0]->id,$quadra[0]->cid]) }}" enctype="multipart/form-data">
    @else
    <form method="post" action="{{ route('quadras.tipoUpdate', [$quadra[0]->qaid,$quadra[0]->id,$quadra[0]->cid]) }}" enctype="multipart/form-data">
            {{ method_field('put') }} 
    @endif
        {{ csrf_field() }}
            <input type="hidden" class="form-control" name="quadra_id" id="quadra_id" value="{{ $quadra[0]->id }}">
            <input type="hidden" class="form-control" name="cid" id="cid" value="{{ $quadra[0]->cid }}">
        <div class="form-group">
        <label for="proprietario">Tipo da quadra</label>
        <select class="form-control" name="tipo_id" id="proprietario">
            <option value="">Selecione o tipo da quadra...</option>
            @foreach($tipos as $tipo)
            @if(!isset($acao))
            <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
            @else
            <option {{ $tipo->id == $quadra[0]->tipo_id ? "selected" : null}} value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
            @endif
            @endforeach
        </select>
        </div>
        <div class="form-group">
            <label for="telefone">Valor</label>
            <input type="text" class="form-control" name="valor" id="valor" value="{{$quadra[0]->valor or old('valor')}}" placeholder="R$">
        </div>
        <div class="form-group">
                <button type="submit" class="btn btn-primary">Enviar</button>
          </div>
    </form>
    @if(!isset($acao))
    <table class="table table-hover">
        <thead>
            <tr>
            <th>Tipo</th>
            <th>Valor</th>
            <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        
            @foreach ($quadrasTipos as $quadraTipo)
            <tr class="d-flex align-items-middle">
            <td> {{ $quadraTipo->tipo }} </td>
            <td id="preco"> R$ {{ number_format($quadraTipo->valor,2,',','.') }} </td>
            <td> <a href="{{ route('quadras.tipoEdit', $quadraTipo->id) }}" class="btn btn-info btn-sm" role="button">Alterar</a>&nbsp;
                <form method="post" action="{{ route('quadras.tipoDestroy', [$quadraTipo->id,  $quadra[0]->cid])}}" style="display: inline-block" onsubmit="return confirm('Confirma Exclusão desta Candidata?')">          
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <input type="submit" class="btn btn-danger btn-sm" value="Excluir">
                </form>
            </td>
            </tr>
        
            @endforeach
        
        </tbody>
    </table>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop