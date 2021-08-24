@extends('admin')

@section('js')
    <script>
        $(document).ready(function () {
            $('.user_threads').on('click', function () {
                const id = $(this).data('id');

                window.location = '/clients/' + id + '/edit';
            })
        })
    </script>
@stop

@section('content')
    <div class="content">
        <div class="jumbotron mb-0" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
                <div class="inner">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            Mes Ventes
                        </li>
                    </ol>
                    <div class="row">

                        <div class="col-xl-5 col-lg-6 ">
                            <div class="card card-transparent">
                                <!--
                                <div class="card-header ">
                                    <div class="card-title">
                                        Liste utilisateurs
                                    </div>
                                </div>
-->
                                <div class="card-block p-1">

                                    {{--                                    --}}{{--@permission('create-cms-events')--}}
                                    {{--                                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'create']) }}"--}}
                                    {{--                                       class="btn btn-primary btn-cons m-t-10">--}}
                                    {{--                                        Ajouter un client--}}
                                    {{--                                    </a>--}}
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
                            {{--                            <th>Identifiant</th>--}}
                            <th>Client</th>
                            <th>Produit</th>
                            <th>Options</th>
                            <th>Date</th>
                            {{--                            <th>Actions</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data AS $key => $item)
                            @if(\App\Models\Client::findOrFail($item->fk_client_id))
                                <tr data-id="{{ $item->fk_client_id }}" class="cursor user_threads">
                                    <td class="v-align-middle semi-bold">
                                        {{ \App\Models\Client::findOrFail($item->fk_client_id)->first_name }}
                                        {{ \App\Models\Client::findOrFail($item->fk_client_id)->name }}
                                    </td>
                                    <td class="v-align-middle">
                                        {{ $item->name }}
                                        <div class="badge badge-info">{{$item->type}}</div>
                                    </td>
                                    <td>

                                        {{ $item->type === \App\Models\Product::ABONNEMENT ? \App\Models\Product::TIME_UNIT_ABONNEMENT : \App\Models\Product::TIME_UNIT }}
                                        :
                                        <div class="badge badge-info">{{$item->time_unit}}</div>
                                        <br>
                                        Nombre de payeur :
                                        <div class="badge badge-info">{{$item->buyer}}</div>
                                        <br>
                                        {{ $item->type === \App\Models\Product::ABONNEMENT ? "Engagement" : 'Validité' }}
                                        :
                                        <div class="badge badge-info">{{$item->validity}}</div>

                                    </td>
                                    <td class="v-align-middle">
                                        {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('m/d/Y'): '—' }}
                                    </td>


                                    {{--                                <td class="v-align-middle">--}}
                                    {{--                                    {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('m/d/Y'): '—' }}--}}
                                    {{--                                </td>--}}
                                    {{--                                <td style="width:20%" class="v-align-middle d-flex">--}}
                                    {{--                                    <a href="{{ route('admin.clients.show', $user->id) }}"--}}
                                    {{--                                       class="btn btn-primary mr-3">--}}
                                    {{--                                        Voir--}}
                                    {{--                                    </a>--}}
                                    {{--                                    <form action="{{ route('admin.clients.destroy', $user->id) }}"--}}
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
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
