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
                    ->get();

        return view('admin/lista', ['quadras' => $quadras]);
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
        $dados = $request->all();
        unset($dados['_token']);
        $path = $request->file('imagem')->store('fotos', 'public');
        $dados['imagem'] = $path; 

        $resp = Quadra::create($dados);

        if ($resp) {
            return redirect()->route('quadras.index')
                   ->with('status', 'Ok! Quadra Inserida com Sucesso');
        } else {
            return redirect()->route('candidatas.store')
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
        foreach($tipos as $tipo){
            $data = ['quadra_id' => $resp->id, 'tipo_id' => $tipo, 'valor'=> 0];
            DB::table('quadras_tipos')->insert($data);
        }

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
}
