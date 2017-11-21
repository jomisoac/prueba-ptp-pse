@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <form action="info_pago" method="post">
                        {{ csrf_field() }}
                        <div class="panel-heading">
                            <b>Información transacción</b>
                            <div class="pull-right">
                                <a href="/cancelar_pago" class="btn btn-danger">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Pagar con PSE
                                </button>
                            </div>
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
                                    <textarea class="form-control" rows="2" id="description" name="description">este es otro pago de prueba</textarea>
                                </div>
                            </div>

                            <div class="row ma">
                                <div class="col-md-12">
                                    <b>Información Personal</b>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="firstName" class="col-md-4 control-label">Name</label>
                                        <div class="col-md-6">
                                            <input id="firstName" type="text" class="form-control" name="firstName"
                                                   value="{{ $user->name }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="document" class="col-md-4 control-label">Document</label>
                                        <div class="col-md-6">
                                            <input id="document" type="text" class="form-control" name="document"
                                                   value="{{ $user->document }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="documentType" class="col-md-4 control-label">Document type</label>
                                        <div class="col-md-6">
                                            <select id="documentType" class="form-control" name="documentType"
                                                    value="{{ $user->documentType }}" required>
                                                <option value=""></option>
                                                <option value="CC" {{ ( $user->documentType == 'CC' ) ? 'selected="selected"' : '' }}>
                                                    Cédula de ciudanía colombiana
                                                </option>
                                                <option value="CE" {{ ( $user->documentType == 'CE' ) ? 'selected="selected"' : '' }}>
                                                    Cédula de extranjería
                                                </option>
                                                <option value="TI" {{ ( $user->documentType == 'TI' ) ? 'selected="selected"' : '' }}>
                                                    Tarjeta de identidad
                                                </option>
                                                <option value="PPN" {{ ( $user->documentType == 'PPN' ) ? 'selected="selected"' : '' }}>
                                                    Pasaporte
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="emailAddress" class="col-md-4 control-label">Email</label>
                                        <div class="col-md-6">
                                            <input id="emailAddress" type="text" class="form-control" name="emailAddress"
                                                   value="{{ $user->email }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="company" class="col-md-4 control-label">Company</label>
                                        <div class="col-md-6">
                                            <input id="company" type="text" class="form-control" name="company"
                                                   value="{{ $user->company }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="phone" class="col-md-4 control-label">Phone</label>
                                        <div class="col-md-6">
                                            <input id="phone" type="text" class="form-control" name="phone"
                                                   value="{{ $user->phone }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="mobile" class="col-md-4 control-label">Mobile</label>
                                        <div class="col-md-6">
                                            <input id="mobile" type="text" class="form-control" name="mobile"
                                                   value="{{ $user->mobile }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="address" class="col-md-4 control-label">Address</label>
                                        <div class="col-md-6">
                                            <input id="address" type="text" class="form-control" name="address"
                                                   value="{{ $user->address }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="city" class="col-md-4 control-label">City</label>
                                        <div class="col-md-6">
                                            <input id="city" type="text" class="form-control" name="city"
                                                   value="{{ $user->city }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="province" class="col-md-4 control-label">Province</label>
                                        <div class="col-md-6">
                                            <input id="province" type="text" class="form-control" name="province"
                                                   value="{{ $user->province }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="country" class="col-md-4 control-label">Country</label>
                                        <div class="col-md-6">
                                            <input id="country" type="text" class="form-control" name="country"
                                                   value="{{ $user->country }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
