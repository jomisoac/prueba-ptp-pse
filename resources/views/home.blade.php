@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Dashboard
                    <a class="pull-right" href="info_pago">Realizar Pago</a>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        @forelse($transacciones as $transaccion)
                        <tr class="{{$transaccion->status == 'OK' ? '' : 'warning'}}">
                            <td>{{ $transaccion->reference }}</td>
                            <td>{{ $transaccion->description }}</td>
                            <td>{{ $transaccion->totalAmount }}</td>
                            <td>{{ $transaccion->status }}</td>
                        </tr>
                        @empty
                            <tr class="active">
                                <h1 align="center">No se han registrado transacciones</h1>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
