<?php

namespace parqueos\Http\Controllers;

use Illuminate\Http\Request;

use parqueos\Grupomenu;
use parqueos\Opcion;
use parqueos\Vopcion;
use parqueos\Opcperfil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class OpcionController extends Controller
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

        $id_opcion = 9000;
        $idperfil = auth()->user()->id_perfil;
        $emailclien = auth()->user()->email;
        $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)
        ->where('id_opcion','=', $id_opcion)->get();
    
        $grupos = Grupomenu::all();
        $opciones = Opcion::orderBy('id_opcion')
        ->paginate(5);
 //       ->get();
        return view('opciones.t_opciones', compact('opciones', 'grupos', 'perfiles'));
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
        $grupos = Grupomenu::all();
        return view('opciones.i_opciones', compact('grupos'));
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
        $regopcion = Opcion::where('id_opcion', '=', $request->input('id_opcion'))->get();

        if(!$regopcion->isEmpty()){
            Session::flash('message','Código ya Existe..!!!');
            Session::flash('class','danger');
//            return Redirect::to('t_opciones');
        } 

        $rules = [
            'id_opcion' => 'required|min:4|max:4',
            'opcion' => 'required',
            'name_objeto' => 'required',
            'consulta' => 'required',
            'grupo' => 'required'
        ];
 
     $messages = [
    'id_opcion.required' => 'El Código no puede ser nulo',
    'opcion.required' => 'La descripción de la Opción no puede ser nula',
    'name_objeto.required' => 'El nombre del objeto no puede ser nulo',
    'consulta.required' => 'El nombre de la Vista no puede ser nulo',
    'grupo.required' => 'el Código del grupo no puede ser nulo'
    ];

    $this->validate($request, $rules, $messages);


        $regopcion = Opcion::where('id_opcion', '=', $request->input('id_opcion'))->get();
        if($regopcion->isEmpty()){
    
               $opmenu = new Opcion();
               $opmenu->grupo = $request->input('grupo');
               $opmenu->id_opcion = $request->input('id_opcion');
               $opmenu->opcion = $request->input('opcion');
               $opmenu->name_objeto = $request->input('name_objeto');
               $opmenu->consulta = $request->input('consulta');
               $opmenu->rep_pdf = $request->input('rep_pdf');
               $opmenu->rep_csv = $request->input('rep_csv');
               $opmenu->rep_txt = $request->input('rep_txt');
               if($opmenu->save()){
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
    
            return Redirect::to('t_opciones');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_opcion)
    {
        $opciones = Vopcion::where('id_opcion', '=', $id_opcion)->get();
        return view('opciones.v_opciones', compact('opciones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_opcion)
    {
        $grupos = Grupomenu::all();
        $opciones = Vopcion::where('id_opcion', '=', $id_opcion)->get();
        return view('opciones.m_opciones', compact('opciones', 'grupos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_opcion)
    {
        $sw1 = 0;
        $rules = [
            'id_opcion' => 'required|min:4|max:4',
            'opcion' => 'required',
            'name_objeto' => 'required',
            'consulta' => 'required',
            'grupo' => 'required'
        ];
 
     $messages = [
    'id_opcion.required' => 'El Código no puede ser nulo',
    'opcion.required' => 'La descripción de la Opción no puede ser nula',
    'name_objeto.required' => 'El nombre del objeto no puede ser nulo',
    'consulta.required' => 'El nombre de la Vista no puede ser nulo',
    'grupo.required' => 'el Código del grupo no puede ser nulo'
    ];

    $this->validate($request, $rules, $messages);

    $opciones = Opcion::where('id_opcion', '=', $id_opcion); 
    $opciones->update(['grupo'=> $request->input('grupo'),
    'opcion'=> $request->input('opcion'),
    'name_objeto'=> $request->input('name_objeto'),
    'consulta'=> $request->input('consulta'),
    'rep_pdf'=> $request->input('rep_pdf'),
    'rep_csv'=> $request->input('rep_csv'),
    'rep_txt'=> $request->input('rep_txt')]);
    Session::flash('message','Registro Actualizado Correctamente!');
    Session::flash('class','info');

    return Redirect::to('t_opciones/show/'.$id_opcion)->with('status','Actualizado Correctamente....!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_opcion)
    {
        $topcion = Opcion::where('id_opcion', '=', $id_opcion);
        $topcion->delete();
        return Redirect::to('t_opciones');
    }
}
