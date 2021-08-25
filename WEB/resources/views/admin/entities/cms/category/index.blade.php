@extends('admin')


@section('css')
@stop

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Category List</h1>
        </div>
        <div class="table-responsive">
            <table class="table tabl    e-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sports as $cat)
                    <tr>
                        <td>{{ $cat->id }}</td>
                        <td>{{ $cat->name }}</td>
                        <td>{{ $cat->type }}</td>
                        <td>
                            <button class="btn btn-primary">Edit</button>
                            <form
                                action="{{ action([\App\Http\Controllers\Admin\EventCategoryController::class, 'delete'], $cat->id) }}"
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
