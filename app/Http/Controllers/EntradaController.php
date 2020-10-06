<?php

namespace parqueos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use parqueos\Usuario;
use parqueos\Opcperfil;
use parqueos\Entrada;
use parqueos\Ventrada;
use parqueos\Vsalida; 
use parqueos\Parqueo;
use parqueos\Secuencia;
use parqueos\Tipovehiculo;
use parqueos\Pvariable;
use parqueos\Vparentrada;
use parqueos\Vreserva;
use parqueos\Reserva;
use parqueos\Vconreser;
use parqueos\Vservicio;
use parqueos\Tarifa;
use parqueos\Vtarifa;
use parqueos\Operario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class EntradaController extends Controller
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
        $id_opcion =1000;
        $id_parque = 0;
        $cc_user = auth()->user()->cc_user;
        $idperfil = auth()->user()->id_perfil;
        $emailclien = auth()->user()->email;
        $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)
        ->where('id_opcion','=', $id_opcion)->get();
        $operarios = Operario::where('cc_operario', '=', $cc_user)->get();
        foreach($operarios as $oper) {
            $id_parque = $oper->id_parque;
        }
        if($idperfil == 999){
          $entradas = Vparentrada::where('id_parque', '>', 0)->paginate(5);
        } else {
          $entradas = Vparentrada::where('id_parque', '=', $id_parque)->paginate(5);
        }    

        return view('entradas.t_entradas', compact('entradas', 'perfiles'));
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
        $id_parque = 0;
        $operarios = Operario::where('cc_operario', '=', $cc_user)->get();
        foreach($operarios as $oper) {
            $id_parque = $oper->id_parque;
        }
        if($id_parque > 0) {
            $parqos = Parqueo::where('id_parque', '=', $id_parque);
        } else {
            $parqos = Parqueo::where('cc_user', '=', $cc_user)->get();
        }
        $tipovehiculos = Tipovehiculo::all();
        $usuarios = Usuario::where('cc_user', '=', $cc_user)->get();
        return view('entradas.i_entradas', compact('parqos', 'tipovehiculos', 'usuarios'));

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
        $fecha_ingreso = date('Y-m-d');
        $hora_ingreso = date('H:i:s', time());
        $rules = [
            'placa' => 'required',
//            'email' => 'required'
        ];
 
     $messages = [
    'placa.required' => 'La Placa no puede ser nula',
//    'email.required' => 'El Correo electrónico no puede ser nulo',
    ];

    $this->validate($request, $rules, $messages);

    $id_reserva = 0;
    $id_parque = 0;
    $forma_pago = 1;
    $cc_cliente = 0;
    $email = 'sincorreo@gmail.com';
    $fecha_reserva = date('Y-m-d');
    $hora_reserva = date('H:i:s', time());
    $cc_user_e = $request->input('cc_user_e');
    if($cc_user_e == 0){
//        $placa = $request->input('placa');
    $cc_user = auth()->user()->cc_user;
    $reservas = Vreserva::where('placa', '=', $request->input('placa'))
    ->where('estado_reserva', '=', 100)->get(); 
    foreach($reservas as $reser){
        $id_parque = $reser->id_parque;
        $id_reserva = $reser->id_reserva;
        $fecha_reserva = $reser->fecha_reserva;
        $hora_reserva = $reser->hora_reserva;
        $email = $reser->email;
        $cc_cliente = $reser->cc_cliente;
        $forma_pago = 0;
    }
    $placa = $request->input('placa');
    $operarios = Operario::where('cc_operario', '=', $cc_user)->get();
    foreach($operarios as $oper) {
        $id_parque = $oper->id_parque;
    }
    if($id_parque > 0) {
        $parqos = Parqueo::where('id_parque', '=', $id_parque);
    } else {
        $parqos = Parqueo::where('cc_user', '=', $cc_user)->get();
    }
    $id_parque = 51;
    $tipovehiculos = Tipovehiculo::all();
    $usuarios = Usuario::where('cc_user', '=', $cc_user)->get();
    if ($id_reserva > 0){
        return view('entradas.icr_entradas', compact('parqos', 'usuarios', 'reservas'));
    } else {
//        return $placa;
        return view('entradas.isr_entradas', compact('parqos', 'placa', 'tipovehiculos', 'usuarios', 'reservas', 'id_parque'));           
    }
  }

    $entradas = Entrada::where('id_parque', '=', $request->input('id_parque'))
    ->where('tipo_vehiculo', '=', $request->input('tipo_vehiculo'))
    ->where('placa', '=', $request->input('placa'))
    ->where('fecha_ingreso', '=', $fecha_ingreso)
    ->where('hora_ingreso', '=', $hora_ingreso)->get();
    if($entradas->isEmpty()){
        $numero_sec = 0;
        $nombre_sec = 'mov_entradas';
        $emailclien = auth()->user()->email;
        $secuencias = Secuencia::where('nombre_sec', '=', $nombre_sec)->get();
//    return $secuencias;
        foreach($secuencias as $secu) {
            $numero_sec = $secu->numero_sec;
            $numero_sec = $numero_sec + 1;
        } 
//        return $numero_sec;
        $usecuencias = Secuencia::where('nombre_sec', '=', $nombre_sec);
        $usecuencias->update(['numero_sec'=> $numero_sec]);
        
        $oentra = new Entrada();
        $oentra->id_entrada = $numero_sec;
        $oentra->id_parque = $request->input('id_parque');
        $oentra->tipo_vehiculo = $request->input('tipo_vehiculo');
        $oentra->placa = $request->input('placa');
        $oentra->fecha_ingreso = $fecha_ingreso;
        $oentra->hora_ingreso = $hora_ingreso;
        $oentra->id_reserva = $request->input('id_reserva');
        $oentra->fecha_reserva = $fecha_reserva;
        $oentra->hora_reserva = $hora_reserva;
//        $oentra->cc_cliente = $request->input('cc_cliente');
        $oentra->cc_cliente = $cc_cliente;
        $oentra->forma_pago = $forma_pago;
        $oentra->email = $request->input('email');
        $oentra->cc_user_e = $request->input('cc_user_e');
        if($oentra->save()){
            $sw1 = 1;
            $tote = 0;
            $tots = 0;
            $totr = 0;
            $estado_reserva = 250;// Parqueo
            $reservas = Reserva::where('id_reserva', '=', $request->input('id_reserva'));
            $reservas->update(['estado_reserva'=> $estado_reserva]);
            $id_parque = $request->input('id_parque');
            $tipo_vehiculo = $request->input('tipo_vehiculo');
        
            $entradas = Ventrada::where('id_parque', '=', $id_parque)
            ->where('tipo_vehiculo', '=', $tipo_vehiculo)->get();
            foreach($entradas as $entra) {
                $tote = $entra->tot_e; 
            }
            $salidas = Vsalida::where('id_parque', '=', $id_parque)
            ->where('tipo_vehiculo', '=', $tipo_vehiculo)->get();
            foreach($salidas as $sali) {
                $tots = $sali->tot_s; 
            }
            $creservas = Vconreser::where('id_parque', '=', $id_parque)
            ->where('tipo_vehiculo', '=', $tipo_vehiculo)->get();
            foreach($creservas as $cre) {
                $totr = $cre->tot_r; 
            }
        
            $tarifas = Tarifa::where('id_parque', '=', $id_parque)
            ->where('tipo_vehiculo', '=', $tipo_vehiculo);
            $tarifas->update(['tot_e'=> $tote,
            'tot_s'=> $tots,
            'tot_r'=> $totr]);
        } else{
            $sw1 = 0;   
        }
    }
    if($sw1 === 1){
        Session::flash('message','Registro Guardado Correctamente!');
        Session::flash('class','info');
    } else{
    Session::flash('message','Entrada ya Existe..!!!');
    Session::flash('class','danger');
    } 
    
    return Redirect::to('t_entradas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_entrada)
    {
        $id_parque = 0;
        $valentradas = Entrada::where('id_entrada', '=', $id_entrada)->get();
        foreach($valentradas as $vale){
            $id_parque = $vale->id_parque;
        }
        if($id_parque > 0){
            $servicios = Vservicio::where('id_parque', '=', $id_parque)->get();
        } else {
            $servicios = Vservicio::where('id_parque', '>', 0)->get();
        }
//        return $servicios;
        $cc_user = auth()->user()->cc_user;
        $entradas = Vparentrada::where('id_entrada', '=', $id_entrada)->get();
        return view('entradas.v_entradas', compact('entradas', 'servicios'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_entrada)
    {
        $cc_user = auth()->user()->cc_user;
        $idperfil = auth()->user()->id_perfil;
        $entradas = Vparentrada::where('id_entrada', '=', $id_entrada)->get();
        $tipovehiculos = Tipovehiculo::all();
        return view('entradas.m_entradas', compact('entradas', 'tipovehiculos'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_entrada)
    {
        $sw1 = 0;
        $tote = 0;
        $tots = 0;
        $totr = 0;
        $cc_user = auth()->user()->cc_user;
        $entradas = Entrada::where('id_entrada', '=', $id_entrada)->get();
        if(!$entradas->isEmpty()){
            Session::flash('message','Entrada no Existe..!!!');
            Session::flash('class','danger');
        } 

        $rules = [
            'tipo_vehiculo' => 'required',
            'placa' => 'required',
//            'cc_cliente' => 'required'
        ];
 
     $messages = [
    'tipo_vehiculo.required' => 'El Tipo de Vehículo no puede ser nulo',
    'placa.required' => 'La Placa no puede ser nula',
//    'cc_cliente.required' => 'La Cédula del Cliente no puede ser nula',
    ];

    $this->validate($request, $rules, $messages);

    $cc_user = auth()->user()->cc_user;
    $estado_reserva = $request->input('estado_reserva');
    $id_parque = $request->input('id_parque');
    $tipo_vehiculo = $request->input('tipo_vehiculo');

    $aentradas = Entrada::where('id_entrada', '=', $id_entrada);
    $aentradas->update(['tipo_vehiculo'=> $request->input('tipo_vehiculo'),
    'email'=> $request->input('email')]);
    $entradas = Ventrada::where('id_parque', '=', $id_parque)
    ->where('tipo_vehiculo', '=', $tipo_vehiculo)->get();
    foreach($entradas as $entra) {
        $tote = $entra->tot_e; 
    }
    $salidas = Vsalida::where('id_parque', '=', $id_parque)
    ->where('tipo_vehiculo', '=', $tipo_vehiculo)->get();
    foreach($salidas as $sali) {
        $tots = $sali->tot_s; 
    }
    $creservas = Vconreser::where('id_parque', '=', $id_parque)
    ->where('tipo_vehiculo', '=', $tipo_vehiculo)->get();
    foreach($creservas as $cre) {
        $totr = $cre->tot_r; 
    }

    $tarifas = Tarifa::where('id_parque', '=', $id_parque)
    ->where('tipo_vehiculo', '=', $tipo_vehiculo);
    $tarifas->update(['tot_e'=> $tote,
    'tot_s'=> $tots,
    'tot_r'=> $totr]);

    $ventradas = Vparentrada::where('id_entrada', '=', $id_entrada)->get();
    Session::flash('message','Actualizado Correctamente....!');
    Session::flash('class','info');
    return Redirect::to('t_entradas/show/'.$id_entrada)->with('status','Actualizado Correctamente....!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_entrada)
    {
        $cc_user = auth()->user()->cc_user;
        $dssrvs = Entrada::where('id_entrada', '=', $id_entrada);
        $dssrvs->delete();
        return Redirect::to('t_entradas');
    }

}
