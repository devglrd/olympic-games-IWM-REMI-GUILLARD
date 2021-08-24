@extends('admin')

@section('css')
    <link href="{{ asset('pages-assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet"
          type="text/css"
          media="screen">
    <link href="{{ asset('pages-assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet"
          type="text/css"
          media="screen">
    <link href="{{ asset('pages-assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet"
          type="text/css"
          media="screen">

    <style>
        .dataTables_wrapper {
            width: 100%;
        }
    </style>
@stop


@section('content')
    <div class="content sm-gutter">
        <div class="container-fluid container-fixed-lg">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ action([\App\Http\Controllers\Admin\DashboardController::class, 'dashboard']) }}">Tableau
                        de bord</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'index']) }}">List des
                        client</a>
                </li>
                <li class="breadcrumb-item active">Information client</li>
            </ol>
            <div>
                <div class="card card-transparent ">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-fillup hidden-sm-down" data-init-reponsive-tabs="dropdownfx">
                        <li class="nav-item">
                            <a href="#" class="active" data-toggle="tab" data-target="#tab-fillup1"
                               aria-expanded="true"><span>Information de base</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" data-target="#tab-fillup2" class=""
                               aria-expanded="false"><span>Planning</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" data-target="#tab-fillup3" class=""
                               aria-expanded="false"><span>Factures</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" data-target="#tab-fillup4" class="d-flex align-items-center justify-content-between"
                               aria-expanded="false"><span>Alertes client</span> <span class="badge badge-success">{{ countNotif() }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" data-target="#tab-fillup5" class=""
                               aria-expanded="false"><span>Information bancaire</span></a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane" id="tab-fillup5" aria-expanded="true">
                            {{--                            // TAB 1--}}
                            <form
                                action="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'sepa'], $user->id) }}"
                                method="POST" class="row">
                                {{ csrf_field() }}
                                <div class="col-xl-12 col-lg-12 ">
                                    <div class="card card-white">
                                        <div class="card-header">
                                            <div class="card-title">
                                                Information bancaire
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <div class="row clearfix">
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-default"
                                                         aria-required="true">
                                                        <label>Iban</label>
                                                        <input type="text" class="form-control" name="iban" value="{{ $user->iban }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-default"
                                                         aria-required="true">
                                                        <label>BIC</label>
                                                        <input type="text" class="form-control" name="bic" value="{{ $user->bic }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <button class="mt-2 btn btn-primary">Enregistrer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane active" id="tab-fillup1" aria-expanded="true">
                            {{--                            // TAB 1--}}
                            <div class="row">
                                <div class="col-xl-7 col-lg-6 ">
                                    <div class="card card-white">
                                        <div class="card-header">
                                            <div class="card-title">
                                                Information de base
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div class="form-group form-group-default"
                                                         aria-required="true">
                                                        <label>Nom</label>
                                                        {{ $user->name }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div class="form-group form-group-default"
                                                         aria-required="true">
                                                        <label>Email</label>
                                                        {{ $user->email }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div class="form-group form-group-default"
                                                         aria-required="true">
                                                        <label>Tel</label>
                                                        {{ $user->tel }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div class="form-group form-group-default"
                                                         aria-required="true">
                                                        <label>Addresse</label>
                                                        {{ $user->address }}, {{ $user->postalCode }}, {{ $user->city }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($user->getCoach->isNotEmpty())
                                        <div class="card card-white">
                                            <a href="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'show'], $user->getCoach->first()->id) }}"
                                               class="m-0 p-0">

                                                <div class="card-header">
                                                    <div class="card-title">
                                                        Information du coach
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="card-block pt-0">
                                                <div class="row clearfix">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-default"
                                                             aria-required="true">
                                                            <label>Nom</label>
                                                            {{ $user->getCoach->first()->name }}
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-xl-5 col-lg-6">
                                    <div class="card card-white">
                                        <div class="card-header ">
                                            <div class="card-title">Produit lié au client
                                                <span
                                                    class="badge badge-info ml-2">{{ count($user->getProduct()) }}</span>
                                            </div>
                                        </div>
                                        @foreach($user->getProduct() as $product)
                                            <div class="card-block d-flex flex-column align-items-start ">
                                                <b>
                                                    {{ $product['name'] }}
                                                </b>
                                                <div class="mt-2">

                                                    <span class="font-weight-bold mb-2">Options</span>

                                                    <p>
                                                        @foreach($product['options'] as $option )
                                                            - <b>{{ $option->name }}</b> : {{ $option->value }}
                                                            <br>
                                                        @endforeach
                                                    </p>
                                                </div>
                                                {{--                                <img src="{{ $event->getFile ? $event->getFile->file : 'N/A' }}" alt="" height="250">--}}
                                            </div>
                                        @endforeach
                                    </div>
                                    {{--                        <div class="card card-transparent">--}}
                                    {{--                            <div class="card-header ">--}}
                                    {{--                                <div class="card-title">Validation--}}
                                    {{--                                </div>--}}
                                    {{--                            </div>--}}
                                    {{--                            <div class="card-block">--}}
                                    {{--                                <h3>--}}
                                    {{--                                    Modifier un événement--}}
                                    {{--                                </h3>--}}
                                    {{--                                <p>--}}
                                    {{--                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci aperiam,--}}
                                    {{--                                    assumenda beatae cumque dicta earum eos error esse facere optio reiciendis saepe--}}
                                    {{--                                    sequi, suscipit tenetur. Atque ea earum eius est eveniet fugit impedit molestias,--}}
                                    {{--                                    odit pariatur perspiciatis quibusdam, repellat!--}}
                                    {{--                                </p>--}}
                                    {{--                                <br>--}}
                                    {{--                                <button type="submit" class="btn btn-primary btn-cons">--}}
                                    {{--                                    Valider les modifications--}}
                                    {{--                                </button>--}}
                                    {{--                            </div>--}}
                                    {{--                        </div>--}}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-fillup2" aria-expanded="false">
                            <div class="row">
                                <div class="col-xl-5 col-lg-6">

                                    <div class="card card-white ">
                                        <div class="card-header cursor " id="headerPanning">
                                            <div class="card-title">Planning du client</strong>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            @foreach($user->getSeances as $seance)

                                                <div class="form-group form-group-default "
                                                     aria-required="true">
                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                        <label class="text-black">Seance de <b
                                                                class="text-orange">{{$seance->getActivity ? ($seance->getActivity  instanceof \Illuminate\Support\Collection ? toString($seance->getActivity) : '-') : '-' }}</b>
                                                            avec
                                                            <b class="text-orange">{{ $seance->getCoach->name }}</b></label>
                                                        <span
                                                            class="badge {{ $seance->isEnd() ? 'badge-danger' : 'badge-success'}}">{{ $seance->isEnd() ?'Finis' : 'A venir' }}</span>
                                                    </div>
                                                    <span class="text-primary">Début</span> : {{ $seance->start }} <b
                                                        class="px-2">|</b> <span class="text-primary">Fin</span>
                                                    : {{ $seance->end }}
                                                </div>
                                            @endforeach
                                            {{--                                <img src="{{ $event->getHomeFile ? $event->getHomeFile->file : 'N/A' }}" alt="" height="250">--}}
                                        </div>
                                    </div>

                                    {{--                        <div class="card card-transparent">--}}
                                    {{--                            <div class="card-header ">--}}
                                    {{--                                <div class="card-title">Validation--}}
                                    {{--                                </div>--}}
                                    {{--                            </div>--}}
                                    {{--                            <div class="card-block">--}}
                                    {{--                                <h3>--}}
                                    {{--                                    Modifier un événement--}}
                                    {{--                                </h3>--}}
                                    {{--                                <p>--}}
                                    {{--                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci aperiam,--}}
                                    {{--                                    assumenda beatae cumque dicta earum eos error esse facere optio reiciendis saepe--}}
                                    {{--                                    sequi, suscipit tenetur. Atque ea earum eius est eveniet fugit impedit molestias,--}}
                                    {{--                                    odit pariatur perspiciatis quibusdam, repellat!--}}
                                    {{--                                </p>--}}
                                    {{--                                <br>--}}
                                    {{--                                <button type="submit" class="btn btn-primary btn-cons">--}}
                                    {{--                                    Valider les modifications--}}
                                    {{--                                </button>--}}
                                    {{--                            </div>--}}
                                    {{--                        </div>--}}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-fillup3" aria-expanded="false">
                            <div class="row">
                                <div class="d-flex">
                                    @if($user->getSepa)
                                        <a target="_blank"
                                           href="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'showSepa'], $user->id) }}"
                                           class="btn btn-primary">Voir le sepa</a>

                                    @else
                                        <form id="sepaForm"
                                              action="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'sepa'], $user->id) }}"
                                              method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="parent-div">
                                                <button class="btn-upload btn btn-primary">Uploader le sepa</button>
                                                <input type="file" id="file" name="upfile"/>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                                <table class="w-100 table table-hover demo-table-search table-responsive-block"
                                       id="tableWithSearch">
                                    <thead>
                                    <tr>
                                        {{--                            <th>Identifiant</th>--}}
                                        <th>Id</th>
                                        <th>Mois</th>
                                        <th>Action</th>
                                        {{--                            <th>Actions</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user->getFactures() AS $key => $item)
                                        <tr data-id="{{ $item['id'] }}" class="cursor facture_theard">
                                            <td class="v-align-middle">{{ $item['id'] }}</td>
                                            <td class="v-align-middle">
                                                {{--                                                {{$item->status === \App\Models\Alert::PENDING ? 'En cours' : 'Finis'}}--}}
                                                {{$item['month']}}
                                            </td>
                                            <td class="v-align-middle semi-bold">
                                                <a target="_blank"
                                                   href="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'pdf'], [$user->id, $key]) }}"
                                                   class="btn btn-primary">Télécharger</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-fillup4" aria-expanded="false">
                            <div class="row">

                                <table class="w-100 table table-hover demo-table-search table-responsive-block"
                                       id="tableWithSearch">
                                    <thead>
                                    <tr>
                                        {{--                            <th>Identifiant</th>--}}
                                        <th>Id</th>
                                        <th>Statut</th>
                                        <th>Contenu</th>
                                        {{--                            <th>Actions</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user->getAlertes AS $key => $item)
                                        <tr data-id="{{ $item->id }}" class="cursor user_threads">
                                            <td class="v-align-middle">{{ $item->id }}</td>
                                            <td class="v-align-middle">
                                                {{$item->status === \App\Models\Alert::PENDING ? 'En cours' : 'Finis'}}
                                            </td>
                                            <td class="v-align-middle semi-bold">
                                                {{ $item->content}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 w-50">
                    <div class="col-md-3 mr-2">
                        <form action="{{ route('admin.clients.destroy', $user->id) }}"
                              method="POST">
                            <input type="hidden" value="DELETE" name="_method">
                            {{ csrf_field() }}
                            <button type="submit"
                                    class="delete btn btn btn-danger">Supprimer
                            </button>
                        </form>

                    </div>
                    {{--                    <div class="col-md-4">--}}
                    {{--                        <button class="btn btn-primary">Faire une vente</button>--}}
                    {{--                    </div>--}}
                    <div class="col-md-4">
                        <a href="{{ action([\App\Http\Controllers\Admin\Cms\WallOfferController::class,"create"], ['id' =>$user->id]) }}"
                           class="btn btn-primary">Crée une offre</a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ action([\App\Http\Controllers\Admin\Cms\AlertController::class, 'create'], ['user' =>$user->id]) }}"
                           class="btn btn-primary">Crée une alerte</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <form id="form" action="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'filterPlanning']) }}"
          class="d-none" method="POST">
        {{ csrf_token() }}
        <input type="hidden" value="{{$user->id}}" name="client">
    </form>
@stop


@section('js')
    <script src="{{ asset('pages-assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-typehead/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-typehead/typeahead.jquery.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#file').on('change', function () {
                console.log('la');
                $('#sepaForm').submit();
            });

            $('#headerPanning').on('click', function () {
                $('#form').submit();
            });
            let months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
            // DATEPICKER - Documentation : http://bootstrap-datepicker.readthedocs.io/en/latest/index.html
            $.fn.datepicker.dates['fr'] = {
                days: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
                daysShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
                daysMin: ["D", "L", "M", "M", "J", "V", "S"],
                months: months,
                monthsShort: ["Janv", "Févr", "Mars", "Avr", "Mai", "Juin", "Juill", "Août", "Sept", "Oct", "Nov", "Déc"],
                today: "Aujourd'hui",
                clear: "Clear",
                format: "dd/mm/yyyy",
                titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
                weekStart: 1
            };
            $('#datepicker').datepicker({
                format: 'dd/mm/yyyy', // FORMAT - Documentation : http://bootstrap-datepicker.readthedocs.io/en/latest/options.html#format
                language: 'fr',
                todayHight: true
            });
            $('#time').timepicker({
                showMeridian: false
            }).on('show.timepicker', function (e) {
                var widget = $('.bootstrap-timepicker-widget');
                widget.find('.glyphicon-chevron-up').removeClass().addClass('pg-arrow_maximize');
                widget.find('.glyphicon-chevron-down').removeClass().addClass('pg-arrow_minimize');
            });
        });
    </script>
@stop
