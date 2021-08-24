@extends('admin')


@section('js')
    <script>
        $(document).ready(function(){
            $('.user_threads').on('click', function(){
                const id = $(this).data('id');

                window.location = '/users/' + id+'/edit';
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
                            Admin users
                        </li>
                    </ol>
                    <div class="row">

                        <div class="col-xl-5 col-lg-6 ">
                            <div class="card card-transparent">

                                <div class="card-block">

                                    {{--@permission('create-cms-events')--}}
                                    {{--<a href="{{ action([\App\Http\Controllers\Admin\Cms\UsersController::class,'create')}}"--}}
                                    <a href="#"
                                    class="btn btn-primary btn-cons m-t-10">
                                    Ajouter un admin
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
                            <th>Identifiant</th>
                            <th>Nom</th>
                            <th>Adresse email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users AS $key => $user)

                            <tr data-id="{{ $user->id }}" class="cursor user_threads">
                                <td class="v-align-middle semi-bold">
                                    #AD{{$user->id ?str_pad($user->id, 5, '0', STR_PAD_LEFT):'XXX'}}
                                </td>
                                <td class="v-align-middle">
                                    {{ $user->name ? $user->name : '—' }}
                                </td>
                                <td class="v-align-middle">
                                    {{ $user->email ? $user->email : '—' }}
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
