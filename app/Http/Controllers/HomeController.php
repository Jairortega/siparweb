<?php

 namespace parqueos\Http\Controllers;


use Illuminate\Http\Request;
use parqueos\Opcperfil;
use parqueos\Comercial;
use parqueos\Http\Controllers\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $idperfil = auth()->user()->id_perfil;
//      $idperfil = 120;
        $comerciales = Comercial::where('id_comer', '=', 1)->get();
        $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)->orderBy('id_perfil', 'grupo', 'id_opcion')->get();
        return view('home', compact('perfiles', 'comerciales'));
    }
}
