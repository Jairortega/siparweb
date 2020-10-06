@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #3399FF; color: #FFF;">COMERCIALES ...!!!</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>

                    @foreach($comerciales as $comer)
                    <div class="form-group row justify-content-center">
                        <img width="80%" height = "140%" src="/../img/{{$comer->archi_comer}}"> 
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection
