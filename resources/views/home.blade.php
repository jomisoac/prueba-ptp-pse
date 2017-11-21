@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Historial de transacciones</strong>
                        <a class="pull-right" href="info_pago">Realizar Pago</a>
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                            <tr>
                                <th>creación</th>
                                <th>referencia</th>
                                <th>descripción</th>
                                <th>total</th>
                                <th>estado</th>
                                <th>actualización estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($transacciones as $transaccion)
                                <tr class="{{ $transaccion->status == 'OK' ? '' : 'warning' }}">
                                    <td>{{ $transaccion->created_at }}</td>
                                    <td>{{ $transaccion->reference }}</td>
                                    <td>{{ $transaccion->description }}</td>
                                    <td>{{ $transaccion->totalAmount }}</td>
                                    <td>{{ $transaccion->status }}</td>
                                    <td>{{ $transaccion->updated_at }}</td>
                                </tr>
                            @empty
                                <tr class="active">
                                    <h1 align="center">No se han registrado transacciones</h1>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
