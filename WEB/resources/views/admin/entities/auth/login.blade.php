@include('admin.template.header')

@section('js')
    <script>
        $(function () {
            $('#form-login').validate()
        })
    </script>
@stop

<div class="login-wrapper">
    <div class="bg-pic">
        <img src="{{ asset('pages-assets/img/demo/splashscreen.jpg') }}"
             data-src="{{ asset('pages-assets/img/demo/splashscreen.jpg') }}"
             data-src-retina="{{ asset('pages-assets/img/demo/splashscreen.jpg') }}"
             alt=""
             class="lazy">
    </div>

    <div class="login-container bg-white">
        <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
            <img src="{{ asset("images/logo_connexion.png") }}" alt="logo" width="100">
            <p class="p-t-35">Connectez-vous à votre espace professionnel</p>
            <form class="p-t-15" action="{{ action([\App\Http\Controllers\Admin\Auth\LoginController::class,'login']) }}"
                  method="post">
                {{ csrf_field() }}
                <div class="form-group form-group-default">
                    <label>Adresse e-mail</label>
                    <div class="controls">
                        <input class="form-control" name="email" type="email" placeholder="@email.com"
                               value="{{ old('email') }}" required {{ !old('email') ? ' autofocus' : '' }}>
                    </div>
                </div>
                <div class="form-group form-group-default">
                    <label>Mot de passe</label>
                    <div class="controls">
                        <input class="form-control" name="password" type="password" placeholder="••••••"
                               required {{ old('email') ? ' autofocus' : '' }}>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 no-padding sm-p-l-10">
                        <div class="checkbox">
                            <input type="checkbox" value="1" name="remember"
                                   {{ old('remember') ? 'checked' : '' }} id="checkbox1">
                            <label for="checkbox1">Me laisser connecté</label>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-cons m-t-10" type="submit">Connexion</button>
            </form>
        </div>
    </div>
</div>

@include('admin.template.footer')
