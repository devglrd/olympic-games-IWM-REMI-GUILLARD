@extends('admin')


@section('css')
@stop

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Sports List</h1>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Content</th>
                    <th scope="col">Nombre d'event</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sports as $sport)
                    <tr>
                        <td>{{ $sport->id }}</td>
                        <td>{{ $sport->name }}</td>
                        <td>{{ $sport->content ?? '-' }}</td>
                        <td>{{ count($sport->event) }}</td>
                        <td>
                            <button class="btn btn-primary">Edit</button>
                            <button class="btn btn-danger">Delete</button>
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
