<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Usuario;
use App\Marcacoe;
use App\Cliente;
use Illuminate\Support\Facades\DB;
class MarcacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all();

        $usuarioDado = ['nome' => $dados['nome'], 'email' => $dados['email'], 'telefone' => $dados['telefone']];
        $usuario = Usuario::create($usuarioDado);

        $tipoValor = explode(";", $dados['tipo']);
        $valor = $tipoValor[1];
        $tipo = $tipoValor[0];
        $dataSplit = explode("-", $dados['data']);
        $data =  $dataSplit[2]."/".$dataSplit[1]."/".$dataSplit[0]." ". $dados['hora'];

        $marcacaoDados = ['usuario_id' => $usuario['id'], 'data_hora' => $data, 'quadra_tipo_id' => $tipo, 'valor' => $valor];
        
        $marcacao = Marcacoe::create($marcacaoDados);
        
        if ($marcacao) {
            $this->enviarEmail($tipo, $marcacao, $usuario['nome']);
            return redirect()->route('inicio')
                   ->with('status', 'Show! A quadra esta marcada!');
        } else {
            return redirect()->route('quadras.ver')
                   ->with('status', 'Opss... Quadra não marcada');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function enviarEmail($quadra_tipo_id, $marcacao, $nome){
        $proprietario = DB::table('clientes AS c')
                        ->join('quadras AS q', 'q.proprietario_id', '=', 'c.id')
                        ->join('quadras_tipos AS qt', 'qt.quadra_id', '=', 'q.id')
                        ->join('tipos AS t', 'qt.tipo_id', '=', 't.id')
                        ->where('qt.id', '=', $quadra_tipo_id)
                        ->select('c.*', 't.tipo', 'qt.valor')
                        ->get();
        
        Mail::send('mail.template', ['nome' => $nome,'marcacao' => $marcacao, 'quadra' => $proprietario[0]->tipo, 'valor' => $proprietario[0]->valor], function ($m) use ($proprietario){
            $m->from('marcandoquadras@gmail.com', 'Marcando!');
            $m->to($proprietario[0]->email)->subject('Quadra '. $proprietario[0]->tipo .' marcada!');
        });    
    }
    
}
