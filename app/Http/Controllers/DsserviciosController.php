<?php

namespace parqueos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use parqueos\Usuario;
use parqueos\Opcperfil;
use parqueos\Dsservicio;
use parqueos\Parqueo;
use parqueos\Vfecsin_servicio; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;



class DsserviciosController extends Controller
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

        $id_opcion = 4040;
        $idperfil = auth()->user()->id_perfil;
        $cc_user = auth()->user()->cc_user;
        $emailclien = auth()->user()->email;
        $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)
        ->where('id_opcion','=', $id_opcion)
        ->get();
        if($idperfil == 999){
            $dssrvs = Vfecsin_servicio::where('cc_user', '>', 0)->orderBy('des_gr_parque', 'desc')->paginate(5);
        } else {
            $dssrvs = Vfecsin_servicio::where('cc_user', '=', $cc_user)->paginate(5);
        }    
            return view('dsservicios.t_dsservicios', compact('dssrvs', 'perfiles'));
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
           $parqos = Parqueo::where('cc_user', '>', 0)->get();
        } else {
            $parqos = Parqueo::where('cc_user', '=', $cc_user)->get();
        }    
        return view('dsservicios.i_dsservicios', compact('parqos'));

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
        $dssrvs = Dsservicio::where('id_parque', '=', $request->input('id_parque'))
        ->where('cc_user', '=', $cc_user)
        ->where('fecha_parque', '=', $request->input('fecha_parque')) 
        ->where('hora_ini', '=', $request->input('hora_ini'))->get(); 
        if(!$dssrvs->isEmpty()){
            Session::flash('message','Fecha y hora ya Existe..!!!');
            Session::flash('class','danger');
        } 

        $rules = [
            'id_parque' => 'required',
            'fecha_parque' => 'required',
            'hora_ini' => 'required',
            'hora_fin' => 'required'
        ];
 
     $messages = [
    'id_parque.required' => 'El Código no puede ser nulo',
    'fecha_parque.required' => 'La fecha no puede ser nula',
    'hora_ini.required' => 'La hora inicial no puede ser nula',
    'hora_fin.required' => 'La hora final no puede ser nula'
    ];

    $this->validate($request, $rules, $messages);

    $horai = substr($request->input('hora_ini'),0,2);
    $horaf = substr($request->input('hora_fin'),0,2);
    $mini = substr($request->input('hora_ini'),3,2);
    $minf = substr($request->input('hora_fin'),3,2);
    $thmi = intval($horai.$mini);
    $thmf = intval($horaf.$minf);
    if($thmi < $thmf) {
        $dssrvs = Dsservicio::where('id_parque', '=', $request->input('id_parque'))
        ->where('cc_user', '=', $cc_user)
        ->where('fecha_parque', '=', $request->input('fecha_parque'))
        ->where('hora_ini', '=', $request->input('hora_ini'))->get(); 
        if($dssrvs->isEmpty()){
            $dsserv = new Dsservicio();
            $dsserv->id_parque = $request->input('id_parque');
            $dsserv->cc_user = $cc_user;
            $dsserv->fecha_parque = $request->input('fecha_parque');
            $dsserv->hora_ini = $request->input('hora_ini');
            $dsserv->hora_fin = $request->input('hora_fin');
            if($dsserv->save()){
                $sw1 = 1;
            } else{
                $sw1 = 0;   
            }
    }
} else {
    $sw1 = 2;
  }

    $cc_user = auth()->user()->cc_user;
    $parqos = Dsservicio::where('id_parque', '=', $request->input('id_parque'))
    ->where('cc_user', '=', $cc_user)
    ->where('fecha_parque', '=', $request->input('fecha_parque'))
    ->where('hora_ini', '=', $request->input('hora_ini'))->get(); 
    if($sw1 === 0){
        Session::flash('message','Fecha y hora ya Existe..!!!');
        Session::flash('class','danger');
    } 

    if($sw1 === 1){
       Session::flash('message','Registro Guardado Correctamente!');
       Session::flash('class','info');
    }

    if($sw1 === 2){
        Session::flash('message','La hora final debe ser mayor..!!');
        Session::flash('class','danger');     
    } 

//    return Redirect::to('t_dsservicios');
        $cc_user = auth()->user()->cc_user;
        $idperfil = auth()->user()->id_perfil;
        if($idperfil == 999){
        $parqos = Parqueo::where('cc_user', '>', 0)->get();
        } else {
            $parqos = Parqueo::where('cc_user', '=', $cc_user)->get();
        }    

      return view('dsservicios.i_dsservicios', compact('parqos'));

}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_parque, $fecha_parque, $hora_ini)
    {
        $cc_user = auth()->user()->cc_user;
        $dssrvs = Vfecsin_servicio::where('id_parque', '=', $id_parque)
        ->where('cc_user', '=', $cc_user)
        ->where('fecha_parque', '=', $fecha_parque)
        ->where('hora_ini', '=', $hora_ini)->get(); 
        return view('dsservicios.v_dsservicios', compact('dssrvs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($created_at)
    {
        $cc_user = auth()->user()->cc_user;
    //    $dssrvs = vfecsin_servicio::where('id_parque', '=', $id_parque)
    //    ->where('cc_user', '=', $cc_user)
    //    ->where('fecha_parque', '=', $fecha_parque)->get();
        $dssrvs = Vfecsin_servicio::where('created_at', '=', $created_at)->get();
        return view('dsservicios.m_dsservicios', compact('dssrvs'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $created_at)
    {
        $sw1 = 0;
        $cc_user = auth()->user()->cc_user;
        $dssrvs = Dsservicio::where('created_at', '=', $created_at)->get();
//           return $dssrvs;
        if($dssrvs->isEmpty()){
            Session::flash('message','Fecha no Existe..!!!');
            Session::flash('class','danger');
        } 

        $rules = [
            'id_parque' => 'required',
            'fecha_parque' => 'required'
        ];
 
     $messages = [
    'id_parque.required' => 'El Código no puede ser nulo',
    'fecha_parque.required' => 'La fecha no puede ser nula'
    ];

    $this->validate($request, $rules, $messages);

    $horai = substr($request->input('hora_ini'),0,2);
    $horaf = substr($request->input('hora_fin'),0,2);
    $mini = substr($request->input('hora_ini'),3,2);
    $minf = substr($request->input('hora_fin'),3,2);
    $thmi = intval($horai.$mini);
    $thmf = intval($horaf.$minf);
    $estadoreg = 'Actualizado Correctamente....!';
    $id_parque = $request->input('id_parque');
    $fecha_parque = $request->input('fecha_parque');
    $hora_ini = $request->input('hora_ini');
    $dssrvs = Vfecsin_servicio::where('id_parque', '=', $id_parque)
    ->where('cc_user', '=', $cc_user)
    ->where('fecha_parque', '=', $fecha_parque)->get();
//    ->where('hora_ini', '=', $hora_ini)->get();

    if($thmi < $thmf) {

    $cc_user = auth()->user()->cc_user;
    $dssrvs = Dsservicio::where('created_at', '=', $created_at);
    $dssrvs->update(['fecha_parque'=> $request->input('fecha_parque'),
    'hora_ini'=> $request->input('hora_ini'),
    'hora_fin'=> $request->input('hora_fin')]);

    $dssrvs = Vfecsin_servicio::where('id_parque', '=', $id_parque)
    ->where('cc_user', '=', $cc_user)
    ->where('fecha_parque', '=', $fecha_parque)->get();
//    ->where('hora_ini', '=', $hora_ini)->get();
    Session::flash('message','Actualizado Correctamente....!');
    Session::flash('class','info');
//    return Redirect::to('t_dsservicios/show/'.$id_parque.'/'.$fecha_parque.'/'.$hora_ini)->with('status','Actualizado Correctamente....!');
 } else {
    $estadoreg = 'La hora final debe ser mayor..!!'; 
    Session::flash('message','La hora final debe ser mayor..!!');
    Session::flash('class','danger');     
  }
  return Redirect::to('t_dsservicios/show/'.$id_parque.'/'.$fecha_parque.'/'.$hora_ini)->with('status',$estadoreg, 'class','danger');
 }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_parque, $fecha_parque, $hora_ini)
    {
        $cc_user = auth()->user()->cc_user;
        $dssrvs = Dsservicio::where('id_parque', '=', $id_parque)
        ->where('cc_user', '=', $cc_user)
        ->where('fecha_parque', '=', $fecha_parque)
        ->where('hora_ini', '=', $hora_ini);
        $dssrvs->delete();
        return Redirect::to('t_dsservicios');

    }
}
