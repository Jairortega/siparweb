<?php

namespace parqueos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use parqueos\Usuario;
use parqueos\Opcperfil;
use parqueos\Entrada;
use parqueos\Salida;
use parqueos\Ventrada;
use parqueos\Vfactura;
use parqueos\Vsalida; 
use parqueos\Vparsalida;
use parqueos\Parqueo;
use parqueos\Tarifa;
use parqueos\Reserva;
use parqueos\Tipovehiculo;
use parqueos\Pvariable;
use parqueos\Vparentrada;
use parqueos\Vconreser;
use parqueos\VServicio;
use parqueos\Vliquidado;
use parqueos\Operario;
use Fpdf;
use QrCode;
use Mail as Tmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;

define ("KEY","siparweb_vrs");
define ("COD","AES-128-ECB");
define ("LINKAPIPRUE","https://api.sandbox.paypal.com");
define ("LINKAPIPROD","https://api.paypal.com");
define ("CLIENTID","AfyylcWquPKvZJxWzjMVOuszARb0g7Frb17Lb1l7lhEpZUOPRzNwapyEIkFngWSJ2KGmulxcXtws3ZGM");
define ("SECRET","ENPpVL7jmeHpIxaafnI-RHQZdZgruXGc0N34YuhWLa6EmUhc6DmiGZWq42-sthnV2-bazhH9OjJVQp1k");


class SalidaController extends Controller
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
        $id_opcion =1002;
        $id_parque = 0;
        $cc_user = auth()->user()->cc_user;
        $idperfil = auth()->user()->id_perfil;
        $emailclien = auth()->user()->email;
        $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)
        ->where('id_opcion','=', $id_opcion)->get();
        if($idperfil == 200){
            $reservas = Reserva::where('cc_cliente', '=', $cc_user)
            ->where('estado_reserva','!=', 200)->get();
            foreach($reservas as $reser) {
                $id_parque = $reser->id_parque;
            }
        } else{
            $operarios = Operario::where('cc_operario', '=', $cc_user)->get();
            foreach($operarios as $oper) {
                $id_parque = $oper->id_parque;
            }
    
        }
        
        if($idperfil == 999){
          $salidas = Vparsalida::where('id_parque', '>', 0)->paginate(5);
        } 
        // 120 = Admon 150 = Operario
        if($idperfil == 120 or $idperfil == 150) {
          $salidas = Vparsalida::where('id_parque', '=', $id_parque)->paginate(5);
        }    
        // 200 = Cliente
        if($idperfil == 200) {
            $salidas = Vparsalida::where('cc_cliente','=', $cc_user)
            ->where('forma_pago','=', 0)->paginate(5);
          }    
  
        return view('salidas.t_salidas', compact('salidas', 'perfiles'));
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
    public function show($id_entrada)
    {
        $cc_user = auth()->user()->cc_user;
        $id_parque = 0;
        $vr_liquidado = 0;
        $valentradas = Salida::where('id_entrada', '=', $id_entrada)->get();
        foreach($valentradas as $vale){
            $id_parque = $vale->id_parque;
            $vr_liquidado = $vale->vr_liquidado;
        }
        if($id_parque > 0){
            $servicios = Vservicio::where('id_parque', '=', $id_parque)->get();
        } else {
            $servicios = Vservicio::where('id_parque', '>', 0)->get();
        }

        if($vr_liquidado == 0){
           $salidas = Vliquidado::where('id_entrada', '=', $id_entrada)->get();
           foreach($salidas as $sal) {
            $vr_pago = $sal->vr_liquidado; 
          }
    
        } else{
           $salidas = Vparsalida::where('id_entrada', '=', $id_entrada)->get();
           foreach($salidas as $sal) {
            $vr_pago = $sal->vr_liquidado; 
          }
        }
       
//        $salidas = Vparsalida::where('id_entrada', '=', $id_entrada)->get();
        return view('salidas.v_salidas', compact('salidas', 'servicios'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_entrada)
    {
        $cc_user = auth()->user()->cc_user;
        $idperfil = auth()->user()->id_perfil;
        // pago con tarjeta = 0, efectivo = 1
        $snpvars = Pvariable::where('id_pv', '<', 9)->get();
        $salidas = Vliquidado::where('id_entrada', '=', $id_entrada)->get();
        return view('salidas.m_salidas', compact('salidas', 'snpvars'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_entrada)
    {
        $sw1 = 0;
        $tote = 0;
        $tots = 0;
        $totr = 0;
        $cc_user = auth()->user()->cc_user;
        $salidas = Vliquidado::where('id_entrada', '=', $id_entrada)->get();
        if(!$salidas->isEmpty()){
            Session::flash('message','Entrada no Existe..!!!');
            Session::flash('class','danger');
        } 

        $rules = [
//            'forma_pago' => 'required',
            'placa' => 'required',
//            'cc_cliente' => 'required'
        ];
 
     $messages = [
//    'forma_pago.required' => 'La forma de pago no puede ser nula',
    'placa.required' => 'La Placa no puede ser nula',
//    'cc_cliente.required' => 'La Cédula del Cliente no puede ser nula',
    ];

    $this->validate($request, $rules, $messages);

    $cc_user = auth()->user()->cc_user;
    $estado_reserva = $request->input('estado_reserva');
    $id_parque = $request->input('id_parque');
    $id_reserva = $request->input('id_reserva');
    $tipo_vehiculo = $request->input('tipo_vehiculo');
    $num_minutos = str_replace(",","",$request->input('num_minutos'));
    $vr_liquidado = str_replace(",","",$request->input('vr_liquidado'));
    $vr_iva = str_replace(",","",$request->input('vr_iva'));
    $forma_pago = $request->input('forma_pago');

    // 1 = Pago en efectivo xxx
    
    if($forma_pago == 1){
    $lsalidas = Salida::where('id_entrada', '=', $id_entrada);
    $lsalidas->update(['fecha_salida'=> $request->input('fecha_salida'),
    'hora_salida'=> $request->input('hora_salida'),
    'num_minutos'=> $num_minutos,
    'vr_liquidado'=> $vr_liquidado,
    'vr_iva'=> $vr_iva,
//    'forma_pago'=> $request->input('forma_pago'),
    'forma_pago'=> 1,
    'cc_user_s'=> $cc_user]);
    $entradas = Ventrada::where('id_parque', '=', $id_parque)
    ->where('tipo_vehiculo', '=', $tipo_vehiculo)->get();
    foreach($entradas as $entra) {
        $tote = $entra->tot_e; 
    }
    $salidas = Vsalida::where('id_parque', '=', $id_parque)
    ->where('tipo_vehiculo', '=', $tipo_vehiculo)->get();
    foreach($salidas as $sali) {
        $tots = $sali->tot_s; 
    }
    $creservas = Vconreser::where('id_parque', '=', $id_parque)
    ->where('tipo_vehiculo', '=', $tipo_vehiculo)->get();
    foreach($creservas as $cre) {
    $totr = $cre->tot_r; 
    }

    $tarifas = Tarifa::where('id_parque', '=', $id_parque)
    ->where('tipo_vehiculo', '=', $tipo_vehiculo);
    $tarifas->update(['tot_e'=> $tote,
    'tot_s'=> $tots,
    'tot_r'=> $totr]);
    // estado_reserva = 300 Pagada
    $reservas = Reserva::where('id_reserva', '=', $id_reserva);
    $reservas->update(['estado_reserva'=> 300]);

    $vsalidas = Vparsalida::where('id_entrada', '=', $id_entrada)->get();
    Session::flash('message','Actualizado Correctamente....!');
    Session::flash('class','info');
    return Redirect::to('t_salidas/show/'.$id_entrada)->with('status','Actualizado Correctamente....!');
    } else{ // 0 = Tarjeta
        $cc_user = auth()->user()->cc_user;
        $idperfil = auth()->user()->id_perfil;
        // pago con tarjeta = 0, efectivo = 1 
        // $ApiKey = "xif6PaM5D2kH3Sd2FTdmleRqH7";
        $ApiKey ="4Vj8eK4rloUd272L48hsrarnUA";
//        $merchantId = "795770";
        $merchantId = "508029";
        // $referenceCode = "SERVICIOPAGOPARQUEADERO011";
        $referenceCode = "TestPayU";
        $parcsigna = $ApiKey."~".$merchantId."~".$referenceCode;
        $snpvars = Pvariable::where('id_pv', '<', 9)->get();
        $salidas = Vliquidado::where('id_entrada', '=', $id_entrada)->get();
        $reservas = Reserva::where('id_reserva', '=', $id_reserva)->get();
        return view('salidas.pagartarj', compact('salidas', 'snpvars', 'reservas','parcsigna'));
//  return $reservas;
//        return Redirect::to('t_salidas/pagartarj/'.$id_entrada);
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_entrada)
    {
        $cc_user = auth()->user()->cc_user;
        $id_reserva = 0;
        $salidas = Salida::where('id_entrada', '=', $id_entrada);
        foreach($salidas as $sal){
          $id_reserva = $sal->id_reserva;
        }
        // estado_reserva = 250 Parqueo
        $reservas = Reserva::where('id_reserva', '=', $id_reserva);
        $reservas->update(['estado_reserva'=> 250]);
        $lsalidas = Salida::where('id_entrada', '=', $id_entrada);
        $lsalidas->update(['vr_liquidado'=> 0,
        'vr_iva'=> 0,
        'num_minutos'=> 0,
        'cc_user_s'=> $cc_user]);
        return Redirect::to('t_salidas');
    }

    public function showreg($id_entrada)
    {
        $id_opcion = 1002;
        $idperfil = auth()->user()->id_perfil;
        $emailclien = auth()->user()->email;
        $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)
        ->where('id_opcion','=', $id_opcion)->get();
        $psalidas = Vfactura::where('id_entrada', '=', $id_entrada)->get();
//        ->paginate(5);
//        ->get();

// return         $views = \View::make('salidas.pdf_salidas', compact('perfiles', 'psalidas'))->render();
        return view('salidas.pdf_salidas', compact('perfiles', 'psalidas'));
    }

    public function respuesta($id_reserva)
    {
        $id_opcion = 1002;
        $idperfil = auth()->user()->id_perfil;
        $emailclien = auth()->user()->email;
        $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)
        ->where('id_opcion','=', $id_opcion)->get();
        $psalidas = Vfactura::where('id_entrada', '=', $id_entrada)->get();
//        ->paginate(5);
//        ->get();

// return         $views = \View::make('salidas.pdf_salidas', compact('perfiles', 'psalidas'))->render();
        return view('salidas.pdf_salidas', compact('perfiles', 'psalidas'));
    }

    public function showpdf($id_entrada)
    {
        
        $id_opcion = 1002;
        $idperfil = auth()->user()->id_perfil;
        $emailclien = auth()->user()->email;
        $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)
        ->where('id_opcion','=', $id_opcion)->get();
        $psalidas = Vfactura::where('id_entrada', '=', $id_entrada)->get();
        foreach($psalidas as $sal){
           $id_entrada = $sal->id_entrada;
           $fecha_hoy = date("Y-m-d - H:i:s");
           $des_parque = $sal->des_parque;
           $nit_parque = $sal->nit_parque;
           $dir_parque = $sal->dir_parque;
           $tel_parque = $sal->tel_parque;
           $dregimen = $sal->dregimen;
           $fecha_reserva = $sal->fecha_reserva;
           $hora_reserva = $sal->hora_reserva;
           $hora_salida = $sal->hora_salida;
           $placa = $sal->placa;
           $des_tvehiculo = $sal->des_tvehiculo;
           $dforpago = $sal->dforpago;
           $porc_iva = $sal->porc_iva;
           $vr_liquidado = number_format($sal->vr_liquidado, 0, '.', ',');
           $vr_iva = number_format($sal->vr_iva, 0, '.', ',');
           $vr_total = number_format($sal->vr_liquidado + $sal->vr_iva, 0, '.', ',');
           $agra = "GRACIAS POR SU PAGO";
           $lsu ="_________________________________________";
           $poli = 5;
        }
        if($vr_liquidado > 0){
        Fpdf::AddPage();
        require('../public/qrcodes/camino.php');
        $arplaca = $placa.'-'.$id_entrada.'.png';
        $arpdf = $placa.'-'.$id_entrada.'.pdf';
        $camino = '../public/qrcodes/';
        $dirqr = '../public/qrcodes/'.$arplaca;
        $dirpdf = $camino.$arpdf;
        QrCode::errorCorrection('H');
        $imaqr = QrCode::format('png')->encoding('UTF-8')->generate($placa.' - '.$des_tvehiculo.' Hora salida: '.date("Y-m-d - H:i:s"), $dirqr);
//        $ulima = "D:\vrs\htdocs\laravel\public\qrcodes\BPC-046.png";
        Fpdf::Image("$dirqr", 30, 10, 40, 0, 'PNG');
//        Fpdf::AddPage();
        Fpdf::SetFillColor(255,255,255);
        Fpdf::SetFont('Courier', 'B', 12);
        Fpdf::Ln(42);
        Fpdf::Cell(4);
        Fpdf::Cell(10, 8, '!! Estimado Cliente: ',0,1,'L',true);
        Fpdf::Cell(4);
        Fpdf::Cell(10, 8, 'Por favor Mostrar este QR',0,1,'L',true);
        Fpdf::Cell(4);
        Fpdf::Cell(10, 6, 'a la salida del Parqueadero !!.',0,1,'L',true);
        Fpdf::Cell(4);
        Fpdf::Cell(10, 8, 'Tiene 15 minutos para la Salida.',0,1,'L',true);
        Fpdf::Ln(6);
        Fpdf::Cell(20);
        Fpdf::SetFont('Courier', 'B', 14);
        Fpdf::Cell(50, 8, 'FACTURA Nro. '.$id_entrada,0,1,'L',true);
        Fpdf::SetFont('Courier', 'B', 8);
        Fpdf::Cell(10);
        Fpdf::Cell(50, 6, 'Fecha Sistema: '.$fecha_hoy,0,1,'L',true); 
        Fpdf::SetFont('Courier', 'B', 10);
        Fpdf::Cell(5);
        Fpdf::Cell(50, 6, $lsu,0,1,'L',true); 
        Fpdf::Ln(4);
        Fpdf::Cell($poli);
        Fpdf::Cell(50, 6, 'Parqueadero: '.$des_parque,0,1,'L',true); 
        Fpdf::Ln(4);
        Fpdf::Cell($poli);
        Fpdf::Cell(50, 4, 'NIT: '.$nit_parque,0,1,'L',true); 
        Fpdf::Ln(4);
        Fpdf::Cell($poli);
        Fpdf::Cell(50, 4,utf8_decode('Dirección: ').$dir_parque,0,1,'L',true); 
        Fpdf::Ln(4);
        Fpdf::Cell($poli);
        Fpdf::Cell(50, 4, utf8_decode('Teléfono: ').$tel_parque,0,1,'L',true); 
        Fpdf::Ln(4);
        Fpdf::Cell($poli);
        Fpdf::Cell(50, 4, $dregimen,0,1,'L',true); 
        Fpdf::Ln(4);
        Fpdf::Cell($poli);
        Fpdf::Cell(50, 4, 'Fecha: '.$fecha_reserva,0,1,'L',true); 
        Fpdf::Ln(4);
        Fpdf::Cell($poli);
        Fpdf::Cell(50, 4, 'Hora Inicio: '.$hora_reserva. ' Hora Pago: '.$hora_salida,0,1,'L',true); 
        Fpdf::Ln(4);
        Fpdf::Cell($poli);
        Fpdf::Cell(50, 4, 'Placa: '.$placa.' '.$des_tvehiculo,0,1,'L',true); 
        Fpdf::Ln(4);
        Fpdf::Cell($poli);
        Fpdf::Cell(50, 4, 'Forma de Pago: '.$dforpago,0,1,'L',true); 
        Fpdf::Ln(4);
        Fpdf::Cell($poli);
        Fpdf::Cell(50, 4, 'Valor -> ',0,0,'L',true);
        Fpdf::Cell(18);
        Fpdf::Cell(20, 4, $vr_liquidado,0,1,'R',true); 
        Fpdf::Ln(4);
        Fpdf::Cell($poli);
        Fpdf::Cell(50, 4, 'Impuesto -> ('.$porc_iva. ')',0,0,'L',true); 
        Fpdf::Cell(18);
        Fpdf::Cell(20, 4, $vr_iva,0,1,'R',true); 
        Fpdf::Ln(4);
        Fpdf::Cell($poli);
        Fpdf::Cell(50, 4, 'Valor Total -> ',0,0,'L',true); 
        Fpdf::Cell(18);
        Fpdf::Cell(20, 4, $vr_total,0,1,'R',true); 
        Fpdf::Ln(4);
        Fpdf::Cell(20);
        Fpdf::Cell(50, 4, $agra); 
        Fpdf::Ln(2);
        Fpdf::Output('I', $arpdf);
        exit;
       }
    }
    public function showcorreo($id_entrada)
       {
           
           $id_opcion = 1002;
           $idperfil = auth()->user()->id_perfil;
           $emailclien = auth()->user()->email;
           $perfiles = Opcperfil::where('id_perfil', '=', $idperfil)
           ->where('id_opcion','=', $id_opcion)->get();
           $psalidas = Vfactura::where('id_entrada', '=', $id_entrada)->get();
           foreach($psalidas as $sal){
              $id_entrada = $sal->id_entrada;
              $fecha_hoy = date("Y-m-d - H:i:s");
              $des_parque = $sal->des_parque;
              $nit_parque = $sal->nit_parque;
              $dir_parque = $sal->dir_parque;
              $tel_parque = $sal->tel_parque;
              $dregimen = $sal->dregimen;
              $fecha_reserva = $sal->fecha_reserva;
              $hora_reserva = $sal->hora_reserva;
              $hora_salida = $sal->hora_salida;
              $email = $sal->email;
              $placa = $sal->placa;
              $des_tvehiculo = $sal->des_tvehiculo;
              $dforpago = $sal->dforpago;
              $porc_iva = $sal->porc_iva;
              $vr_liquidado = number_format($sal->vr_liquidado, 0, '.', ',');
              $vr_iva = number_format($sal->vr_iva, 0, '.', ',');
              $vr_total = number_format($sal->vr_liquidado + $sal->vr_iva, 0, '.', ',');
              $agra = "GRACIAS POR SU PAGO";
              $lsu ="_________________________________________";
              $poli = 5;
              if($vr_liquidado > 0){
              $data = array(
                  'name' => auth()->user()->name,
                  'email' => auth()->user()->email,
                  'subject' => 'Correo del Parqueadero',
                  'msg' => 'Se adjunta archivo PDF con la Factura' 
                );
           
           $arpdf = $placa.'-'.$id_entrada.'.pdf';
           $camino = '../public/qrcodes/';
           $dirpdf = $camino.$arpdf;
           $subject = 'Correo del Parqueadero';
           $mensg = 'Se adjunta archivo PDF con la Factura';
           $mensaje = 'Correo enviado correctamente..!!!';
//           $fromEmail = 'oortegon@gmail.com';
//           $fromName ='APP de Reservas';
           Mail::send('salidas.pdf_factura', compact('perfiles', 'psalidas'), function($msg) use ($email, $dirpdf){
               $msg->to($email);
               $msg->subject('Factura del Parqueadero');
               $msg->attach($dirpdf);
           });
// return $vr_liquidado;
//            Session::flash('message', 'Correo enviado correctamente..!!!');
            return Redirect::to('t_salidas'); 
        }
      }
    }

}
