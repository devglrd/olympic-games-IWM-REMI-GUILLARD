@extends('admin')

@section('css')
<link href="{{ asset('pages-assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet" type="text/css"
media="screen">
<link href="{{ asset('pages-assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css"
media="screen">
<link href="{{ asset('pages-assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css"
media="screen">
@stop

@section('content')
    <div class="content sm-gutter">
        <div class="container-fluid container-fixed-lg">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ action([\App\Http\Controllers\SskController::class, 'index']) }}">Compétences de coaching</a>
                </li>
                <li class="breadcrumb-item active">Ajouter une nouvelle compétence</li>
            </ol>
            <form action="{{ action([\App\Http\Controllers\SskController::class, 'store']) }}" method="POST"
                  data-toggle="validator"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
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
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required"
                                             aria-required="true">
                                            <label>Nom</label>
                                            <input type="text" class="form-control" name="title"
                                                   value="{{ old('title') }}" placeholder="Nom"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required"
                                             aria-required="true">
                                            <label>Description</label>
                                            <textarea type="text" class="form-control editor" name="content"
                                                      placeholder="Description"
                                                      style="height: 50px;"
                                                      required>{{ old('excerpt') }}</textarea>
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
            $( '#time' ).timepicker( {
                showMeridian: false
            } ).on( 'show.timepicker', function (e) {
                var widget = $( '.bootstrap-timepicker-widget' );
                widget.find( '.glyphicon-chevron-up' ).removeClass().addClass( 'pg-arrow_maximize' );
                widget.find( '.glyphicon-chevron-down' ).removeClass().addClass( 'pg-arrow_minimize' );
            } );
        });
    </script>
@stop
