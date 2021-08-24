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
                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\AlertController::class, 'index']) }}">Mes Alertes</a>
                </li>
                @if(request()->has('user'))
                    <li class="breadcrumb-item active"><a href="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'edit'],request()->get('user')) }}">#CL{{str_pad(request()->get('user'), 5, '0', STR_PAD_LEFT)}}</a></li>
                @endif
                <li class="breadcrumb-item active">Ajouter une alerte</li>

            </ol>
            <form action="{{ action([\App\Http\Controllers\Admin\Cms\AlertController::class, 'store']) }}"
                  method="POST"
                  data-toggle="validator"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xl-5 col-lg-6">
                        <div class="card card-transparent">
                            <div class="card-block">
                                <button type="submit" class="btn btn-primary btn-cons">
                                    Créer une alerte
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-7 col-lg-6 ">
                        <div class="card card-white">
                            <div class="card-header">
                                <div class="card-title">
                                    Contenu de l'alerte
                                </div>
                            </div>
                            <div class="card-block">
                                @if(request()->has('user'))
                                    <input type="hidden" name="user" value="{{ request()->get('user') }}">
                                @endif
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('client') ? 'has-error' : '' }} form-group-default required"
                                            aria-required="true">
                                            <label>Client</label>
                                            <select name="client" id="select" class="form-control">
                                                @if(request()->has('user'))
                                                    <option
                                                        value="{{ App\Models\Client::find(request()->get('user'))->id }}"
                                                        selected="selected"
                                                        class="disabled">{{ \App\Models\Client::find(request()->get('user'))->name }}</option>
                                                @else
                                                    @foreach(\App\Models\Client::all() as $s)
                                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('content') ? 'has-error' : '' }} form-group-default required"
                                            aria-required="true">
                                            <label>Date de l'alerte</label>
                                            <input id="datepicker" type="text" class="form-control" name="date"
                                                   value="{{ old('date') ? old('date') : Carbon\Carbon::now()->format('d/m/Y')}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('content') ? 'has-error' : '' }} form-group-default required"
                                            aria-required="true">
                                            <label>Contenue de l'alerte</label>
                                            <textarea type="text" class="form-control editor" name="content"
                                                      placeholder="Description de l'événement"
                                                      style="height: 100px;"
                                                      required></textarea>
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
        var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
        // Success color: #10CFBD
        elems.forEach(function (html) {
            var switchery = new Switchery(html, {color: '#10CFBD'});
        });
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
