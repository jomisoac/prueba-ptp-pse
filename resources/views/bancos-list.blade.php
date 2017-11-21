    @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Con que banco desea realizar la transacción?
                    </div>

                    <div class="panel-body">
                        @if($bancos)
                            <form action="/nuevo_pago" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-8 form-group @if($errors->has('bankCode')) has-error @endif">
                                        <select class="form-control  input-lg" name="bankCode">
                                            @foreach($bancos as $banco)
                                                <option value="{{$banco->getBankCode()}}">
                                                    {{$banco->getBankName()}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('bankCode'))
                                            @foreach($errors->get('bankCode') as $error)
                                                <div class="help-block">{{$error}}</div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-md-4 form-group @if($errors->has('bankInterface')) has-error @endif">
                                        <select class="form-control  input-lg" name="bankInterface">
                                            <option value="">Tipo de banca</option>
                                            <option value="0">Personas</option>
                                            <option value="1">Empresas</option>
                                        </select>
                                        @if($errors->has('bankInterface'))
                                            @foreach($errors->get('bankInterface') as $error)
                                                <div class="help-block">{{$error}}</div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="/cancelar_pago" class="btn btn-danger pull-left">
                                            Cancelar Transacción
                                        </a>
                                        <input type="submit" value="Continuar" class="btn btn-primary pull-right">
                                    </div>
                                </div>
                            </form>
                        @else
                            <h3 class="text-center">No se pudo obtener la lista de Entidades Financieras, por favor intente más tarde</h3>
                            <div class="col-md-12">
                                <input type="button" value="Reintentar" class="btn btn-default btn-success pull-right" onClick="location.href=location.href">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
