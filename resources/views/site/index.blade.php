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
      <th>Nome da Candidata</th>
      <th>Clube</th>
      <th>Foto</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>
@endsection