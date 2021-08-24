@extends('admin')

@section('js')
    <script>
        $(document).ready(function(){
            $('.user_threads').on('click', function(){
                const id = $(this).data('id');

                window.location = '/options/' + id + '/edit';
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
                        <li class="breadcrumb-item">
                            <a href="{{ action([\App\Http\Controllers\Admin\Cms\ProductController::class, 'index']) }}">Mes Produits</a>
                        </li>
                        <li class="breadcrumb-item active">Mes Options</li>
                    </ol>
                    <div class="row">

                        <div class="col-xl-12 col-lg-12 ">
                            <div class="card card-transparent">
                                <div class="card-block d-flex w-100">

                                    {{--@permission('create-cms-events')--}}
                                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\OptionController::class, 'create']) }}"
                                       class="btn btn-primary btn-cons m-t-10">
                                        Ajouter une option
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
                            <th>Type</th>
                            <th>Valeur</th>
                            <th style="width:20%">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($options AS $key => $option)

                            <tr data-id="{{ $option->id }}" class="cursor user_threads">
                                <td class="v-align-middle semi-bold">
                                    #OP{{ $option->id ? str_pad($option->id, 5, '0', STR_PAD_LEFT) : 'XXX' }}
                                </td>
                                <td class="v-align-middle semi-bold">
                                    {{ $option->name ? $option->name : '—' }}
                                </td>
                                <td class="v-align-middle semi-bold">
                                    {{ $option->value ? $option->value : '—' }}
                                </td>
                                <td style="width:20%" class="v-align-middle d-flex">
                                    <form action="{{ route('admin.options.destroy', $option->id) }}"
                                          method="POST">
                                        <input type="hidden" value="DELETE" name="_method">
                                        {{ csrf_field() }}
                                        <button type="submit"
                                                class="delete btn btn btn-danger"
                                                style="display: inline-block;vertical-align: top;">
                                            Supprimer
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
