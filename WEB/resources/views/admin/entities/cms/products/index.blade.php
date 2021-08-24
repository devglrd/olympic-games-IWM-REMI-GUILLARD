@extends('admin')

@section('js')
    <script>
        $(document).ready(function () {
            $('.user_threads').on('click', function () {
                const id = $(this).data('id');

                window.location = '/products/' + id + '/edit';
            })
        })
    </script>
@stop

@section('content')
    <div class="content">
            <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
                <div class="inner">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            Mes Produits
                        </li>
                    </ol>
                    <div class="row">

                        <div class="col-xl-12 col-lg-12 ">
                            <div class="card card-transparent">
                                <div class="card-block d-flex w-100">

                                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\ProductController::class, 'assing']) }}"
                                       class="btn btn-primary m-t-10 mr-2">
                                        Faire une vente
                                    </a>
                                    {{--@permission('create-cms-events')--}}
                                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\ProductController::class, 'create']) }}"
                                       class="btn btn-primary btn-cons m-t-10">
                                        Ajouter un produit
                                    </a>

                                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\OptionController::class, 'index']) }}"
                                       class="btn btn-primary btn-cons m-t-10">
                                        Gerer les options
                                    </a>


                                    {{--@endpermission--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs nav-tabs-fillup hidden-sm-down" data-init-reponsive-tabs="dropdownfx">
                        <li class="nav-item">
                            <a href="{{ action([\App\Http\Controllers\Admin\Cms\ProductController::class, 'index'], ['abonnement' => true]) }}" class="{{ $abonnement  ? 'active' : ''}}">
                               <span>Abonnement ({{$nbAbonnements}})</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ action([\App\Http\Controllers\Admin\Cms\ProductController::class, 'index'], ['pack' => true]) }}" class="{{  $pack ? 'active' : ''}}">
                               <span>Pack ({{$nbPacks}})</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-data" aria-expanded="true">
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
                                        @if ($abonnement)
                                            <th>Nbre de personne</th>
                                            <th>Engagement</th>
                                            <th>Unité mensuel</th>
                                        @elseif ($pack)
                                            <th>Nbre de personne</th>
                                            <th>Validité</th>
                                            <th>Unité de pack</th>
                                        @else
                                            <th>Type</th>
                                        @endif

                                        <th style="min-width:80px;">Prix</th>

                                        {{--                            <th style="width:20%">Actions</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($produits AS $key => $produit)

                                        <tr data-id="{{ $produit->id }}" class="cursor user_threads">

                                            <td class="v-align-middle semi-bold">
                                                #P{{ $produit->id ? str_pad($produit->id, 5, '0', STR_PAD_LEFT) : 'XXX' }}
                                            </td>
                                            <td class="v-align-middle semi-bold">
                                                {{ $produit->name ? $produit->name : '—' }}
                                            </td>

                                            @if ($abonnement)
                                                <td class="v-align-middle semi-bold">
                                                    {{ getOption('Nb personne', $produit->getOptions) }}
                                                </td>
                                                <td class="v-align-middle semi-bold">
                                                    {{ getOption('Engagement', $produit->getOptions) }}
                                                </td>
                                                <td class="v-align-middle semi-bold">
                                                    {{ getOption('Unité d\'abonnement', $produit->getOptions) }}
                                                </td>

                                            @elseif ($pack)
                                                <td class="v-align-middle semi-bold">
                                                    {{ getOption('Nb personne', $produit->getOptions) }}
                                                </td>
                                                <td class="v-align-middle semi-bold">
                                                    {{ getOption('Validité', $produit->getOptions) }}
                                                </td>
                                                <td class="v-align-middle semi-bold">
                                                    {{ getOption('Unité de pack', $produit->getOptions) }}
                                                </td>
                                            @else
                                                <td class="v-align-middle semi-bold">
                                                    {{ $produit->type ? $produit->type : '—' }}
                                                </td>
                                            @endif
                                            <td class="v-align-middle semi-bold">
                                                <span>{{ $produit->price ? $produit->price : '—' }} €</span>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@stop
