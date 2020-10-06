<?php

namespace parqueos\Http\Controllers;

use Illuminate\Http\Request;
use parqueos\Opcion;
use parqueos\Vperfilesxop;
use parqueos\Opcperfil;
use parqueos\Perfil;
use parqueos\Perfilesxop;
use parqueos\Pvariable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class PerfilesxopController extends Controller
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
            
        $id_opcion = 9020;
        $idperfil = auth()->user()->id_perfil;
        $emailclien = auth()->user()->email;
        $operfiles = Opcperfil::where('id_perfil', '=', $idperfil)
        ->where('id_opcion','=', $id_opcion)->get();
        $opxperfiles = Vperfilesxop::where('id_opcion', '>', 0)
        ->paginate(5);
 //       ->get();
        return view('perfilesxop.t_perfilesxop', compact('operfiles', 'opxperfiles'));
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
        $opciones = Opcion::all();
        $perfiles = Perfil::all();
        $ivapvars = Pvariable::where('id_pv', '<', 9)->get();
        return view('perfilesxop.i_perfilesxop', compact('opciones', 'ivapvars', 'perfiles'));
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
        $perfilesxop = Perfilesxop::where('id_perfil', '=', $request->input('id_perfil'))
        ->where('id_opcion', '=', $request->input('id_opcion'))->get();

        if(!$perfilesxop->isEmpty()){
            Session::flash('message','Código ya Existe..!!!');
            Session::flash('class','danger');
//            return Redirect::to('t_opciones');
        } 

        $rules = [
            'id_perfil' => 'required',
            'id_opcion' => 'required|min:4|max:4',
            'p_insertar' => 'required',
            'p_modificar' => 'required',
            'p_borrar' => 'required',
            'r_pdf' => 'required',
            'r_csv' => 'required',
            'r_txt' => 'required'
        ];
 
     $messages = [
    'id_perfil.required' => 'El Código Perfil no puede ser nulo',
    'id_opcion.required' => 'El Código Opción puede ser nulo',
    'p_insertar.required' => 'El permiso de Insertar no puede ser nulo',
    'p_modificar.required' => 'El permiso de Modificar no puede ser nulo',
    'p_borrar.required' => 'El permiso de Borrar no puede ser nulo',
    'r_pdf.required' => 'El permiso de PDF no puede ser nulo',
    'r_csv.required' => 'El permiso de CSV no puede ser nulo',
    'r_txt.required' => 'el permiso de TXT no puede ser nulo'
    ];

    $this->validate($request, $rules, $messages);

    $perfilesxop = Perfilesxop::where('id_perfil', '=', $request->input('id_perfil'))
    ->where('id_opcion', '=', $request->input('id_opcion'))->get();
    if($perfilesxop->isEmpty()){
    
            $operfil = new Perfilesxop();
            $operfil->id_perfil = $request->input('id_perfil');
            $operfil->id_opcion = $request->input('id_opcion');
            $operfil->p_insertar = $request->input('p_insertar');
            $operfil->p_modificar = $request->input('p_modificar');
            $operfil->p_borrar = $request->input('p_borrar');
            $operfil->r_pdf = $request->input('r_pdf');
            $operfil->r_csv = $request->input('r_csv');
            $operfil->r_txt = $request->input('r_txt');
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

        return Redirect::to('t_perfilesxop');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_perfil, $id_opcion)
    {
        $operfiles = Vperfilesxop::where('id_perfil', '=', $id_perfil)
        ->where('id_opcion', '=', $id_opcion)->get();
        return view('perfilesxop.v_perfilesxop', compact('operfiles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_perfil, $id_opcion)
    {
        $opciones = Opcion::all();
        $perfiles = Perfil::all();
        $ivapvars = Pvariable::where('id_pv', '<', 9)->get();
        $operfiles = Vperfilesxop::where('id_perfil', '=', $id_perfil)
        ->where('id_opcion', '=', $id_opcion)->get();
        return view('perfilesxop.m_perfilesxop', compact('opciones', 'perfiles', 'ivapvars', 'operfiles'));
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
            'id_opcion' => 'required|min:4|max:4',
            'p_insertar' => 'required',
            'p_modificar' => 'required',
            'p_borrar' => 'required',
            'r_pdf' => 'required',
            'r_csv' => 'required',
            'r_txt' => 'required'
        ];
 
     $messages = [
    'id_perfil.required' => 'El Código Perfil no puede ser nulo',
    'id_opcion.required' => 'El Código Opción puede ser nulo',
    'p_insertar.required' => 'El permiso de Insertar no puede ser nulo',
    'p_modificar.required' => 'El permiso de Modificar no puede ser nulo',
    'p_borrar.required' => 'El permiso de Borrar no puede ser nulo',
    'r_pdf.required' => 'El permiso de PDF no puede ser nulo',
    'r_csv.required' => 'El permiso de CSV no puede ser nulo',
    'r_txt.required' => 'el permiso de TXT no puede ser nulo'
    ];

    $this->validate($request, $rules, $messages);

    $perfilesxop = Perfilesxop::where('id_perfil', '=', $id_perfil)
    ->where('id_opcion', '=', $request->input('id_opcion'));
    $perfilesxop->update(['p_insertar'=> $request->input('p_insertar'),
    'p_modificar'=> $request->input('p_modificar'),
    'p_borrar'=> $request->input('p_borrar'),
    'r_pdf'=> $request->input('r_pdf'),
    'r_csv'=> $request->input('r_csv'),
    'r_txt'=> $request->input('r_txt')]);

    $id_perfil = $request->input('id_perfil');
    $id_opcion = $request->input('id_opcion');

    $dssrvs = Vperfilesxop::where('id_perfil', '=', $id_perfil)
    ->where('id_opcion', '=', $id_opcion)->get();
    Session::flash('message','Actualizado Correctamente....!');
    Session::flash('class','info');
    return Redirect::to('t_perfilesxop/show/'.$id_perfil.'/'.$id_opcion)->with('status','Actualizado Correctamente....!');

  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_perfil, $id_opcion)
    {
        $perfilesxop = Perfilesxop::where('id_perfil', '=', $id_perfil)
        ->where('id_opcion', '=', $id_opcion);
        $perfilesxop->delete();
        return Redirect::to('t_perfilesxop');

    }
}
