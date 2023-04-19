<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Familia;
use App\Models\Pessoa;
use Auth;

class HomeController extends Controller
{
    public function index(){
        return view('index');
    }


    public function arvore($id){

        $familia = Familia::find($id);
        $user = Auth::user();
        $pessoa = Pessoa::where('user_id', $user->id)->where('id',$familia->raiz->id)->with('pessoa')->first();
        

        return view('pessoas.show', compact('pessoa'));

    }
}
