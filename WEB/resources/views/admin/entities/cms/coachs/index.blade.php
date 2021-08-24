@extends('admin')

@section('js')
    <script>
        $(document).ready(function(){
            $('.user_threads').on('click', function(){
                const id = $(this).data('id');

                window.location = '/coachs/' + id + '/edit';
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
                            Coachs
                        </li>
                    </ol>
                    <div class="row">

                        <div class="col-xl-5 col-lg-6 ">
                            <div class="card card-transparent">
                                <div class="card-block">

                                    {{--@permission('create-cms-events')--}}
                                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'create']) }}"
                                       class="btn btn-primary btn-cons m-t-10">
                                        Ajouter un coach
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
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Adresse email</th>
                            <th>Nombre de clients</th>
                            <th>Nombre de coaching dans le mois</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users AS $key => $user)

                            <tr data-id="{{ $user->id }}" class="cursor user_threads">
                                <td class="v-align-middle semi-bold {{$user->active? '' : 'disable'}}">
                                    #CO{{ $user->id ? str_pad($user->id, 5, '0', STR_PAD_LEFT) : 'XXX' }}
                                </td>
                                <td class="v-align-middle semi-bold text-center {{$user->active? '' : 'disable'}}">
                                    {{ $user->name ? $user->name : '—' }}
                                </td>
                                <td class="v-align-middle semi-bold text-center {{$user->active? '' : 'disable'}}">
                                    {{ $user->first_name ? $user->first_name : '—' }}
                                </td>
                                <td class="v-align-middle text-center {{$user->active? '' : 'disable'}}">
                                    {{ $user->email ? $user->email : '—' }}
                                </td>
                                <td class="v-align-middle text-center {{$user->active? '' : 'disable'}}">
                                    {{ $user->getClients ? $user->getClients->count() : '—' }}
                                </td>
                                <td class="v-align-middle text-center {{$user->active? '' : 'disable'}}">
                                    {{$user->getCoaching()}}
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
