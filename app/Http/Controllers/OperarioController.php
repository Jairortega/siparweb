<?php

namespace parqueos\Http\Controllers;

use Illuminate\Http\Request;
use parqueos\Http\Requests\StoreClienteRequest;
use parqueos\Vcliente;
use Illuminate\Database\Eloquent\Model;
use parqueos\Usuario;
use parqueos\Opcperfil;
use parqueos\Operario; 
use parqueos\Voperario;
use parqueos\Parqueo;
use parqueos\Ciudaddepto; 
use parqueos\User;
use parqueos\Pvariable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class OperarioController extends Controller
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
        $id_opcion =4050;
        $cc_user = auth()->user()->cc_user;
        $idperfil = auth()->user()->id_perfil;
        $emailclien = auth()->user()->email;
        $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)
        ->where('id_opcion','=', $id_opcion)->get();

        if($idperfil == 999){
          $operarios = Voperario::where('cc_user', '>', 0)->paginate(5);
        } else {
          $operarios = Voperario::where('cc_user', '=', $cc_user)->paginate(5);
        }    
        return view('operarios.t_operarios', compact('operarios', 'perfiles'));
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
        $deptos = Ciudaddepto::orderBy('desc_ciudepto')->get();
        if($idperfil == 999){
           $parqos = Parqueo::where('cc_user', '>', 0)->get();
        } else {
            $parqos = Parqueo::where('cc_user', '=', $cc_user)->get();
        }    
        return view('operarios.i_operarios', compact('parqos', 'deptos'));

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
        $operarios = Operario::where('cc_operario', '=', $request->input('cc_operario'))
        ->where('bloqueo', '=', 0)->get();

        if(!$operarios->isEmpty()){
            Session::flash('message','Cédula ya Existe..!!!');
            Session::flash('class','danger');
        } 

        $rules = [
            'cc_operario' => 'required',
            'nom_operario' => 'required',
            'id_parque' => 'required',
            'dir_operario' => 'required',
            'tel_operario' => 'required',
            'cel_operario' => 'required',
            'mail_operario' => 'required|email',
//           'cod_dc_operario' => 'required'
        ];
 
     $messages = [
    'cc_operario.required' => 'La Cédula no puede ser nula',
    'nom_operario.required' => 'El Nombre del Operario no puede ser nulo',
    'id_parque.required' => 'El Código del Parqueadero no puede ser nulo',
    'dir_operario.required' => 'La Dirección no puede ser nula',
    'tel_operario.required' => 'El Teléfono no puede ser nulo',
    'cel_operario.required' => 'El Celular no puede ser nulo',
    'mail_operario.required' => 'El Correo no puede ser nulo',
//    'cod_dc_operario.required' => 'El Código de la Ciudad no puede ser nulo'
    ];

    $this->validate($request, $rules, $messages);

    $operarios = Operario::where('cc_operario', '=', $request->input('cc_operario'))->get();

    if($operarios->isEmpty()){

               $bloqueo = 0;
               $nopera = new Operario();
               $nopera->cc_operario = $request->input('cc_operario');
               $nopera->id_parque = $request->input('id_parque');
               $nopera->cc_user = $cc_user;
               $nopera->nom_operario = $request->input('nom_operario');
               $nopera->dir_operario = $request->input('dir_operario');
               $nopera->tel_operario = $request->input('tel_operario');
               $nopera->cel_operario = $request->input('cel_operario');
               $nopera->mail_operario = $request->input('mail_operario');
//               $nopera->cod_dc_operario = $request->input('cod_dc_operario');
               $nopera->cod_dc_operario = "11001";
               $nopera->bloqueo = $bloqueo;
               if($nopera->save()){
                  $sw1 = 1;
               } else{
                  $sw1 = 0;   
               }

               // 150 = operario
               $idperfil = 150;
               $usuarios = User::where('cc_user','=', $request->input('cc_operario'))->get();

               if($usuarios->isEmpty()){
                   $ador = new User();
                   $ador->cc_user = $request->input('cc_operario');
                   $ador->name = $request->input('nom_operario');
                   $ador->tel_user = $request->input('tel_operario');
                   $ador->cel_user = $request->input('cel_operario');
                   $ador->email = $request->input('mail_operario');
//                   $ador->cod_dc_user = $request->input('cod_dc_operario');
                   $ador->cod_dc_user = "11001";
                   $ador->id_perfil = $idperfil;
                   $ador->password = Hash::make($request->input('cc_operario'));
                   $ador->save();
               }
           
            } else {
                $bloqueo = 0;
                $operarios = Operario::where('cc_operario', '=', $request->input('cc_operario'))->get();
                $operarios->update(['nom_operario'=> $request->input('nom_operario'),
                'id_parque'=> $request->input('id_parque'),
                'cc_user'=> $cc_user,
                'dir_operario'=> $request->input('dir_operario'),
                'tel_operario'=> $request->input('tel_operario'),
                'cel_operario'=> $request->input('cel_operario'),
                'mail_operario'=> $request->input('mail_operario'),
//                'cod_dc_operario'=> $request->input('cod_dc_operario'),
                'cod_dc_operario'=> "11001",
                'bloqueo'=> $bloqueo]);
    // Actualiza User
                $usuarios = User::where('cc_user', '=', $request->input('cc_operario'))->get();
                $usuarios->update(['name'=> $request->input('nom_operario'),
                'tel_user'=> $request->input('tel_operario'),
                'cel_user'=> $request->input('cel_operario'),
                'email'=> $request->input('mail_operario'),
//                'cod_dc_user'=> $request->input('cod_dc_operario'),
                'cod_dc_user'=> "11001",
                'bloqueo'=> $bloqueo]);
                 $sw1 = 1;
            }
            if($sw1 === 1){
               Session::flash('message','Registro Guardado Correctamente!');
               Session::flash('class','info');
            } else{
               Session::flash('message','Código ya Existe..!!!');
               Session::flash('class','danger');
            } 
    
        return Redirect::to('t_operarios');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cc_operario)
    {
        $cc_user = auth()->user()->cc_user;
        $operarios = Voperario::where('cc_operario', '=', $cc_operario)->get();
        return view('operarios.v_operarios', compact('operarios'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cc_operario)
    {
        $cc_user = auth()->user()->cc_user;
        $idperfil = auth()->user()->id_perfil;
        $operarios = Voperario::where('cc_operario', '=', $cc_operario)->get();
        $deptos = Ciudaddepto::orderBy('desc_ciudepto')->get();
        $ivapvars = Pvariable::where('id_pv', '<', 9)->get();
        if($idperfil == 999){
           $parqos = Parqueo::where('cc_user', '>', 0)->get();
        } else {
            $parqos = Parqueo::where('cc_user', '=', $cc_user)->get();
        }    
        return view('operarios.m_operarios', compact('operarios', 'tipovehiculos', 'deptos', 'ivapvars', 'parqos'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cc_operario)
    {
        $sw1 = 0;
        $cc_user = auth()->user()->cc_user;
        $operarios = Operario::where('cc_operario', '=', $cc_operario)->get();

        if($operarios->isEmpty()){
            Session::flash('message','Cédula no Existe..!!!');
            Session::flash('class','danger');
        } 

        $rules = [
            'cc_operario' => 'required',
            'nom_operario' => 'required',
            'id_parque' => 'required',
            'dir_operario' => 'required',
            'tel_operario' => 'required',
            'cel_operario' => 'required',
            'mail_operario' => 'required|email'
//            'cod_dc_operario' => 'required'
        ];
 
     $messages = [
    'cc_operario.required' => 'La Cédula no puede ser nula',
    'nom_operario.required' => 'El Nombre del Operario no puede ser nulo',
    'id_parque.required' => 'El Código del Parqueadero no puede ser nulo',
    'dir_operario.required' => 'La Dirección no puede ser nula',
    'tel_operario.required' => 'El Teléfono no puede ser nulo',
    'cel_operario.required' => 'El Celular no puede ser nulo',
    'mail_operario.required' => 'El Correo no puede ser nulo'
//    'cod_dc_operario.required' => 'El Código de la Ciudad no puede ser nulo'
    ];

    $this->validate($request, $rules, $messages);

        $cc_user = auth()->user()->cc_user;
        $operarios = Operario::where('cc_operario', '=', $cc_operario);
        $operarios->update(['nom_operario'=> $request->input('nom_operario'),
        'id_parque'=> $request->input('id_parque'),
        'dir_operario'=> $request->input('dir_operario'),
        'tel_operario'=> $request->input('tel_operario'),
        'cel_operario'=> $request->input('cel_operario'),
        'mail_operario'=> $request->input('mail_operario'),
//        'cod_dc_operario'=> $request->input('cod_dc_operario'),
        'cod_dc_operario'=> "11001",
        'bloqueo'=> $request->input('bloqueo')]);

        $bloqueo = $request->input('bloqueo');
        if($bloqueo == 1) {
            // 200 = El Operario se cambia a Cliente por bloqueo
            $idperfil = 200;
            $usuarios = User::where('cc_user', '=', $cc_operario)->get();
            $usuarios->update(['id_perfil'=> $idperfil]);
        }
        $operarios = Voperario::where('cc_operario', '=', $cc_operario)->get();
        Session::flash('message','Actualizado Correctamente....!');
        Session::flash('class','info');
        return Redirect::to('t_operarios/'.$cc_operario)->with('status','Actualizado Correctamente....!');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cc_operario)
    {
        $cc_user = auth()->user()->cc_user;
        $dssrvs = Operario::where('cc_operario', '=', $cc_operario);
        $dssrvs->delete();
        $usuarios = User::where('cc_user', '=', $cc_operario);
        $usuarios->delete();
        return Redirect::to('t_operarios');

    }
}
