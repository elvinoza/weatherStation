@extends('layouts.developer_layout')

@section('hello')
@stop

@section('content')
<!-- Section: register -->
<section id="contact" class="home-section nopadd-bot color-dark bg-gray text-center">
    <div class="container marginbot-50">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="animatedParent">
                    <div class="section-heading text-center">
                        <h2 class="h-bold animated bounceInDown">Registracija</h2>
                        <div class="divider-header"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($errors->all() as $error)
    <p class="alert alert-danger">{!!$error!!}</p>
    @endforeach
    <div class="container">
        <div class="row marginbot-80">
            <div class="col-md-8 col-md-offset-2">
                {!!Form::open(['route'=>'developer.register','id'=>'contact-form'])!!}
                <div class="row marginbot-20">
                    <div class="col-md-6 xs-marginbot-20">
                        {!! Form::text('station_name',Input::old('station_name'),['class'=>'form-control input-lg', 'id'=>'name', 'placeholder'=>'Stotelės vardas', 'required' => 'required']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::text('email',Input::old('email'),['class'=>'form-control input-lg', 'id'=>'email', 'placeholder'=>'Elektroninio pašto adresas', 'required' => 'required']) !!}
                    </div>
                </div>

                <div class="row marginbot-20">
                    <div class="col-md-6 xs-marginbot-20">
                        {!! Form::password('password',['class'=>'form-control input-lg', 'placeholder' => 'Slaptažodis', 'required' => 'required']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::password('password_confirmation',['class'=>'form-control input-lg', 'placeholder' => 'Pakartokite slaptažodį', 'required' => 'required']) !!}
                    </div>
                </div>
                <div class="text-center">
                    {!!Form::submit('Registruotis',['class'=>'btn btn-skin btn-lg btn-block', 'id' => 'btnContactUs'])!!}
                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</section>
@stop
