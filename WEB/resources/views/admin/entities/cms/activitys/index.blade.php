@extends('admin')

@section('js')
    <script>
        $(document).ready(function(){
            $('.item_threads').on('click', function(){
                const id = $(this).data('id');

                window.location = '/activitys/' + id + '/edit';
            })
        })
    </script>
@stop

@section('content')
    <div class="content">
        <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
                <div class="inner">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            Mes activités
                        </li>
                    </ol>
                    <div class="row">

                        <div class="col-xl-5 col-lg-6 ">
                            <div class="card card-transparent">
                                <div class="card-block">

                                    {{--@permission('create-cms-events')--}}
                                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\ActivityController::class, 'create']) }}"
                                    class="btn btn-primary btn-cons m-t-10">
                                    Ajouter une activité
                                    </a>
                                    {{--@endpermission--}}
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <th>Id</th>
                            <th>Nom</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data AS $key => $activity)

                            <tr data-id="{{ $activity->id }}" class="cursor item_threads">
                                <td class="v-align-middle semi-bold">
                                    #AC{{ $activity->id ? str_pad($activity->id, 5, '0', STR_PAD_LEFT) : 'XXX' }}
                                </td>
                                <td class="v-align-middle">
                                    {{ $activity->name ? $activity->name : '—' }}
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
