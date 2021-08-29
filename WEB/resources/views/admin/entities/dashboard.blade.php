@extends('admin')


@section('css')
@stop

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">

            </div>
        </div>
        <h2>Score à valider</h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Médailles</th>
                    <th scope="col">Score</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($scores as $score)
                    <tr>
                        <td>{{$score->id}}</td>
                        <td>{{ $score->type }}</td>
                        <td>{{ $score->score . ' ' . $score->unit }}</td>
                        <td>{{$score->email}}</td>
                        <td>
                            <a href="{{action([\App\Http\Controllers\Admin\AdminController::class, 'validateScore'], $score->id)}}"
                               class="btn btn-success">Valider</a>
                            <a href="{{action([\App\Http\Controllers\Admin\AdminController::class, 'refuse'], $score->id)}}"
                               class="btn btn-danger">Refuser</a>
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
