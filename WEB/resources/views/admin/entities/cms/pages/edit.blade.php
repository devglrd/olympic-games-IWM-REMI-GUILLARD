@extends('admin')

@section('js')
    <script>
        $(document).ready(function () {
            $('.delete').on('click', function (e) {
                e.preventDefault();
                var urlDelete = $(this).data('url');
                var tr = $(this).closest('tr');
                swal({
                    title: "{{ trans('admin/success.sure') }}",
                    text: "{{ trans('admin/success.noway') }}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "{{ trans('admin/generics.delete') }}",
                    cancelButtonText: "{{ trans('admin/generics.cancel') }}",
                }).then(function (isConfirm) {
                    if (isConfirm) {
                        swal("{{ trans('admin/generics.suppression') }}", "{{ trans('admin/success.destroyBlock') }}", "success");
                        $.ajax({
                            url: urlDelete,
                            method: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function () {
                                tr.remove();
                            }
                        });
                    } else if (isConfirm === false) {
                        swal("{{ trans('admin/generics.cancellation') }}", "{{ trans('admin/success.cancelPage') }}", "error");
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="popover"]').popover();
        });
    </script>
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
    <script>
        $(function () {
            // Change status on create modal
            $('#typeBlockCreate').on('change', function () {
                $('#errorMessageBlock').addClass('hidden')
                var selected = $(this).find('option:selected').val();
                if (selected === 'image') {
                    $('#createBlockForm')[0].reset()
                    // User wants to create an image, we show him the good part
                    $('#imageBlockCreate').removeClass('hidden');
                    $('#textBlockCreate').addClass('hidden');
                } else {
                    $('#createBlockForm')[0].reset()
                    // User wants to create an image, we show him the good part
                    $('#imageBlockCreate').addClass('hidden');
                    $('#textBlockCreate').removeClass('hidden');
                }
                $('#typeBlockCreated').val(selected);
            });
            // Submit create block form
            $('#createBlockForm').on('submit', function (e) {
                var selected = $('#typeBlockCreate').find('option:selected').val();
                if (selected == 'image') {
                    return true;
                }
                e.preventDefault();
                var _form = $(this);
                console.log($(this))
                $.ajax({
                    url: _form.attr('action'),
                    cache: false,
                    type: _form.attr('method'),
                    dataType: 'json',
                    data: _form.serialize(),
                    success: function (data, status) {
                        console.log(data)
                        $('#createBlockForm')[0].reset();
                        $('#blocksTable').prepend(data.html);
                        $('#createBlock').modal('hide');
                    },
                    error: function (result, status, error) {
                        $('#errorMessageBlock').removeClass('hidden').text(result.message);
                    }
                });
            });
            // Open editable block modal
            $(document).on('click', '.editBlockBtn', function () {
                var _action = $(this).data('action');
                var _key = $(this).data('key');
                var _value = $(this).data('value');
                var _type = $(this).data('type');
                $('#updateBlockForm').attr('action', _action);
                $('#uniqueUpdateKey').val(_key);
                $('#typeUpdate').val(_type);
                if (_type == 'image') {
                    $('#imageBlockUpdate').removeClass('hidden');
                    $('#textBlockUpdate').addClass('hidden');
                    $('#imageBlockUpdate img').attr('src', _value);
                } else {
                    $('#textBlockUpdate').removeClass('hidden');
                    $('#imageBlockUpdate').addClass('hidden');
                    $('#updateValue').val(_value);
                }
            });
            // Submit update block form
            $('#updateBlockForm').on('submit', function (e) {
                var selected = $('#typeUpdate').val();
                if (selected == 'image') {
                    return true;
                }
                e.preventDefault();
                var _form = $(this);
                $.ajax({
                    url: _form.attr('action'),
                    cache: false,
                    type: _form.attr('method'),
                    dataType: 'json',
                    data: _form.serialize(),
                    success: function (data, status) {
                        $('#updateBlockForm')[0].reset();
                        $('#blocksTable tr[data-id="' + data.id + '"]').remove();
                        $('#blocksTable').prepend(data.html);
                        $('#editBlock').modal('hide');
                    },
                    error: function (result, status, error) {
                        $('#errorMessageBlock').removeClass('hidden').text(result.message);
                    }
                });
            });
            // TODO : Delete function
        });
    </script>
@stop

@section('modals')
    @if($page->getOgImage)
        <div class="modal fade slide-up disable-scroll show" id="ogImage" tabindex="-1" role="dialog"
             aria-hidden="true" style="overflow: scroll !important;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content-wrapper">
                    <div class="modal-content">
                        <div class="modal-header clearfix text-left">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <i class="pg-close fs-14"></i>
                            </button>
                            <h5>{!! trans('admin/entities/cms/pages.image-upload-by') !!}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="{{ $page->getOgImage ? $page->getOgImage->file : '' }}"
                                         width="100%" alt="">
                                </div>
                            </div>
                            <div class="m-t-10 sm-m-t-10">
                                <button type="button" class="btn btn-primary btn-block m-t-5" data-dismiss="modal">
                                    {{ trans('admin/entities/cms/pages.close') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop

@section('content')
    <div class="content sm-gutter">
        <div class="container-fluid container-fixed-lg">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ action('Admin\DashboardController@dashboard') }}">Tableau de bord</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ action('Admin\Cms\PagesController@index') }}">Page SEO</a>
                </li>
                <li class="breadcrumb-item active">{{$page->title}}</li>
            </ol>
            <form action="{{ action('Admin\Cms\PagesController@update', $page->id) }}" method="POST"
                  data-toggle="validator"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('PUT')
                <div class="row py-3 ml-1">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-cons">
                            Enregistrer
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-7 col-lg-6 ">
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
                                            {{ $page->seo_title ? $page->seo_title : "Titre de la page" }}
                                        </p>
                                        <p class="link-seo" data-text="seo-url">
                                            {{ env('APP_URL') }}<span
                                                    data-text="seo-url">{{ $page->url ? $page->url : 'nom-de-page' }}</span>
                                        </p>
                                        <p class="description-seo" data-text="seo-description">
                                            {{ $page->seo_description ? $page->seo_description : "Description de la page" }}
                                        </p>
                                    </div>
                                    <div class="form-group {{ $errors->has('seo_title') ? 'has-error' : '' }} form-group-default">
                                        <label>
                                            Titre de la page
                                            <span id="remainingSeoTitle">
                                                (<span class="count">70</span> CARACTÈRES RESTANTS
                                                )
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" name="seo_title"
                                               value="{{ $page->seo_title }}"
                                               placeholder="Titre de la page">
                                        @if ($errors->has('seo_title'))
                                            <div class="help-block">
                                                <strong>{{ $errors->first('seo_title') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('seo_description') ? 'has-error' : '' }} form-group-default">
                                        <label>
                                            Courte description de la page
                                            <span id="remainingSeoDescription">
                                                (<span class="count">160</span> CARACTÈRES RESTANTS
                                                )
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" name="seo_description"
                                               value="{{ $page->seo_description }}"
                                               placeholder="Courte description">
                                        @if ($errors->has('seo_description'))
                                            <div class="help-block">
                                                <strong>{{ $errors->first('seo_description') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('seo_keywords') ? 'has-error' : '' }} form-group-default">
                                        <label>
                                            Mots-clés
                                        </label>
                                        <input type="text" class="form-control" name="seo_keywords"
                                               value="{{ $page->seo_keywords }}"
                                               placeholder="Mots-clés à référencer">
                                        @if ($errors->has('seo_keywords'))
                                            <div class="help-block">
                                                <strong>{{ $errors->first('seo_keywords') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        
                        <div class="card card-white">
                            <div class="card-header">
                                <div class="card-title">
                                    Referencement opengraphe
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="form-group">
                                        <p class="title-seo text-primary" data-text="og-title">
                                            {{ $page->og_title ? $page->og_title : "Titre de la page" }}
                                        </p>
                                        <p class="link-seo" data-text="seo-url">
                                            {{ env('APP_URL') }}<span
                                                    data-text="seo-url">{{ $page->url ? $page->url : 'nom-de-page' }}</span>
                                        </p>
                                        <p class="description-seo" data-text="og-description">
                                            {{ $page->og_description ? $page->og_description : "Description de la page" }}
                                        </p>
                                    </div>
                                    <div class="form-group {{ $errors->has('og_title') ? 'has-error' : '' }} form-group-default">
                                        <label>
                                            Titre de la page
                                            <span id="remainingOgTitle">
                                                (<span class="count">70</span>CARACTÈRES RESTANTS
                                                )
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" name="og_title"
                                               value="{{ $page->og_title }}"
                                               placeholder="Titre de la page">
                                        @if ($errors->has('og_title'))
                                            <div class="help-block">
                                                <strong>{{ $errors->first('og_title') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('og_description') ? 'has-error' : '' }} form-group-default">
                                        <label>
                                            Courte description
                                            <span id="remainingOgDescription">
                                                (<span class="count">160</span>CARACTÈRES RESTANTS
                                                )
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" name="og_description"
                                               value="{{ $page->og_description }}"
                                               placeholder="Courte description">
                                        @if ($errors->has('og_description'))
                                            <div class="help-block">
                                                <strong>{{ $errors->first('og_description') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-{{ $page->getOgImage ? '6' : '12' }}">
                                        <div class="form-group form-group-default">
                                            <label>Nouvelle image mise en avant</label>
                                            <input type="file" name="og_image" class="form-control">
                                            @if($errors->count())
                                                <div class="help-block">
                                                    <strong>#</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @if($page->getOgImage)
                                        <div class="col-md-6">
                                            Image mise en avant
                                            <div>
                                                <a data-toggle="modal" href="#ogImage">
                                                    <span class="label label-success">Voir l'image</span>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop