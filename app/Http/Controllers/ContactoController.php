<?php

namespace parqueos\Http\Controllers;

use Illuminate\Http\Request;
// use parqueos\Depto;
use parqueos\Ciudaddepto;
use parqueos\Administrador;
use parqueos\Valmones;
use parqueos\Opcperfil;
use parqueos\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ContactoController extends Controller
{
    public function index(){
        $user = Auth::user();

        if(!$user == null)
        {

        $id_opcion = 4016;
        $idperfil = auth()->user()->id_perfil;
        $cc_user = auth()->user()->cc_user;
        $emailclien = auth()->user()->email;
        $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)
        ->where('id_opcion','=', $id_opcion)
        ->get();
        
        if($idperfil == 999){
            $admones = Administrador::where('cc_admon', '>', 0)->paginate(5); 
        } else {
            $admones = Administrador::where('cc_admon', '=', $cc_user)->paginate(5);
        }
        return view('admones.t_admones', compact('admones', 'perfiles'));
    } else {
        return Redirect::to('home');  
    }

    }

    public function create(){
           // trae todos los reg. sin nombre de los campos
   //        $deptos =  \DB :: table ( "deptos" ) -> pluck ("desc_depto" , "cod_depto");
//          $deptos = Depto::all(); tambien trae todos los reg
//            $deptos = Depto::orderBy('desc_depto')->get();
            $deptos = Ciudaddepto::orderBy('desc_ciudepto')->get();
             return view('components.contactenos', compact('deptos'));
   //         return $deptos;
       }
   
    public function store(Request $request){
        $sw1 = 0;

        $regadmon = Administrador::where('cc_admon', '=', $request->input('cc_admon'))->get();
        if(!$regadmon->isEmpty()){
            Session::flash('message','Cédula ya Existe..!!!');
            Session::flash('class','danger');
            return Redirect::to('contactenos');
        } 

        $rules = [
            'cc_admon' => 'required|min:5|max:12',
            'nom_admon' => 'required',
            'dir_admon' => 'required',
            'tel_admon' => 'required',
            'cel_admon' => 'required',
            'mail_admon' => 'required|email',
//            'cod_dc_admon' => 'required'
        ];
 
     $messages = [
    'cc_admon.numeric' => 'La cédula debe ser un numerica',
    'cc_admon.required' => 'La cédula debe ser reportada',
    'cc_admon.min' =>'La cédula no puede ser menor a :min caracteres.',
    'cc_admon.max' =>'La cédula no puede ser mayor a :max caracteres.',
    'nom_admon.required' => 'El nombre no puede ser nulo',
    'dir_admon.required' => 'La dirección no puede ser nula',
    'tel_admon.numeric' => 'El teléfono debe ser un numerico',
    'tel_admon.required' => 'El teléfono no puede ser nulo',
    'cel_admon.numeric' => 'El celular debe ser un numerico',
    'cel_admon.required' => 'El celular no puede ser nulo',
    'mail_admon.required' => 'El correo electrónico no puede ser nulo',
    ];

    $this->validate($request, $rules, $messages);
    $regadmon = Administrador::where('cc_admon', '=', $request->input('cc_admon'))->get();
    if($regadmon->isEmpty()){

           $ador = new Administrador();
           $ador->cc_admon = $request->input('cc_admon');
           $ador->nom_admon = $request->input('nom_admon');
           $ador->dir_admon =$request->input('dir_admon');
           $ador->tel_admon = $request->input('tel_admon');
           $ador->cel_admon = $request->input('cel_admon');
           $ador->mail_admon = $request->input('mail_admon');
//           $ador->cod_dc_admon = $request->input('cod_dc_admon');
           $ador->cod_dc_admon = "11001";
           $ador->cod_bco_admon = "99";
           $ador->ncuenta_admon = "999999";
           $ador->tcuenta_admon = 0;
           $ador->fecha_sys = date('Y-m-d');
           $ador->hora_sys = date('H:i:s', time()); 

           if($ador->save()){
            $sw1 = 1;
           } else{
            $sw1 = 0;   
           }
        }
           if($sw1 === 1){
             Session::flash('message','Registro Guardado Correctamente!');
             Session::flash('class','info');
           } else{
            Session::flash('message','Cédula ya Existe..!!!');
            Session::flash('class','danger');
           } 

        return Redirect::to('contactenos');
       }
   

       public function registrarse(){
           return view('components.registrarse');
       }
   
       public function login(){
           return view('components.login');
       }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cc_admon)
    {
        $admones = Valmones::where('cc_admon', '=', $cc_admon)->get();
        return view('admones.v_admones', compact('admones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cc_admon)
    {
        $deptos = Ciudaddepto::orderBy('desc_ciudepto')->get();
        $admones = Valmones::where('cc_admon', '=', $cc_admon)->get();
        return view('admones.m_admones', compact('admones', 'deptos'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cc_admon)
    {
        $sw1 = 0;
        $rules = [
            'nom_admon' => 'required',
            'dir_admon' => 'required',
            'tel_admon' => 'required',
            'cel_admon' => 'required',
            'mail_admon' => 'required|email',
//            'cod_dc_admon'=> 'required'
        ];
 
     $messages = [
    'nom_admon.required' => 'El Nombre no puede ser nulo',
    'dir_admon.required' => 'La dirección no puede ser nula',
    'tel_admon.required' => 'El teléfono no puede ser nulo',
    'cel_admon.required' => 'El celular no puede ser nulo',
    'mail_admon.required' => 'El correo electrónico no puede ser nulo',
//    'cod_dc_admon.required' => 'El Código de la Ciudad no puede ser nulo'
    ];

    $this->validate($request, $rules, $messages);

    $admones = Administrador::where('cc_admon', '=', $cc_admon);
    $admones->update(['nom_admon'=> $request->input('nom_admon'),
    'dir_admon'=> $request->input('dir_admon'),
    'tel_admon'=> $request->input('tel_admon'),
    'cel_admon'=> $request->input('cel_admon'),
    'mail_admon'=> $request->input('mail_admon'),    
//    'cod_dc_admon'=> $request->input('cod_dc_admon') 
    'cod_dc_admon'=> "11001"   
    ]);

//    $cc_admon = $request->input('cc_admon');
    $idperfil = 120;
    $usuarios = User::where('cc_user','=', $cc_admon)->get();
//    return $usuarios;
    if($usuarios->isEmpty()){
        $ador = new User();
        $ador->cc_user = $cc_admon;
        $ador->name = $request->input('nom_admon');
        $ador->tel_user = $request->input('tel_admon');
        $ador->cel_user = $request->input('cel_admon');
        $ador->email = $request->input('mail_admon');
//        $ador->cod_dc_user = $request->input('cod_dc_admon');
        $ador->cod_dc_user = "11001";
        $ador->id_perfil = $idperfil;
        $ador->password = Hash::make($cc_admon);
        $ador->save();
    }

    $admones = Valmones::where('cc_admon', '=', $cc_admon)->get();
    Session::flash('message','Actualizado Correctamente....!');
    Session::flash('class','info');
    return Redirect::to('t_admones/show/'.$cc_admon)->with('status','Actualizado Correctamente....!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cc_admon)
    {
        $admones = Administrador::where('cc_admon', '=', $cc_admon);
        $admones->delete();
        return Redirect::to('t_admones');
    }

   
}
