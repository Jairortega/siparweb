<?php $retorno = '/'; ?>
@extends('components.vheadgral')
@csrf
@section('content')
        <div class="container">
            <!-- APPLICATION -->
            <div id="App" class="row pt-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="color: #007bff; font-size: 20px; ">NOSOTROS</h4>
                        </div>
                        <?php
                         $somos = "somos_1.png";
                         $ventajas = "ventajas_2.png";
                         $mision = "mision_3.png";
                         $politica = "politica_4.png";
                        ?>
                        <div class="form-group">
                            <img width="100%" src="/../img/{{$somos}}"> 
                        </div>
                        <div class="form-group">
                            <img width="100%" src="/../img/{{$ventajas}}"> 
                        </div>
                        <div class="form-group">
                            <img width="100%" src="/../img/{{$mision}}"> 
                        </div>
                        <div class="form-group">
                            <img width="100%" src="/../img/{{$politica}}"> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

@extends('components.vfootgral')

@endsection