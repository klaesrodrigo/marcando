<div class="container-fluid">
    <h4 style="text-align: center">Revenda Herbie</h4>
    <h5 style="text-align: center">Relatório de Veículos Cadastrados</h5>
   <table class="table table-bordered table-sm">
        <thead class="thead-light">
            <tr><th>Nome</th>
                <th>Proprietário</th>
                <th>Telefone</th>
                <th>Valor total de agendamentos R$:</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
        @foreach($quadras as $q)
        <tr><td>{{$q->nome}}</td>
            <td>{{$q->proprietario}}</td>
            <td style="text-align: center">{{$q->telefone}}</td>
            <td style="text-align: right">R$ {{number_format($q->sum, 2, ',', '.')}}</td>
            <td style="text-align: center">
            <img src="{{public_path('storage/'.$q->imagem)}}" style="width:100px;height:60px">
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
   </div>