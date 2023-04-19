<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoContato;

class TipoContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoContato = TipoContato::orderBy('id', 'DESC')->get();

        return view('tipo_contato/index', compact('tipoContato'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipo_contato/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Form validation
        $this->validate($request, [
            'descricao' => 'required',
        ]);
        
        //  Store data in database
        TipoContato::create($request->all());

        return redirect('tipocontato')->with('success', 'Novo Tipo Contato Cadastrado');
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
        $tipo = TipoContato::find($id);
        return view('tipo_contato/edit', compact('tipo'));
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
        // Form validation
        $this->validate($request, [
            'descricao' => 'required',
        ]);
        
        //  Store data in database
        $tipo = TipoContato::find($id);
        $tipo->descricao = $request->get('descricao');
        $tipo->prefixo = $request->get('prefixo');
        $tipo->save();

        return redirect('tipocontato')->with('success', 'Tipo Contato alterado');
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
