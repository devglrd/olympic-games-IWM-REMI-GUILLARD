@extends('admin')


@section('css')
@stop

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Events List</h1>
            <a href="{{ action([\App\Http\Controllers\Admin\EventController::class, 'create']) }}" class="btn btn-success">Add new event</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Epreuve</th>
                    <th scope="col">Location</th>
                    <th scope="col">Jour</th>
                    <th scope="col">Horaire</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sports as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->category->name }}</td>
                        <td>{{ $event->location ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::createFromFormat("d/m/Y", $event->startAt)->toDateString() ?? '-' }}</td>
                        <td>{{ $event->time ?? '-' }}</td>
                        <td>
                            <a href="{{ action([\App\Http\Controllers\Admin\EventController::class, 'edit'], $event->id) }}" class="btn btn-primary">Edit</a>
                            <form
                                action="{{ action([\App\Http\Controllers\Admin\EventController::class, 'delete'], $event->id) }}"
                                method="POST">
                                {{ csrf_field() }}
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </main>
@stop

@section('js')
@stop
