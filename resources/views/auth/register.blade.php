@extends('layouts.developer_layout')

@section('content')
<div class="col-md-8 col-md-offset-2 form-content">
    <h3 class="heading">Sign up</h3>
    @foreach($errors->all() as $error)
    <p class="alert alert-danger">{!!$error!!}</p>
    @endforeach
    {!!Form::open(['route'=>'developer.register','class'=>'form form-horizontal','style'=>'margin-top:50px'])!!}
    <div class="form-group">
        {!! Form::label('station_name','Station name:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('station_name',Input::old('station_name'),['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('email','Email:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('email',Input::old('email'),['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('password','Password:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::password('password',['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('password_confirmation','Confirm Password:',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="text-center">
        {!!Form::submit('Register',['class'=>'btn btn-default'])!!}
    </div>
    {!!Form::close()!!}
</div>

@stop
