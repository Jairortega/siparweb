<?php

namespace parqueos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use parqueos\Usuario;
use parqueos\Opcperfil;
use parqueos\Parqueo; 
use parqueos\Vparqueo;
use parqueos\Pvariable;
use parqueos\Secuencia;
use parqueos\Grupoparqueo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class ParqueosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = Auth::user();

        if(!$user == null)
        {

        $id_opcion = 4010;
        $idperfil = auth()->user()->id_perfil;
        $cc_user = auth()->user()->cc_user;
        $emailclien = auth()->user()->email;
        $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)
        ->where('id_opcion','=', $id_opcion)
        ->get();
        if($idperfil == 999){
            $parqos = Parqueo::where('cc_user', '>', 0)->paginate(5);
        } else {
            $parqos = Parqueo::where('cc_user', '=', $cc_user)->paginate(5);
        }
        return view('parqueos.t_parqueos', compact('parqos', 'perfiles'));
    } else {
        return Redirect::to('home');  
    }

    }
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $cc_user = auth()->user()->cc_user;
        $idperfil = auth()->user()->id_perfil;
        if($idperfil == 999){
            $grparqos = Grupoparqueo::where('cc_user', '>', 0)->get();
        } else {
            $grparqos = Grupoparqueo::where('cc_user', '=', $cc_user)->get();
        }    
        $regimenes = Pvariable::whereIn('id_pv', [30,40] )->get();
        $locations = Vparqueo::where('cc_user', '>', 0)->get();
        return view('parqueos.i_parqueos', compact('grparqos', 'regimenes', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sw1 = 0;
        $cc_user = auth()->user()->cc_user;
//        $parqueos = Parqueo::where('id_parque', '=', $request->input('id_parque'))
//        ->where('cc_user', '=', $cc_user)->get();
//        if(!$parqueos->isEmpty()){
//            Session::flash('message','Código ya Existe..!!!');
//            Session::flash('class','danger');
//        } 

        $rules = [
//            'id_parque' => 'required',
        'des_parque' => 'required',
        'nit_parque' => 'required',
        'id_regimen' => 'required',
        'dir_parque' => 'required',
        'tel_parque' => 'required',
        'mail_parque' => 'required|email',
        'cod_gr_parque' => 'required'
        ];
 
     $messages = [
//    'id_parque.required' => 'El Código no puede ser nulo',
    'des_parque.required' => 'La descripción del Parqueadero no puede ser nulo',
    'nit_parque.required' => 'El NIT del Parqueadero no puede ser nulo',
    'id_regimen.required' => 'El Regimen no puede ser nulo',
    'dir_parque.required' => 'La dirección del Parqueadero no puede ser nula',
    'tel_parque.required' => 'El teléfono del Parqueadero no puede ser nulo',
    'mail_parque.required' => 'El correo electrónico no puede ser nulo',
    'cod_gr_parque.required' => 'El Grupo del Parqueadero no puede ser nulo'
    ];

    $this->validate($request, $rules, $messages);


    $parqueos = Parqueo::where('id_parque', '=', $request->input('id_parque'))
    ->where('cc_user', '=', $cc_user)->get();
    if($parqueos->isEmpty()){
        $numero_sec = 0;
        $nombre_sec = 'parqueos';
        $secuencias = Secuencia::where('nombre_sec', '=', $nombre_sec)->get();
    //    return $secuencias;
        foreach($secuencias as $secu) {
            $numero_sec = $secu->numero_sec;
            $numero_sec = $numero_sec + 1;
        } 
//        return $numero_sec;
        $usecuencias = Secuencia::where('nombre_sec', '=', $nombre_sec);
        $usecuencias->update(['numero_sec'=> $numero_sec]);
        
        $oparqueo = new Parqueo();
        $oparqueo->id_parque = $numero_sec;
        $oparqueo->cc_user = $cc_user;
//      dd($request->file('foto_parque'));

        if($request->hasFile('foto_parque')){  
          $file = $request->file('foto_parque');
          $name = $file->getClientOriginalName();
          $file->move(public_path().'/img/', $name);
          $oparqueo->foto_parque = $name;
        }
        $oparqueo->des_parque = $request->input('des_parque');
        $oparqueo->nit_parque = $request->input('nit_parque');
        $oparqueo->id_regimen = $request->input('id_regimen');
        $oparqueo->dir_parque = $request->input('dir_parque');
        $oparqueo->tel_parque = $request->input('tel_parque');
        $oparqueo->mail_parque = $request->input('mail_parque');
        $oparqueo->cod_dc_parque = '11001';
        $oparqueo->latitud_parque = $request->input('latitud_parque');
        $oparqueo->longitud_parque = $request->input('longitud_parque');
        $oparqueo->fecha_desde = date('Y-m-d');
        $oparqueo->fecha_hasta = date('Y-m-d');
        $oparqueo->cod_gr_parque = $request->input('cod_gr_parque');
        $oparqueo->estado_parque = 0;
        if($oparqueo->save()){
            $sw1 = 1;
        } else{
            $sw1 = 0;   
        }
    }
    if($sw1 === 1){
        Session::flash('message','Registro Guardado Correctamente!');
        Session::flash('class','info');
        } else{
        Session::flash('message','Código ya Existe..!!!');
        Session::flash('class','danger');
    } 
    
    return Redirect::to('t_parqueos');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_parque)
    {
        $idperfil = auth()->user()->id_perfil;
        $cc_user = auth()->user()->cc_user;
        if($idperfil == 999){
            $parqos = Vparqueo::where('id_parque', '=', $id_parque)
            ->where('cc_user', '>', 0)->get();
        } else {
            $parqos = Vparqueo::where('id_parque', '=', $id_parque)
            ->where('cc_user', '=', $cc_user)->get();
            }
        return view('parqueos.v_parqueos', compact('parqos'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_parque)
    {
        $idperfil = auth()->user()->id_perfil;
        $cc_user = auth()->user()->cc_user;
        if($idperfil == 999){
            $parqos = Parqueo::where('id_parque', '=', $id_parque)
            ->where('cc_user', '>', 0)->get();
        } else {
            $parqos = Parqueo::where('id_parque', '=', $id_parque)
            ->where('cc_user', '=', $cc_user)->get();
            }
        $grparqos = Grupoparqueo::where('cc_user', '=', $cc_user)->get();
        $regimenes = Pvariable::whereIn('id_pv', [30,40] )->get();
        return view('parqueos.m_parqueos', compact('parqos', 'grparqos', 'regimenes'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, $id_parque)
    {
        $sw1 = 0;
        $rules = [
            'id_parque' => 'required',
            'des_parque' => 'required',
            'nit_parque' => 'required',
            'id_regimen' => 'required',
            'dir_parque' => 'required',
            'tel_parque' => 'required',
            'mail_parque' => 'required|email',
            'cod_gr_parque'=> 'required'
        ];
 
     $messages = [
    'id_parque.required' => 'El Código no puede ser nulo',
    'des_parque.required' => 'La descripción del Parqueadero no puede ser nulo',
    'nit_parque.required' => 'El NIT del Parqueadero no puede ser nulo',
    'id_regimen.required' => 'El Regimen no puede ser nulo',
    'dir_parque.required' => 'La dirección del Parqueadero no puede ser nula',
    'tel_parque.required' => 'El teléfono del Parqueadero no puede ser nulo',
    'mail_parque.required' => 'El correo electrónico no puede ser nulo',
    'cod_gr_parque.required' => 'El Grupo no puede ser nulo'
    ];

    $this->validate($request, $rules, $messages);

    $cc_user = auth()->user()->cc_user;
    $parqos = Parqueo::where('id_parque', '=', $id_parque);
//    ->where('cc_user', '=', $cc_user);
//    dd($request->file('foto_parque'));
    $name = 'parqueos5.jpg';

    if($request->hasFile('foto_parque')){
        $file = $request->file('foto_parque');
        $name = $file->getClientOriginalName();
        $file->move(public_path().'/img/', $name);
//        return $name;
    }

    $parqos->update(['des_parque'=> $request->input('des_parque'),
    'foto_parque' => $name,
    'nit_parque'=> $request->input('nit_parque'),
    'id_regimen'=> $request->input('id_regimen'),
    'dir_parque'=> $request->input('dir_parque'),
    'tel_parque'=> $request->input('tel_parque'),
    'mail_parque'=> $request->input('mail_parque'),
    'latitud_parque'=> $request->input('latitud_parque'),
    'longitud_parque'=> $request->input('longitud_parque'),    
    'cod_gr_parque'=> $request->input('cod_gr_parque')    
    ]);
    Session::flash('message','Registro Actualizado Correctamente!');
    Session::flash('class','info');

    return Redirect::to('t_parqueos/show/'.$id_parque)->with('status','Actualizado Correctamente....!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_parque)
    {
        $cc_user = auth()->user()->cc_user;
        $idperfil = auth()->user()->id_perfil;
        if($idperfil == 999){
            $parqos = Parqueo::where('id_parque', '=', $id_parque);
        } else {
            $parqos = Parqueo::where('id_parque', '=', $id_parque)
            ->where('cc_user', '=', $cc_user);
            }
        $parqos->delete();
        return Redirect::to('t_parqueos');
    }
}
