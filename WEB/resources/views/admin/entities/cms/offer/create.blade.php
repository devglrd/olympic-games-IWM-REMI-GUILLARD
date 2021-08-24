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
    <link href="{{ asset('pages-assets/plugins/jquery-nouislider/jquery.nouislider.css') }}" rel="stylesheet"
          type="text/css"
          media="screen">
    <link href="{{ asset('pages-assets/plugins/ion-slider/css/ion.rangeSlider.css') }}" rel="stylesheet"
          type="text/css"
          media="screen">
    <link href="{{ asset('pages-assets/plugins/ion-slider/css/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet"
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
                    <a href="{{ redirect()->back() }}">Offres</a>
                </li>
                <li class="breadcrumb-item active">Ajouter une offre</li>
            </ol>
            <form action="{{ action([\App\Http\Controllers\Admin\Cms\WallOfferController::class, 'store']) }}"
                  method="POST"
                  data-toggle="validator"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xl-5 col-lg-6">
                        <div class="card card-transparent">
                            <div class="card-block">
                                <button type="submit" class="btn btn-primary btn-cons">
                                    Ajouter une offre
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 ">
                        <div class="card card-white">
                            <div class="card-header">
                                <div class="card-title">
                                    Détails de l'offre
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required"
                                            aria-required="true">
                                            <label>Client</label>
                                            <select name="client" id="selectClient" class="select2 w-100 form-control">
                                                <option value="false">Choissisez un client</option>
                                                @if(request()->has('id'))
                                                    <option
                                                        value="{{ request()->get('id') }}">{{ \App\Models\Client::find(request()->get('id'))->name }} {{ \App\Models\Client::find(request()->get('id'))->first_name }}</option>
                                                @else
                                                    @foreach(\App\Models\Client::all() as $s)
                                                        <option
                                                            value="{{ $s->id }}">{{ $s->name }} {{ $s->first_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card  d-none cardSuite">
                            <div class="card-header">
                                <div class="card-title">
                                    Suite
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div
                                            class="form-group {{ $errors->has('activity') ? 'has-error' : '' }} form-group-default required"
                                            aria-required="true">
                                            <label>Seance</label>
                                            <select name="activity" id="selectSeance" class="form-control">
                                                <option value="">Choissisez une séance</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div
                                            class="w-100 form-group {{ $errors->has('time') ? 'has-error' : '' }} form-group-default "
                                            aria-required="true">
                                            <label>Tranche de temps</label>
                                            <select name="time" class="select form-control" id="">
                                                <option value="30">
                                                    30 min
                                                </option>
                                                <option value="60">
                                                    60 min
                                                </option>
                                                <option value="90">
                                                    90 min
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div
                                            class="form-group {{ $errors->has('ionSlider') ? 'has-error' : '' }} form-group-default required"
                                            aria-required="true">
                                            <label>Gains</label>

                                            <div class="irs-wrapper">
                                                {{--                                                <input type="text" id="ionSlider" name="ionSlider" />--}}
                                                <input type="text" name="gains" id="gains" class="form-control"
                                                       value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card  d-none cardSuiteTwo">
                            <div class="card-header">
                                <div class="card-title">
                                    Seance
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required">

                                            <label for="">Seance 1</label>
                                            <div class="input-prepend input-group mt-3 d-flex">
                                                <input id="datepicker"
                                                       type="text"
                                                       class="form-control"
                                                       name="seances[]"
                                                       value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}">
                                                @if ($errors->has('date'))
                                                    <div class="help-block">
                                                        <strong>{{ $errors->first('date') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-input-group flex-1 bootstrap-timepicker">
                                            <label class="">Heure de début</label>
                                            <input id="time" type="text" class="form-control" name="timeChoose[]"
                                                   value="{{ old('time') }}">
                                            @if ($errors->has('time'))
                                                <div class="help-block">
                                                    <strong>{{ $errors->first('time') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required">

                                            <label for="">Seance 2</label>
                                            <div class="input-prepend input-group mt-3 d-flex">
                                                <input id="datepicker2"
                                                       type="text"
                                                       class="form-control"
                                                       name="seances[]"
                                                       value="{{ \Carbon\Carbon::now()->addDay()->format('d/m/Y') }}">
                                                @if ($errors->has('date'))
                                                    <div class="help-block">
                                                        <strong>{{ $errors->first('date') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-input-group flex-1 bootstrap-timepicker">
                                            <label class="">Heure de début</label>
                                            <input id="timeMOP" type="text" class="form-control" name="timeChoose[]"
                                                   value="{{ old('time') }}">
                                            @if ($errors->has('time'))
                                                <div class="help-block">
                                                    <strong>{{ $errors->first('time') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required">

                                            <label for="">Seance 3</label>
                                            <div class="input-prepend input-group mt-3 d-flex">
                                                <input id="datepicker3"
                                                       type="text"
                                                       class="form-control"
                                                       name="seances[]"
                                                       value="{{ \Carbon\Carbon::now()->addDays(2)->format('d/m/Y') }}">
                                                @if ($errors->has('date'))
                                                    <div class="help-block">
                                                        <strong>{{ $errors->first('date') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-input-group flex-1 bootstrap-timepicker">
                                            <label class="">Heure de début</label>
                                            <input id="timeed" type="text" class="form-control" name="timeChoose[]"
                                                   value="">
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
    <script src="{{asset('pages-assets/plugins/moment/moment.min.js')}}"></script>

    <script src="{{ asset('pages-assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-typehead/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-typehead/typeahead.jquery.min.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/jquery-nouislider/jquery.nouislider.min.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/jquery-nouislider/jquery.liblink.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/ion-slider/js/ion.rangeSlider.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#selectSeance').on('change', function () {
                const id = $(this).val();
                const price = $('#data-option-' + id).data('price');
                $('#gains').val(price);
            })

            $('select').select2();

            $('#selectClient').on('change', function () {
                console.log('a');
                const id = $(this).val()
                $.ajax({
                    url: "/api/product/client/" + id,
                    method: 'GET',
                    success: function (data) {
                        console.log(data);
                        const option = $('.option-val').remove();
                        // console.log(option);
                        // if (option.length) {
                        //     option.forEach((e) => {
                        //         $(e).remove()
                        //     })
                        // }
                        data.forEach((e) => {
                            console.log(e.id);
                            $('#selectSeance').append("<option class='option-val' value='" + e.id + "' id='data-option-" + e.id + "' data-price='" + e.price + "'> " + e.name + "</option>")
                        });
                        {{--                            @foreach(\App\Models\Seance::all() as $s)--}}
                        {{--                        <option--}}
                        {{--                            value="{{ $s->id }}" id="data-option-{{$s->id}}"--}}
                        {{--                            data-price="{{$s->price}}">{{$s->name}}</option>--}}
                        {{--                        @endforeach--}}
                        $('.cardSuite').removeClass('d-none');
                    }
                })

            });

            $('#selectSeance').on('change', function () {
                $('.cardSuiteTwo').removeClass('d-none');
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
                todayHight: true,
                startDate: new Date()
            });
            $('#datepicker2').datepicker({
                format: 'dd/mm/yyyy', // FORMAT - Documentation : http://bootstrap-datepicker.readthedocs.io/en/latest/options.html#format
                language: 'fr',
                todayHight: true,
                startDate: new Date()
            });
            $('#datepicker3').datepicker({
                format: 'dd/mm/yyyy', // FORMAT - Documentation : http://bootstrap-datepicker.readthedocs.io/en/latest/options.html#format
                language: 'fr',
                todayHight: true,
                startDate: new Date()
            });
            $('#time').timepicker({
                showMeridian: false
            }).on('show.timepicker', function (e) {
                var widget = $('.bootstrap-timepicker-widget');
                widget.find('.glyphicon-chevron-up').removeClass().addClass('pg-arrow_maximize');
                widget.find('.glyphicon-chevron-down').removeClass().addClass('pg-arrow_minimize');
            });
            $('#timeMOP').timepicker({
                showMeridian: false
            }).on('show.timepicker', function (e) {
                var widget = $('.bootstrap-timepicker-widget');
                widget.find('.glyphicon-chevron-up').removeClass().addClass('pg-arrow_maximize');
                widget.find('.glyphicon-chevron-down').removeClass().addClass('pg-arrow_minimize');
            });
            $('#timeed').timepicker({
                showMeridian: false
            }).on('show.timepicker', function (e) {
                var widget = $('.bootstrap-timepicker-widget');
                widget.find('.glyphicon-chevron-up').removeClass().addClass('pg-arrow_maximize');
                widget.find('.glyphicon-chevron-down').removeClass().addClass('pg-arrow_minimize');
            });
        });
    </script>
@stop
