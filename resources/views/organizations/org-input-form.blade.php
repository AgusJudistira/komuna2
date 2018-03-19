@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <form action="/organizations" method="post" id="formentry" role="form" data-parsley-validate="" novalidate="">
                {{ csrf_field() }}
                <div class="container-fluid shadow">

                <div class="col-md-12">
                    <div class="form-group brdbot" style="display: block;">
			            <h3>Organisatiegegevens</h3>			        
                    </div>
                    <div id="panel1" class="panel panel-default" data-role="panel">
                        <h4 class="panel-heading">Nieuwe organisatie aanmaken</h4>
                        <div class="panel-body">                        
                            <div class="form-group row" rel="popover" data-trigger="hover" data-content="De naam van de organisatie" data-original-title="">
                                <label class="control-label control-label-left col-md-4" for="name">Organisatienaam<span class="req"> *</span></label>
                                <div class="controls col-md-8">
                                        
                                    <input id="name" name="name" class="form-control k-textbox" data-role="text" required="required" data-parsley-minwords="1" style="cursor: auto;" type="text">
                                </div>

                                @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                                    
                            </div>
                            <div class="form-group row" rel="popover" data-trigger="hover" data-content="De email van de organisatie" data-original-title="">
                                <label class="control-label control-label-left col-md-4" for="email">Email</label>
                                <div class="controls col-md-8">
                                        
                                    <input id="email" name="email" class="form-control k-textbox" data-role="text" data-parsley-minlength="3" type="text">
                                </div>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif

                            </div>
                            <div class="form-group row" rel="popover" data-trigger="hover" data-content="Het adres van de organisatie" data-original-title="">
                                <label class="control-label control-label-left col-md-4" for="streetname_number">Straatnaam &amp; nummer</label>
                                <div class="controls col-md-8">                    
                                    <input id="streetname_number" name="streetname_number" class="form-control k-textbox" data-role="text" type="text">
                                </div>

                                @if ($errors->has('streetname_number'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('streetname_number') }}</strong>
                                </span>
                                @endif
                                    
                            </div>
                            <div class="form-group row">
                                <label class="control-label control-label-left col-md-4" for="postal_code">Postcode</label>
                                <div class="controls col-md-8">                    
                                    <input id="postal_code" name="postal_code" class="form-control k-textbox" data-role="text" data-parsley-minlength="6" type="text">
                                </div>

                                @if ($errors->has('postal_code'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('postal_code') }}</strong>
                                </span>
                                @endif
                                    
                            </div>
                            <div class="form-group row">
                                <label class="control-label control-label-left col-md-4" for="city">Vestigingsplaats</label>
                                <div class="controls col-md-8">                    
                                    <input id="city" name="city" class="form-control k-textbox" data-role="text" type="text">
                                </div>

                                @if ($errors->has('city'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                                @endif
                                    
                            </div>
                            <div class="form-group row">
                                <label class="control-label control-label-left col-md-4" for="phonenumber">Telefoonnummer</label>
                                <div class="controls col-md-8">                    
                                    <input id="phonenumber" name="phonenumber" class="form-control k-textbox" data-role="text" data-parsley-minlength="6" type="text">
                                </div>

                                @if ($errors->has('phonenumber'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('phonenumber') }}</strong>
                                </span>
                                @endif
                                    
                            </div>

                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <button id="annuleren" name="annuleren" value="annuleren" type="submit" class="btn btn-info btn-lg">Annuleren</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <button id="aanmaken" name="aanmaken" value="aanmaken" type="submit" class="btn btn-primary btn-lg">Aanmaken</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                
                    </div>
                </div>
                </div>
                            
                </div>
            </form>                                
        </div>
    </div>

@endsection

    {{--  <script src="http://cdn.kendostatic.com/2014.1.318/js/jquery.min.js"></script>
    <script src="http://protostrap.com/Assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="http://wenzhixin.net.cn/p/bootstrap-table/src/bootstrap-table.js" type="text/javascript"></script>

    <script src="http://protostrap.com/Assets/inputmask/js/jquery.inputmask.js" type="text/javascript"></script>
    <script src="http://cdn.kendostatic.com/2014.1.318/js/kendo.all.min.js"></script>
    <script src="http://protostrap.com/Assets/parsely/parsley.extend.js" type="text/javascript"></script>
    <script src="http://protostrap.com/Assets/parsely/2.0/parsley.js" type="text/javascript"></script>
    <script src="http://protostrap.com/Assets/download.js" type="text/javascript"></script>
    <script src="http://protostrap.com/Assets/protostrap.js" type="text/javascript"></script>  --}}


