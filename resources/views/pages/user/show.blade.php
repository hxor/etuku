@extends('layouts.app') 
@section('content')
<div class="wraper container">

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">User</a></li>
                <li class="active">Profile</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-lg-3">
            <div class="profile-detail card-box">
                <div>
                    <img src="{{ asset('assets/images/users/avatar-1.png') }}" class="img-circle" alt="profile-image">

                    <hr>
                    <h4 class="text-uppercase font-600">About Me</h4>

                    <div class="text-left">
                        <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">{{ $getData->name }}</span></p>

                        <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">{{ $getData->email }}</span></p>

                        <p class="text-muted font-13"><strong>Role :</strong> <span class="m-l-15">{{ ucwords($getData->role) }}</span></p>

                    </div>
                </div>

            </div>
        </div>


        <div class="col-lg-9 col-md-8">
            <div class="panel panel-border panel-primary">
                <div class="panel-heading">
                </div>
                <div class="panel-body table-responsive">

                    {!! Form::model($getData, ['route' => ['admin.user.update.profile', $getData->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                    
                        
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('name', 'Nama') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'autofocus']) !!}
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::label('email', 'Email address') !!}
                            {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'eg: foo@bar.com']) !!}
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        </div>

                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            {!! Form::label('role', 'Role') !!}
                            <select name="role" id="" class="form-control" required readonly>
                                <option value="{{ $getData->role }}"> {{ ucwords($getData->role) }}</option>
                            </select>
                            <small class="text-danger">{{ $errors->first('role') }}</small>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('password', 'Password') !!}
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                        </div>

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



</div> <!-- container -->
@endsection