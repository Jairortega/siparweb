<?php

namespace parqueos\Http\Controllers;

use Illuminate\Http\Request;
use parqueos\Http\Requests\StoreClienteRequest;
use Illuminate\Database\Eloquent\Model;
use parqueos\Usuario;
use parqueos\Opcperfil;
use parqueos\Banco; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class BancoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_opcion =4170;
        $idperfil = auth()->user()->id_perfil;
        $emailclien = auth()->user()->email;
        $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)
        ->where('id_opcion','=', $id_opcion)
        ->get();
        $bancos = Banco::where('cod_bco', '>', 0)->paginate(5);
        return view('bancos.t_bancos', compact('bancos', 'perfiles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bancos.i_bancos');
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
        $regbco = Banco::where('cod_bco', '=', $request->input('cod_bco'))->get();

        if(!$regbco->isEmpty()){
            Session::flash('message','Código ya Existe..!!!');
            Session::flash('class','danger');
        } 

        $rules = [
            'cod_bco' => 'required',
            'banco' => 'required'
        ];
 
     $messages = [
    'cod_bco.required' => 'El Código no puede ser nulo',
    'banco.required' => 'El nombre del Banco no puede ser nulo',
    ];

    $this->validate($request, $rules, $messages);


        $regbco = Banco::where('cod_bco', '=', $request->input('cod_bco'))->get();
        if($regbco->isEmpty()){
    
               $opbco = new Banco();
               $opbco->cod_bco = $request->input('cod_bco');
               $opbco->banco = $request->input('banco');
               if($opbco->save()){
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
    
            return Redirect::to('t_bancos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cod_bco)
    {
        $bancos = Banco::where('cod_bco', '=', $cod_bco)->get();
        return view('bancos.v_bancos', compact('bancos'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cod_bco)
    {
        $bancos = Banco::where('cod_bco', '=', $cod_bco)->get();
        return view('bancos.m_bancos', compact('bancos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cod_bco)
    {
        $sw1 = 0;
        $rules = [
            'cod_bco' => 'required',
            'banco' => 'required'
        ];
 
     $messages = [
    'cod_bco.required' => 'El Código no puede ser nulo',
    'banco.required' => 'El nombre del Banco no puede ser nulo',
    ];

    $this->validate($request, $rules, $messages);

    $opbco = Banco::where('cod_bco', '=', $cod_bco); 
    $opbco->update(['banco'=> $request->input('banco')]);
    Session::flash('message','Registro Actualizado Correctamente!');
    Session::flash('class','info');

    return Redirect::to('t_bancos/show/'.$cod_bco)->with('status','Actualizado Correctamente....!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cod_bco)
    {
        $tbanco = Banco::where('cod_bco', '=', $cod_bco);
        $tbanco->delete();
        return Redirect::to('t_bancos');

    }
}
