<?php

namespace parqueos\Http\Controllers;
use parqueos\Depto;

class FrontController extends Controller
{
    public function index(){
     return view('components.index');
    }

    public function nosotros(){
        return view('components.nosotros');
    }

    public function registrarse(){
        return view('components.registrarse');
    }

    public function login(){
        return view('components.login');
    }

}
