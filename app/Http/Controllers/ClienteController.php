<?php

namespace parqueos\Http\Controllers;

use Illuminate\Http\Request;
use parqueos\Http\Requests\StoreClienteRequest;
use parqueos\Vcliente;
use Illuminate\Database\Eloquent\Model;
use parqueos\Usuario;
use parqueos\Opcperfil;
use parqueos\Ciudaddepto; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class ClienteController extends Controller
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
        $id_opcion =4020;
        $idperfil = auth()->user()->id_perfil;
        $emailclien = auth()->user()->email;
        $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)
        ->where('id_opcion','=', $id_opcion)->get();

        if($idperfil == 999){
          $clientes = Vcliente::where('email', '>', ' ')->paginate(5);
        } else {
          $clientes = Vcliente::where('email', '=', $emailclien)->paginate(5);
        }    

        return view('clientes.t_clientes', compact('clientes', 'perfiles'));
    } else {
        return Redirect::to('home');  
    }
//        return $clientes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.i_clientes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClienteRequest $request)
    { 
        $sw1 = 0;

        $regclien = vcliente::where('cc_user', '=', $request->input('cc_user'))->get();
        if(!$regclien->isEmpty()){
            Session::flash('message','Cédula ya Existe..!!!');
            Session::flash('class','danger');
            return Redirect::to('home');
        } 

    $regclien = Vcliente::where('cc_user', '=', $request->input('cc_user'))->get();
    if($regclien->isEmpty()){

           $ador = new User();
           $ador->cc_user = $request->input('cc_cliente');
           $ador->name = $request->input('name');
           $ador->tel_user = $request->input('tel_user');
           $ador->cel_user = $request->input('cel_user');
           $ador->email = $request->input('email');
           $ador->cod_dc_user = $request->input('cod_dc_user');
           $ador->estado_clien = 0;
           $ador->observa_clien = "__";
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
            Session::flash('message','Cédula no Existe..!!!');
            Session::flash('class','danger');
           } 

        return Redirect::to('clientes.t_clientes');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cc_cliente)
    {
//     return $cc_cliente;
        $clientes = Vcliente::where('cc_user', '=', $cc_cliente)->get();
        return view('clientes.v_clientes', compact('clientes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cc_cliente)
    {
//     dd($cc_cliente);
     $deptos = Ciudaddepto::orderBy('desc_ciudepto')->get();
     $clientes = Vcliente::where('cc_user', '=', $cc_cliente)->get();
     return view('clientes.m_clientes', compact('clientes', 'deptos'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClienteRequest $request, $cc_cliente)
    {
        $sw1 = 0;

        $regclien = Usuario::where('cc_user', '=', $cc_cliente); 
        $regclien->update(['name'=> $request->input('name'),
        'tel_user'=> $request->input('tel_user'),
        'cel_user'=> $request->input('cel_user'),
        'cod_dc_user'=> $request->input('cod_dc_user')]);
        Session::flash('message','Registro Actualizado Correctamente!');
        Session::flash('class','info');

//        return Redirect::to('t_clientes');
        return Redirect::to('t_clientes/show/'.$cc_cliente)->with('status','Actualizado Correctamente....!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cc_cliente)
    {
        return "borrar: ".$cc_cliente;
        $tcliente = Cliente::findOrfail($cc_cliente);
        $tcliente->delete();
        return Redirect::to('clientes.t_clientes');
    }
}
