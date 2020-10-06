<?php

namespace parqueos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use parqueos\Usuario;
use parqueos\Opcperfil;
use parqueos\Comercial; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class ComercialController extends Controller
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

        $id_opcion = 4175;
        $idperfil = auth()->user()->id_perfil;
        $cc_user = auth()->user()->cc_user;
        $emailclien = auth()->user()->email;
        $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)
        ->where('id_opcion','=', $id_opcion)
        ->get();
//        if($idperfil == 999){
//            $comerciales = Comercial::where('id_comer', '=', 1)->paginate(5);
//        }
        $comerciales = Comercial::where('id_comer', '=', 1)->get();
        return view('comerciales.t_comercial', compact('comerciales', 'perfiles'));
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
    public function show($id_comer)
    {
        $idperfil = auth()->user()->id_perfil;
        $cc_user = auth()->user()->cc_user;
        $comerciales = Comercial::where('id_comer', '=', $id_comer)->get();
        return view('comerciales.v_comercial', compact('comerciales'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_comer)
    {
        $idperfil = auth()->user()->id_perfil;
        $cc_user = auth()->user()->cc_user;
        $comerciales = Comercial::where('id_comer', '=', $id_comer)->get();
        return view('comerciales.m_comercial', compact('comerciales'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_comer)
    {
        $sw1 = 0;
        $rules = [
            'archi_comer' => 'required',
            'tipo_comer' => 'required'
        ];
 
     $messages = [
    'archi_comer.required' => 'El Nombre del Archivo no puede ser nulo',
    'tipo_comer.required' => 'El Tipo de Archivo no puede ser nulo'
    ];

    $this->validate($request, $rules, $messages);

    $cc_user = auth()->user()->cc_user;
//    $id_comer = $request->input('id_comer');
//    $id_comer = $id;
    $name = 'parqueos5.jpg';

    $comerciales = Comercial::where('id_comer', '=', $id_comer);

    if($request->hasFile('archi_comer')){
        $file = $request->file('archi_comer');
        $name = $file->getClientOriginalName();
        $file->move(public_path().'/img/', $name);
//        return $name;
    }

    $comerciales->update(['archi_comer'=> $name,
    'tipo_comer'=> $request->input('tipo_comer')
    ]);
    Session::flash('message','Registro Actualizado Correctamente!');
    Session::flash('class','info');

    return Redirect::to('t_comercial/show/'.$id_comer)->with('status','Actualizado Correctamente....!');

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
