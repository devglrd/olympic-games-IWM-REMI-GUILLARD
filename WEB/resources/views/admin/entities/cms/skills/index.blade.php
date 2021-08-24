@extends('admin')

@section('js')
    <script>
    </script>
@stop

@section('content')
    <div class="content">
        <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
                <div class="inner">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            Traits de caractère de coach
                        </li>
                    </ol>
                    <div class="row">

                        <div class="col-xl-5 col-lg-6 ">
                            <div class="card card-transparent">
                                <div class="card-block">    
                                    {{--@permission('create-cms-events')--}}
                                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\SkillController::class, 'create']) }}"
                                       class="btn btn-primary btn-cons m-t-10">
                                        Ajouter un trait de caractère
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
                            <th>Description</th>
                            <th style="width:20%">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data AS $key => $skill)

                            <tr>
                                <td class="v-align-middle semi-bold">
                                    #SK{{ $skill->id ? str_pad($skill->id, 5, '0', STR_PAD_LEFT) : 'XXX' }}
                                </td>
                                <td class="v-align-middle">
                                    {{ $skill->name ? $skill->name : '—' }}
                                </td>

                                <td class="v-align-middle">
                                    {{ $skill->content ? $skill->content : '—' }}
                                </td>

                                <td style="width:20%" class="v-align-middle d-flex">
                                    <a href="{{ route('admin.skills.edit', $skill->id) }}"
                                       class="btn btn-primary mr-3">
                                        Editer
                                    </a>
                                    <form action="{{ route('admin.skills.destroy', $skill->id) }}"
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
