<?php

namespace parqueos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use parqueos\Usuario;
use parqueos\Opcperfil;
use parqueos\Parqueo; 
use parqueos\Vparqueo;
use parqueos\Pvariable;
use parqueos\Vbingreso;
use parqueos\Grupoparqueo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class BingresoController extends Controller
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

        $id_opcion = 2052;
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
        return view('bingresos.t_bingresos', compact('parqos', 'perfiles'));
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_parque)
    {
        $forma_pago = 1;
        $reserva = 0;
        $idperfil = auth()->user()->id_perfil;
        $cc_user = auth()->user()->cc_user;
        $parqos = Parqueo::where('id_parque', '=', $id_parque)
            ->where('cc_user', '=', $cc_user)->get();
        foreach($parqos as $parq){
          $forma_pago = $parq->forma_pago;
          $reserva = $parq->reserva;
        }
        // 0 = tarjeta
        if($forma_pago == 220){
            $forma_pago = 0;
        }
        // 1 = efectivo
        if($forma_pago == 230){
            $forma_pago = 1;
        }
        $condire = '>=';
        $vreserva = 0;
        $orden = 'fecha_ingreso';
        // 0 = No Reserva
        if($reserva == 0){
            $condire = '=';
            $vreserva = 0;
        }
        // 1 = Con Reserva
        if($reserva == 1){
            $condire = '>';
            $vreserva = 0;
        }

        if($forma_pago == 240){
            $ingresos = Vbingreso::where('id_parque', '=', $id_parque)
            ->where('cc_user', '=', $cc_user)
            ->where('id_reserva', $condire, $vreserva)
            ->orderBy($orden)->paginate(5);
        } else {
            $ingresos = Vbingreso::where('id_parque', '=', $id_parque)
            ->where('cc_user', '=', $cc_user)
            ->where('forma_pago', $condire, $vreserva)
            ->where('id_reserva', '>=', 0)
            ->orderBy($orden)->paginate(5);
            }
//            return $ingresos;
        return view('bingresos.v_bingresos', compact('ingresos', 'parqos'));

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
        $sinos = Pvariable::whereIn('id_pv', [0,1,2] )->get();
        $fpagos = Pvariable::whereIn('id_pv', [220,230,240] )->get();
        return view('bingresos.m_bingresos', compact('parqos', 'sinos', 'fpagos'));

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
            'forma_pago' => 'required',
            'reserva' => 'required',
            'fecha_desde' => 'required',
            'fecha_hasta' => 'required',
        ];
 
     $messages = [
    'id_parque.required' => 'El Código del Parqueadero no puede ser nulo',
    'forma_pago.required' => 'La Forma de Pago no puede ser nula',
    'reserva.required' => 'La Reserva no puede ser nula',
    'fecha_desde.required' => 'La Fecha Desde no puede ser nula',
    'fecha_hasta.required' => 'La Fecha Hasta no puede ser nula',
    ];

    $this->validate($request, $rules, $messages);

    $cc_user = auth()->user()->cc_user;
    $parqos = Parqueo::where('id_parque', '=', $id_parque);
//    ->where('cc_user', '=', $cc_user);
//    dd($request->file('foto_parque'));

    $parqos->update(['forma_pago'=> $request->input('forma_pago'),
    'reserva'=> $request->input('reserva'),
    'fecha_desde'=> $request->input('fecha_desde'),
    'fecha_hasta'=> $request->input('fecha_hasta')
    ]);
    Session::flash('message','Registro Actualizado Correctamente!');
    Session::flash('class','info');

    return Redirect::to('t_bingresos/show/'.$id_parque)->with('status','Actualizado Correctamente....!');

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
