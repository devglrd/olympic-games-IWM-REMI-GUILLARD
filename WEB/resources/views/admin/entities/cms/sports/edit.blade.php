@extends('admin')


@section('css')
@stop

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit sport</h1>

        </div>
        <div class="container">
            <form class="row g-3" action="{{ action([\App\Http\Controllers\Admin\SportController::class, 'update'], $sport->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Nom</label>
                    <input type="text" name="name" class="form-control" id="inputEmail4" value="{{ $sport->name }}">
                </div>
                <div class="col-6">
                    <label for="inputAddress" class="form-label">Image</label>
                    <input type="file" class="form-control" id="inputAddress" name="file">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword4" class="form-label">Description</label>
                    <textarea name="content"  class="form-control" id="" cols="30" rows="10" placeholder="{{$sport->content}}">{{$sport->content}}</textarea>

                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </main>
@stop

@section('js')
@stop
