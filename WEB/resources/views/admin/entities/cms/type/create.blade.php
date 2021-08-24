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
                    <a href="{{ action([\App\Http\Controllers\Admin\DashboardController::class, 'typeSeance']) }}">Mes types de seances</a>
                </li>
                <li class="breadcrumb-item active">Ajouter un type de séance</li>
            </ol>
            <form action="{{ action([\App\Http\Controllers\Admin\DashboardController::class, 'createSeance']) }}"
                  method="POST"
                  data-toggle="validator"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-12">
                        <div class="card card-transparent">
                            <div class="card-block">
                                <button type="submit" class="btn btn-primary">
                                    Ajouter
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6 ">
                        <div class="card card-white">
                            <div class="card-header">
                                <div class="card-title">
                                    Nouveau Type de seances
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required"
                                            aria-required="true">
                                            <label>Nom</label>
                                            <input type="text" class="form-control" name="title"
                                                   value="{{ old('title') }}" placeholder="Nom"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12 d-none">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required"
                                            aria-required="true">
                                            <label>Activité relié</label>
                                            <select name="activity[]" multiple class="form-control select" id="">
                                                @foreach(\App\Models\Activity::all() as $act)
                                                    <option value="{{$act->id}}">{{$act->name}}</option>
                                                @endforeach()
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required"
                                            aria-required="true">
                                            <label>Tarif Coach</label>
                                            <input type="number" class="form-control" name="price">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required"
                                            aria-required="true">
                                            <label>Couleur</label>
                                            <input type="color" class="form-control" name="color">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required">
                                            <label>Temps</label>
                                            <select name="times[]" id="" multiple class="form-control">
                                                <option value="30">30min</option>
                                                <option value="60">60min</option>
                                                <option value="90">90min</option>
                                                <option value="120">120min</option>
                                            </select>
{{--                                            <div class="d-flex align-items-center justify-content-between" style="width: 50%">--}}
{{----}}
{{--                                                <div class="radio radio-success">--}}
{{--                                                    <input type="radio" checked="checked" value="30" name="time" id="radio2Yes">--}}
{{--                                                    <label for="radio2Yes">30 min</label>--}}
{{--                                                    <input type="radio" value="60" name="time" id="radio2No">--}}
{{--                                                    <label for="radio2No">60 min</label>--}}
{{--                                                    <input type="radio" value="90" name="time" id="radio3No">--}}
{{--                                                    <label for="radio3No">90 min</label>--}}
{{--                                                </div>--}}


                                            </div>
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
    <script>
        $(document).ready(function () {
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
