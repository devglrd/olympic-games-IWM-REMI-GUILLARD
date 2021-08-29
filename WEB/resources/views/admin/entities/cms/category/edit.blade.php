@extends('admin')


@section('css')
@stop

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit List</h1>

        </div>
        <div class="container">
            <form class="row g-3" action="{{ action([\App\Http\Controllers\Admin\EventCategoryController::class, 'update'], $cat->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="inputEmail4" value="{{ $cat->name }}">
                </div>
                <div class="col-6">
                    <label for="inputAddress" class="form-label">Type</label>
                    <select name="type" id="type" class="form-control">
                        <option selected="{{ $cat->type === "Women" ? 'selected' : '' }}"  value="Women">Women</option>
                        <option selected="{{ $cat->type === "Men" ? 'selected' : '' }}" value="Men">Men</option>
                        <option  selected="{{ $cat->type === "MenWomen" ? 'selected' : '' }}" value="MenWomen">MenWomen</option>
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
@stop
