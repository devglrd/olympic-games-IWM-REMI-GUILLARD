@extends('admin')


@section('css')
@stop

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit score</h1>

        </div>
        <div class="container">
            <form class="row g-3"
                  action="{{ action([\App\Http\Controllers\Admin\ScoreController::class, 'update'], $score->id) }}"
                  method="POST">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">type</label>
                    <select name="type" id="" class="form-control">
                        <option value="">Sélectionner un type</option>
                        <option value="Gold" selected="{{$score->type === "Gold" ? 'selected' : ''}}">Gold</option>
                        <option value="Silver" selected="{{$score->type === "Silver" ? 'selected' : ''}}">Silver</option>
                        <option value="Bronze" selected="{{$score->type === "Bronze" ? 'selected' : ''}}">Bronze</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="inputAddress" class="form-label">Unit</label>
                    <input type="text" class="form-control" id="inputAddress" name="unit"
                           value="{{ $score->unit }}">
                </div>

                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Score</label>
                    <input type="text" name="score" class="form-control"
                           value="{{ $score->score }}">
                </div>


                <div class="col-md-12">
                    <label for="inputPassword4" class="form-label">Event</label>
                    <select name="event" id="" class="form-control">
                        <option value="">Sélectionner un event</option>
                        @foreach($events as $event)
                            <option value="{{$event->id}}" selected="{{$event->id === $score->event->id ? 'selected' : ''}}">{{$event->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </main>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            var dateToday = new Date();
            $("#datepicker").datepicker({
                changeMonth: true,
                minDate: dateToday,
            });
            $('#sport').on('change', function () {

                const val = $(this).val()
                $.ajax({
                    url: "http://127.0.0.1:3000/api/category?filter=" + val + "&filterType=sport",
                    success: ({data}) => {
                        $('#event').removeClass('d-none');
                        $('#event-seltc').empty();
                        console.log(data);
                        data.map((e) => {
                            $('#event-seltc').append('<option value="' + e.slug + '">' + e.name + '</option>')
                        })

                    }
                })
            });
            $('#timepicker').timepicker({
                timeFormat: 'h:mm p',
                interval: 60,
                minTime: '10',
                maxTime: '6:00pm',
                defaultTime: '11',
                startTime: '10:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
        })
    </script>
@stop
