@extends('layouts.developer_layout')

@section('hello')
@stop

@section('content')
    <section id="contact" class="home-section nopadd-bot color-dark bg-gray text-center">
        <div class="container marginbot-50">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="animatedParent">
                        <div class="section-heading text-center">
                            <h2 class="h-bold animated bounceInDown">Prisijungimas</h2>
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
                    {!!Form::open(['route'=>'developer.login','id'=>'contact-form'])!!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::text('email',Input::old('email'),['class'=>'form-control input-lg', 'placeholder' => 'Elektroninio pašto adresas', 'required' => 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::password('password',['class'=>'form-control input-lg', 'placeholder' => 'Slaptažodis', 'required' => 'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        {!!Form::submit('Prisijungti',['class'=>'btn btn-skin btn-lg btn-block', 'id' => 'btnContactUs'])!!}
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </section>
@stop
