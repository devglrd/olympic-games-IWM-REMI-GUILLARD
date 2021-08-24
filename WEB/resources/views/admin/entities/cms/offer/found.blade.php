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
                            Les Offres
                        </li>
                    </ol>
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-transparent">
                                <div class="card-block text-right py-0">

                                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\WallOfferController::class, 'create']) }}"
                                       class="btn btn-primary btn-cons m-t-10">
                                        Créer une offre
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-tabs nav-tabs-fillup hidden-sm-down" data-init-reponsive-tabs="dropdownfx">
                        <li class="nav-item">
                            <a href="{{ action([\App\Http\Controllers\Admin\Cms\WallOfferController::class, 'index']) }}"
                               aria-expanded="true"><span>Offres en attente</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ action([\App\Http\Controllers\Admin\Cms\WallOfferController::class, 'notFound']) }}"
                               aria-expanded="false"><span>Offres publiées</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ action([\App\Http\Controllers\Admin\Cms\WallOfferController::class, 'indexFound']) }}"
                               class="active"
                               aria-expanded="false"><span>Offres validées </span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-infos" aria-expanded="true">
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
                                    <table class="table table-hover demo-table-search table-responsive-block"
                                           id="tableWithSearch">
                                        <thead>
                                        <tr>
                                            <th class="idcolumn">Id</th>
                                            <th>Date</th>
                                            <th>Client</th>
                                            <th>Coach</th>
                                            <th>Seance</th>

                                            <th>Date de la séance</th>


                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($offers AS $key => $offer)
                                            <tr>
                                                <td class="v-align-middle semi-bold idcolumn">
                                                    #OF{{str_pad($offer->id, 5, '0', STR_PAD_LEFT)}}
                                                </td>
                                                <td class="v-align-middle">
                                                    {{ $offer->created_at ? \Carbon\Carbon::parse($offer->created_at)->format('m/d/Y'): '—' }}
                                                </td>
                                                <td class="v-align-middle">
                                                    {{ $offer->getClient ? $offer->getClient->name : '—' }} {{ $offer->getClient ? $offer->getClient->first_name : '—' }}
                                                </td>
                                                <td class="v-align-middle">

                                                    {{ $offer->getSubscribes->count() ? implode(', ', $offer->getSubscribes->map(function($item){
    return ucfirst($item->getCoach->first_name) . ' ' . $item->getCoach->name;
})->toArray()) : '-'}}
                                                </td>
                                                <td class="v-align-middle">
                                                    {{ $offer->getSeance ? $offer->getSeance->name : '' }}
                                                </td>
                                                <td class="v-align-middle">
                                                    {{ getDatefromOffer($offer) ? getDatefromOffer($offer) : ''}}
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
    </div>
@stop
