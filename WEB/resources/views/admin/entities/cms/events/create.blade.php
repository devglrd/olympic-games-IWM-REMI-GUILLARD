@extends('admin')


@section('css')
@stop

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Create event</h1>

        </div>
        <div class="container">
            <form class="row g-3" action="{{ action([\App\Http\Controllers\Admin\EventController::class, 'store']) }}"
                  method="POST">
                {{ csrf_field() }}
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Nom</label>
                    <input type="text" name="name" class="form-control" id="inputEmail4">
                </div>
                <div class="col-6">
                    <label for="inputAddress" class="form-label">Location</label>
                    <input type="text" class="form-control" id="inputAddress" name="location">
                </div>

                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Start at</label>
                    <input type="text" id="datepicker" name="startAt" class="form-control">
                </div>
                <div class="col-6">
                    <label for="inputAddress" class="form-label">Time</label>
                    <input type="text" class="form-control" id="timepicker" name="time">
                </div>

                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Sport</label>
                    <select name="sport" id="sport" class="form-control">
                        @foreach($sports as $sport)
                            <option value="{{$sport->id}}">{{ $sport->name  }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 d-none " id="event">
                    <label for="inputAddress" class="form-label">Event Category</label>
                    <select name="event" id="event-seltc" class="form-control">

                    </select>
                </div>

                <div class="col-md-12">
                    <label for="inputPassword4" class="form-label">Description</label>
                    <textarea name="content" class="form-control" id="" cols="30" rows="10"></textarea>

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
