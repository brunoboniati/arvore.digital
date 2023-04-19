<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FamiliasController;
use App\Http\Controllers\PessoasController;
use App\Http\Controllers\TipoContatoController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LogController;

use App\Http\Middleware\VerifyIsAdmin;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

   
/**
 * Início Routes
 */
Route::get('/', [HomeController::class, 'index'])->name('home.index');
    
/**
 * Login Routes
 */
Route::get('/login', [LoginController::class, 'show'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login.login');

/**
 * Usuários Routes
 */
Route::get('/criarconta', [UsuarioController::class, 'create'])->name('register.create');
Route::post('/criarconta', [UsuarioController::class, 'store'])->name('register.store');

/**
 * Forgot password
 */
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::group(['middleware' => ['auth']], function() {

    Route::resource('familias', FamiliasController::class);
    Route::get('familias/criarnova/{id}',[FamiliasController::class, 'criarnova'])->name('criarnova');
    Route::get('familias/viewUser/{id}', [FamiliasController::class, 'viewUser'])->name('familias.viewUser');
    Route::get('familias/createUser/{id}', [FamiliasController::class, 'createUser'])->name('familias.createUser');
    Route::post('familias/storeUser', [FamiliasController::class, 'storeUser'])->name('familias.storeUser');
    Route::get('familias/removeUser/{id}', [FamiliasController::class, 'removeUser'])->name('familias.removeUser');


    Route::resource('pessoas', PessoasController::class);
    Route::get('pessoas/adicionar/{id}', [PessoasController::class, 'adicionar'])->name('adicionar');
    Route::post('pessoas/storePessoaRaiz', [PessoasController::class, 'storePessoaRaiz'])->name('pessoas.storePessoaRaiz')->middleware(VerifyIsAdmin::class);
    Route::get('pessoas/adicionarDescendente/{id}', [PessoasController::class, 'createDescendente'])->name('createDescendente');
    Route::post('pessoas/storeDescendente', [PessoasController::class, 'storeDescendente'])->name('pessoas.storeDescendente');
    Route::get('pessoas/adicionarContato/{id}', [PessoasController::class, 'adicionarContato'])->name('pessoas.adicionarContato');
    Route::post('pessoas/storeContato', [PessoasController::class, 'storeContato'])->name('pessoas.storeContato');
    Route::get('pessoas/deleteContato/{id}', [PessoasController::class, 'deleteContato'])->name('pessoas.deleteContato');
    Route::get('pessoas/showContato/{id}', [PessoasController::class, 'showContato'])->name('pessoas.showContato');


    Route::resource('tipocontato', TipoContatoController::class)->middleware(VerifyIsAdmin::class);

    /**
     * Log de ações dos usuários
     */
    Route::get('log', [LogController::class, 'index'])->name('log')->middleware(VerifyIsAdmin::class);
    
    /**
     * Usuários Routes
     */
    Route::get('user_familias', [UsuarioController::class, 'userFamilias'])->name('userFamilias');
    Route::get('users', [UsuarioController::class, 'index'])->name('users');  
    Route::get('users/create', [UsuarioController::class, 'create'])->name('users.create');   
    Route::get('users/{id}', [UsuarioController::class, 'edit'])->name('users.edit');
    Route::patch('users/update/{id}', [UsuarioController::class, 'update'])->name('users.update');      
    Route::get('users/editPassword/{id}', [UsuarioController::class, 'editPassword'])->name('users.editPassword');
    Route::patch('users/updatePassword/{id}', [UsuarioController::class, 'updatePassword'])->name('users.updatePassword');
    Route::get('users/viewFamilias/{id}', [UsuarioController::class, 'viewFamilias'])->name('users.viewFamilias');
    Route::get('users/createFamilias/{id}', [UsuarioController::class, 'createFamilias'])->name('users.createFamilias');
    Route::post('users/storeFamilias', [UsuarioController::class, 'storeFamilias'])->name('users.storeFamilias');
    Route::get('users/removeFamilias/{id}', [UsuarioController::class, 'removeFamilias'])->name('users.removeFamilias');


    /**
     * Logout Routes
     */
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});

Route::get('familia/{slug}', [FamiliasController::class, 'show'])->name('show');
Route::get('pessoas_arvore/{slug}', [PessoasController::class, 'showArvore'])->name('showArvore');




