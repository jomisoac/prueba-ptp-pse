@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    :(
                    <a class="pull-right" href="home">home</a>
                </div>

                <div class="panel-body">
                    <div class="alert alert-success">
                    <h1 class="has-error">Ha ocurrido un error en la transacción</h1>
                    @if (app('env') != 'production')
                        <p>{{$responseReasonText}}</p>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
