@extends('app')


@section('css')

@stop

@section('content')
    <div class="container">

        <div class="row">

            <ul class="list-group">
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
                                        <a href="#"
                                           class="w-auto list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <div class="flex-column">
                                                {{ $event->name }}
                                                <p><small>{{ $event->location }}</small></p>
                                                <span
                                                    class="badge badge-info badge-pill text-dark"> {{ $sport->content }}</span>
                                            </div>
                                            @foreach($event->scores as $score)
                                                <div class="medail ">
                                                    <span>Médailles : {{$score->type}}</span>
                                                    <span>
                                                        Score : {{ $score->score }} {{ $score->unit }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>


            </ul>
        </div>
    </div>
@stop

@section('js')

@stop
