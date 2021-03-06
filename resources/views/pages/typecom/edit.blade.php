@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li>
                        Dashboard
                    </li>
                    <li>
                        Jenis Komoditas
                    </li>
                    <li class="active">
                        Edit
                    </li>
                </ol>
            </div>
        </div>
    
        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-border panel-primary">
                    <div class="panel-heading">
                        <h5> 
                            Ubah Data
                        </h5>
                    </div>
                    <div class="panel-body table-responsive">

                        {!! Form::model($getData, ['route' => ['admin.typecom.update', $getData->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                        
                            
                            @include('pages.typecom._form')

                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-white waves-effect waves-light">
                                    Reset
                                </button>
                                <a href="{{ url()->previous() }}" class="btn btn-danger waves-effect waves-light">Cancel</a>
                            </div>
                        
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    
    </div>
@endsection