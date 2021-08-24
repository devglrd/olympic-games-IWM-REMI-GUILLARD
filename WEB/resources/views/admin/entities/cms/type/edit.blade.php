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
                    <a href="{{ action([\App\Http\Controllers\Admin\DashboardController::class, 'typeSeance']) }}">Mes type de seances</a>
                </li>
                <li class="breadcrumb-item active">#TS{{str_pad($seance->id, 5, '0', STR_PAD_LEFT)}}</li>
            </ol>
            <form
                action="{{ action([\App\Http\Controllers\Admin\DashboardController::class, 'updateSeance'], $seance->id) }}"
                method="POST"
                data-toggle="validator"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-12">
                        <div class="card card-transparent">
                            <div class="card-block">
                                <button type="submit" class="btn btn-primary">
                                    Enregistrer
                                </button>

                                <div id="delete"
                                    class="delete btn btn btn-danger"
                                    style="display: inline-block;vertical-align: top;">
                                    Supprimer
                                </div>


                                </td>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6 ">
                        <div class="card card-white">
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required"
                                            aria-required="true">
                                            <label>Nom</label>
                                            <input type="text" class="form-control" name="title"
                                                   value="{{ $seance->name }}" placeholder="Nom"
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
                                                    <option {{ $seance->getActivity->filter(function($item) use($act){
    return $item->id === $act->id;
})->first() ? 'selected="selected"' : '' }} value="{{$act->id}}">{{$act->name}}</option>
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
                                            <input type="number" class="form-control" name="price"
                                                   value="{{$seance->price}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required"
                                            aria-required="true">
                                            <label>Couleur</label>
                                            <input type="color" class="form-control" name="color" value="{{$seance->color}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required">
                                            <label>Temps</label>
                                            <select name="times[]" id="" multiple class="form-control">
                                                <option
                                                    {{ in_array('30', explode(',', $seance->time)) ? 'selected="selected"'  : ''}} value="30">
                                                    30min
                                                </option>
                                                <option
                                                    {{ in_array('60', explode(',', $seance->time)) ? 'selected="selected"'  : ''}} value="60">
                                                    60min
                                                </option>
                                                <option
                                                    {{ in_array('90', explode(',', $seance->time)) ? 'selected="selected"'  : ''}} value="90">
                                                    90min
                                                </option>
                                                <option
                                                    {{ in_array('120', explode(',', $seance->time)) ? 'selected="selected"'  : ''}} value="120">
                                                    120min
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

    <form class="d-none" id="formDelete"
          action="{{ action([\App\Http\Controllers\Admin\DashboardController::class, 'deleteSeance'], $seance->id) }}"
          method="POST">
        <input type="hidden" value="DELETE" name="_method">
        {{ csrf_field() }}
    </form>
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
            $('#delete').on('click', function () {
                $("#formDelete").submit();
            });
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
