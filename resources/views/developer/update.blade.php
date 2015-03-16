@extends('layouts.developer_layout')

@section('content')
    <div class="col-md-8 col-md-offset-2 form-content">
        <h3 class="heading">Update your station information</h3>
        @foreach($errors->all() as $error)
        <p class="alert alert-danger">{!!$error!!}</p>
        @endforeach
        <form class="form form-horizontal">
            <div class="form-group">
                <label class="col-sm-3">Your app id</label>
                <div class="col-sm-8">
                    <span class="form-control uneditable-input">{{ $user->id }}</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3">Your app key</label>
                <div class="col-sm-8">
                    <span class="form-control uneditable-input">{{ $user->app_key }}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-8">

                    <button id="regenerate" type="button" class="btn btn-default">Generate new app key</button>
                </div>
            </div>

        </form>

        {!!Form::model($user, ['route'=>'developer.update','class'=>'form form-horizontal','style'=>'margin-top:50px'])!!}
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
        <div class="text-center">
            {!!Form::submit('Update',['class'=>'btn btn-default'])!!}
        </div>
        {!! Form::close() !!}
        {!! Form::open(['route'=>'developer.update','class'=>'form form-horizontal','style'=>'margin-top:50px']) !!}
        <div class="form-group">
            {!! Form::label('current_password','Current password:',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::password('current_password',['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('new_pasword','New password:',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::password('new_password',['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('new_password_confirmation','Confirm Password:',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::password('new_password_confirmation',['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="text-center">
            {!!Form::submit('Change',['class'=>'btn btn-default'])!!}
        </div>
        {!!Form::close()!!}
    </div>
@stop