@extends('admin')

@section('css')
    <link href="{{ asset('pages-assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet"
          type="text/css"
          media="screen">
    <link href="{{ asset('pages-assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet"
          type="text/css"
          media="screen">
    <link href="{{ asset('pages-assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet"
          type="text/css"
          media="screen">
@stop
@section('js')
    <script>
        $('[name="seo_title"]').on('keyup', function () {
            var max = 70;
            var current = $(this).val().length;
            var remaining = max - current;
            if (remaining < 30 && remaining > 0) {
                $('#remainingSeoTitle')
                .addClass('text-complete').removeClass('text-danger').removeClass('text-primary')
            }
            else if (remaining <= 0) {
                $('#remainingSeoTitle')
                .addClass('text-danger').removeClass('text-primary').removeClass('text-complete')
            } else {
                $('#remainingSeoTitle')
                .addClass('text-primary').removeClass('text-complete').removeClass('text-danger')
            }
            $('#remainingSeoTitle .count').text(remaining);
            $('[data-text="seo-title"]').text($(this).val())
        })
        $('[name="seo_description"]').on('keyup', function () {
            var max = 160;
            var current = $(this).val().length;
            var remaining = max - current;
            if (remaining < 50 && remaining > 0) {
                $('#remainingSeoDescription')
                .addClass('text-complete').removeClass('text-danger').removeClass('text-primary')
            }
            else if (remaining <= 0) {
                $('#remainingSeoDescription')
                .addClass('text-danger').removeClass('text-primary').removeClass('text-complete')
            } else {
                $('#remainingSeoDescription')
                .addClass('text-primary').removeClass('text-complete').removeClass('text-danger')
            }
            $('#remainingSeoDescription .count').text(remaining);
            $('[data-text="seo-description"]').text($(this).val())
        })
        $('[name="og_title"]').on('keyup', function () {
            var max = 70;
            var current = $(this).val().length;
            var remaining = max - current;
            if (remaining < 30 && remaining > 0) {
                $('#remainingOgTitle')
                .addClass('text-complete').removeClass('text-danger').removeClass('text-primary')
            }
            else if (remaining <= 0) {
                $('#remainingOgTitle')
                .addClass('text-danger').removeClass('text-primary').removeClass('text-complete')
            } else {
                $('#remainingOgTitle')
                .addClass('text-primary').removeClass('text-complete').removeClass('text-danger')
            }
            $('#remainingOgTitle .count').text(remaining);
            $('[data-text="og-title"]').text($(this).val())
        })
        $('[name="og_description"]').on('keyup', function () {
            var max = 160;
            var current = $(this).val().length;
            var remaining = max - current;
            if (remaining < 50 && remaining > 0) {
                $('#remainingOgDescription')
                .addClass('text-complete').removeClass('text-danger').removeClass('text-primary')
            }
            else if (remaining <= 0) {
                $('#remainingOgDescription')
                .addClass('text-danger').removeClass('text-primary').removeClass('text-complete')
            } else {
                $('#remainingOgDescription')
                .addClass('text-primary').removeClass('text-complete').removeClass('text-danger')
            }
            $('#remainingOgDescription .count').text(remaining);
            $('[data-text="og-description"]').text($(this).val())
        })
    </script>
@stop

@section('content')
    <div class="content sm-gutter">
        <div class="container-fluid container-fixed-lg">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ action('Admin\DashboardController@dashboard') }}">Tableau de bord</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ action('Admin\Cms\PagesController@index') }}">Pages</a>
                </li>
                <li class="breadcrumb-item active">Ajouter une page</li>
            </ol>
            <form action="{{ action('Admin\Cms\PagesController@store') }}" method="POST"
                  data-toggle="validator"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xl-7 col-lg-6 ">
                        <div class="card card-white">
                            <div class="card-header">
                                <div class="card-title">
                                    Ajouter une page
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required"
                                             aria-required="true">
                                            <label>Titre de la page</label>
                                            <input type="text" class="form-control" name="title"
                                                   value="{{ old('title') }}"
                                                   placeholder="Titre de la page"
                                                   required>
                                            @if ($errors->has('title'))
                                                <div class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }} form-group-default required"
                                             aria-required="true">
                                            <label>Description de la page</label>
                                            <textarea type="text" class="form-control" name="description"
                                                   placeholder="Description de la page">{{ old('description') }}</textarea>
                                            @if ($errors->has('description'))
                                                <div class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-transparent">
                            <div class="card-header ">
                                <div class="card-title">
                                    Validation
                                </div>
                            </div>
                            <div class="card-block">
                                <h3>
                                    Ajouter une page
                                </h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis debitis dicta, eaque hic impedit ipsam non quia quo repellat sint? Exercitationem fuga illo minima molestiae quaerat quidem repellat, similique veniam!
                                </p>
                                <br>
                                <button type="submit" class="btn btn-primary btn-cons">
                                    Ajouter une page
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <div class="card card-white">
                            <div class="card-header">
                                <div class="card-title">
                                    Referencement organique
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="form-group">
                                        <p class="title-seo text-primary" data-text="seo-title">
                                            {{ old('seo_title') ? old('seo_title') : 'Titre de la page' }}
                                        </p>
                                        <p class="link-seo" data-text="seo-url">
                                            {{ env('APP_URL') }}/<span
                                                    data-text="seo-title">{{ old('seo_title') ? old('seo_title') : 'nom-de-page' }}</span>
                                        </p>
                                        <p class="description-seo" data-text="seo-description">
                                            {{ old('seo_description') ? old('seo_description') : 'Description de la page' }}
                                        </p>
                                    </div>
                                    <div class="form-group {{ $errors->has('seo_title') ? 'has-error' : '' }} form-group-default">
                                        <label>
                                            TITRE DE LA PAGE
                                            <span id="remainingSeoTitle">
                                                (<span class="count">70</span>CARACTÈRES RESTANTS
                                                )
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" name="seo_title"
                                               value="{{ old('seo_title') }}"
                                               placeholder="Titre de la page">
                                        @if ($errors->has('seo_title'))
                                            <div class="help-block">
                                                <strong>{{ $errors->first('seo_title') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('seo_description') ? 'has-error' : '' }} form-group-default">
                                        <label>
                                            DESCRIPTION COURTE
                                            <span id="remainingSeoDescription">
                                                (<span class="count">160</span>CARACTÈRES RESTANTS
                                                )
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" name="seo_description"
                                               value="{{ old('seo_description') }}"
                                               placeholder="Description courte">
                                        @if ($errors->has('seo_description'))
                                            <div class="help-block">
                                                <strong>{{ $errors->first('seo_description') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-white">
                            <div class="card-header">
                                <div class="card-title">
                                    RÉFÉRENCEMENT OPENGRAPH
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="form-group">
                                        <p class="title-seo text-primary" data-text="og-title">
                                            {{ old('og_title') ? old('og_title') : 'Titre de la page' }}
                                        </p>
                                        <p class="link-seo" data-text="og-url">
                                            {{ env('APP_URL') }}/<span
                                                    data-text="og-title">{{ old('og_title') ? old('og_title') : 'nom-de-page' }}</span>
                                        </p>
                                        <p class="description-seo" data-text="og-description">
                                            {{ old('og_description') ? old('og_description') : 'Titre de la page' }}
                                        </p>
                                    </div>
                                    <div class="form-group {{ $errors->has('og_title') ? 'has-error' : '' }} form-group-default">
                                        <label>
                                            TITRE DE LA PAGE
                                            <span id="remainingOgTitle">
                                                (<span class="count">70</span> CARACTÈRES RESTANTS
                                                )
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" name="og_title"
                                               value="{{ old('og_title') }}"
                                               placeholder="Titre de la page">
                                        @if ($errors->has('og_title'))
                                            <div class="help-block">
                                                <strong>{{ $errors->first('og_title') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('og_description') ? 'has-error' : '' }} form-group-default">
                                        <label>
                                            DESCRIPTION COURTE
                                            <span id="remainingOgDescription">
                                                (<span class="count">160</span> CARACTÈRES RESTANTS
                                                )
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" name="og_description"
                                               value="{{ old('og_description') }}"
                                               placeholder="Description courte">
                                        @if ($errors->has('og_description'))
                                            <div class="help-block">
                                                <strong>{{ $errors->first('og_description') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group form-group-default">
                                        <label>Image mise en avant</label>
                                        <input type="file" name="file" class="form-control">
                                        @if($errors->count())
                                            <div class="help-block">
                                                <strong>1</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

