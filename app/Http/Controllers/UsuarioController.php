<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Familia;
use App\Models\UserFamilia;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Auth;

class UsuarioController extends Controller
{
    /**
     * Display users page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','DESC')->paginate(15);
        return view('auth.index',compact('users'));
    }

    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $familia = Familia::find($id);
        return view('auth.create',compact('familia'));
    }

    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       
        return view('auth.create');
    }

    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        // Form validation
        $this->validate($request, [
            'email' => 'required|email:rfc,dns|unique:users,email',
            'tipo' => 'required',
            'adm' => 'required',
            'name' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

        $user = new User();
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->tipo = $request->tipo;
        $user->save();
        
        $user = User::find($user->id);
       
        //auth()->login($user);
        if(Auth::check() and Auth::user()->isAdmin())
            return redirect('/users')->with('success', "Usuário criado com sucesso!");
        else
            return redirect('/')->with('success', "Conta criada com sucesso!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
   
        return view('auth/edit', compact('user'));
    }

     /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) 
    {
        // Form validation
        $this->validate($request, [
            'email' => 'required|email:rfc,dns|unique:users,email,'.$id,
            'tipo' => 'required',
            'name' => 'required',
            'ativo' => 'required'
        ]);

        $user = User::find($id);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->tipo = $request->tipo;
        $user->ativo = $request->ativo;
        $user->save();

        if(Auth::user()->isAdmin()){
            return redirect('users')->with('success', "Usuário atualizado com sucesso!");
        }
               
        return redirect('/')->with('success', "Usuário atualizado com sucesso!");
    }

    /**
     * Alterar senha de usuário logado
     */
    public function editPassword($id){
        $user = User::find($id);   
        return view('auth/editPassword', compact('user'));
    }

     /**
     * Atualizar senha de usuário logado
     */
    public function updatePassword(Request $request, $id)
    {

        $input = $request->all();

        if (! Hash::check($input['password_old'],Auth::user()->password)){
            return redirect()->back()->withErrors(['password_old' => 'Senha atual está incorreta'])->withInput();
        }

        // Form validation
        $this->validate($request, [
            'password'   => ["required"],
            'password_confirmation' => 'required|same:password'
        ]);

        $user = User::find($id);

        $input['password'] = bcrypt($input['password']);//criptografa password
        $user->password = $input['password'];
        $user->update();

        return redirect('/')->with('success', 'Senha atualizada com sucesso');
    }

    /**
     * Adicionar administrados a famílias
     */
    public function viewFamilias($id)
    {     
        $user = User::find($id);
        
        return view('auth/adm_familia/index', compact('user'));
    }

    public function createFamilias($id)
    {     
        $user = User::find($id);
        $familias = Familia::whereDoesntHave('users')->get();
        
        return view('auth/adm_familia/create', compact('user','familias'));
    }

    public function storeFamilias(Request $request)
    {        
        $user = User::find($request->user_id);               
        $user->familias()->attach($request->familia_id, ['adm' => '1']);

        return redirect()->route('users.viewFamilias',$user->id);
    }


    public function removeFamilias($id)
    {        
        $adm = Userfamilia::find($id);
        $message = 'Esse usuário não é mais administrador da família '.$adm->familia->nome_familia;
        
        $adm->delete();

        return redirect()->back()->with('success', $message);
    }
}
