@extends('admin')

@section('css')
    <link href="{{ asset('pages-assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet"
          type="text/css"
          media="screen">
    <link href="{{ asset('pages-assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet"
          type="text/css"
          media="screen">
@endsection
@section('js')

    <script src="{{ asset('pages-assets/plugins/interactjs/interact.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('pages-assets/plugins/moment/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('pages-assets/pages/js/pages.calendar.min.js')}}"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"
            type="text/javascript"></script>
    <script>
        let eventObjTemp = null;
        $(document).ready(function () {


            console.log('l', $('#timeed'));
            $('#timeed').timepicker({
                showMeridian: false
            }).on('show.timepicker', function (e) {
                var widget = $('.bootstrap-timepicker-widget');
                widget.find('.glyphicon-chevron-up').removeClass().addClass('pg-arrow_maximize');
                widget.find('.glyphicon-chevron-down').removeClass().addClass('pg-arrow_minimize');
            });

            $('#time').timepicker({
                showMeridian: false
            }).on('show.timepicker', function (e) {
                var widget = $('.bootstrap-timepicker-widget');
                widget.find('.glyphicon-chevron-up').removeClass().addClass('pg-arrow_maximize');
                widget.find('.glyphicon-chevron-down').removeClass().addClass('pg-arrow_minimize');
            });

            $('#eventSave').on('click', function () {
                const val = $('#timedSelect option:selected').val();
                const start = $('input[name="startTime"]').val();
                const coach = $('#coachSelect option:selected').val();
                const index = $('#eventIndex').val();
                const date = $('#event-datepicker').val();

                $.ajax({
                    url: `/planningsData/update`,
                    type: 'POST',
                    data: {
                        planning: index,
                        timeTranche: val,
                        time: start,
                        date,
                        coach
                    },
                    dataType: 'json',
                    success: function (data, status) {
                        console.log(data);
                        notie.alert(1, 'Séance mise à jour', 8);
                        window.location.reload();
                    },
                    error: function (result, status, error) {
                        console.log(result);
                    }
                });
            });
            $('#deleteEvent').on('click', function () {
                console.log('delete');

                const index = $('#eventIndex').val();
                console.log(index);

                $.ajax({
                    url: `/planningsData?delete=${index}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data, status) {
                        notie.alert(1, 'Séance supprimée', 8);
                        window.location.reload();
                    },
                    error: function (result, status, error) {
                        console.log(result);
                    }
                });
            });
            $('#myCalendar .options').on('click', function () {
                window.location.href = "/plannings/create";
            });


            $('#event-datepicker').datepicker({
                format: 'dd/mm/yyyy', // FORMAT - Documentation : http://bootstrap-datepicker.readthedocs.io/en/latest/options.html#format
                language: 'fr',
                todayHight: true,
                startDate: new Date()
            });

// $('select').select2()
            $('#timepicker').timepicker({
                showMeridian: false
            }).on('show.timepicker', function (e) {
                var widget = $('.bootstrap-timepicker-widget');
                widget.find('.glyphicon-chevron-up').removeClass().addClass('pg-arrow_maximize');
                widget.find('.glyphicon-chevron-down').removeClass().addClass('pg-arrow_minimize');
            });

            $('#deleteEvent').on('click', function () {
                console.log('delete');

                const index = $('#eventIndex').val();
                console.log(index);

                $.ajax({
                    url: `/planningsData?delete=${index}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data, status) {
                        notie.alert(1, 'Séance supprimée', 8);
                        window.location.reload();
                    },
                    error: function (result, status, error) {
                        console.log(result);
                    }
                });
            });
            $('#myCalendar .options').on('click', function () {
                window.location.href = "/plannings/create";
            });
            let dataCalendar = [];
            const hasFilter = "{{ isset($filter) && $filter ? 1 : 0 }}";
            const client = "{{ isset($filter) && $filter ? $filter['client'] : null }}";
            const coach = "{{ isset($filter) && $filter ? $filter['coach'] : null }}";

            const seance = "{{ isset($filter) && $filter ? $filter['seance'] : null }}";
            console.log(client);
            console.log(coach);
            console.log(hasFilter);
            if (hasFilter) {
                console.log('ic');
                if (client) {
                    console.log('cli');
                    buildFilterPlanning(client, 'client');
                }
                if (coach) {
                    console.log('coa');
                    buildFilterPlanning(coach, 'coach');
                }
                if (seance) {
                    buildFilterPlanning(seance, 'seance');

                }
                buildDefaultPlanning();
            } else {
                console.log('default');
            }


            function setEventDetailsToForm(event) {
                console.log(event);
                // $('#eventIndex').val();
                // $('#txtEventName').val();
                // $('#txtEventCode').val();
                // $('#txtEventLocation').val();
                //Show Event date
                $('#event-date').html(moment(event.start).format('MMMM Do YYYY'));
                //

                $('#lblfromTime').html(moment(event.start).format('h:mm:ss a'));
                $('#lbltoTime').html(moment(event.end).format('h:mm:ss a'));
                //
                // //Load Event Data To Text Field

                $('#eventIndex').val(event.index);

                $('#txtEventName').html(event.title);
                // $('#txtEventCode').val(event.other.code);

            }

            console.log(dataCalendar);

            $('#calendar').on('click', function () {
                    $('#calendar-event').removeClass('open');
                }
            )
            $('#close').on('click', function () {
                    $('#calendar-event').removeClass('open');
                }
            )
            $('#filteringBtn').on('click', function () {


            });
        })

        function buildDefaultPlanning() {
            console.log('default');
            $.ajax({
                url: '/planningsData',
                type: 'GET',
                dataType: 'json',
                success: function (data, status) {
                    console.log(data.data);
                    const d = data.data;
                    dataCalendar = data.data;

                    buildPlanning(d);
                },
                error: function (result, status, error) {
                    console.log(result);
                }
            });
        }

        function empty() {
            $('#titleEvent').empty();
            $('#lblfromTime').empty();
            $('#txtEvent').empty();
            $('#event-date').empty();
            $('#txtSeance').empty();
            $('#lbltoTime').empty();
            $('#txtCoach').empty("");
            $('#txtClient').val("");

            $('#timeed').val('')
        }

        function setEventDetailsToForm(event) {

            empty();
            console.log(event);
            $('#titleEvent').append(event.title);
            $('#txtEvent').append(event.seance.name);
            const start = moment(event.start_at);
            const end = moment(event.end_at);
            $("#event-datepicker").val(start.format("dddd, MMMM Do YYYY"));
            $('#event-date').append(start.format("dddd, MMMM Do YYYY"));
            // $('#lblfromTime').append(start.format('HH:mm:ss'));
            // $('#lbltoTime').append(end.format('HH:mm:ss'));
            $('#timeed').val(start.format('HH:mm:ss'));
            $('input[name="endTime"]').val(end.format('HH:mm:ss'));
            $('input[name="coach"]').val(event.coach.id);
            $('#txtCoach').append('Coach actuelle : <b>' + event.coach.first_name + ' ' + event.coach.name + '</b>')
            // $('#coach-' + event.coach.id).attr('selected', 'selected')
            $('#txtSeance').append(event.seance.name);
            $('#txtCoach').val(event.coach.name)
            $('#txtClient').val(event.client.name)
        }

        function buildFilterPlanning(client, type) {
            console.log(client, 'client');
            $.ajax({
                url: `/planningsData?${type}=${client}`,
                type: 'GET',
                dataType: 'json',
                success: function (data, status) {
                    console.log(data.data);
                    const d = data.data;
                    dataCalendar = data.data;

                    buildPlanning(d);
                },
                error: function (result, status, error) {
                    console.log(result);
                }
            });
        }

        function buildPlanning(data) {
            console.log(data);
            console.log('ici');
            $('#myCalendar').pagescalendar({
                ui: {
                    //Year Selector
                    year: {
                        visible: false,
                        format: 'YYYY',
                        startYear: '2000',
                        endYear: moment().add(10, 'year').format('YYYY'),
                        eventBubble: true
                    },
                    //Month Selector
                    month: {
                        visible: true,
                        format: 'MMM',
                        eventBubble: true
                    },
                    dateHeader: {
                        format: 'MMMM YYYY, D dddd',
                        visible: true,
                    },
                    //Mini Week Day Selector
                    week: {
                        day: {
                            format: 'D'
                        },
                        header: {
                            format: 'dd'
                        },
                        eventBubble: true,
                        startOfTheWeek: '0',
                        endOfTheWeek: '6'
                    },
                    //Week view Grid Options
                    grid: {
                        dateFormat: 'D dddd',
                        // timeFormat: 'h A',
                        eventBubble: false,
                        scrollToFirstEvent: false,
                        scrollToAnimationSpeed: 300,
                        scrollToGap: 20,
                        disableDragging: false,
                    }
                },
                eventObj: {
                    editable: false
                },
                view: 'week',
                now: null,
                editable: false,
                locale: 'fr',
                //Event display time format
                timeFormat: 'h:mm a',
                minTime: 0,
                eventStartEditable: false,
                maxTime: 24,
                dateFormat: 'MMMM Do YYYY',
                slotDuration: '30', //In Mins : supports 15, 30 and 60
                events: data,
                eventOverlap: false,
                weekends: true,
                disableDates: [],
                onEventClick: function (event) {
                    if (eventObjTemp && event.index === eventObjTemp.index) {
                        $('#calendar-event').removeClass('open');
                        eventObj = null;
                    } else {

                        const concern = data[event.index];
                        eventObj = event;
                        console.log(event);
                        if (!$('#calendar-event').hasClass('open'))
                            $('#calendar-event').addClass('open');


                        $('#eventIndex').val(concern.id);
                        // $('#calendar-event').addClass('open')

                        setEventDetailsToForm(concern);
                    }
                },
            });


            {{--            @if(isset($request->has('date')))÷--}}
            const hasDate = "{{ isset($date) && $date ? $date : ''}}"
            console.log(hasDate);
            const idseance = "{{ isset($seance) && $seance ? $seance : ''}}"
            if (hasDate !== '') {
                $('#myCalendar').pagescalendar('setDate', hasDate)

                if (idseance !== '') {

                    $.ajax({
                        url: `/api/event?id=${idseance}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data, status) {
                            const d = data.data;
                            // const d = data.data;
                            // dataCalendar = data.data;

                            // buildPlanning(d);
                            const event = {
                                title: d.title,
                                seance: {
                                    name: d.seance.name
                                },
                                start_at: d.start_at,
                                end_at: d.end_at,
                                coach: {
                                    id: d.coach.id,
                                    first_name: d.coach.first_name,
                                    last_name: d.coach.last_name,
                                },
                                client: {
                                    name: d.client.first_name + ' ' + d.client.name
                                }
                            };
                            setEventDetailsToForm(event);
                            // $('#titleEvent').append(event.title);
                            // $('#txtEvent').append(event.seance.name);
                            // const start = moment(event.start_at);
                            // const end = moment(event.end_at);
                            // $("#event-datepicker").val(start.format("dddd, MMMM Do YYYY"));
                            // $('#event-date').append(start.format("dddd, MMMM Do YYYY"));
                            // // $('#lblfromTime').append(start.format('HH:mm:ss'));
                            // // $('#lbltoTime').append(end.format('HH:mm:ss'));
                            // $('input[name="startTime"]').val(start.format('HH:mm:ss'));
                            // $('input[name="endTime"]').val(end.format('HH:mm:ss'));
                            // $('input[name="coach"]').val(event.coach.id);
                            // $('#txtCoach').append('Coach actuelle : <b>' + event.coach.first_name + ' ' + event.coach.name + '</b>')
                            // // $('#coach-' + event.coach.id).attr('selected', 'selected')
                            // $('#txtSeance').append(event.seance.name);
                            // $('#txtCoach').val(event.coach.name)
                            // $('#txtClient').val(event.client.name)

                        },
                        error: function (result, status, error) {
                            console.log(result);
                        }
                    });

                    $('#calendar-event').addClass('open')
                }

                // $('#myCalendar').pagescalendar('rebuild');
            }
            {{--            @endif--}}

        }

    </script>
@stop

@section('content')
    <div class="content">
        <div class="jumbotron mb-0" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
                <div class="inner">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ action([\App\Http\Controllers\Admin\DashboardController::class, 'dashboard']) }}">Tableau
                                de bord</a>
                        </li>
                        <li class="breadcrumb-item active">
                            PLanning
                        </li>
                    </ol>
                    <div class="row">

                        <div class="col-lg-12 ">
                            <div class="card card-transparent mb-0">
                                <!--
                                <div class="card-header ">
                                    <div class="card-title">
                                        Liste utilisateurs
                                    </div>
                                </div>
-->
                                <div class="card-block d-flex align-items-center justify-content-between">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <form
                                                action="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'filterPlanning']) }}"
                                                method="POST" class="d-flex w-100 align-items-start flex-column mr-5">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="type" value="client">
                                                <div class="form-group">
                                                    <label for="">Client</label>
                                                    <select name="client" id="" class="form-control">
                                                        @foreach(\App\Models\Client::all()->where('active','1') as $client)
                                                            <option
                                                                value="{{$client->id}}">{{$client->first_name}} {{$client->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary" id="filteringBtn">Filter
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-4">
                                            <form
                                                action="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'filterPlanning']) }}"
                                                method="POST" class="d-flex w-100 align-items-start flex-column">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="type" value="coach">
                                                <div class="form-group">
                                                    <label for="">Coach</label>
                                                    <select name="coach" id="" class="form-control">
                                                        @foreach(\App\Models\Coach::all()->where('active','1') as $client)
                                                            <option
                                                                value="{{$client->id}}">{{$client->first_name}} {{$client->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary" id="filteringBtn">Filter
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-4">

                                            <form
                                                action="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'filterPlanning']) }}"
                                                method="POST" class="d-flex w-100 align-items-start flex-column">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="type" value="seance">
                                                <div class="form-group">
                                                    <label for="">Séance</label>
                                                    <select name="seance" id="" class="form-control">
                                                        @foreach(\App\Models\Seance::all() as $client)
                                                            <option value="{{$client->id}}">{{$client->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary" id="filteringBtn">Filter
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center align-items-center">
                                        <div class="col-md-12 d-flex align-items-center justify-content-center">

                                            {{--@permission('create-cms-events')--}}


                                            <a href="{{ action([\App\Http\Controllers\SeanceController::class, 'create']) }}"
                                               class="ml-4 btn btn-primary">
                                                Ajouter une seances
                                            </a>

                                            <a href="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'planning']) }}"
                                               class="ml-4 btn btn-primary">
                                                Réinitialiser le filtre
                                            </a>
                                        </div>
                                    </div>

                                    {{--@endpermission--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @if(isset($filter))
                                <h3 class="mb-0 mt-4">Filtrer pour : <b
                                        class="text-primary">{{ $name }}</b></h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid container-fixed-lg bg-white">
            <div class="card card-transparent">
                <div id="myCalendar" class="full-height"></div>
                <div class="quickview-wrapper calendar-event " id="calendar-event">
                    <div class="view-port clearfix" id="eventFormController">
                        <div class="view bg-white">
                            <div class="scroll-wrapper scrollable" style="position: relative;">
                                <div class="scrollable scroll-content"
                                     style="height: 984px; margin-bottom: 0px; margin-right: 0px; max-height: none;">
                                    <div class="p-l-30 p-r-30 p-t-20">
                                        <span class="pg-close text-master link pull-right" id="close">

                                        </span>
                                        {{--                                        <a class="pg-close text-master link pull-right" data-toggle="quickview"--}}
                                        {{--                                           data-toggle-element="#calendar-event" href="#"></a>--}}
                                        <h4 id="event-date"></h4>
                                        <div class="input-prepend input-group mt-3 d-flex">
                                            <input id="event-datepicker"
                                                   type="text"
                                                   class="form-control"
                                                   name="date"
                                                   value="">
                                        </div>

                                        <div class="m-b-20">
                                            <i class="fa fa-clock-o"></i>
                                            à
                                            <br>
                                            {{--                                            <div class="input-group bootstrap-timepicker w-50">--}}
                                            {{--                                                <input id="timepicker" name="startTime" type="text"--}}
                                            {{--                                                       class="form-control">--}}
                                            {{--                                                <span class="input-group-addon"><i class="pg-clock"></i></span>--}}
                                            {{--                                            </div>--}}
                                            <div class="form-input-group flex-1 bootstrap-timepicker">
                                                <label class="">Heure de début</label>
                                                <input id="timeed" type="text" class="form-control" name="dzad"
                                                       value="">
                                            </div>
                                            <br>
                                            pour
                                            <br>
                                            <br>
                                            <select name="time" id="timedSelect" class="select form-control">
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
                                    <div class="p-t-15">
                                        <input id="eventIndex" name="eventIndex" type="hidden" value="2">
                                        <div class="px-3 form-group-attached">
                                            <div class="">
                                                <label id="titleEvent"></label>
                                                <br>
                                                <br>
                                                Seance : <label for="" id="txtSeance"> </label>
                                                {{--                                                <p id="txtEvent"></p>--}}
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12 my-1 mb-3">
                                                    <label for="" id="txtCoach"></label>
                                                    <div class="h-75 form-group form-group-default">
                                                        <label>Coach</label>
                                                        <select name="coach" id="coachSelect" class="form-control">
                                                            @foreach(\App\Models\Coach::all()->where('active','1') as $coach)
                                                                <option
                                                                    value="{{ $coach->id }}"
                                                                    id="coach-{{$coach->id}}"> {{$coach->first_name }} {{ $coach->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-md-12 my-1">
                                                    <div class="  form-group form-group-default">
                                                        <label>Client</label>
                                                        <input type="text" disabled class="form-control disabled"
                                                               id="txtClient">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="p-l-30 p-r-30 p-t-30">
                                            <button id="eventSave" class="btn btn-warning btn-cons">Enregistré</button>
                                            <button id="deleteEvent" data-event="0" class="btn btn-danger btn-cons">
                                                Supprimer
                                            </button>

                                            {{--                                        <button id="eventDelete" class="btn btn-white"><i class="fa fa-trash-o"></i>--}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop
