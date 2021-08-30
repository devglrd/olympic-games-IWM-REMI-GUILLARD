@extends('app')


@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@stop

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-6">


                <div class="list-group">
                    <h6 class="text-muted">Lists of olympic games </h6>
                    <div class="accordion" id="accordionExample">
                        @foreach($sports as $sport)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-{{$sport->id}}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{$sport->id}}" aria-expanded="false"
                                            aria-controls="collapse-{{$sport->id}}">
                                        {{ $sport->name }} <span
                                            class="ms-5 me-1 badge bg-success">{{count($sport->event)}}</span> events
                                    </button>

                                </h2>
                                <div id="collapse-{{$sport->id}}" class="accordion-collapse collapse"
                                     aria-labelledby="heading-{{$sport->id}}" data-bs-parent="#accordionExample">
                                    <span class="text-muted ms-3 mt-3">Lists of events of this sport </span>
                                    @foreach($sport->event as $event)
                                        <div class="accordion-body">
                                            <div
                                                class="w-auto flex-column list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                <div class="flex-column">
                                                    {{ $event->name }}
                                                    <p class="mb-0"><small>Location : {{ $event->location }}</small></p>
                                                    <p class="mt-0"><small>date
                                                            : {{ \Carbon\Carbon::createFromFormat("d/m/Y", $event->startAt)->toDateString() }} {{ $event->time }}</small>
                                                    </p>
                                                    <span
                                                        class="badge badge-info badge-pill text-dark"> {{ $sport->content }}</span>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    @foreach($event->scores as $score)
                                                        <div class="medail mx-3 border-{{$score->type}}">
                                                            <span>Médailles : {{$score->type}}</span>
                                                            <span>
                                                        Score : {{ $score->score }} {{ $score->unit }}
                                                    </span>

                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
            </div>
            <div class="col-md-6">
                <h6 class="text-muted">Proposer un score pour une épreuve </h6>
                <form class="row g-3" action="{{ action([\App\Http\Controllers\App\StaticsController::class, 'store']) }}" method="POST">
                    {{csrf_field()}}
                    <div class="col-md-12">

                        <label for="inputEmail4" class="form-label">Sport</label>
                        <select name="sport" class="select2 form-control" id="sport">
                            <option value="0"> Selectionner un sport</option>
                            @foreach($forms as $sport)
                                <option value="{{$sport->id}}">{{ $sport->name }} ({{collect($sport->event)->filter(function($item){
    return \Carbon\Carbon::createFromFormat("d/m/Y", $item->startAt)->isToday();
})->count()}})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 flex-column d-flex d-none" id="event-form">
                        <label for="inputEmail2" class="form-label">Events</label>
                        <select name="event" class="select2 form-control w-100" id="event-selct">
                            <option value="0"> Choose a event</option>
                        </select>
                    </div>

                    <div class="col-md-12 flex-column d-flex d-none" id="form-ctn">
                        <div class="form-group">
                            <label for="" class="form-label">Médaile</label>
                            <select name="type" id="" class="form-control">
                                <option value="Gold">Gold</option>
                                <option value="Silver">Silver</option>
                                <option value="Bronze">Bronze</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="" class="form-label">Score</label>
                            <input type="text" name="score" class="form-control" placeholder="2">
                        </div>

                        <div class="form-group mt-3">
                            <label for="" class="form-label">Unité</label>
                            <input type="text" name="unit" class="form-control" placeholder="Time">
                        </div>

                        <div class="form-group mt-3">
                            <label for="" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="gl@gmail.com">
                        </div>
                    </div>

                    <div class="col-12">
                        <input type="hidden" value="" name="startAt" id="startAt">
                        <button type="submit" id="submitBtn" disabled="disabled" class="btn btn-primary">Soummettre</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();

            $('#sport').on('change', function () {
                const val = $(this).val()
                $('#heading-' + val + ' .accordion-button').trigger('click');
                $.ajax({
                    url: "http://127.0.0.1:3000/api/events?filter=" + val + "&filterType=sport",
                    success: ({data}) => {
                        $('#event-form').removeClass('d-none');
                        console.log(data);
                        $('#event-selct').empty();
                        $('#event-selct').append("<option value=\"0\"> Choose a event</option>");
                        if (!data.length) {
                            $('#event-selct').empty();
                            $('#event-selct').append("<option value=\"0\"> No events for this sport</option>");

                        }

                        data.forEach((e) => {
                                $('#event-selct').append('<option value="' + e.id + '">' + e.name + '</option>')
                        })
                    }
                })
            })
            $('#event-selct').on('change', function () {
                $('#form-ctn').removeClass("d-none");
                $('#submitBtn').prop("disabled", false);
            })
        });
    </script>
@stop
