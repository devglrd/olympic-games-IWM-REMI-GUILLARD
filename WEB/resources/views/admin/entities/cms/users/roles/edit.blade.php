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
                <li class="breadcrumb-item active">Modifiez un role</li>
            </ol>
            <form action="{{ action('Admin\Cms\RolesController@update', $role->id) }}" method="post"
                  data-toggle="validator">
                {{ csrf_field() }}
                {{ method_field('put') }}
                <div class="row">
                    <div class="col-xl-7 col-lg-6 ">
                        <div class="card card-default">
                            <div class="card-header">
                                <div class="card-title">
                                    Roles
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }} form-group-default required"
                                             aria-required="true">
                                            <label>Nom du role</label>
                                            <input type="text" class="form-control" name="display_name"
                                                   value="{{ $role->display_name }}"
                                                   placeholder="{{ $role->display_name }}" required>
                                            @if ($errors->has('display_name'))
                                                <div class="help-block">
                                                    <strong>{{ $errors->first('display_name') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }} form-group-default">
                                            <label>Description</label>
                                            <textarea type="text" class="form-control"
                                                      name="description">{{ $role->description }}</textarea>
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
                                        <div class="form-group {{ $errors->has('can_access_admin') ? 'has-error' : '' }} form-group-default">
                                            <label class="">Peut il acceder à l'espace admin ?</label>
                                            <select class="full-width form-control"
                                                    name="can_access_admin">
                                                <option value="1" {{ $role->can_access_admin ? 'selected' : '' }}>Yes
                                                </option>
                                                <option value="0" {{ !$role->can_access_admin ? 'selected' : '' }}>No
                                                </option>
                                            </select>
                                            @if ($errors->has('can_access_admin'))
                                                <div class="help-block">
                                                    <strong>{{ $errors->first('can_access_admin') }}</strong>
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
                                                <div class="checkbox check-primary">
                                                    <input type="checkbox" name="permissions[]"
                                                           id="{{ $permission->id }}"
                                                           value="{{ $permission->id }}" {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                    <label for="{{ $permission->id }}">
                                                        {{ $permission->display_name }}
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
                                    Modifiez un role
                                </div>
                            </div>
                            <div class="card-block">
                                <h3>
                                    Modifiez un roles
                                </h3>
                                <p>
                                    Cette page vous permet de modifier les informations concernant ce rôle. Vous pouvez
                                    ainsi modifier son nom, sa description, son accès à l’administration ainsi que les
                                    permissions qui lui sont accordées.
                                </p>
                                <br>
                                <button type="submit" class="btn btn-primary btn-cons">
                                    Modifiez le role
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop