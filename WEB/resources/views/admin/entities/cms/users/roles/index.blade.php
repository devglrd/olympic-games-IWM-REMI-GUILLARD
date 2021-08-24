@extends('admin')

@section('content')
    <div class="content">
        <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
                <div class="inner">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ action('Admin\DashboardController@dashboard') }}">Tableau de bord</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Roles
                        </li>
                    </ol>
                    <div class="row">
                        
                        <div class="col-xl-5 col-lg-6 ">
                            <div class="card card-transparent">
                                <div class="card-header ">
                                    <div class="card-title">
                                        Roles
                                    </div>
                                </div>
                                <div class="card-block">
                                    <h3>
                                        Roles
                                    </h3>
                                    <p>
                                        Cette page vous permet de gérer les rôles que vous pouvez, par la suite,
                                        attribuer à des utilisateurs. Sur cette page vous pouvez :
                                    <li>
                                        Ajouter / supprimer un rôle
                                    </li>
                                    <li>
                                        Modifier le nom d’un rôle
                                    </li>
                                    <li>
                                        Modifier la description d’un rôle
                                    </li>
                                    <li>
                                        Modifier les permissions attribuées à un rôle
                                    </li>
                                    </p>
                                    <a href="{{ action('Admin\Cms\RolesController@create') }}"
                                       class="btn btn-primary btn-cons m-t-10">
                                        Ajouter un role
                                    </a>
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
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles AS $key => $role)
                            <tr>
                                <td class="v-align-middle semi-bold">
                                    <p>{{ $role->display_name . ' ('.$role->name.')' }}</p>
                                </td>
                                <td class="v-align-middle">
                                    <a href="{{ action('Admin\Cms\RolesController@edit', $role->id) }}"
                                       class="btn btn-primary" style="display: inline-block;vertical-align: top;">
                                        <span>Voir</span>
                                    </a>
                                    <form action="{{ action('Admin\Cms\RolesController@delete', $role->id) }}"
                                          style="display: inline" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="delete btn btn btn-danger"
                                                style="display: inline-block;vertical-align: top;">
                                            Supprimé
                                        </button>
                                    </form>
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