<?php

namespace parqueos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use parqueos\Usuario;
use parqueos\Opcperfil;
use parqueos\Grupoparqueo; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class GrparqueController extends Controller
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

        $id_opcion = 4012;
        $idperfil = auth()->user()->id_perfil;
        $cc_user = auth()->user()->cc_user;
        $emailclien = auth()->user()->email;
        $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)
        ->where('id_opcion','=', $id_opcion)
        ->get();
        if($idperfil == 999){
            $grparqos = Grupoparqueo::where('cc_user', '>', 0)->paginate(5);
        } else {
            $grparqos = Grupoparqueo::where('cc_user', '=', $cc_user)->paginate(5);
        }
        return view('grparqueos.t_gparqueos', compact('grparqos', 'perfiles'));
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
        return view('grparqueos.i_gparqueos')->with('cc_user', $cc_user);
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
        $grparqueos = Grupoparqueo::where('cod_gr_parque', '=', $request->input('cod_gr_parque'))
        ->where('cc_user', '=', $cc_user)->get();
        if(!$grparqueos->isEmpty()){
            Session::flash('message','Código ya Existe..!!!');
            Session::flash('class','danger');
        } 

        $rules = [
            'cod_gr_parque' => 'required',
            'des_gr_parque' => 'required'
        ];
 
     $messages = [
    'cod_gr_parque.required' => 'El Código no puede ser nulo',
    'des_gr_parque.required' => 'La descripción del Grupo no puede ser nulo',
    ];

    $this->validate($request, $rules, $messages);


    $grparqueos = Grupoparqueo::where('cod_gr_parque', '=', $request->input('cod_gr_parque'))
    ->where('cc_user', '=', $cc_user)->get();
    if($grparqueos->isEmpty()){
    
               $opgrpar = new Grupoparqueo();
               $opgrpar->cod_gr_parque = $request->input('cod_gr_parque');
               $opgrpar->cc_user = $cc_user;
               $opgrpar->des_gr_parque = $request->input('des_gr_parque');
               if($opgrpar->save()){
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
    
            return Redirect::to('t_gparqueos');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cod_gr_parque)
    {
        $cc_user = auth()->user()->cc_user;
        $grparqos = Grupoparqueo::where('cod_gr_parque', '=', $cod_gr_parque)
        ->where('cc_user', '=', $cc_user)->get();
        return view('grparqueos.v_gparqueos', compact('grparqos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cod_gr_parque)
    {
        $cc_user = auth()->user()->cc_user;
        $grparqos = Grupoparqueo::where('cod_gr_parque', '=', $cod_gr_parque)
        ->where('cc_user', '=', $cc_user)->get();
        return view('grparqueos.m_gparqueos', compact('grparqos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_gr_parque)
    {
        $sw1 = 0;
        $rules = [
            'cod_gr_parque' => 'required',
            'des_gr_parque' => 'required'
        ];
 
     $messages = [
    'cod_gr_parque.required' => 'El Código no puede ser nulo',
    'des_gr_parque.required' => 'La descripción del Grupo no puede ser nulo',
    ];

    $this->validate($request, $rules, $messages);

    $cc_user = auth()->user()->cc_user;
    $grparqos = Grupoparqueo::where('cod_gr_parque', '=', $cod_gr_parque)
    ->where('cc_user', '=', $cc_user);
    $grparqos->update(['des_gr_parque'=> $request->input('des_gr_parque')]);
    Session::flash('message','Registro Actualizado Correctamente!');
    Session::flash('class','info');

    return Redirect::to('t_gparqueos/show/'.$cod_gr_parque)->with('status','Actualizado Correctamente....!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_gr_parque)
    {
        $cc_user = auth()->user()->cc_user;
        $grparqos = Grupoparqueo::where('cod_gr_parque', '=', $cod_gr_parque)
        ->where('cc_user', '=', $cc_user);
        $grparqos->delete();
        return Redirect::to('t_gparqueos');
    }
}
