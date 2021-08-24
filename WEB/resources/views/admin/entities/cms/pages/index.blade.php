@extends('admin')

@section('js')
    <script>
        {{--$( document ).ready( function () {--}}
        {{--$( '.delete' ).on( 'click', function (e) {--}}
        {{--e.preventDefault();--}}
        {{--var urlDelete = $( this ).data( 'url' );--}}
        {{--var tr        = $( this ).closest( 'tr' );--}}
        {{--swal( {--}}
        {{--title:              "{{ trans('admin/success.sure') }}",--}}
        {{--text:               "{{ trans('admin/success.noway') }}",--}}
        {{--type:               "warning",--}}
        {{--showCancelButton:   true,--}}
        {{--confirmButtonColor: "#DD6B55",--}}
        {{--confirmButtonText:  "{{ trans('admin/generics.delete') }}",--}}
        {{--cancelButtonText:   "{{ trans('admin/generics.cancel') }}"--}}
        {{--} ).then( function (isConfirm) {--}}
        {{--if ( isConfirm ) {--}}
        {{--swal( "{{ trans('admin/generics.suppression') }}", "{{ trans('admin/success.destroyUser') }}", "success" );--}}
        {{--$.ajax( {--}}
        {{--url:     urlDelete,--}}
        {{--method:  'POST',--}}
        {{--data:    {--}}
        {{--_method: 'DELETE',--}}
        {{--_token:  '{{ csrf_token() }}'--}}
        {{--},--}}
        {{--success: function () {--}}
        {{--tr.remove();--}}
        {{--}--}}
        {{--} );--}}
        {{--} else if ( isConfirm === false ) {--}}
        {{--swal( "{{ trans('admin/generics.cancellation') }}", "{{ trans('admin/success.cancelUser') }}", "error" );--}}
        {{--}--}}
        {{--} );--}}
        {{--} );--}}
        {{--} );--}}
    </script>
@stop

@section('content')
    <div class="content">
        <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
                <div class="inner">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Tableau de bord</a>
                        </li>
                        <li class="breadcrumb-item active">
                            SEO
                        </li>
                    </ol>
                </div>
            </div>
        </div>


        <div class="container-fluid container-fixed-lg bg-white">
            <div class="card card-transparent">
                <div class="card-header ">
                    <div class="pull-right">
                        <div class="col-xs-12">
                            <input type="text" id="search-table" class="form-control pull-right"
                                   placeholder="Search">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="card-block">
                    <table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
                        <thead>
                        <tr>
                            <th style="width:10%;">#</th>
                            <th>Titre</th>
                            <th>Url</th>
                            <th>Date</th>
                            <th style="width:20%">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pages AS $key => $page)
                            <tr>
                                <td style="width:10%;" class="v-align-middle">
                                    {{ $key+1 }}
                                </td>
                                <td class="v-align-middle semi-bold">
                                    {{ $page->title ? $page->title : '—' }}
                                </td>
                                <td class="v-align-middle">
                                    {{ $page->url ? $page->url : '—' }}
                                </td>
                                <td class="v-align-middle">
                                    {{ $page->created_at ? \Carbon\Carbon::parse($page->created_at)->format('m/d/Y'): '—' }}
                                </td>
                                <td style="display: flex;" class="v-align-middle">
                                    <a href="{{ action('Admin\Cms\PagesController@edit', $page->id) }}"
                                       class="btn btn-primary mr-3">
                                        Modifier
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
