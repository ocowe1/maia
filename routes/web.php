<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
//Route::get('/','HomeController@welcome')->name ('/');

Auth::routes(['register' => false, 'password.request' => false]);

Route::middleware (function ($request, $next) {
    if(Auth::check () == true) {
        if ( Auth::user ()->tipo === 3 ) {
            return redirect ()->route ( 'maia' );
        }
    }
    return $next( $request );
})->group(function(){

Route::get('/', function () {
    return view('welcome');
})->name ('/');

//Protocolos
Route::get('/home', function () {
    return redirect()->route('home');
});

Route::get('/protocolos', 'ProtocolosController@exibirProtocolos')->name('home');
Route::post('/protocolos/novo', 'ProtocolosController@novoProtocolo')->name('novo-protocolo');
Route::get('/protocolos/exibir/{id}', 'ProtocolosController@verProtocolo')->name('ver-protocolo');
Route::post('/protocolos/habilitar/{id}', 'ProtocolosController@habilitarProtocolo')->name('habilitar-protocolo');
Route::post('/protocolos/desabilitar/{id}', 'ProtocolosController@desabilitarProtocolo')->name('desabilitar-protocolo');
Route::post('/protocolos/deletar/{id}', 'ProtocolosController@deletarProtocolo')->name('deletar-protocolo');
Route::post('/protocolos/assimilar/{id}', 'ProtocolosController@assimilarProtocolo')->name ('assimilar-protocolo');

//Gravações
Route::post('/gravacoes/upload', 'GravacoesController@upload')->name('upload');
Route::get('/gravacoes', 'GravacoesController@exibirGravacoes')->name ('gravacoes');
Route::post('/gravacoes/deletar/{id}', 'GravacoesController@deletarGravacao')->name('deletar-gravacao');
Route::post('/gravacoes/assimilar/{id}', 'GravacoesController@assimilarGravacao')->name ('assimilar-gravacao');
Route::get('/gravacoes/assistir/{id}', 'GravacoesController@assistirGravacao')->name ('assistir');

Route::post ('/protocolos/{id_protocolo}/remover/gravacao/{id_gravacao}', 'ProtocolosController@removerGravacao')->name ('remover-gravacao');

//Painel
Route::get('/sistema', 'SistemaController@index')->name ('sistema');
Route::get ('/sistema/protocolos/info', 'SistemaController@protocolosInfo')->name ('protocolos-info');
Route::get ('/sistema/gravacoes/info', 'SistemaController@gravacoesInfo')->name ('gravacoes-info');
Route::get ('/sistema/usuarios/info', 'SistemaController@usuariosInfo')->name ('usuarios-info');
Route::get ('/sistema/log/info', 'SistemaController@logInfo')->name ('log-info');
Route::post ('/sistema/usuarios/info/criar', 'SistemaController@criarUsuario')->name ('criar-usuario');
Route::post('/sistema/usuarios/info/editar/', 'SistemaController@alterarUsuario')->name('alterar-usuario');
});

//Usuario
Route::get ('/maia', 'MaiaController@inicio')->name ('maia');
Route::get('/maia/assistir/{id}', 'MaiaController@assistirGravacao')->name ('assistir-usuario');
