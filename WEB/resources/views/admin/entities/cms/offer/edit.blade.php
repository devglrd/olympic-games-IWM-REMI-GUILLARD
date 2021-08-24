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
                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\WallOfferController::class, 'index']) }}">Offres
                        en attente</a>
                </li>
                <li class="breadcrumb-item active">#OF{{str_pad($offer->id, 5, '0', STR_PAD_LEFT)}}</li>
            </ol>
            <div class="row mx-1 my-3">
                <div class="col-2">
                    <form
                        action="{{ action([\App\Http\Controllers\Admin\Cms\WallOfferController::class, 'destroy'],$offer->id) }}"
                        method="POST"
                        data-toggle="validator"
                        enctype="multipart/form-data">
                        <button type="submit"
                                class="btn btn-danger">Supprimé l'offre
                        </button>
                    </form>
                </div>
                <div class="col-2">
                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'edit'],$offer->getClient->id) }}"
                       class="btn btn-primary">Voir la fiche client</a>
                </div>
            </div>
            <form
                action="{{ action([\App\Http\Controllers\Admin\Cms\WallOfferController::class, 'update'], $offer->id) }} }}"
                method="POST"
                data-toggle="validator"
                enctype="multipart/form-data">
                {{ method_field('put') }}
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xl-6 col-lg-6 ">
                        <div class="card card-white">
                            <div class="card-header ">
                                <div class="card-title">Information du client
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default"
                                             aria-required="true">
                                            <label>Nom</label>
                                            {{ $offer->getClient->name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default"
                                             aria-required="true">
                                            <label>Prénom</label>
                                            {{ $offer->getClient->first_name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default"
                                             aria-required="true">
                                            <label>Email</label>
                                            {{ $offer->getClient->email }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default"
                                             aria-required="true">
                                            <label>Tel</label>
                                            {{ $offer->getClient->tel }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default"
                                             aria-required="true">
                                            <label>Adresse</label>
                                            {{ $offer->getClient->address }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default"
                                             aria-required="true">
                                            <label>Code postale</label>
                                            {{ $offer->getClient->postalCode }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default"
                                             aria-required="true">
                                            <label>Ville</label>
                                            {{ $offer->getClient->city }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="card card-white">
                            <div class="card-header ">
                                <div class="card-title">Informations sportive
                                </div>
                            </div>
                            <div class="card-block pt-0">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group form-group-default {{ $errors->has('age') ? 'has-error' : '' }}"
                                            aria-required="true">
                                            <label>Age</label>
                                            {{ $offer->getClient->age }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group form-group-default {{ $errors->has('height') ? 'has-error' : '' }}"
                                            aria-required="true">
                                            <label>Taille (cm)</label>
                                            {{ $offer->getClient->height }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group form-group-default {{ $errors->has('weight') ? 'has-error' : '' }}"
                                            aria-required="true">
                                            <label>Poids (kg)</label>
                                            {{ $offer->getClient->weight }}
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group form-group-default {{ $errors->has('sport') ? 'has-error' : '' }}"
                                            aria-required="true">
                                            <label>Sport pratiqué</label>
                                            {{ $offer->getClient->sport ? $offer->getClient->sport : 'inconnu'}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group form-group-default {{ $errors->has('materiel_sportif') ? 'has-error' : '' }}"
                                            aria-required="true">
                                            <label>Matériel Sportif</label>
                                            {{ $offer->getClient->materiel_sportif ? $offer->getClient->materiel_sportif : 'inconnu'}}

                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default"
                                             aria-required="true">
                                            <label>Objectif Sportif</label>
                                            {{  $offer->getClient->sport_objectif }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group form-group-default {{ $errors->has('coaching_place') ? 'has-error' : '' }}"
                                            aria-required="true">
                                            <label>Lieu de coaching</label>
                                            {{ $offer->getClient->coaching_place ? $offer->getClient->coaching_place : 'nom communiqué' }}

                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default"
                                             aria-required="true">
                                            <label>Précison Objectif</label>
                                            {{ $offer->getClient->precision_sportif ? $offer->getClient->precision_sportif : 'nom communiqué' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group form-group-default {{ $errors->has('nb_coaching') ? 'has-error' : '' }}"
                                            aria-required="true">
                                            <label>Fréquence de coaching souhaité</label>
                                            {{ $offer->getClient->nb_coaching ? $offer->getClient->nb_coaching : 'inconnu'}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(count($subscribe) > 0 && $offer->status != \App\Models\WallOffer::FIND)
                    <div class="row clearfix">
                        <div class="card card-white">
                            <div class="card-block pt-0">
                                <div class="card-header ">
                                    <div class="card-title">détails de l'Offre
                                    </div>
                                </div>
                                <div class="row clearfix mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label for="">Type de Seance </label>
                                            {{$offer->getSeance->name}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label for="">Durée de la Seance (en min) </label>
                                            {{$offer->getSeance->time}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    @foreach($offer->getDate() as $booking)
                                        <div class="col-md-4">
                                            <div class="form-group form-group-default">
                                                <label for="">Seance </label>
                                                <div class="input-prepend input-group mt-3 d-flex">
                                                    {{$booking['start']}} - {{$booking['end']}}

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row clearfix">
                        <div class="card card-white">
                            <div class="card-block pt-0">
                                <div class="card-header ">
                                    <div class="card-title">détails de l'Offre
                                    </div>
                                </div>

                                <div class="row clearfix mt-3">
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label for="">Type de Seance </label>
                                            <select name="activity" id="select" class="form-control">
                                                @foreach(\App\Models\Seance::all() as $s)
                                                    <option
                                                        {{ $offer->getSeance->id == $s->id ? 'selected="selected"' : '' }} value="{{ $s->id }}">{{$s->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label for="">Durée de la Seance (en min) </label>
                                            <select name="time" class="select form-control" id="">
                                                <option
                                                    {{ $offer->getSeance->time == 30 ? 'selected="selected"' : '' }} value="30">
                                                    30 min
                                                </option>
                                                <option
                                                    {{ $offer->getSeance->time == 60 ? 'selected="selected"' : '' }} value="60">
                                                    60 min
                                                </option>
                                                <option
                                                    {{ $offer->getSeance->time == 90 ? 'selected="selected"' : '' }} value="90">
                                                    90 min
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-group-default">
                                            <label for="">Gains</label>
                                            <input type="string" value="{{ $offer->gains ? $offer->gains : $offer->getSeance->price }}" name="gains" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <label for="">Seance 1</label>
                                        <div
                                            class="w-100 form-group {{ $errors->has('date_start_1') ? 'has-error' : '' }} form-group-default "
                                            aria-required="true">
                                            <label>Date début</label>
                                            <div id="myDatepicker_1" class="input-group date">
                                                <input type="text" name="date_start_1" class="form-control"
                                                       value="{{\Carbon\Carbon::parse($offer->getDate()[0]['start'])->format("d/m/Y")}}">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div
                                            class="w-100 form-group {{ $errors->has('time_start_1') ? 'has-error' : '' }} form-group-default ">
                                            <div class="input-group bootstrap-timepicker">
                                                <input id="timepicker_1" name="time_start_1" type="text"
                                                       class="form-control"
                                                       value="{{ \Carbon\Carbon::parse($offer->getDate()[0]['start'])->toTimeString() }}">
                                                <span class="input-group-addon"><i class="pg-clock"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Seance 2</label>
                                        <div
                                            class="w-100 form-group {{ $errors->has('date_start_2') ? 'has-error' : '' }} form-group-default "
                                            aria-required="true">
                                            <label>Date début</label>
                                            <div id="myDatepicker_2" class="input-group date">
                                                <input type="text" name="date_start_2" class="form-control"
                                                       value="{{\Carbon\Carbon::parse($offer->getDate()[1]['start'])->format("d/m/Y")}}">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div
                                            class="w-100 form-group {{ $errors->has('time_start_2') ? 'has-error' : '' }} form-group-default ">
                                            <div class="input-group bootstrap-timepicker">
                                                <input id="timepicker_2" name="time_start_1" type="text"
                                                       class="form-control"
                                                       value="{{ \Carbon\Carbon::parse($offer->getDate()[1]['start'])->toTimeString() }}">
                                                <span class="input-group-addon"><i class="pg-clock"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Seance 3</label>
                                        <div
                                            class="w-100 form-group {{ $errors->has('date_start_3') ? 'has-error' : '' }} form-group-default "
                                            aria-required="true">
                                            <label>Date début</label>
                                            <div id="myDatepicker_3" class="input-group date">
                                                <input type="text" name="date_start_3" class="form-control"
                                                       value="{{\Carbon\Carbon::parse($offer->getDate()[2]['start'])->format("d/m/Y")}}">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div
                                            class="w-100 form-group {{ $errors->has('time_start_3') ? 'has-error' : '' }} form-group-default ">
                                            <div class="input-group bootstrap-timepicker">
                                                <input id="timepicker_3" name="time_start_3" type="text"
                                                       class="form-control"
                                                       value="{{ \Carbon\Carbon::parse($offer->getDate()[2]['start'])->toTimeString() }}">
                                                <span class="input-group-addon"><i class="pg-clock"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix mt-3">
                                    <div class="col-xl-12 col-lg-12">
                                        <button type="submit" class="btn btn-primary btn-cons">
                                            Modifier
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card card-white">
                            <div class="card-header">
                                <div class="card-title">
                                    Les candidatures :
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="card-group horizontal" id="accordion" role="tablist"
                                             aria-multiselectable="true">
                                            @foreach($subscribe as $key => $su)
                                                <div class="card card-default m-b-0">
                                                    <div class="card-header " role="tab" id="headingOne-{{$key}}">
                                                        <div
                                                            class="cursor card-title d-flex align-items-center justify-content-between"
                                                            data-toggle="collapse" data-parent="#accordion"
                                                            href="#collapseOne-{{$key}}" aria-expanded="false"
                                                            aria-controls="collapseOne-{{$key}}" class="collapsed">
                                                            <div class="d-flex align-items-center">
                                                                <div class="d-flex flex-column align-items-start">
                                                                    <h4 class="text-black">
                                                                        {{$su->getCoach->name}} {{$su->getCoach->first_name}}
                                                                    </h4>
                                                                    <span
                                                                        class=" label label-success">
                                                                        Seance du
                                                                        {{$su->start_at}} - {{$su->end_at}}
                                                                </span>
                                                                </div>
                                                                <div class="sepa"></div>
                                                                <div class="ml-2">
                                                                    @foreach($su->getCoach->getSkills as $skill)
                                                                        <span
                                                                            class=" label label-info p-t-5 p-b-5 inline fs-12">{{$skill->name}}</span>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            @if($offer->status != \App\Models\WallOffer::FIND)
                                                                <div class="">
                                                                    <a data-id="{{$key}}"
                                                                       class="btn-approuved text-white btn btn-info fs-12">Approuver
                                                                        ce coach</a>
                                                                    <span id="deleteCoach" data-id="{{ $offer->id }}"
                                                                          data-coach="{{ $su->getCoach->id }}"
                                                                          class="btn btn-danger">Supprimer cette candidature</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div id="collapseOne-{{$key}}" class="collapse" role="tabcard"
                                                         aria-labelledby="headingOne-{{$key}}" aria-expanded="false"
                                                         style="">
                                                        <div class="card-block">
                                                            <div>
                                                                - Addresse du coach : {{$su->getCoach->address}}
                                                                , {{$su->getCoach->postalCode}}, {{$su->getCoach->city}}
                                                                <br>
                                                                <br>
                                                                - Tel du coach : {{$su->getCoach->tel}}
                                                            </div>
                                                            <div class="m-t-35 d-none" id="call-{{$key}}">
                                                                <a href="{{ action([\App\Http\Controllers\Admin\Cms\WallOfferController::class, 'assign'], [$offer->id,$su->id]) }}"
                                                                   class="btn btn-info">Approuver ce coach</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
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

            $('#deleteCoach').on('click', function () {
                const url = "/admin/offers/destroy/1";
                const id = $(this).data('id');
                const coach = $(this).data('coach');
                const urlNew = url.replace('y/1', 'y/' + id) + '?coach=' + coach;

                console.log(urlNew);
                $.ajax({
                    url: urlNew,
                    method: 'POST',
                    success: function (item) {
                        console.log(item);
                        window.location.reload();
                    }
                });
            });

            $('.btn-approuved').on('click', function () {
                const id = $(this).data('id');
                $('#call-' + id).find("a")[0].click();
            })

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


            $('#myDatepicker_1').datepicker({
                format: 'dd/mm/yyyy', // FORMAT - Documentation : http://bootstrap-datepicker.readthedocs.io/en/latest/options.html#format
                language: 'fr',
                todayHight: true
            });
            $('#timepicker_1').timepicker({
                showMeridian: false
            }).on('show.timepicker', function (e) {
                var widget = $('.bootstrap-timepicker-widget');
                widget.find('.glyphicon-chevron-up').removeClass().addClass('pg-arrow_maximize');
                widget.find('.glyphicon-chevron-down').removeClass().addClass('pg-arrow_minimize');
            });


            $('#myDatepicker_2').datepicker({
                format: 'dd/mm/yyyy', // FORMAT - Documentation : http://bootstrap-datepicker.readthedocs.io/en/latest/options.html#format
                language: 'fr',
                todayHight: true
            });
            $('#timepicker_2').timepicker({
                showMeridian: false
            }).on('show.timepicker', function (e) {
                var widget = $('.bootstrap-timepicker-widget');
                widget.find('.glyphicon-chevron-up').removeClass().addClass('pg-arrow_maximize');
                widget.find('.glyphicon-chevron-down').removeClass().addClass('pg-arrow_minimize');
            });


            $('#myDatepicker_3').datepicker({
                format: 'dd/mm/yyyy', // FORMAT - Documentation : http://bootstrap-datepicker.readthedocs.io/en/latest/options.html#format
                language: 'fr',
                todayHight: true
            });
            $('#timepicker_3').timepicker({
                showMeridian: false
            }).on('show.timepicker', function (e) {
                var widget = $('.bootstrap-timepicker-widget');
                widget.find('.glyphicon-chevron-up').removeClass().addClass('pg-arrow_maximize');
                widget.find('.glyphicon-chevron-down').removeClass().addClass('pg-arrow_minimize');
            });
        });
    </script>
@stop
