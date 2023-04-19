<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Familia;
use App\Models\Pessoa;
use App\Models\User;
use App\Models\UserFamilia;
use Auth;

class FamiliasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if(Auth::user()->isAdmin())
            $familias = Familia::orderBy('id', 'DESC')->paginate(15);
        else
            $familias = $user->familias;
     
        return view('familia/index', compact('familias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pessoas = Pessoa::orderBy('id', 'DESC')->get();
        return view('familia/pessoa/create', compact('pessoas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function criarnova($id)
    {
        $pessoa = Pessoa::find($id);
        $pessoas = Pessoa::orderBy('id', 'DESC')->get();
        return view('familia/create', compact('pessoa','pessoas'));
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
            'nome_familia' => 'required',
            'descricao' => 'required',
            'pessoa_id' => 'required'
        ]);

        //  Store data in database
        $familia = Familia::create($request->all());
        
        Pessoa::where('id',$request->pessoa_id)->update(['familia_id'=>$familia->id]);

        return redirect('familias')->with('success', 'Nova Família Cadastrada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $familia = Familia::where('slug',$slug)->first();
       
        $pessoa = Pessoa::find($familia->pessoa_id);
   
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
        $familia = Familia::find($id);
        return view('familia.edit', compact('familia'));
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
            'nome_familia' => 'required',
            'descricao' => 'required',
        ]); 
        
        $familia = Familia::find($id);

        // Update database
        $familia->nome_familia = $request->get('nome_familia');
        $familia->slug = \Str::slug($request->get('nome_familia'));
        $familia->descricao = $request->get('descricao');
        $familia->save();
 
        return redirect('/familias')->with('success', 'Registro de Família atualizada.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /**
         * $familia = Familia::find($id);
        *  $familia->delete(); 
        *
        *  return redirect('familia')->with('success', 'Familia deletada.'); 
         */
    }

    /**
     * Adicionar usuário a família como administrador
     */

     public function viewUser($id)
     {     
         $familia = Familia::find($id);
         
         return view('familia/users/index', compact('familia'));
     }
 
     public function createUser($id)
     {     
         $familia = Familia::find($id);
         $usuarios = User::whereDoesntHave('familias')->get();
         
         return view('familia/users/create', compact('usuarios','familia'));
     }
 
     public function storeUser(Request $request)
     {        
         $familia = Familia::find($request->familia_id);               
         $familia->users()->attach($request->user_id, ['adm' => '1']);
 
         return redirect()->route('familias.viewUser',$familia->id);
     }
 
 
     public function removeUser($id)
     {        
         $adm = Userfamilia::find($id);
         $message = $adm->user->name.' não é mais administrador da família '.$adm->familia->nome_familia;
         $adm->delete();
 
         return redirect()->back()->with('success', $message);
     }
}
