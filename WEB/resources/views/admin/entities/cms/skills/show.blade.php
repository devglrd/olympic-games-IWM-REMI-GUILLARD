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
                    <a href="{{ action([\App\Http\Controllers\Admin\DashboardController::class, 'dashboard']) }}">Tableau
                        de bord</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ redirect()->back() }}">List des utilisateurs</a>
                </li>
                <li class="breadcrumb-item active">Modifier un événement</li>
            </ol>
            <div>
                <div class="row">
                    <div class="col-xl-7 col-lg-6 ">
                        <div class="card card-white">
                            <div class="card-header">
                                <div class="card-title">
                                    Information de l'utilisateur
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default"
                                             aria-required="true">
                                            <label>Nom</label>
                                            {{ $user->name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default"
                                             aria-required="true">
                                            <label>Email</label>
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default"
                                             aria-required="true">
                                            <label>Tel</label>
                                            {{ $user->tel }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default"
                                             aria-required="true">
                                            <label>Addresse</label>
                                            {{ $user->address }}, {{ $user->postalCode }}, {{ $user->city }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <div class="card card-white">
                            <div class="card-header ">
                                <div class="card-title">Photo actuelle de l'événement
                                </div>
                            </div>
                            <div class="card-block">
                                {{--                                <img src="{{ $event->getFile ? $event->getFile->file : 'N/A' }}" alt="" height="250">--}}
                            </div>
                        </div>
                        <div class="card card-white">
                            <div class="card-header ">
                                <div class="card-title">Photo actuelle de l'événement <strong>(home)</strong>
                                </div>
                            </div>
                            <div class="card-block">
                                {{--                                <img src="{{ $event->getHomeFile ? $event->getHomeFile->file : 'N/A' }}" alt="" height="250">--}}
                            </div>
                        </div>
{{--                        <div class="card card-transparent">--}}
{{--                            <div class="card-header ">--}}
{{--                                <div class="card-title">Validation--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="card-block">--}}
{{--                                <h3>--}}
{{--                                    Modifier un événement--}}
{{--                                </h3>--}}
{{--                                <p>--}}
{{--                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci aperiam,--}}
{{--                                    assumenda beatae cumque dicta earum eos error esse facere optio reiciendis saepe--}}
{{--                                    sequi, suscipit tenetur. Atque ea earum eius est eveniet fugit impedit molestias,--}}
{{--                                    odit pariatur perspiciatis quibusdam, repellat!--}}
{{--                                </p>--}}
{{--                                <br>--}}
{{--                                <button type="submit" class="btn btn-primary btn-cons">--}}
{{--                                    Valider les modifications--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
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
