<?php

namespace parqueos\Http\Controllers;

use Illuminate\Http\Request;
use parqueos\Vreserva;
use Illuminate\Database\Eloquent\Model;
use parqueos\Usuario;
use parqueos\Opcperfil;
use parqueos\Reserva; 
use parqueos\Parqueo;
use parqueos\Secuencia;
use parqueos\Tipovehiculo;
use parqueos\Pvariable;
use parqueos\Ventrada;
use parqueos\Vsalida;
use parqueos\Vtaricupo;
use parqueos\Salida;
use parqueos\Vparsalida;
use parqueos\Vconreser;
use parqueos\Tarifa;
use parqueos\Vtarifa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class ReservaController extends Controller
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
        $id_opcion =1010;
        $cc_user = auth()->user()->cc_user;
        $idperfil = auth()->user()->id_perfil;
        $emailclien = auth()->user()->email;
        $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)
        ->where('id_opcion','=', $id_opcion)->get();

        if($idperfil == 999){
          $reservas = Vreserva::where('cc_cliente', '>', 0)->paginate(5);
        } else {
          $reservas = Vreserva::where('cc_cliente', '=', $cc_user)->paginate(5);
        }    
        return view('reservas.t_reservas', compact('reservas', 'perfiles'));
    } else {
        return Redirect::to('home');  
    }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idre)
    {
        $cc_user = auth()->user()->cc_user;
        $idperfil = auth()->user()->id_perfil;
        $tipovehiculos = Tipovehiculo::all();
        $z5 = 0;
        $parqos = Parqueo::all();
        $vservicios = Vtaricupo::all();
        $usuarios = Usuario::where('cc_user', '=', $cc_user)->get();
//        return public_path();
        if($idre == 1){
            return view('reservas.i_reservas', compact('parqos', 'tipovehiculos', 'usuarios', 'vservicios'));
        }
        if($idre == 2){
            return view('reservas.i_mreservas', compact('parqos', 'tipovehiculos', 'usuarios', 'vservicios'));
        }
//     return public_path();
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
        $fecha_reserva = date('Y-m-d');
        $hora_reserva = date('H:i:s', time());
        $reservas = Reserva::where('cc_cliente', '=', $cc_user)
        ->where('id_parque', '=', $request->input('id_parque'))
        ->where('fecha_reserva', '=', $fecha_reserva)
        ->where('hora_reserva', '=', $hora_reserva)->get();
        if(!$reservas->isEmpty()){
            Session::flash('message','Reserva ya Existe..!!!');
            Session::flash('class','danger');
        } 

        $rules = [
//            'id_parque' => 'required',
            'dir_origen' => 'required',
            'dir_destino' => 'required',
            'tipo_vehiculo' => 'required',
            'placa' => 'required',
            'latitud_clien' => 'required',
            'longitud_clien' => 'required',
            'latitud_origen' => 'required',
            'longitud_origen' => 'required',
            'latitud_destino' => 'required',
            'longitud_destino' => 'required',
            'latitud_parque' => 'required',
            'longitud_parque' => 'required'
        ];
 
     $messages = [
//    'id_parque.required' => 'El Código Parqueadero no puede ser nulo',
    'dir_origen.required' => 'La Dirección del Origen no puede ser nula',
    'dir_destino.required' => 'La Dirección del Destino no puede ser nula',
    'tipo_vehiculo.required' => 'El Tipo de Vehículo no puede ser nulo',
    'placa.required' => 'La Placa no puede ser nula',
    'latitud_clien.required' => 'La Latitud del Cliente no puede ser nula',
    'longitud_clien.required' => 'La Longitud del Cliente no puede ser nula',
    'latitud_origen.required' => 'La Latitud del Origen no puede ser nula',
    'longitud_origen.required' => 'La Longitud del Origen no puede ser nula',
    'latitud_destino.required' => 'La Latitud del Destino no puede ser nula',
    'longitud_destino.required' => 'La Longitud del Destino no puede ser nula',
    'latitud_parque.required' => 'La Latitud del Parqueadero no puede ser nula (Seleccione un Parqueadero)',
    'longitud_parque.required' => 'La Longitud del Parqueadero no puede ser nula (Seleccione un Parqueadero)'
    ];

    $this->validate($request, $rules, $messages);

    $reservas = Reserva::where('cc_cliente', '=', $cc_user)
    ->where('id_parque', '=', $request->input('id_parque'))
    ->where('fecha_reserva', '=', $fecha_reserva)
    ->where('hora_reserva', '=', $hora_reserva)->get();
    if($reservas->isEmpty()){
        $numero_sec = 0;
        $nombre_sec = 'reservas';
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
    
        $id_parque = 1;
        $oreserva = new Reserva();
        $oreserva->cc_cliente = $cc_user;
        $oreserva->id_parque = $id_parque;
        $oreserva->id_reserva = $numero_sec;
        $oreserva->fecha_reserva = $fecha_reserva;
        $oreserva->hora_reserva = $hora_reserva;
        $oreserva->dir_origen = $request->input('dir_origen');
        $oreserva->dir_destino = $request->input('dir_destino');
        $oreserva->tipo_vehiculo = $request->input('tipo_vehiculo');
        $oreserva->placa = $request->input('placa');
        $oreserva->email = $emailclien;
        $oreserva->estado_reserva = 100;
        $oreserva->latitud_clien = $request->input('latitud_clien');
        $oreserva->longitud_clien = $request->input('longitud_clien');
        $oreserva->latitud_origen = $request->input('latitud_origen');
        $oreserva->longitud_origen = $request->input('longitud_origen');
        $oreserva->latitud_destino = $request->input('latitud_destino');
        $oreserva->longitud_destino = $request->input('longitud_destino');
        $oreserva->latitud_parque = $request->input('latitud_parque');
        $oreserva->longitud_parque = $request->input('longitud_parque');
        $oreserva->fecha_sys = $fecha_reserva;
        $oreserva->hora_sys = $hora_reserva;

        $lati = $request->input('latitud_destino');
        $longi = $request->input('longitud_destino');
        $id_reserva = $numero_sec;
        $tipo_vehiculo = $request->input('tipo_vehiculo');

        if($oreserva->save()){
            $sw1 = 1;
            $tote = 0;
            $tots = 0;
            $totr = 0;
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
/*
    if($sw1 === 1){
        Session::flash('message','Registro Guardado Correctamente!');
        Session::flash('class','info');
    } else{
    Session::flash('message','Reserva ya Existe..!!!');
    Session::flash('class','danger');
    } 
*/   
	
	$rilati = $lati - 0.08;
	$rflati = $lati + 0.08;
	$rilngi = $longi - 0.08;
    $rflngi = $longi + 0.08;
    
    $camporden = 'minutocar';
    $tipovehi = 'dis_cupocar';
	if($tipo_vehiculo == 2){
        $camporden = 'minutomoto';
        $tipovehi = 'dis_cupomoto';
    }
	if($tipo_vehiculo == 3){
        $camporden = 'minutobici';
        $tipovehi = 'dis_cupobici';
    }
	$parqos = Vtaricupo::where('latitud_parque', '>=', $rilati)
			->where('latitud_parque', '<=', $rflati)
			->where('longitud_parque', '>=', $rilngi)
            ->where('longitud_parque', '<=', $rflngi)
            ->where($tipovehi, '>', 0)
            ->orderBy($camporden)->get();
            
    $cc_user = auth()->user()->cc_user;
    $tipovehiculos = Tipovehiculo::all();
    $estapvars = Pvariable::whereIn('id_pv', [100, 200, 220])->get();
    $reservas = Vreserva::where('id_reserva', '=', $id_reserva)->get();
    return view('reservas.m_reservas', compact('parqos', 'reservas', 'tipovehiculos', 'estapvars'));

    }


    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_reserva)
    {
        $cc_user = auth()->user()->cc_user;
        $reservas = Vreserva::where('id_reserva', '=', $id_reserva)->get();
//  return $reservas;
        return view('reservas.v_reservas', compact('reservas'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_reserva)
    {
        $cc_user = auth()->user()->cc_user;
        $idperfil = auth()->user()->id_perfil;
        $reservas = Vreserva::where('id_reserva', '=', $id_reserva)->get();
        $tipovehiculos = Tipovehiculo::all();
        $estapvars = Pvariable::whereIn('id_pv', [100, 200, 220])->get();

        $lati = 0;
        $longi = 0;
        $tipo_vehiculo = 1;
        foreach($reservas as $reserva){
           $lati = $reserva->latitud_destino;
           $longi = $reserva->longitud_destino;
           $tipo_vehiculo = $reserva->tipo_vehiculo;
        }
        $rilati = $lati - 0.08;
        $rflati = $lati + 0.08;
        $rilngi = $longi - 0.08;
        $rflngi = $longi + 0.08;
        
        $camporden = 'minutocar';
        $tipovehi = 'dis_cupocar';
        if($tipo_vehiculo == 2){
            $camporden = 'minutomoto';
            $tipovehi = 'dis_cupomoto';
        }
        if($tipo_vehiculo == 3){
            $camporden = 'minutobici';
            $tipovehi = 'dis_cupobici';
        }
        $parqos = Vtaricupo::where('latitud_parque', '>=', $rilati)
                ->where('latitud_parque', '<=', $rflati)
                ->where('longitud_parque', '>=', $rilngi)
                ->where('longitud_parque', '<=', $rflngi)
                ->where($tipovehi, '>', 0)
                ->orderBy($camporden)->get();
                
    
        return view('reservas.m_reservas', compact('reservas', 'tipovehiculos', 'estapvars', 'parqos'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_reserva)
    {
        $sw1 = 0;
        $tote = 0;
        $tots = 0;
        $totr = 0;
        $cc_user = auth()->user()->cc_user;

        $reservas = Vreserva::where('id_reserva', '=', $id_reserva)->get();

        if($reservas->isEmpty()){
            Session::flash('message','Reserva no Existe..!!!');
            Session::flash('class','danger');
        } 

        $rules = [
            
            'id_parque' => 'required',
            'estado_reserva' => 'required',
        ];
 
     $messages = [
    'id_parque.required' => 'El Código del Parqueadero no puede ser nulo',
    'estado_reserva.required' => 'El Estado de la Reserva no puede ser nulo'
    ];

    $this->validate($request, $rules, $messages);

    $cc_user = auth()->user()->cc_user;
    $id_entrada = 0;
    $estado_reserva = $request->input('estado_reserva');
    $salidas = Vparsalida::where('id_reserva', '=', $id_reserva)->get();
    foreach($salidas as $sal) {
        $id_entrada = $sal->id_entrada; 
    }

    $forma_pago = 0; // tarjeta 220 = pago efectivo 200 = declinada
    if($estado_reserva == 220){
        $forma_pago = 1; // Efectivo 
    }
    if($estado_reserva == 200 and $id_entrada > 0){
        $forma_pago = 0; // Tarjeta
        $estado_reserva = 250;
    }
    $latitud_parque = 0;
    $longitud_parque = 0;
    $id_parque = $request->input('id_parque');
    $tipo_vehiculo = $request->input('tipo_vehiculo');
    $parqueos = Parqueo::where('id_parque', '=', $id_parque)->get();
//    return $id_parque;

    foreach($parqueos as $parque){
        $latitud_parque = $parque->latitud_parque;
        $longitud_parque = $parque->longitud_parque; 
    }
//    return $latitud_parque;

    // Actualizacion
    $reservas = Vreserva::where('id_reserva', '=', $id_reserva);
    $reservas->update(['id_parque'=> $request->input('id_parque'),
    'latitud_parque'=> $latitud_parque,
    'longitud_parque'=> $longitud_parque,
    'estado_reserva'=> $estado_reserva]);

    if($id_entrada > 0){
        $lsalidas = Salida::where('id_entrada', '=', $id_entrada);
        $lsalidas->update(['forma_pago'=> $forma_pago]);
    }

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
//    return 'id_parque '.$id_parque;
    $tarifas = Tarifa::where('id_parque', '=', $id_parque)
    ->where('tipo_vehiculo', '=', $tipo_vehiculo);
    $tarifas->update(['tot_e'=> $tote,
    'tot_s'=> $tots,
    'tot_r'=> $totr]);

    $reservas = Vreserva::where('id_parque', '=', $id_parque)->get();
    Session::flash('message','Actualizado Correctamente....!');
    Session::flash('class','info');
    return Redirect::to('t_reservas/show/'.$id_reserva)->with('status','Actualizado Correctamente....!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_reserva)
    {
        $cc_user = auth()->user()->cc_user;
        $dssrvs = Reserva::where('id_reserva', '=', $id_reserva);
        $dssrvs->delete();
        return Redirect::to('t_reservas');

    }

    public function listapar(Request $request, $cc_user)
    {
//        if($request->ajax()){
        $cc_user = auth()->user()->cc_user;
        $lati = $request->input('latitud_destino');
        $longi = $request->input('longitud_destino');
        return $lati;
        $rilati = $lati - 0.08;
        $rflati = $lati + 0.08;
        $rilngi = $longi - 0.08;
        $rflngi = $longi + 0.08;
//        $vservicios = Vtaricupo::all();
        $vservicios = DB::table('vtarifas_cupo')
                ->where('latitud_parque', '>=', $rilati)
                ->where('latitud_parque', '<=', $rflati)
                ->where('longitud_parque', '>=', $rilngi)
                ->where('longitud_parque', '<=', $rflngi)->get();
//        return Response::json($vservicios);
        return $vservicios;
//        }
    }


}
