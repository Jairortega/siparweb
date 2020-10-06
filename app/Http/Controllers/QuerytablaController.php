<?php

namespace parqueos\Http\Controllers;

use Illuminate\Http\Request;
use parqueos\Perfil;
use parqueos\Opcperfil;
use parqueos\Querytabla;
use parqueos\Vquerytabla;
use parqueos\Control_tabla;
use parqueos\Control_columna;
use parqueos\Crud;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class QuerytablaController extends Controller
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

        $id_opcion = 9979;
        $results = '1';
        $idperfil = auth()->user()->id_perfil;
        $emailclien = auth()->user()->email;
        $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)
        ->where('id_opcion','=', $id_opcion)->get();
        $oconsolas = Querytabla::where('id_query', '>', 0)
        ->paginate(5);
 //       ->get();

//        valcol = JSON.parse(cadena);
//        $valcol = json_encode($results);
       return view('consola.t_consola', compact('perfiles', 'oconsolas'));
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
        $cruds = Crud::all();
        $ctablas = Control_tabla::orderBy('table_name')->get();
        return view('consola.i_consola', compact('ctablas', 'cruds'));
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
        $oconsolas = Querytabla::where('id_query', '=',  $request->input('id_query'))->get();

        if(!$oconsolas->isEmpty()){
            Session::flash('message','Código ya Existe..!!!');
            Session::flash('class','danger');
        } 

        $rules = [
            'id_query' => 'required',
            'id_crud' => 'required',
            'table_name' => 'required',
            'condicion' => 'required',
            'valor1' => 'required'
        ];
 
     $messages = [
    'id_query.required' => 'El Código no puede ser nulo',
    'id_crud.required' => 'El ID de CRUD no puede ser nulo',
    'table_name.required' => 'El nombre de la tabla no puede ser nulo',
    'condicion.required' => 'La condición no puede ser nula',
    'valor1.required' => 'El campo valor 1 no puede ser nulo'
    ];

    $this->validate($request, $rules, $messages);

        $oconsolas = Querytabla::where('id_query', '=',  $request->input('id_query'))->get();
        if($oconsolas->isEmpty()){
    
               $oconsola = new Querytabla();
               $oconsola->id_query = $request->input('id_query');
               $oconsola->id_crud = $request->input('id_crud');
               $oconsola->table_name = $request->input('table_name');
               $oconsola->condicion = $request->input('condicion');
               $oconsola->valor1 = $request->input('valor1');
               $oconsola->valor2 = $request->input('valor2');
               if($oconsola->save()){
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
    
            return Redirect::to('t_consola');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_query)
    {
        $oconsolas = Vquerytabla::where('id_query', '=', $id_query)->get();
        return view('consola.v_consola', compact('oconsolas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_query)
    {
        $cruds = Crud::all();
        $ctablas = Control_tabla::orderBy('table_name')->get();
        $oconsolas = Vquerytabla::where('id_query', '=', $id_query)->get();
        return view('consola.m_consola', compact('oconsolas', 'ctablas', 'cruds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_query)
    {
        $sw1 = 0;

        $rules = [
            'id_query' => 'required',
            'id_crud' => 'required',
            'table_name' => 'required',
            'condicion' => 'required',
            'valor1' => 'required'
        ];
 
     $messages = [
    'id_query.required' => 'El Código no puede ser nulo',
    'id_crud.required' => 'El ID CRUD no puede ser nulo',
    'table_name.required' => 'El Nombre de la tabla no puede ser nulo',
    'condicion.required' => 'La condición no puede ser nula',
    'valor1.required' => 'El campo valor 1 no puede ser nulo'
    ];

    $this->validate($request, $rules, $messages);
    $oconsolas = Querytabla::where('id_query', '=',  $id_query);    
    $oconsolas->update(['id_crud'=> $request->input('id_crud'),
    'table_name'=> $request->input('table_name'),
    'condicion'=> $request->input('condicion'),
    'valor1'=> $request->input('valor1'),
    'valor2'=> $request->input('valor2')]);
    Session::flash('message','Registro Actualizado Correctamente!');
    Session::flash('class','info');

    return Redirect::to('t_consola/show/'.$id_query)->with('status','Actualizado Correctamente....!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_query)
    {
        $oconsolas = Querytabla::where('id_query', '=',  $id_query);
        $oconsolas->delete();
        return Redirect::to('t_consola');
    }

    public function showreg($id_query)
    {
        $id_opcion = 9979;
        $results = '1';
        $id_crud = 1;
        $idperfil = auth()->user()->id_perfil;
        $emailclien = auth()->user()->email;
        $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)
        ->where('id_opcion','=', $id_opcion)->get();

        $oconsolas = Querytabla::where('id_query', '=', $id_query)
        ->paginate(5);
//        ->get();
        if(!$oconsolas->isEmpty()){
            foreach($oconsolas as $oconsol) {
              $id_crud = $oconsol->id_crud;
        // 1 = insert, 2 = select, 3 = update y 4 = delete      
              $table_name = $oconsol->table_name;
              $condi = $oconsol->condicion;
              $valor1 = $oconsol->valor1;
              $valor2 = $oconsol->valor2;
            }
            $cabcolumns = Control_columna::where('table_name', '=', $table_name)
            ->orderBy('position','asc')->get();
            $results = DB::select($condi, [$valor1]);
        }   
       if($id_crud == 2) {
          return view('consola.q_consola', compact('perfiles', 'oconsolas', 'results', 'cabcolumns'));
       } else {
        $condi = 'SELECT * FROM '.$table_name;  
        $results = DB::select($condi, [$valor1]);  
        $oconsolas = Querytabla::where('id_query', '>', 0)
        ->paginate(5);
        return view('consola.q_consola', compact('perfiles', 'oconsolas', 'results', 'cabcolumns'));
       }
    }

}
