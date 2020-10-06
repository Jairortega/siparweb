<?php

namespace parqueos\Http\Controllers;

use Illuminate\Http\Request;
use parqueos\Http\Requests\StoreClienteRequest;
use parqueos\Vcliente;
use Illuminate\Database\Eloquent\Model;
use parqueos\Usuario;
use parqueos\Opcperfil;
use parqueos\Tarifa; 
use parqueos\Vtarifa;
use parqueos\Parqueo;
use parqueos\Tipovehiculo;
use parqueos\Pvariable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class TarifaController extends Controller
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
        $id_opcion =4035;
        $cc_user = auth()->user()->cc_user;
        $idperfil = auth()->user()->id_perfil;
        $emailclien = auth()->user()->email;
        $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)
        ->where('id_opcion','=', $id_opcion)->get();

        if($idperfil == 999){
          $tarifas = Vtarifa::where('cc_user', '>', 0)->paginate(5);
        } else {
          $tarifas = Vtarifa::where('cc_user', '=', $cc_user)->paginate(5);
        }    
        return view('tarifas.t_tarifas', compact('tarifas', 'perfiles'));
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
        $tipovehiculos = Tipovehiculo::all();
        $ivapvars = Pvariable::where('id_pv', '<', 9)->get();
        $tarpvars = Pvariable::where('id_pv', '>', 9)->get();
        if($idperfil == 999){
           $parqos = Parqueo::where('cc_user', '>', 0)->get();
        } else {
            $parqos = Parqueo::where('cc_user', '=', $cc_user)->get();
        }    
        return view('tarifas.i_tarifas', compact('parqos', 'tipovehiculos', 'ivapvars', 'tarpvars'));
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
        $vr_minuto = 0;
        $cc_user = auth()->user()->cc_user;
        $tarifas = Tarifa::where('cc_user', '=', $cc_user)
        ->where('id_parque', '=', $request->input('id_parque'))
        ->where('tipo_vehiculo', '=', $request->input('tipo_vehiculo'))->get();
        if(!$tarifas->isEmpty()){
            Session::flash('message','Tarifa ya Existe..!!!');
            Session::flash('class','danger');
        } 

        $rules = [
            'id_parque' => 'required',
            'tipo_vehiculo' => 'required',
            'und_parque' => 'required',
            'vr_parque' => 'required',
            'cupo' => 'required',
            'porc_iva' => 'required',
            'iva' => 'required'
        ];
 
     $messages = [
    'id_parque.required' => 'El Código no puede ser nulo',
    'tipo_vehiculo.required' => 'El Tipo de Vehículo no puede ser nulo',
    'und_parque.required' => 'La Unidad de Tarifa no puede ser nula',
    'vr_parque.required' => 'El Valor de la Tarifa no puede ser nulo',
    'cupo.required' => 'El Cupo del Parqueadero no puede ser nulo',
    'porc_iva.required' => 'El Porcentaje del IVA no puede ser nulo',
    'iva.required' => 'El S/N del IVA no puede ser nulo'
    ];

    $this->validate($request, $rules, $messages);

    $tarifas = Tarifa::where('cc_user', '=', $cc_user)
    ->where('id_parque', '=', $request->input('id_parque'))
    ->where('tipo_vehiculo', '=', $request->input('tipo_vehiculo'))->get();
    if($tarifas->isEmpty()){
               $vr_minuto = $request->input('vr_parque');
               if ($request->input('und_parque') == 20){
                  $vr_minuto = intval($request->input('vr_parque') / 60);
               }
               $otarifa = new Tarifa();
               $otarifa->cc_user = $cc_user;
               $otarifa->id_parque = $request->input('id_parque');
               $otarifa->tipo_vehiculo = $request->input('tipo_vehiculo');
               $otarifa->und_parque = $request->input('und_parque');
               $otarifa->vr_parque = $request->input('vr_parque');
               $otarifa->vr_minuto = $vr_minuto;
               $otarifa->cupo = $request->input('cupo');
               $otarifa->porc_iva = $request->input('porc_iva');
               $otarifa->iva = $request->input('iva');
               if($otarifa->save()){
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
    
            return Redirect::to('t_tarifas');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_parque, $tipo_vehiculo)
    {
        $cc_user = auth()->user()->cc_user;
        $tarifas = Vtarifa::where('cc_user', '=', $cc_user)
        ->where('id_parque', '=', $id_parque)
        ->where('tipo_vehiculo', '=', $tipo_vehiculo)->get();
        return view('tarifas.v_tarifas', compact('tarifas'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_parque, $tipo_vehiculo)
    {
        $cc_user = auth()->user()->cc_user;
        $idperfil = auth()->user()->id_perfil;
        $tarifas = Vtarifa::where('cc_user', '=', $cc_user)
        ->where('id_parque', '=', $id_parque)
        ->where('tipo_vehiculo', '=', $tipo_vehiculo)->get();
        $tipovehiculos = Tipovehiculo::all();
        $ivapvars = Pvariable::where('id_pv', '<', 9)->get();
        $tarpvars = Pvariable::where('id_pv', '>', 9)->get();
        if($idperfil == 999){
           $parqos = Parqueo::where('cc_user', '>', 0)->get();
        } else {
            $parqos = Parqueo::where('cc_user', '=', $cc_user)->get();
        }    
        return view('tarifas.m_tarifas', compact('tarifas', 'tipovehiculos', 'ivapvars', 'tarpvars', 'parqos'));

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
        $cc_user = auth()->user()->cc_user;
        $tarifas = Tarifa::where('cc_user', '=', $cc_user)
        ->where('id_parque', '=', $id_parque)
        ->where('tipo_vehiculo', '=', $request->input('tipo_vehiculo'))->get();

        if(!$tarifas->isEmpty()){
            Session::flash('message','Tarifa no Existe..!!!');
            Session::flash('class','danger');
        } 

        $rules = [
            'id_parque' => 'required',
            'tipo_vehiculo' => 'required',
            'und_parque' => 'required',
            'vr_parque' => 'required',
            'cupo' => 'required',
            'porc_iva' => 'required',
            'iva' => 'required'
        ];
 
     $messages = [
    'id_parque.required' => 'El Código no puede ser nulo',
    'tipo_vehiculo.required' => 'El Tipo de Vehículo no puede ser nulo',
    'und_parque.required' => 'La Unidad de Tarifa no puede ser nula',
    'vr_parque.required' => 'El Valor de la Tarifa no puede ser nulo',
    'cupo.required' => 'El Cupo del Parqueadero no puede ser nulo',
    'porc_iva.required' => 'El Porcentaje del IVA no puede ser nulo',
    'iva.required' => 'El S/N del IVA no puede ser nulo'
    ];

    $this->validate($request, $rules, $messages);

    $vr_minuto = $request->input('vr_parque');
    if ($request->input('und_parque') == 20){
       $vr_minuto = intval($request->input('vr_parque') / 60);
    }

    $cc_user = auth()->user()->cc_user;
    $tarifas = Tarifa::where('cc_user', '=', $cc_user)
    ->where('id_parque', '=', $request->input('id_parque'))
    ->where('tipo_vehiculo', '=', $request->input('tipo_vehiculo'));
    $tarifas->update(['und_parque'=> $request->input('und_parque'),
    'vr_parque'=> $request->input('vr_parque'),
    'vr_minuto'=> $vr_minuto,
    'cupo'=> $request->input('cupo'),
    'porc_iva'=> $request->input('porc_iva'),
    'iva'=> $request->input('iva')]);

    $id_parque = $request->input('id_parque');
    $tipo_vehiculo = $request->input('tipo_vehiculo');

    $dssrvs = Vtarifa::where('id_parque', '=', $id_parque)
    ->where('cc_user', '=', $cc_user)
    ->where('tipo_vehiculo', '=', $tipo_vehiculo)->get();
    Session::flash('message','Actualizado Correctamente....!');
    Session::flash('class','info');
    return Redirect::to('t_tarifas/show/'.$id_parque.'/'.$tipo_vehiculo)->with('status','Actualizado Correctamente....!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_parque, $tipo_vehiculo)
    {
        $cc_user = auth()->user()->cc_user;
        $dssrvs = Tarifa::where('id_parque', '=', $id_parque)
        ->where('cc_user', '=', $cc_user)
        ->where('tipo_vehiculo', '=', $tipo_vehiculo);
        $dssrvs->delete();
        return Redirect::to('t_tarifas');

    }
}
