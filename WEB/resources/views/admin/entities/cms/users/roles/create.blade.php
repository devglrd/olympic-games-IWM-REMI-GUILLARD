@extends('admin')

@section('content')
    <div class="content sm-gutter">
        <div class="container-fluid container-fixed-lg">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ action('Admin\DashboardController@dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ action('Admin\Cms\RolesController@index') }}">Roles</a>
                </li>
                <li class="breadcrumb-item active">Ajouter un role</li>
            </ol>
            <form action="{{ action('Admin\Cms\RolesController@store') }}" method="post"
                  data-toggle="validator">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xl-7 col-lg-6 ">
                        <div class="card card-default">
                            <div class="card-header">
                                <div class="card-title">
                                    Crée un roles
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }} form-group-default required"
                                             aria-required="true">
                                            <label>Nom du roles</label>
                                            <input type="text" class="form-control" name="display_name"
                                                   value="{{ old('display_name') }}"
                                                   placeholder="nom du role" required>
                                            @if ($errors->has('display_name'))
                                                <div class="help-block">
                                                    <strong>{{ $errors->first('display_name') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }} form-group-default">
                                            <label>description du role</label>
                                            <textarea type="text" class="form-control" name="description"
                                                      placeholder="description du role">{{ old('description') }}</textarea>
                                            @if ($errors->has('description'))
                                                <div class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('admin') ? 'has-error' : '' }} form-group-default">
                                            <label class="">Admin ?</label>
                                            <select class="full-width form-control"
                                                    name="admin">
                                                <option value="1">Oui</option>
                                                <option value="0">Non</option>
                                            </select>
                                            @if ($errors->has('admin'))
                                                <div class="help-block">
                                                    <strong>{{ $errors->first('admin') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-default">
                            <div class="card-header">
                                <div class="card-title">
                                    Permissions
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    @foreach($permissions->chunk(4) AS $chunk)
                                        <div class="col-lg-4 col-sm-6">
                                            @foreach($chunk AS $permission)
                                                <div>
                                                    <label>
                                                        <input class="checkbox" type="checkbox" name="permissions[]"
                                                               value="{{ $permission->id }}">
                                                        <span class="mrgn-l-xs">{{ $permission->display_name }}</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <div class="card card-transparent">
                            <div class="card-header ">
                                <div class="card-title">
                                    Ajouter un roles
                                </div>
                            </div>
                            <div class="card-block">
                                <h3>
                                    Ajouter un role
                                </h3>
                                <p>
                                    Cette page vous permet d’ajouter un rôle. Vous pouvez ainsi définir son nom, son
                                    description, son accès à l’administration ainsi que les permissions qui lui sont
                                    accordées.
                                </p>
                                <br>
                                <button type="submit" class="btn btn-primary btn-cons">
                                    Ajouter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop