@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <form action="info_pago" method="post">
                        {{ csrf_field() }}
                        <div class="panel-heading">
                            Información transacción
                            <button type="submit" class="btn btn-default btn-primary pull-right">
                                Pagar con PSE
                            </button>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-3 col-sm-offset-5">
                                    <label for="totalAmount">Total</label>
                                    <input type="number"
                                           class="form-control"
                                           id="totalAmount" name="totalAmount"
                                           value="{{ rand(100000,1000000) }}">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="reference">Reference</label>
                                    <input type="text"
                                           class="form-control"
                                           id="reference" name="reference"
                                           value="{{ uniqid() }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="2"
                                              id="description" name="description">
                                    </textarea>
                                </div>
                            </div>

                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
