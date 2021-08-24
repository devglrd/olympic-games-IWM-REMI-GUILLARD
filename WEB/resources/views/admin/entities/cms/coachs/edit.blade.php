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

@section('js')
    <script>
        $('select').select2();

        function onOff(it) {
            if ($(it).is(":checked")) {
                $('#activeCoach').prop("checked", false);
            } else {
                $('#activeCoach').prop("checked", true);

            }
        }

        var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
        // Success color: #10CFBD
        elems.forEach(function (html) {
            var switchery = new Switchery(html, {color: '#10CFBD'});
        });

        $(document).ready(function () {
            $('.client_threads').on('click', function () {
                const id = $(this).data('id');

                window.location = '/clients/' + id + '/edit';
            })
        })
    </script>

@stop



@section('content')
    <div class="content sm-gutter">
        <div class="container-fluid container-fixed-lg">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'index']) }}">Mes
                        coachs</a>
                </li>
                <li class="breadcrumb-item active">#CO{{str_pad($coach->id, 5, '0', STR_PAD_LEFT)}}
                    -{{$coach->name}}</li>
            </ol>

            <div>
                <div class="card card-transparent ">
                    <div class="row mx-1 my-3">
                        <div class="col-11 text-right">
                            <a href="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'planning']) }}"
                               class="btn btn-primary">Voir le planning</a>
                            <a href=""
                               class="btn btn-primary">Crée une séance</a>
                            <a href="{{ action([\App\Http\Controllers\Admin\Cms\AlertController::class, 'create'], ['user' =>$coach->id]) }}"
                               class="btn btn-primary">Crée une alerte</a>
                        </div>
                        <div class="col-1 text-right">
                            <form action="{{ route('admin.coachs.destroy', $coach->id) }}"
                                  method="POST">
                                <input type="hidden" value="DELETE" name="_method">
                                {{ csrf_field() }}
                                <button type="submit"
                                        class="delete btn btn btn-danger">Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger my-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif
                <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-fillup hidden-sm-down" data-init-reponsive-tabs="dropdownfx">
                        <li class="nav-item">
                            <a href="#" class="active" data-toggle="tab" data-target="#tab-infos"
                               aria-expanded="true"><span>Informations générales</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" data-target="#tab-clients"
                               aria-expanded="false"><span>Clients ({{count($coach->getClients()->get())}})</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" data-target="#tab-scéances" class=""
                               aria-expanded="false"><span>Scéances ({{count($coach->getSeancesIncomming()->get())}})</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" data-target="#tab-alertes" class=""
                               aria-expanded="false"><span>Alertes</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" data-target="#tab-invoices" class=""
                               aria-expanded="false"><span>Factures ({{count($coach->getInvoices())}})</span></a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-infos" aria-expanded="true">
                            <form class="row" method="POST"
                                  action="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'update'], $coach->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <div class="col-xl-7 col-lg-6 ">
                                    <div class="card card-white">
                                        <div class="card-header">
                                            <div class="row clearfix flex-column align-items-start">
                                                <div class="mb-4">
                                                    <button class="btn btn-primary">Enregistré</button>
                                                </div>
                                                <div class="row w-100">
                                                    <div class="col-md-6">
                                                        <div class="card-title">
                                                            Information d'identité
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 text-right">
                                                        <label for="">Actif</label>
                                                        <label class="switch">
                                                            <input type="checkbox" name="active"
                                                                   {{ $coach->active ? "checked" : ""}}
                                                                   onclick="onOff(this, null)">
                                                            <span class="slider round"></span>
                                                            <input class="hidden" type='checkbox'
                                                                   name="active" id="active">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div class="radio radio-success m-0 ">
                                                        <div class="d-table my-1">
                                                            <div class="d-table-row">
                                                                <div class="d-table-cell px-2">
                                                                    <input type="radio"
                                                                           {{ $coach->sexe === "h" ? 'checked="checked"' :'' }}
                                                                           name="sexe" id="sexe_homme" value="h">
                                                                    <label for="sexe_homme">Homme</label>
                                                                </div>
                                                                <div class="d-table-cell px-2">
                                                                    <input type="radio"
                                                                           {{ $coach->sexe === "f" ? 'checked="checked"' :'' }}
                                                                           name="sexe" id="sexe_femme" value="f">
                                                                    <label for="sexe_femme">Femme</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div class="form-group form-group-default"
                                                         aria-required="true">
                                                        <label>Status</label>
                                                        <span class="text-primary">{{ getStatus($coach) }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('name') ? 'has-error' : '' }} "
                                                        aria-required="true">
                                                        <label>Nom *</label>
                                                        <input type="text" value="{{ $coach->name }}"
                                                               class="form-control" name="name">
                                                        @if ($errors->has('name'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('first_name') ? 'has-error' : '' }} "
                                                        aria-required="true">
                                                        <label>Prénom *</label>
                                                        <input type="text" value="{{ $coach->first_name }}"
                                                               class="form-control" name="first_name">
                                                        @if ($errors->has('first_name'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('first_name') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('email') ? 'has-error' : '' }} "
                                                        aria-required="true">
                                                        <label>Email *</label>
                                                        <input type="text" value="{{ $coach->email }}"
                                                               class="form-control" name="email">
                                                        @if ($errors->has('email'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('tel') ? 'has-error' : '' }} "
                                                        aria-required="true">
                                                        <label>Tel</label>
                                                        <input type="tel" value="{{ $coach->tel }}"
                                                               class="form-control" name="tel">
                                                        @if ($errors->has('tel'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('tel') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('tel_2') ? 'has-error' : '' }} "
                                                        aria-required="true">
                                                        <label>Tel portable</label>
                                                        <input type="tel" value="{{ $coach->tel_2 }}"
                                                               class="form-control" name="tel_2">
                                                        @if ($errors->has('tel_2'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('tel_2') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('address') ? 'has-error' : '' }} "
                                                        aria-required="true">
                                                        <label>Adresse</label>
                                                        <input type="text" value="{{ $coach->address }}"
                                                               class="form-control" name="address">
                                                        @if ($errors->has('address'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('address') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('postalCode') ? 'has-error' : '' }} "
                                                        aria-required="true">
                                                        <label>Code postal</label>
                                                        <input type="text" value="{{ $coach->postalCode }}"
                                                               class="form-control" name="postalCode">
                                                        @if ($errors->has('postalCode'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('postalCode') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('city') ? 'has-error' : '' }} "
                                                        aria-required="true">
                                                        <label>Ville</label>
                                                        <input type="text" value="{{ $coach->city }}"
                                                               class="form-control" name="city">
                                                        @if ($errors->has('city'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('city') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('birthday_date') ? 'has-error' : '' }} "
                                                        aria-required="true">
                                                        <label>Date de naissance</label>
                                                        <input type="date" value="{{ $coach->birthday_date }}"
                                                               class="form-control" name="birthday_date">
                                                        @if ($errors->has('birthday_date'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('birthday_date') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-6">
                                    <div class="card card-white">
                                        <div class="card-header ">
                                            <div class="card-title">Informations sportive
                                            </div>
                                        </div>
                                        <div class="card-block pt-0">
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('age') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Age</label>
                                                        <input type="text" value="{{ $coach->age }}"
                                                               class="form-control" name="age">
                                                        @if ($errors->has('age'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('age') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('height') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Taille</label>
                                                        <input type="text" value="{{ $coach->height }}"
                                                               class="form-control" name="height">
                                                        @if ($errors->has('height'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('height') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('weight') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Poids</label>
                                                        <input type="text" value="{{ $coach->weight }}"
                                                               class="form-control" name="weight">
                                                        @if ($errors->has('weight'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('weight') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    @if($coach->getActivitys)
                                                        <div class="form-group form-group-default"
                                                             aria-required="true">
                                                            <label>Compétences sportives</label>
                                                            <select name="activity[]" class="form-control" id=""
                                                                    multiple>
                                                                @foreach(\App\Models\SoftSkill::all() as $skill)
                                                                    <option
                                                                        value="{{$skill->id}}" {{ $coach->getActivitys->contains($skill->id) ? 'selected="selected"' : '' }}>{{ $skill->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            Actuelle : {{ implode(', ', $coach->getActivitys->map(function($item){
                                                                    return ucfirst($item->name);
                                                                })->toArray()) }}
                                                        </div>
                                                    @endif
                                                    @if($coach->getSkills)
                                                        <div class="form-group form-group-default"
                                                             aria-required="true">
                                                            <label>Traits de caractère</label>
                                                            <select name="skill[]" class="form-control" id="" multiple>
                                                                @foreach(\App\Models\Skill::all() as $skill)
                                                                    <option
                                                                        value="{{$skill->id}}" {{ $coach->getSkills->contains($skill) ? 'selected="selected"' : '' }}>{{ $skill->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            Actuelle : {{ implode(', ', $coach->getSkills->map(function($item){
                                                                return $item->name;
                                                            })->toArray()) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-white">
                                        <div class="card-header ">
                                            <div class="card-title">Informations facturation
                                            </div>
                                        </div>
                                        <div class="card-block pt-0">
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('siret') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Siret</label>
                                                        <input type="text" value="{{ $coach->siret }}"
                                                               class="form-control" name="siret">
                                                        @if ($errors->has('siret'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('siret') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('iban') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>IBAN</label>
                                                        <input type="text" value="{{ $coach->iban }}"
                                                               class="form-control" name="iban">
                                                        @if ($errors->has('iban'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('iban') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="tab-pane" id="tab-clients" aria-expanded="false">
                            <div class="row">
                                <div class="col-xl-5 col-lg-6 ">
                                    @foreach($coach->getClients()->get() as $client)
                                        <div data-id="{{ $client['id']  }}" class="card card-product client_threads">
                                            <div class="card-header ">
                                                <div class="card-title">Client :
                                                    #CL{{str_pad($client['id'], 5, '0', STR_PAD_LEFT)}}</div>
                                            </div>
                                            <div class="card-block d-flex flex-column align-items-start ">
                                                <b> {{ $client['name'] }} {{ $client['first_name'] }} </b>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-scéances" aria-expanded="false">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">

                                    <div class="card card-white ">
                                        <div class="card-header cursor " id="headerPanning">
                                            <div class="card-title"><strong>Scéances à venir :</strong>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                        @foreach($coach->getSeancesIncomming as $seance)

                                        <div class="form-group form-group-default seanceClick"
                                            aria-required="true" data-id="{{$seance->id}}"
                                            data-date="{{ \Carbon\Carbon::parse($seance->start_at)->format('m-d-Y') }}">
                                            <div
                                                class="d-flex align-items-center justify-content-between mb-2">
                                                <label class="text-black">Seance de <b
                                                        class="text-orange">{{$seance->getSeance ? $seance->getSeance->name : '-'}}</b>
                                                    avec
                                                    <b class="text-orange">{{ $seance->getCoach->name }}</b></label>
                                                <span
                                                    class="badge {{ $seance->isEnd() ? 'badge-danger' : 'badge-success'}}">{{ $seance->isEnd() ?'Finis' : 'A venir' }}</span>
                                            </div>
                                            <span class="text-primary">Début</span>
                                            : {{ \Carbon\Carbon::parse($seance->start)->toDateString() }}
                                            <b
                                                class="px-2">|</b>
                                            <span class="text-primary">Heure</span>
                                            : {{ \Carbon\Carbon::parse($seance->start)->toTimeString() }}
                                            <b
                                                class="px-2">|</b>
                                            <span class="text-primary">Temps </span>
                                            : {{ $seance->time }} min
                                        </div>
                                        @endforeach


                                        </div>

                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6">

                                    <div class="card card-white ">
                                        <div class="card-header cursor " id="headerPanning">
                                            <div class="card-title"><strong>Historique :</strong></div>
                                        </div>
                                        <div class="card-block">
                                            @foreach($coach->getSeancesPassed as $seance)
                                                    <div class="form-group form-group-default seanceClick "
                                                        aria-required="true" data-id="{{$seance->id}}"
                                                        data-date="{{ \Carbon\Carbon::parse($seance->start_at)->format('m-d-Y') }}">
                                                        <div
                                                            class="d-flex align-items-center justify-content-between mb-2">
                                                            <label class="text-black">Seance de <b
                                                                    class="text-orange">{{$seance->getSeance ? $seance->getSeance->name : '-' }}</b>
                                                                avec
                                                                <b class="text-orange">{{ $seance->getCoach->name }}
                                                                    - {{ $seance->getCoach->first_name }}</b></label>
                                                            <span
                                                                class="badge {{ $seance->isEnd() ? 'badge-danger' : 'badge-success'}}">{{ $seance->isEnd() ?'Finis' : 'A venir' }}</span>
                                                        </div>
                                                        <span class="text-primary">Début</span>
                                                        : {{ \Carbon\Carbon::parse($seance->start)->toDateString() }}
                                                        <b
                                                            class="px-2">|</b>
                                                        <span class="text-primary">Heure</span>
                                                        : {{ \Carbon\Carbon::parse($seance->start)->toTimeString() }}
                                                        <b
                                                            class="px-2">|</b>
                                                        <span class="text-primary">Temps </span>
                                                        : {{ $seance->time ? $seance->time : ''}} min
                                                    </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-alertes" aria-expanded="false">
                            <div class="row">

                                <table class="w-100 table table-hover demo-table-search table-responsive-block"
                                       id="tableWithSearch">
                                    <thead>
                                    <tr>
                                        <th>Idd</th>

                                        <th>date</th>
                                        <th>Statut</th>
                                        <th>Contenu</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-invoices" aria-expanded="true">
                            <div class="row">

                                <table class="w-100 table table-hover demo-table-search table-responsive-block"
                                       id="tableWithSearch">
                                    <thead>
                                    <tr>
                                        <th>Id</th>                       
                                        <th>Date</th>
                                        <th>Nombre Seance</th>
                                        <th>Time unit</th>
                                        <th>Total</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($coach->getInvoices() as $invoice)
                                        <tr class="cursor">
                                            <td class=" semi-bold text-center {{!$invoice->validate ? '' : 'validate'}}">
                                                {{$invoice->year}}{{$invoice->month}}-{{$invoice->id}}
                                            </td>
                                            <td class="{{!$invoice->validate ? '' : 'validate'}}">
                                                {{$invoice->ordered_at}}            
                                            </td>
                                            <td class=" semi-bold text-center {{!$invoice->validate ? '' : 'validate'}}">
                                                {{ $invoice->nb_seances}}
                                            </td>
                                            <td class=" semi-bold text-center {{!$invoice->validate ? '' : 'validate'}}">
                                                {{ $invoice->nb_time_unit}}
                                            </td>
                                            <td class=" semi-bold text-center {{!$invoice->validate ? '' : 'validate'}}">
                                                {{ $invoice->total_price}} €
                                            </td>
                                            <td class=" semi-bold text-center {{!$invoice->validate ? '' : 'validate'}}">
                                            <a target="_blank"
                                                   href="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'pdf'], $invoice->id) }}"
                                                   class="btn btn-primary">Télécharger</a>
                                                   @if(!$invoice->validate)
                                                   <a target="_blank"
                                                   href="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'regenerateInvoice'], $invoice->id) }}"
                                                   class="btn btn-primary">Régénérer</a>
                                                   @endif
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


@section('js')
    <script src="{{ asset('pages-assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-typehead/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-typehead/typeahead.jquery.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('select').select2();
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
