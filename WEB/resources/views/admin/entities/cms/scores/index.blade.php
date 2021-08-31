@extends('admin')


@section('css')
@stop

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Scores List</h1>
            <a href="{{ action([\App\Http\Controllers\Admin\ScoreController::class, 'create']) }}" class="btn btn-success">Add new score</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sport / Category</th>
                    <th scope="col">Type</th>
                    <th scope="col">Score</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Validate</th>
                    <th scope="col">Owner</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($scores as $score)
                    <tr>
                        <td>{{ $score->id }}</td>
                        <td>{{ $score->event ? $score->event->sport->name : '' }} / {{ $score->event ? $score->event->category->name : '-'}}</td>
                        <td>{{ $score->type }}</td>
                        <td>{{ $score->score ?? '-' }}</td>
                        <td>{{ $score->unit }}</td>
                        <td>{{ $score->validate ?? '-' }}</td>
                        <td>{{ $score->email ?? '-' }}</td>
                        <td>
                            <a href="{{ action([\App\Http\Controllers\Admin\ScoreController::class, 'edit'], $score->id) }}" class="btn btn-primary">Edit</a>
                            @if($score->validate === 0 ) <a href="{{ action([\App\Http\Controllers\Admin\ScoreController::class, 'edit'], $score->id) }}" class="btn btn-primary">Edit</a>@endif
                            <form
                                action="{{ action([\App\Http\Controllers\Admin\ScoreController::class, 'delete'], $score->id) }}"
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
