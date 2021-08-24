@extends('admin')

@section('js')
    <script>
        $(document).ready(function () {
            $('.user_threads').on('click', function () {
                const id = $(this).data('id');

                window.location = '/clients/' + id;
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
                            Mes Alertes
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
                                <div class="card-block">

                                    {{--@permission('create-cms-events')--}}
                                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\AlertController::class, 'create']) }}"
                                       class="btn btn-primary btn-cons m-t-10">
                                        Crée une Alertes
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
                            {{--                            <th>Identifiant</th>--}}
                            <th>ID</th>
                            <th>Client</th>
                            <th>Statut</th>
                            <th>Contenu</th>
                            {{--                            <th>Actions</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data AS $key => $item)
                            <tr data-id="{{ $item->id }}" class="cursor user_threads">
                                <td class="v-align-middle">
                                    #AL{{ $item->id ? str_pad($item->id, 5, '0', STR_PAD_LEFT) : 'XXX' }}
                                </td>
                                <td class="v-align-middle semi-bold">
                                    {{ $item->getClient ? $item->getClient->name : '—' }}
                                </td>

                                {{--                                <td class="v-align-middle">--}}
                                {{--                                    {{ $user->getCoach->isNotEmpty() ? $user->getCoach->first()->name : '—' }}--}}
                                {{--                                </td>--}}

                                <td class="v-align-middle">
                                    {{\Carbon\Carbon::now()->isAfter($item->trigger) ? 'Finis' : 'En cours'}}
                                </td>
                                <td class="v-align-middle">
                                    {{$item->content}}
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
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
