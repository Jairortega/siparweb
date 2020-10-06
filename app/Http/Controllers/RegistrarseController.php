<?php

namespace parqueos\Http\Controllers;

use Illuminate\Http\Request;

use parqueos\Ciudaddepto;
use parqueos\Usuario;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class RegistrarseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
         $deptos = Ciudaddepto::orderBy('desc_ciudepto')->get();
          return view('components.registrarse', compact('deptos'));
//         return $deptos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $sw1 = 0;

        $regadmon = Usuario::where('cc_usuario', '=', $request->input('cc_usuario'))->get();
        if(!$regadmon->isEmpty()){
            Session::flash('message','Cédula ya está Registrada..!!!');
            Session::flash('class','danger');
            return Redirect::to('registrarse');
        } 

        $rules = [
            'cc_usuario' => 'required|min:5|max:12',
            'nom_usuario' => 'required',
            'tel_usuario' => 'required',
            'cel_usuario' => 'required',
            'mail_usuario' => 'required|email',
//            'cod_dc_usuario' => 'required',
            'clave' => 'required',
            'pregunta' => 'required',
            'respuesta' => 'required',
        ];
 
     $messages = [
    'cc_usuario.numeric' => 'La cédula debe ser un numerica',
    'cc_usuario.required' => 'La cédula debe ser reportada',
    'cc_usuario.min' =>'La cédula no puede ser mayor a :min caracteres.',
    'cc_usuario.max' =>'La cédula no puede ser mayor a :max caracteres.',
    'nom_usuario.required' => 'El nombre no puede ser nulo',
    'tel_usuario.numeric' => 'El teléfono debe ser un numerico',
    'tel_usuario.required' => 'El teléfono no puede ser nulo',
    'cel_usuario.numeric' => 'El celular debe ser un numerico',
    'cel_usuario.required' => 'El celular no puede ser nulo',
    'mail_usuario.required' => 'El correo electrónico no puede ser nulo',
    'clave_usuario.required' => 'La clave no puede ser nula',
    'reclave.required' => 'La confirmación de la clave no puede ser nula',
    'pregunta.required' => 'La pregunta no puede ser nula',
    'respuesta.required' => 'La respuesta no puede ser nula',
    'conrespuesta.required' => 'La confirmación de la respuesta no puede ser nula',
    ];

    $this->validate($request, $rules, $messages);
    $regadmon = Usuario::where('cc_usuario', '=', $request->input('cc_usuario'))->get();
    if($regadmon->isEmpty()){

           $ador = new Usuario();
           $ador->cc_usuario = $request->input('cc_usuario');
           $ador->nom_usuario = $request->input('nom_usuario');
           $ador->tel_usuario = $request->input('tel_usuario');
           $ador->cel_usuario = $request->input('cel_usuario');
           $ador->mail_usuario = $request->input('mail_usuario');
//           $ador->cod_dc_usuario = $request->input('cod_dc_usuario');
           $ador->cod_dc_usuario = "11001";
           $ador->clave_usuario = bcryt($request->input('clave_usuario'));
           $ador->pregunta = $request->input('pregunta');
           $ador->respuesta = bcryt($request->input('respuesta'));
           $ador->id_perfil = 200;
           $ador->bloqueo = 0;
           $ador->fecha_crea = date('Y-m-d');
           $ador->hora_crea = date('H:i:s', time()); 
           $ador->fecha_modi = date('Y-m-d');
           $ador->hora_modi = date('H:i:s', time()); 

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
        //
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
        //
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
