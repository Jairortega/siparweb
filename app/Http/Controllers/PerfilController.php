<?php

namespace parqueos\Http\Controllers;

use Illuminate\Http\Request;
use parqueos\Perfil;
use parqueos\Opcperfil;
// use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class PerfilController extends Controller
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

        $id_opcion = 9010;
        $idperfil = auth()->user()->id_perfil;
        $emailclien = auth()->user()->email;
        $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)
        ->where('id_opcion','=', $id_opcion)->get();
    
       $operfiles = Perfil::orderBy('id_perfil')
        ->paginate(5);
 //       ->get();
        return view('perfiles.t_perfiles', compact('perfiles', 'operfiles'));
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
        return view('perfiles.i_perfiles');
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
        $operfiles = Perfil::where('id_perfil', '=', $request->input('id_perfil'))->get();

        if(!$operfiles->isEmpty()){
            Session::flash('message','Código ya Existe..!!!');
            Session::flash('class','danger');
        } 

        $rules = [
            'id_perfil' => 'required',
            'perfil' => 'required',
        ];
 
     $messages = [
    'id_perfil.required' => 'El Código no puede ser nulo',
    'perfil.required' => 'El Nombre del Perfil no puede ser nulo'
    ];

    $this->validate($request, $rules, $messages);


        $operfiles = Perfil::where('id_perfil', '=', $request->input('id_perfil'))->get();
        if($operfiles->isEmpty()){
    
               $operfil = new Perfil();
               $operfil->id_perfil = $request->input('id_perfil');
               $operfil->perfil = $request->input('perfil');
               if($operfil->save()){
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
    
            return Redirect::to('t_perfiles');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_perfil)
    {
        $operfiles = Perfil::where('id_perfil', '=', $id_perfil)->get();
        return view('perfiles.v_perfiles', compact('operfiles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_perfil)
    {
        $operfiles = Perfil::where('id_perfil', '=', $id_perfil)->get();
        return view('perfiles.m_perfiles', compact('operfiles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_perfil)
    {
        $sw1 = 0;
        $rules = [
            'id_perfil' => 'required',
            'perfil' => 'required'
        ];
 
     $messages = [
    'id_perfil.required' => 'El Código no puede ser nulo',
    'perfil.required' => 'El Nombre del Perfil no puede ser nulo'
    ];

    $this->validate($request, $rules, $messages);

    $operfiles = Perfil::where('id_perfil', '=', $id_perfil); 
    $operfiles->update(['perfil'=> $request->input('perfil')]);
    Session::flash('message','Registro Actualizado Correctamente!');
    Session::flash('class','info');

    return Redirect::to('t_perfiles/show/'.$id_perfil)->with('status','Actualizado Correctamente....!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_perfil)
    {
        $tperfil = Perfil::where('id_perfil', '=', $id_perfil);
        $tperfil->delete();
        return Redirect::to('t_perfiles');
    }
}
