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

    <link media="screen" type="text/css" rel="stylesheet"
          href="{{ asset('pages-assets/assets/plugins/switchery/css/switchery.min.css')}}">
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
                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'index']) }}">Coachs</a>
                </li>
                <li class="breadcrumb-item active">Créer une séance</li>
            </ol>
            <form action="{{ action([\App\Http\Controllers\SeanceController::class, 'store']) }}" method="POST"
                  data-toggle="validator"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xl-5 col-lg-6">
                        <div class="card card-transparent">
                            <div class="card-block">
                                <button type="submit" class="btn btn-primary btn-cons">
                                    Ajouter une séance
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 ">
                        <div class="card card-white">
                            <div class="card-header">
                                <div class="card-title">
                                    Information de base
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div
                                            class="w-100 form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default "
                                        >
                                            <label>Client</label>
                                            <select name="client" id="select" class="form-control">
                                                @if($hasClient)
                                                    <option
                                                         selected='selected' value="{{$client->id}}"> {{$client->name . ' ' . $client->first_name}}</option>
                                                @else
                                                    @foreach(\App\Models\Client::active()->get() as $pr)
                                                        <option
                                                            value="{{$pr->id}}"> {{$pr->name . ' ' . $pr->first_name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="w-100 form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default "
                                            aria-required="true">
                                            <label>Coach</label>
                                            <select name="coach" id="select" class="form-control">
                                                @foreach(\App\Models\Coach::where('active','1')->get() as $pr)
                                                    <option
                                                        value="{{$pr->id}}"> {{$pr->name . ' ' . $pr->first_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="w-100 form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default "
                                            aria-required="true">
                                            <label>Seance</label>
                                            <select name="seance" id="select" class="form-control">
                                                @foreach(\App\Models\Seance::all() as $pr)
                                                    <option
                                                        value="{{$pr->id}}"> {{$pr->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <div
                                            class="w-100 form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default "
                                            aria-required="true">
                                            <label>Date de la séance</label>
                                            <div id="myDatepicker" class="input-group date">
                                                <input type="text" name="date" class="form-control">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="w-100 form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default ">
                                            <label>Heure de la séance</label>
                                            <div class="input-group bootstrap-timepicker">
                                                <input id="timepicker" name="time" type="text" class="form-control">
                                                <span class="input-group-addon"><i class="pg-clock"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div
                                            class="w-100 form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default "
                                            aria-required="true">
                                            <label>Tranche de temps</label>
                                            <select name="timeChoose" class="select form-control" id="">
                                                <option value="30">
                                                    30 min
                                                </option>
                                                <option value="60" selected="selected">
                                                    60 min
                                                </option>
                                                <option value="90">
                                                    90 min
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </form>
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
    <script type="text/javascript" src="{{ asset('pages-assets/plugins/switchery/js/switchery.min.js') }}"></script>
    <script>

        var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
        // Success color: #10CFBD
        elems.forEach(function (html) {
            var switchery = new Switchery(html, {color: '#10CFBD'});
        });


        $(document).ready(function () {
            $('#myDatepicker').datepicker({startDate: new Date()});
            $('#timepicker').timepicker().on('show.timepicker', function (e) {
                var widget = $('.bootstrap-timepicker-widget');
                widget.find('.glyphicon-chevron-up').removeClass().addClass('pg-arrow_maximize');
                widget.find('.glyphicon-chevron-down').removeClass().addClass('pg-arrow_minimize');
            });

            $('select').select2();
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
            var date = new Date();
            date.setDate(date.getDate()-1);
            $('#datepicker').datepicker({
                format: 'dd/mm/yyyy', // FORMAT - Documentation : http://bootstrap-datepicker.readthedocs.io/en/latest/options.html#format
                language: 'fr',
                todayHight: true,
                startDate:new Date(),
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
