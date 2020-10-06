<?php

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

/*
Route::get('nombre/{nombre}', function($nombre){
    return "Mi nombre es: ".$nombre;
});

Route::get('edad/{age}', function($age){
    return "Mi edad es: ".$age;
});

Route::get('edad2/{age?}', function($age = 25){
    return "Mi edad es: ".$age;
});

Route::get('/', function () {
    return view('welcome');
});

Route::resource('parqueos', 'ParqueosController');
Route::get('/',' ');
*/

Route::get('/','FrontController@index');
Route::resource('contactenos','ContactoController');
Route::get('contactenos','ContactoController@create');
Route::resource('nosotros','NosotroController');
Route::get('nosotros','NosotroController@index');

// usuarios
Route::resource('t_clientes','ClienteController');
Route::get('t_clientes/{cc_cliente}/edit','ClienteController@edit');
Route::put('t_clientes/update/{cc_cliente}','ClienteController@update');
Route::get('t_clientes/show/{cc_cliente}','ClienteController@show');
Route::get('t_clientes/destroy/{cc_cliente}','ClienteController@destroy');

//Perfiles
Route::resource('t_perfiles','PerfilController');
Route::get('t_perfiles/create','PerfilController@create');
Route::get('t_perfiles/store','PerfilController@store');
Route::get('t_perfiles/{id_perfil}/edit','PerfilController@edit');
Route::put('t_perfiles/update/{id_perfil}','PerfilController@update');
Route::get('t_perfiles/show/{id_perfil}','PerfilController@show');
Route::get('t_perfiles/destroy/{id_perfil}','PerfilController@destroy');


// opciones
Route::resource('t_opciones','OpcionController');
Route::get('t_opciones/create','OpcionController@create');
Route::get('t_opciones/store','OpcionController@store');
Route::get('t_opciones/{cc_cliente}/edit','OpcionController@edit');
Route::put('t_opciones/update/{cc_cliente}','OpcionController@update');
Route::get('t_opciones/show/{cc_cliente}','OpcionController@show');
Route::get('t_opciones/destroy/{cc_cliente}','OpcionController@destroy');

// bancos
Route::resource('t_bancos','BancoController');
Route::get('t_bancos/create','BancoController@create');
Route::get('t_bancos/store','BancoController@store');
Route::get('t_bancos/{cod_bco}/edit','BancoController@edit');
Route::put('t_bancos/update/{cod_bco}','BancoController@update');
Route::get('t_bancos/show/{cod_bco}','BancoController@show');
Route::get('t_bancos/destroy/{cod_bco}','BancoController@destroy');

// grupo_parqueos
Route::resource('t_gparqueos','GrparqueController');
Route::get('t_gparqueos/create','GrparqueController@create');
Route::get('t_gparqueos/store','GrparqueController@store');
Route::get('t_gparqueos/{cod_gr_parque}/edit','GrparqueController@edit');
Route::put('t_gparqueos/update/{cod_gr_parque}','GrparqueController@update');
Route::get('t_gparqueos/show/{cod_gr_parque}','GrparqueController@show');
Route::get('t_gparqueos/destroy/{cod_gr_parque}','GrparqueController@destroy');

// parqueaderos
Route::resource('t_parqueos','ParqueosController');
Route::get('t_parqueos/create','ParqueosController@create');
Route::get('t_parqueos/store','ParqueosController@store');
Route::get('t_parqueos/{id_parque}/edit','ParqueosController@edit');
Route::put('t_parqueos/update/{id_parque}','ParqueosController@update');
Route::get('t_parqueos/show/{id_parque}','ParqueosController@show');
Route::get('t_parqueos/destroy/{id_parque}','ParqueosController@destroy');

// administradores
Route::resource('t_admones','ContactoController');
// Route::get('t_admones/create','ContactoController@create');
Route::get('t_admones/store','ContactoController@store');
Route::get('t_admones/{cc_admon}/edit','ContactoController@edit');
Route::put('t_admones/update/{cc_admon}','ContactoController@update');
Route::get('t_admones/show/{cc_admon}','ContactoController@show');
Route::get('t_admones/destroy/{cc_admon}','ContactoController@destroy');

// fecsin_servicio
Route::resource('t_dsservicios','DsserviciosController');
Route::get('t_dsservicios/create','DsserviciosController@create');
Route::get('t_dsservicios/store','DsserviciosController@store');
Route::get('t_dsservicios/{id_parque}/{fecha_parque}/edit','DsserviciosController@edit');
Route::put('t_dsservicios/update/{id_parque}/{fecha_parque}','DsserviciosController@update');
Route::get('t_dsservicios/show/{id_parque}/{fecha_parque}/{hora_ini}','DsserviciosController@show');
Route::get('t_dsservicios/destroy/{id_parque}/{fecha_parque}/{hora_ini}','DsserviciosController@destroy');

// tarifas
Route::resource('t_tarifas','TarifaController');
Route::get('t_tarifas/create','TarifaController@create');
Route::get('t_tarifas/store','TarifaController@store');
Route::get('t_tarifas/{id_parque}/{tipo_vehiculo}/edit','TarifaController@edit');
Route::put('t_tarifas/update/{id_parque}','TarifaController@update');
Route::get('t_tarifas/show/{id_parque}/{tipo_vehiculo}','TarifaController@show');
Route::get('t_tarifas/destroy/{id_parque}/{tipo_vehiculo}','TarifaController@destroy');

// operarios
Route::resource('t_operarios','OperarioController');
Route::get('t_operarios/create','OperarioController@create');
Route::get('t_operarios/store','OperarioController@store');
Route::get('t_operarios/{cc_operario}/edit','OperarioController@edit');
Route::put('t_operarios/update/{cc_operario}','OperarioController@update');
Route::get('t_operarios/show/{cc_operario}','OperarioController@show');
Route::get('t_operarios/destroy/{cc_operario}','OperarioController@destroy');

// opciones x perfil
Route::resource('t_perfilesxop','PerfilesxopController');
Route::get('t_perfilesxop/create','PerfilesxopController@create');
Route::get('t_perfilesxop/store','PerfilesxopController@store');
Route::get('t_perfilesxop/{id_perfil}/{id_opcion}/edit','PerfilesxopController@edit');
Route::put('t_perfilesxop/update/{id_perfil}','PerfilesxopController@update');
Route::get('t_perfilesxop/show/{id_perfil}/{id_opcion}','PerfilesxopController@show');
Route::get('t_perfilesxop/destroy/{id_perfil}/{id_opcion}','PerfilesxopController@destroy');

// consola
Route::resource('t_consola','QuerytablaController');
Route::get('t_consola/create','QuerytablaController@create');
Route::get('t_consola/store','QuerytablaController@store');
Route::get('t_consola/{id_query}/edit','QuerytablaController@edit');
Route::put('t_consola/update/{id_query}','QuerytablaController@update');
Route::get('t_consola/show/{id_query}','QuerytablaController@show');
Route::get('t_consola/destroy/{id_query}','QuerytablaController@destroy');
Route::get('t_consola/showreg/{id_query}','QuerytablaController@showreg');

// reservas listapar
Route::resource('t_reservas','ReservaController');
Route::get('t_reservas/create/{idre}','ReservaController@create');
Route::get('t_reservas/store','ReservaController@store');
Route::get('t_reservas/{id_reserva}/edit','ReservaController@edit');
Route::put('t_reservas/update/{id_reserva}','ReservaController@update');
Route::get('t_reservas/show/{id_reserva}','ReservaController@show');
Route::get('t_reservas/destroy/{id_reserva}','ReservaController@destroy');
Route::post('t_reservas/listapar/{cc_user}','ReservaController@listapar');

// entradas
Route::resource('t_entradas','EntradaController');
Route::get('t_entradas/create','EntradaController@create');
Route::get('t_entradas/store','EntradaController@store');
Route::get('t_entradas/{id_entrada}/edit','EntradaController@edit');
Route::put('t_entradas/update/{id_entrada}','EntradaController@update');
Route::get('t_entradas/show/{id_entrada}','EntradaController@show');
Route::get('t_entradas/destroy/{id_entrada}','EntradaController@destroy');

// entrada cliente
Route::resource('i_entracli','EntracliController');
Route::get('i_entracli/create','EntracliController@create');
Route::get('i_entracli/store','EntracliController@store');


// salidas
Route::resource('t_salidas','SalidaController');
Route::get('t_salidas/create','SalidaController@create');
Route::get('t_salidas/store','SalidaController@store');
Route::get('t_salidas/{id_entrada}/edit','SalidaController@edit');
Route::put('t_salidas/update/{id_entrada}','SalidaController@update');
Route::get('t_salidas/show/{id_entrada}','SalidaController@show');
Route::get('t_salidas/destroy/{id_entrada}','SalidaController@destroy');
Route::get('t_salidas/showreg/{id_entrada}','SalidaController@showreg');
Route::get('t_salidas/showpdf/{id_entrada}','SalidaController@showpdf');
Route::get('t_salidas/showcorreo/{id_entrada}','SalidaController@showcorreo');
Route::get('t_salidas/pagartarj/{id_entrada}','SalidaController@pagartarj');
Route::get('t_salidas/respuesta/{id_reserva}','SalidaController@respuesta');

// comerciales
Route::resource('t_comercial','ComercialController');
Route::get('t_comercial/create','ComercialController@create');
Route::get('t_comercial/store','ComercialController@store');
Route::get('t_comercial/{id_comer}/edit','ComercialController@edit');
Route::put('t_comercial/update/{id_comer}','ComercialController@update');
Route::get('t_comercial/show/{id_comer}','ComercialController@show');
Route::get('t_comercial/destroy/{id_comer}','ComercialController@destroy');

// bce Ingresos
Route::resource('t_bingresos','BingresoController');
Route::get('t_bingresos/{id_parque}/edit','BingresoController@edit');
Route::put('t_bingresos/update/{id_parque}','BingresoController@update');
Route::get('t_bingresos/show/{id_parque}','BingresoController@show');


// PDF
Route::resource('pdf', 'PdfController');

// Mail
Route::resource('mail','MailController');


/* Auth::routes(); */

        // Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::get('/home', 'HomeController@index')->name('home');

