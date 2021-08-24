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
                    <a href="{{ action('Admin\AdminController@dashboard') }}">Tableau de bord</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ action('Admin\Cms\Souffle\EventsController@index') }}">Events</a>
                </li>
                <li class="breadcrumb-item active">Ajouter un événement</li>
            </ol>
            <form action="{{ action('Admin\Cms\Souffle\EventsController@store') }}" method="POST"
                  data-toggle="validator"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xl-7 col-lg-6 ">
                        <div class="card card-white">
                            <div class="card-header">
                                <div class="card-title">
                                    Ajouter un événement
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required"
                                             aria-required="true">
                                            <label>Titre de l'événement</label>
                                            <input type="text" class="form-control" name="title"
                                                   value="{{ old('title') }}" placeholder="Titre de l'événement"
                                                   required>
                                            @if ($errors->has('title'))
                                                <div class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }} form-group-default">
                                            <label>Prix (Adhérents)</label>
                                            <input type="text" class="form-control" name="price"
                                                   value="{{ old('price') }}" placeholder="€">
                                            @if ($errors->has('price'))
                                                <div class="help-block">
                                                    <strong>{{ $errors->first('price') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }} form-group-default">
                                            <label>Prix (Non adhérents)</label>
                                            <input type="text" class="form-control" name="price_2"
                                                   value="{{ old('price_2') }}" placeholder="€">
                                            @if ($errors->has('price_2'))
                                                <div class="help-block">
                                                    <strong>{{ $errors->first('price_2') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="row clearfix">--}}
                                {{--<div class="col-md-12">--}}
                                {{--<div class="form-group">--}}
                                {{--<div class="input-daterange input-group" id="datepicker-range">--}}
                                {{--<input type="text" class="input-sm form-control" name="start"/>--}}
                                {{--<div class="input-group-addon">to</div>--}}
                                {{--<input type="text" class="input-sm form-control" name="end"/>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                <div class="row clearfix">
                                    <div class="col-6">
                                        <div class="form-group form-group-default input-group required">
                                            <div class="form-input-group flex-1">
                                                <label class="">Date de l'événement</label>
                                                <input id="datepicker" type="text" class="form-control" name="date"
                                                       value="{{ old('date') ? old('date') : Carbon\Carbon::now()->format('d/m/Y')}}">
                                                @if ($errors->has('date'))
                                                    <div class="help-block">
                                                        <strong>{{ $errors->first('date') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group form-group-default input-group required">
                                            <div class="form-input-group flex-1 bootstrap-timepicker">
                                                <label class="">Heure de début</label>
                                                <input id="time" type="text" class="form-control" name="time"
                                                       value="{{ old('time') }}">
                                                @if ($errors->has('time'))
                                                    <div class="help-block">
                                                        <strong>{{ $errors->first('time') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('place') ? 'has-error' : '' }} form-group-default">
                                            <label>Lieu de l'événement</label>
                                            <input type="text" class="form-control" name="place"
                                                   value="{{ old('place') }}" placeholder="Lieu de l'événement">
                                            @if ($errors->has('place'))
                                                <div class="help-block">
                                                    <strong>{{ $errors->first('place') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Image de l'événement<span style="color: #f35958;">*</span></label>
                                            <input type="file" name="file">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Image de l'événement (home)<span style="color: #f35958;"></span></label>
                                            <input type="file" name="home_file">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('theme') ? 'has-error' : '' }} form-group-default required"
                                             aria-required="true">
                                            <label>Thème de l'événement</label>
                                            <input type="text" class="form-control" name="theme"
                                                   value="{{ old('theme') }}" placeholder="Thème de l'événement"
                                                   required>
                                            @if ($errors->has('theme'))
                                                <div class="help-block">
                                                    <strong>{{ $errors->first('theme') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Extrait descriptif<span style="color: #f35958;">*</span></label>
                                            <textarea type="text" class="form-control editor" name="excerpt"
                                                      placeholder="Extrait de l'événement"
                                                      style="height: 50px;"
                                                      required>{{ old('excerpt') }}</textarea>
                                            @if ($errors->has('excerpt'))
                                                <div class="help-block">
                                                    <strong>{{ $errors->first('excerpt') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description <span style="color: #f35958;">*</span></label>
                                            <textarea type="text" class="form-control editor" name="content"
                                                      placeholder="Description de l'événement"
                                                      style="height: 100px;"
                                                      required>{{ old('content') }}</textarea>
                                            @if ($errors->has('content'))
                                                <div class="help-block">
                                                    <strong>{{ $errors->first('content') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <div class="card card-transparent">
                            <div class="card-header ">
                                <div class="card-title">Validation
                                </div>
                            </div>
                            <div class="card-block">
                                <h3>
                                    Ajouter un événement
                                </h3>
                                
                                @permission('create-cms-events')
                                <button type="submit" class="btn btn-primary btn-cons">
                                    Ajouter l'événement
                                </button>
                                @endpermission
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