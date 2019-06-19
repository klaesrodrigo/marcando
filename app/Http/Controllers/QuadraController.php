<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cliente;
use App\Quadra;
use App\Tipo;
use App\Qudras_tipo;

class QuadraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quadras = DB::table('quadras')
                    ->join('clientes', 'clientes.id', '=', 'quadras.proprietario_id')
                    ->select('quadras.*', 'clientes.nome AS cliente')
                    ->paginate(1);

        return view('admin/lista', ['quadras' => $quadras, 'acao' => 1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
       
        $clientes = Cliente::get();
        $tipos = Tipo::get();
        $quadra = [];
        // var_dump($clientes);
        // die();
        return view('admin/registrar', ['quadra'=>[], 'clientes' => $clientes, 'tipos' => $tipos, 'acao' => 1]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|min:2|max:50',
            'telefone' => 'required',
            'descricao' => 'required|min:10|max:150',
        ]);
        $dados = $request->all();
        unset($dados['_token']);
        $path = $request->file('imagem')->store('fotos', 'public');
        $dados['imagem'] = $path; 

        $resp = Quadra::create($dados);

        if ($resp) {
            return redirect()->route('quadras.index')
                   ->with('status', 'Ok! Quadra Inserida com Sucesso');
        } else {
            return redirect()->route('quadras.store')
                   ->with('status', 'Erro... Quadra Não Inserida...');
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
        $clientes = Cliente::get();
        $quadra = Quadra::find($id);
        return view('admin/registrar', ['quadra'=> $quadra, 'clientes' => $clientes, 'acao' => 3]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clientes = Cliente::get();
        $quadra = Quadra::find($id);
        return view('admin/registrar', ['quadra'=> $quadra, 'clientes' => $clientes, 'acao' => 2]);
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
        $dados = $request->all();
        // unset($dados['_token']);
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {

            if (Storage::exists($reg->foto)) {
                Storage::delete($reg->foto);
            }

            $path = $request->file('foto')->store('fotos');
            
            $dados['foto'] = $path;
        }
        $path = $request->file('imagem')->store('fotos', 'public');
        $dados['imagem'] = $path; 

        $resp = Quadra::create($dados);
        

        if ($resp) {
            return redirect()->route('quadras.index')
                   ->with('status', 'Ok! Quadra Inserida com Sucesso');
        } else {
            return redirect()->route('quadras.store')
                   ->with('status', 'Erro... Quadra Não Inserida...');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $quadra = Quadra::find($id);
        if ($quadra->delete()) {
            return redirect()->route('quadras.index')
                            ->with('status', $quadra->nome . ' Excluído!');
        } else {
            return redirect()->route('quadras.index')
                            ->with('status', 'Erro ao excluir!');
        }
    }

    public function listaQuadra(){
        $quadras = DB::table('quadras')
                    ->join('clientes', 'clientes.id', '=', 'quadras.proprietario_id')
                    ->select('quadras.*', 'clientes.nome AS cliente', 'clientes.id AS cid')
                    ->paginate(5);

        return view('admin/lista', ['quadras' => $quadras, 'acao' => 2]);
    }

    public function configuraQuadra($id, $cid){
        
        $quadrasTipos = DB::table('quadras_tipos AS qa')
                    ->join('tipos AS t', 't.id', '=', 'qa.tipo_id')
                    ->join('quadras AS q', 'q.id', '=', 'qa.quadra_id')
                    ->join('clientes AS c', 'c.id', '=', 'q.proprietario_id')
                    ->select('c.nome AS cliente', 'q.nome AS quadra', 't.tipo', 'qa.*')
                    ->where('qa.quadra_id', '=', $id)
                    ->where('q.proprietario_id', '=', $cid)
                    ->get();
        
        $quadra = DB::table('quadras')
                    ->join('clientes', 'clientes.id', '=', 'quadras.proprietario_id')
                    ->select('quadras.*', 'clientes.nome AS cliente', 'clientes.id AS cid')
                    ->where('quadras.id', '=', $id)
                    ->get();
        $tipos = Tipo::orderBy('tipo')->get();
        return view('admin/config', ['quadra' => $quadra, 'tipos' => $tipos, 'quadrasTipos' => $quadrasTipos]);
    }

    public function insereQuadraTipo(Request $request){
        $dados = $request->all();
        $cid = $dados['cid'];
        unset($dados['_token']);
        unset($dados['cid']);
        $resp = DB::table('quadras_tipos')->insert($dados);
        if ($resp) {
            return redirect()->route('quadras.config', [$dados['quadra_id'],$cid])
                   ->with('status', 'Ok! Quadra Inserida com Sucesso');
        } else {
            return redirect()->route('quadras.config', [$quadra[0]->id,$cid])
                   ->with('status', 'Erro... Quadra Não Inserida...');
        }
    }

    public function destroyQuadraTipo($id, $cid){
        $quadra = DB::table('quadras_tipos')->where('id', '=', $id)->get();
        if(DB::table('quadras_tipos')->where('id', '=', $id)->delete()){
            return redirect()->route('quadras.config', [$quadra[0]->quadra_id,$cid])
                   ->with('status', 'Ok! Quadra Inserida com Sucesso');
        } else {
            return redirect()->route('quadras.config', [$quadra[0]->id,$cid])
                ->with('status', 'Erro... Quadra Não Inserida...');
        }
    }

    public function editQuadraTipo($id){
        $quadra = DB::table('quadras_tipos AS qa')
        ->join('tipos AS t', 't.id', '=', 'qa.tipo_id')
        ->join('quadras AS q', 'q.id', '=', 'qa.quadra_id')
        ->join('clientes AS c', 'c.id', '=', 'q.proprietario_id')
        ->select('q.id', 'c.nome AS cliente', 'c.id AS cid', 'qa.id AS qaid', 'qa.valor', 'qa.tipo_id')
        ->where('qa.id', '=', $id)
        ->get();
        $tipos = Tipo::orderBy('tipo')->get();
        return view('admin/config', ['quadra' => $quadra, 'tipos' => $tipos, 'acao' => 1]);
    }

    public function updateQuadraTipo(Request $request, $qaid, $id, $cid ){
        $dados = $request->all();
        unset($dados['_token']);
        unset($dados['_method']);
        unset($dados['cid']);
        $resp = DB::table('quadras_tipos')
                    ->where('id', $qaid)
                    ->update($dados);
        if($resp){
            return redirect()->route('quadras.config', [$id,$cid])
                    ->with('status', 'Ok! Quadra Inserida com Sucesso');
        } else {
            return redirect()->route('quadras.config', [$id,$cid])
                ->with('status', 'Erro... Quadra Não Inserida...');
        }
    }

    public function listaQuadrasSite(){       
        $quadras = Quadra::orderBy('nome')->get();

        return view('site/index', ['quadras' => $quadras]);
    }

    public function ver($id){       
        $quadra = Quadra::find($id);
        $tipos = DB::table('tipos AS t')
                    ->join('quadras_tipos AS qt', function($join){
                        $join->on('qt.tipo_id', '=', 't.id');
                    })
                    ->where('qt.quadra_id', '=', $id)
                    ->select('t.tipo', 'qt.*')
                    ->get();
        return view('site/ver', ['quadra' => $quadra, 'tipos' => $tipos, 'acao' => 1]);
    }
}
