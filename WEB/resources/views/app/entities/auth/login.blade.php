@extends('app')

@section('content')

    <div class="w-100 d-flex justify-content-center align-items-center">
        <div class="text-center ">

            <div class="form-signin ">
                <form method="POST" action="{{ action([\App\Http\Controllers\App\StaticsController::class, 'login']) }}">
                    {{ csrf_field() }}
                    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

                    <div class="form-floating">
                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                </form>
            </div>
        </div>
    </div>
@endsection
