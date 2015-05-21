@extends('layouts.developer_layout')
@if(!Auth::check())
    @section('hello')
        @parent
    @show
@else
    @section('hello')
    @stop
@endif

@section('content')
    <div class="col-md-8 col-md-offset-2 form-content">
        <h3 class="heading">Sign up</h3>
        @foreach($errors->all() as $error)
        <p class="alert alert-danger">{!!$error!!}</p>
        @endforeach
    </div>
    <!-- Section: about -->
    <section id="about" class="home-section color-dark bg-white">
        <div class="container marginbot-50">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="animatedParent">
                        <div class="section-heading text-center animated bounceInDown">
                            <h2 class="h-bold">APIE MeteO</h2>
                            <div class="divider-header"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 animatedParent">
                    <div class="text-center">
                        <p>
                            Mes padedame žmonėms sukurti savo orų stotelę ir žiūrėti jos informaciją internete.
                        </p>
                        <p>
                            Mūsų vartotojai siųsdami mums realiu laiku duomenis iš savo stotelės, suteikia mums savo informaciją, kurią mes pateikiame visiems vartotojams.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section: services -->
    <section id="service" class="home-section color-dark bg-gray">
        <div class="container marginbot-50">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div>
                        <div class="section-heading text-center">
                            <h2 class="h-bold">Ką mes jums suteikiame</h2>
                            <div class="divider-header"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <div>
                <div class="row animatedParent">
                    <div class="col-xs-6 col-sm-4 col-md-4">
                        <div class="animated rotateInDownLeft">
                            <div class="service-box">
                                <div class="service-icon">
                                    <span class="fa fa-laptop fa-2x"></span>
                                </div>
                                <div class="service-desc">
                                    <h5>Internetinis puslapis</h5>
                                    <div class="divider-header"></div>
                                    <p>
                                        Galite žiūrėti informaciją realiu laiku, bei tyrinėti duomenis grafikų ir lentelių pagalba.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-4">
                        <div class="animated rotateInDownLeft slow">
                            <div class="service-box">
                                <div class="service-icon">
                                    <span class="fa fa-mobile fa-2x"></span>
                                </div>
                                <div class="service-desc">
                                    <h5>Mobilus</h5>
                                    <div class="divider-header"></div>
                                    <p>
                                        Žiūrėkite pasirinktos stotelės duomenis mobiliajame įrenginyje. Susikurkite savo taisykles, kuriuos tenkinant jūsų mobilusis jus informuos pranešimu.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-4">
                        <div class="animated rotateInDownLeft slower">
                            <div class="service-box">
                                <div class="service-icon">
                                    <span class="fa fa-code fa-2x"></span>
                                </div>
                                <div class="service-desc">
                                    <h5>Arduino kodas</h5>
                                    <div class="divider-header"></div>
                                    <p>
                                        Jei jūs naudojate Arduino, mes duosime jums kodą, kurį įsirašę, galėsite laisvai naudotis savo nuosava orų stotele.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop