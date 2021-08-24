@extends('admin')

@section('js')
    <script>
        $(document).ready(function(){
            $('.user_threads').on('click', function(){
                const id = $(this).data('id');

                window.location = '/type/seances/' + id;
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
                            Mes Type de séances
                        </li>
                    </ol>
                    <div class="row">

                        <div class="col-xl-5 col-lg-6 ">
                            <div class="card card-transparent">
                                <div class="card-block">

                                    {{--@permission('create-cms-events')--}}
                                    <a href="{{ action([\App\Http\Controllers\Admin\DashboardController::class, 'createTypeSeance']) }}"
                                       class="btn btn-primary btn-cons m-t-10">
                                        Ajouter un type de séance
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
                            <th>Nom des activités</th>
                            <th>Couleur</th>
                            <th>Cout horaire coach</th>
                            <th>Durée de seance disponible</th>
{{--                            <th style="width:20%">Actions</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data AS $key => $item)

                            <tr data-id="{{ $item->id }}" class="cursor user_threads">
                                <td class="v-align-middle semi-bold">
                                    {{ $item->name }}
                                </td>
                                <td class="v-align-middle">
                                    <div class="badge {{!$item->color ? 'badge-primary' : ''}}" style="background-color: {{$item->color}}">
                                        <span class="text {{!$item->color ? 'text-primary' : ''}}" style="color: {{$item->color}}">0</span>
                                    </div>
                                </td>
                                <td class="v-align-middle">
                                    {{ $item->price ? $item->price : '—' }}
                                </td>

                                <td class="v-align-middle">
                                    {{ $item->time ? $item->time : '—' }}
                                </td>

{{--                                <td style="width:20%" class="v-align-middle d-flex">--}}
{{--                                    <a href="{{ route('admin.skills.edit', $item->id) }}"--}}
{{--                                       class="btn btn-primary mr-3">--}}
{{--                                        Editer--}}
{{--                                    </a>--}}
{{--                                    <form action="{{ route('admin.skills.destroy', $item->id) }}"--}}
{{--                                          method="POST">--}}
{{--                                        <input type="hidden" value="DELETE" name="_method">--}}
{{--                                        {{ csrf_field() }}--}}
{{--                                        <button type="submit"--}}
{{--                                                class="delete btn btn btn-danger"--}}
{{--                                                style="display: inline-block;vertical-align: top;">--}}
{{--                                            Supprimer--}}
{{--                                        </button>--}}
{{--                                    </form>--}}
{{--                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
