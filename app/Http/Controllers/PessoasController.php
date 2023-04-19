<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\TipoContato;
use App\Models\Familia;
use App\Models\PessoaContato;
use Auth;

class PessoasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $pessoas = [];
        if($user->isAdmin())
            $pessoas = Pessoa::orderBy('id', 'DESC')->with('pessoa')->paginate(15);
        else
            $pessoas = Pessoa::where('user_id', $user->id)->orderBy('id', 'DESC')->with('pessoa')->paginate(15);

        return view('pessoas/index', compact('pessoas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pessoas = Pessoa::orderBy('id', 'DESC')->get();
        return view('pessoas/create', compact('pessoas'));
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
            'nome_completo' => 'required',
            'genero' => 'required',
            'adotivo' => 'required',  
            'vivo' => 'required'
        ]);

        $familia = Pessoa::find($request->pessoa_id);
        $request['familia_id'] = $familia->familia_id;
        
        //  Store data in database
        Pessoa::create($request->all());

        return redirect()->back()->with('success', 'Nova pessoa adicionada!'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePessoaRaiz(Request $request)
    {
        // Form validation
        $this->validate($request, [
            'nome_completo' => 'required',
            'genero' => 'required',
            'adotivo' => 'required',     
            'vivo' => 'required'
        ]);
        
        //  Store data in database
        $pessoa = Pessoa::create($request->all());

        return redirect()->route('criarnova', ['id' => $pessoa->id])->with('success', 'Nova pessoa adicionada!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDescendente($id)
    {
        $raiz = Pessoa::find($id);
        $pessoas = Pessoa::orderBy('id', 'DESC')->get();
        return view('pessoas/createDescendente', compact('pessoas','raiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDescendente(Request $request)
    {        
        // Form validation
        $this->validate($request, [
            'nome_completo' => 'required',
            'genero' => 'required',
            'adotivo' => 'required',   
            'vivo' => 'required'
        ]);
               
        //  Store data in database
        $p = Pessoa::create($request->all());
       
        $familia = Familia::find($p->familia_id);
        
        if($request->action == "addContato")
            return redirect('pessoas/adicionarContato/'.$p->id);

        return redirect('familia/'.$familia->slug.'#collapse'.$p->id);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adicionar($id)
    {
        $descendente = Pessoa::find($id);
        $pessoas = Pessoa::orderBy('id', 'DESC')->get();
        return view('pessoas/create', compact('pessoas','descendente'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        $pessoa = Pessoa::where('id',$id)->with('pessoa')->first();

        return view('pessoas/show', compact('pessoa'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showArvore($slug)
    {
        $pessoa = Pessoa::where('slug',$slug)->with('pessoa')->first();
        //dd($pessoa);
   
        return view('pessoas/show', compact('pessoa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pessoa = Pessoa::find($id);
        $pessoas = Pessoa::orderBy('id', 'DESC')->get();
        return view('pessoas.edit', compact('pessoa','pessoas'));
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
            'nome_completo' => 'required',
            'genero' => 'required',
            'adotivo' => 'required', 
            'vivo' => 'required'
        ]);
        //usuário logado
        $user = Auth::user();
        //busca pessoa a ser atualizada
        $pessoa = Pessoa::find($id);

        //verifica se o usuário logado pode atualizar a pessoa
        if($user->tipo==='1' || $pessoa->user_id == $user->id){
        
            // Update data in database            
            $pessoa->nome_completo = $request->nome_completo;
            $pessoa->genero = $request->genero;
            $pessoa->adotivo = $request->adotivo;
            $pessoa->pai_mae = $request->pai_mae;
            $pessoa->vivo = $request->vivo;
            $pessoa->nasc_dia = $request->nasc_dia;
            $pessoa->nasc_mes = $request->nasc_mes;
            $pessoa->nasc_ano = $request->nasc_ano;
            $pessoa->nasc_local = $request->nasc_local; 
            $pessoa->nasc_latitude = $request->nasc_latitude; 
            $pessoa->nasc_longitude = $request->nasc_longitude; 
            $pessoa->obt_dia = $request->obt_dia;
            $pessoa->obt_mes = $request->obt_mes;
            $pessoa->obt_ano = $request->obt_ano;
            $pessoa->obt_local = $request->obt_local;
            $pessoa->obt_latitude = $request->obt_latitude; 
            $pessoa->obt_longitude = $request->obt_longitude; 
            $pessoa->observacoes = $request->observacoes;
            $pessoa->slug = \Str::slug($request->get('nome_completo'));
            $pessoa->save();

            return redirect('familia/'.$pessoa->familia->slug.'#collapse'.$pessoa->id);
        }else{
            return redirect()->back()->with('error', 'Você não está autorizado a editar essa Pessoa');
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
        //usuário logado
        $user = Auth::user();
        //busca pessoa a ser atualizada
        $pessoa = Pessoa::find($id);

        //verifica se o usuário logado pode atualizar a pessoa
        if($user->tipo==='1' || $pessoa->user_id == $user->id){
            $pessoa = Pessoa::find($id);
            if($pessoa->filhos()->count() > 0)
                return redirect()->back()->with('error', 'Essa pessoa não pode ser excluída da árvore, pois ela possui descendentes.'); 
            
            if($pessoa->raiz())
                return redirect()->back()->with('error', 'Essa pessoa não pode ser excluída da árvore, pois ela é a primeira da família.'); 
            
            $pessoa->delete();         
            return redirect()->back()->with('success', 'Pessoa deletada da árvore.'); 
        }else{
            return redirect()->back()->with('error', 'Você não tem permissão para excluir essa pessoa.'); 
        }
         
    }

    //ADICIONAR CONTATO A PESSOA

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showContato($id)
    {        
        $pessoa = Pessoa::where('id',$id)->with('contatos')->first();
        //dd($pessoa->contatos());
       
        return view('pessoas/contato/index', compact('pessoa'));
    }

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adicionarContato($id)
    {
        $pessoa = Pessoa::find($id);
        $tipoContato = TipoContato::all();
        return view('pessoas/contato/create', compact('pessoa','tipoContato'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeContato(Request $request)
    {
        // Form validation
        $this->validate($request, [
            'descricao' => 'required',
        ]);
       
        $pessoa = Pessoa::find($request->pessoa_id);
        $pessoa->contatos()->attach($request->tipo_contato, ['descricao' => $request->descricao]);

        return redirect('pessoas/showContato/'.$pessoa->id)->with('success', 'Novo contato adicionada!');
    }

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteContato($id)
    {

        $contato = PessoaContato::find($id);
        $contato->delete();
        return redirect()->back()->with('success', 'Contato deletado!');
        
    }

}
