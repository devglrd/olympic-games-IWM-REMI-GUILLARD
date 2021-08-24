@extends('admin')

@section('css')
    <link href="{{ asset('pages-assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet"
          type="text/css"
          media="screen">
    <link href="{{ asset('pages-assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet"
          type="text/css"
          media="screen">
    <link href="{{ asset('pages-assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet"
          type="text/css"
          media="screen">
@stop


@section('content')
    <div class="content sm-gutter">
        <div class="container-fluid container-fixed-lg">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\UsersController::class, 'index']) }}">Utilisateurs</a>
                </li>
                <li class="breadcrumb-item active"> #U{{str_pad($user->id, 5, '0', STR_PAD_LEFT)}}-{{$user->name}}</li>
            </ol>

            <div class="row">
                <div class="col-xl-6 col-lg-6 ">
                    <form action="{{ action([\App\Http\Controllers\Admin\Cms\UsersController::class, 'update'],$user->id) }}" method="POST"
                        data-toggle="validator"
                        enctype="multipart/form-data">
                        {{ method_field('put') }}
                        {{ csrf_field() }}
                        <div class="card card-white">
                            <div class="card-header">
                                <div class="card-title">
                                    Informations générales
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} form-group-default required"
                                            aria-required="true">
                                            <label>Nom</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $user->name }}" placeholder="nom utilisateur"
                                                required>
                                            @if ($errors->has('name'))
                                                <div class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} form-group-default required"
                                            aria-required="true">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email"
                                                value="{{ $user->email }}" placeholder="email utilisateur"
                                                required>
                                            @if ($errors->has('email'))
                                                <div class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary">Mettre à jour</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <form action="{{ action([\App\Http\Controllers\Admin\Cms\UsersController::class, 'updatePassword']) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="card card-white">
                            <div class="card-header ">
                                <div class="card-title">Changer de mot de passe</div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('password') ? 'has-error' : '' }} form-group-default required"
                                            aria-required="true">
                                            <label>Nouveau mot de passe</label>
                                            <input type="password" name="password" class="form-control"
                                                value="password">
                                        </div>
                                        <div
                                            class="form-group {{ $errors->has('confirmpassword') ? 'has-error' : '' }} form-group-default required"
                                            aria-required="true">
                                            <label>Confirmer mot de passe</label>
                                            <input type="password" name="confirmpassword" class="form-control"
                                                value="confirmpassword">
                                        </div>
                                        <div>
                                            <button class="btn btn-primary">Mettre à jour</button>
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
@stop


@section('js')
    <script src="{{ asset('pages-assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-typehead/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-typehead/typeahead.jquery.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            let months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
            // DATEPICKER - Documentation : http://bootstrap-datepicker.readthedocs.io/en/latest/index.html
            $.fn.datepicker.dates['fr'] = {
                days: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
                daysShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
                daysMin: ["D", "L", "M", "M", "J", "V", "S"],
                months: months,
                monthsShort: ["Janv", "Févr", "Mars", "Avr", "Mai", "Juin", "Juill", "Août", "Sept", "Oct", "Nov", "Déc"],
                today: "Aujourd'hui",
                clear: "Clear",
                format: "dd/mm/yyyy",
                titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
                weekStart: 1
            };
            $('#datepicker').datepicker({
                format: 'dd/mm/yyyy', // FORMAT - Documentation : http://bootstrap-datepicker.readthedocs.io/en/latest/options.html#format
                language: 'fr',
                todayHight: true
            });
            $('#time').timepicker({
                showMeridian: false
            }).on('show.timepicker', function (e) {
                var widget = $('.bootstrap-timepicker-widget');
                widget.find('.glyphicon-chevron-up').removeClass().addClass('pg-arrow_maximize');
                widget.find('.glyphicon-chevron-down').removeClass().addClass('pg-arrow_minimize');
            });
        });
    </script>
@stop
