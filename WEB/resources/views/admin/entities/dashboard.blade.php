@extends('admin')


@section('css')
@stop

@section('content')
    <div class="content">
        <div class="container">
            <h1>
                <span
                    class="bold">Vue d'ensemble</span>
            </h1>
            <div class="row">
                <div class="col-12 my-3">
                    <span> Cliquez <a href="{{ route("apk") }}" target="_blank">ici</a> pour télécharger la derniere version de l'application mobile en APK</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-white card-dashboard">
                        <a class="card-header text-center"
                           href="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'index']) }}">
                            <div class="card-title bold">Nombre de clients
                            </div>
                        </a>
                        <div class="card-block text-center">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <h1>{{ \App\Models\Client::count() }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-white card-dashboard">
                        <a class="card-header text-center"
                           href="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'index']) }}">
                            <div class="card-title bold">Nombre de coachs
                            </div>
                        </a>
                        <div class="card-block text-center">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <h1>{{ \App\Models\Coach::count() }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-white card-dashboard">
                        <a class="card-header text-center"
                           href="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'planning']) }}">
                            <div class="card-title bold">Nombre de séances programées
                            </div>
                        </a>
                        <div class="card-block text-center">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <h1>{{ \App\Models\CoachClientSeance::count() }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-white card-dashboard">
                        <a class="card-header text-center"
                           href="{{ action([\App\Http\Controllers\Admin\Cms\WallOfferController::class, 'index']) }}">
                            <div class="card-title bold">Nombre d'offre à valider
                            </div>
                        </a>
                        <div class="card-block text-center">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <h1>{{ \App\Models\WallOffer::pending()->count() }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-white card-dashboard">
                        <a class="card-header text-center" href="{{ action([\App\Http\Controllers\Admin\Cms\WallOfferController::class, 'notFound']) }}">
                            <div class="card-title bold">Nombre d'offre validé
                            </div>
                        </a>
                        <div class="card-block text-center">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <h1>{{ \App\Models\WallOffer::notFound()->count() }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-white card-dashboard">
                        <a class="card-header text-center" href="{{ action([\App\Http\Controllers\Admin\Cms\WallOfferController::class, 'indexFound']) }}">
                            <div class="card-title bold">Nombre d'offre valider et approuvée
                            </div>
                        </a>
                        <div class="card-block text-center">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <h1>{{ \App\Models\WallOfferSubscriber::where('status', \App\Models\WallOfferSubscriber::ACCEPTED)->count() }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-white card-dashboard">
                        <a class="card-header text-center" href="{{ action([\App\Http\Controllers\Admin\Cms\ActivityController::class, 'index']) }}">
                            <div class="card-title bold">Nombre de compétences
                            </div>
                        </a>
                        <div class="card-block text-center">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <h1>{{ \App\Models\Activity::count() }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-white card-dashboard">
                        <a class="card-header text-center" href="{{ action([\App\Http\Controllers\Admin\Cms\SkillController::class, 'index']) }}">
                            <div class="card-title bold">Nombre de traits de caractère
                            </div>
                        </a>
                        <div class="card-block text-center">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <h1>{{ \App\Models\Skill::count() }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
@stop
