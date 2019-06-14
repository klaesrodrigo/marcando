<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cliente;
use App\Quadra;
use App\Tipo;

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
        // var_dump($clientes);
        // die();
        return view('admin/registrar', ['clientes' => $clientes, 'tipos' => $tipos]);
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
        unset($dados['tipos']);
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
}
