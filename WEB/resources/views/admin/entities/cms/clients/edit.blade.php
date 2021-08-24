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
                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'index']) }}">Mes
                        clients</a>
                </li>
                <li class="breadcrumb-item active">#CL{{str_pad($client->id, 5, '0', STR_PAD_LEFT)}}
                    -{{$client->name}}</li>
            </ol>

            <div>

                <div class="card card-transparent ">
                    <div class="row mx-1 my-3">
                        <div class="col-12 text-right">
                            <a href="{{ action([\App\Http\Controllers\Admin\Cms\ProductController::class, 'assing'], ['client' => $client->id]) }}"
                               class="btn btn-primary">
                                Faire une vente
                            </a>
                            <a href="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'planning']) }}"
                               class="btn btn-primary">Voir le planning</a>
                            <a href="{{ action([\App\Http\Controllers\SeanceController::class, 'create'], ['client'=> $client->id]) }}"
                               class="btn btn-primary">Crée une séance</a>
                            <a href="{{ action([\App\Http\Controllers\Admin\Cms\WallOfferController::class,'create'], ['id' =>$client->id]) }}"
                               class="btn btn-primary">Crée une annonce</a>
                            <a href="{{ action([\App\Http\Controllers\Admin\Cms\AlertController::class, 'create'], ['user' =>$client->id]) }}"
                               class="btn btn-primary">Crée une alerte</a>
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
                            <a href="#" data-toggle="tab" data-target="#tab-produit"
                               aria-expanded="false"><span>Pack / Abonnement ({{ count($client->getProduct()) }})</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" data-target="#tab-offers" class=""
                               aria-expanded="false"><span>Offres ({{ count($client->getOffersNotFound)}}) </span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" data-target="#tab-scéances" class=""
                               aria-expanded="false"><span>Scéances ({{ count($client->getSeancesIncomming)}}) </span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" data-target="#tab-factures" class=""
                               aria-expanded="false"><span>Factures ({{ count($client->getFactures())}})</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" data-target="#tab-banque" class=""
                               aria-expanded="false"><span>Informations bancaire</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" data-target="#tab-alertes" class=""
                               aria-expanded="false"><span>Alertes ({{countNotif($client->id)}})</span></a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane" id="tab-banque" aria-expanded="true">
                            <div class="d-flex">
                                @if($client->getSepa)
                                    <a target="_blank"
                                       href="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'showSepa'], $client->id) }}"
                                       class="btn btn-primary">Voir le sepa</a>

                                @else
                                    <form id="sepaForm"
                                          action="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'sepa'], $client->id) }}"
                                          method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="parent-div">
                                            <button class="btn-upload btn btn-primary">Uploader le sepa</button>
                                            <input type="file" id="file" name="upfile"/>
                                        </div>
                                    </form>
                                @endif
                            </div>
                            <form
                                action="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'sepa'], $client->id) }}"
                                method="POST" class="row">
                                {{ csrf_field() }}
                                <div class="col-xl-12 col-lg-12 ">
                                    <div class="card card-white">
                                        <div class="card-header">
                                            <div class="card-title">
                                                Informations bancaire
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <div class="row clearfix">
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-default"
                                                         aria-required="true">
                                                        <label>Iban</label>
                                                        <input type="text" class="form-control" name="iban"
                                                               value="{{ $client->iban }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-default"
                                                         aria-required="true">
                                                        <label>BIC</label>
                                                        <input type="text" class="form-control" name="bic"
                                                               value="{{ $client->bic }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-default"
                                                         aria-required="true">
                                                        <label>jour mensuel de prélévement</label>
                                                        <select name="date" id="" class="form-control select">
                                                            @foreach(range(1,31) as $day)
                                                                <option value="{{ $day }}">{{ $day }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-6">
                                                    <button class="mt-2 btn btn-primary">Enregistrer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane active" id="tab-infos" aria-expanded="true">
                            <form class="row" method="POST"
                                  action="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'update'], $client->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <div class="col-xl-7 col-lg-6 ">
                                    <div class="card card-white">
                                        <div class="card-header">
                                            <div class="row clearfix flex-column align-items-start">
                                                <div class="mb-4">
                                                    <button class="btn btn-primary">Enregistrer</button>
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
                                                                   {{ $client->active ? "checked" : ""}}
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
                                                                           {{ $client->sexe === "h" ? 'checked="checked"' :'' }}
                                                                           name="sexe" id="sexe_homme" value="h">
                                                                    <label for="sexe_homme">Homme</label>
                                                                </div>
                                                                <div class="d-table-cell px-2">
                                                                    <input type="radio"
                                                                           {{ $client->sexe === "f" ? 'checked="checked"' :'' }} name="sexe"
                                                                           id="sexe_femme" value="f" required>
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
                                                        <span class="text-primary">
                                                        {!!  getStatusClient($client) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div class="form-group form-group-default"
                                                         aria-required="true">
                                                        <label>Inscrit le </label>
                                                        <span class="text-primary">
                                                        {!!  $client->created_at !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('name') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Nom *</label>
                                                        <input type="text" value="{{ $client->name ?? old('name')}}"
                                                               class="form-control" name="name" required>
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
                                                        class="form-group form-group-default {{ $errors->has('first_name') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Prénom *</label>
                                                        <input type="text"
                                                               value="{{ $client->first_name ?? old('first_name')}}"
                                                               class="form-control" name="first_name" required>
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
                                                        class="form-group form-group-default {{ $errors->has('email') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Email *</label>
                                                        <input type="text" value="{{ $client->email ?? old('email')}}"
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
                                                        class="form-group form-group-default {{ $errors->has('tel') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Tel</label>
                                                        <input type="tel" value="{{ $client->tel ?? old('tel')}}"
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
                                                        class="form-group form-group-default {{ $errors->has('tel_2') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Tel portable</label>
                                                        <input type="tel" value="{{ $client->tel_2 ?? old('tel_2')}}"
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
                                                        class="form-group form-group-default {{ $errors->has('address') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Adresse</label>
                                                        <input type="text"
                                                               value="{{ $client->address ?? old('address')}}"
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
                                                        class="form-group form-group-default {{ $errors->has('postalCode') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Code postal</label>
                                                        <input type="number"
                                                               value="{{ $client->postalCode ?? old('postalCode')}}"
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
                                                        class="form-group form-group-default {{ $errors->has('city') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Ville</label>
                                                        <input type="text" value="{{ $client->city ?? old('city')}}"
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
                                                        class="form-group form-group-default {{ $errors->has('job') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Proffession</label>
                                                        <input type="text" value="{{ $client->job ?? old('job')}}"
                                                               class="form-control" name="job">
                                                        @if ($errors->has('job'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('job') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('birthday_date') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Date de naissance</label>
                                                        <input type="date"
                                                               value="{{ $client->birthday_date ?? old('birthday_date')}}"
                                                               class="form-control" name="birthday_date">
                                                        @if ($errors->has('birthday_date'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('birthday_date') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div class="form-group form-group-default"
                                                         aria-required="true">
                                                        <label>Antécédants médicaux</label>
                                                        <textarea type="text" class="form-control editor"
                                                                  name="medical_content"
                                                                  placeholder="Antécédants médicaux du client"
                                                                  style="height: 100px;"
                                                                  required>{{ $client->medical_content }}</textarea>
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
                                                        {{$client->age}}

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('height') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Taille (cm)</label>
                                                        <input type="number"
                                                               value="{{ $client->height ?? old('height')}}"
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
                                                        <label>Poids (kg)</label>
                                                        <input type="number"
                                                               value="{{ $client->weight ?? old('weight')}}"
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
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('sport') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Sport pratiqué</label>
                                                        <input type="text" value="{{ $client->sport ?? old('sport')}}"
                                                               class="form-control" name="sport">
                                                        @if ($errors->has('sport'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('sport') }}</strong>
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-white">
                                        <div class="card-header ">
                                            <div class="card-title">Besoins
                                            </div>
                                        </div>
                                        <div class="card-block pt-0">
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div class="form-group form-group-default"
                                                         aria-required="true">
                                                        <label>Objectif Sportif</label>
                                                        <select name="activity[]" id="select" class="form-control"
                                                                multiple>
                                                            @foreach(\App\Models\Activity::all() as $s)
                                                                <option
                                                                    value="{{ $s->id }}" {{ $client->sport_objectif === $s->name ? 'selected="selected"' : '' }}>{{ $s->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        Actuelle : {{ implode(', ', $client->getActivity->map(function($item){
                                                                    return ucfirst($item->name);
                                                                })->toArray()) }}

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('precision_sportif') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Précision Objectif</label>
                                                        <input type="text"
                                                               value="{{ $client->precision_sportif ?? old('precision_sportif')}}"
                                                               class="form-control" name="precision_sportif">
                                                        @if ($errors->has('precision_sportif'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('precision_sportif') }}</strong>
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('precision_sportif') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Motivation</label>
                                                        <input type="text"
                                                               value="{{ $client->motivation ?? old('motivation')}}"
                                                               class="form-control" name="precision_sportif">
                                                        @if ($errors->has('precision_sportif'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('precision_sportif') }}</strong>
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('coaching_place') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Lieu de coaching</label>
                                                        <input type="text"
                                                               value="{{ $client->coaching_place ?? old('coaching_place')}}"
                                                               class="form-control" name="coaching_place">
                                                        @if ($errors->has('coaching_place'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('coaching_place') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('nb_coaching') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Fréquence de coaching souhaité</label>
                                                        <input type="string"
                                                               value="{{ $client->nb_coaching ?? old('nb_coaching')}}"
                                                               class="form-control" name="nb_coaching">
                                                        @if ($errors->has('nb_coaching'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('nb_coaching') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('materiel_sportif') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>Matériel Sportif</label>
                                                        <input type="text"
                                                               value="{{ $client->materiel_sportif ?? old('materiel_sportif')}}"
                                                               class="form-control" name="materiel_sportif">
                                                        @if ($errors->has('materiel_sportif'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('materiel_sportif') }}</strong>
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card card-white">
                                        <div class="card-header ">
                                            <div class="card-title">Vos coachs :
                                                <span
                                                    class="badge badge-info ml-2">{{ count($client->getCoach()->get()) }}</span>
                                            </div>
                                        </div>
                                        @foreach($client->getCoach()->get() as $coach)
                                            <div
                                                class="card-block d-flex flex-column align-items-start justify-content-center pb-0 pt-0">
                                                <b class="d-flex justify-content-center align-items-center">
                                                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'show'],$coach->id) }}">{{ $coach->name}} {{ $coach->first_name}}</a>
                                                    <span id="deleteCoach" data-client="{{$client->id}}"
                                                          data-coach="{{$coach->id}}"
                                                          class="cursor icon-thumbnail"><i
                                                            class="fa fa-close"></i></span>
                                                </b>
                                            </div>
                                        @endforeach

                                        <div class="card-header ">
                                            <div class="card-title">Nouveaux coachs :
                                            </div>
                                        </div>

                                        <div class="w-100 card-block d-flex flex-column align-items-start ">
                                            {{ csrf_field() }}
                                            <div class="row clearfix w-100">
                                                <div class="col-md-12">
                                                    <div class="w-100 form-group form-group-default"
                                                         aria-required="true">
                                                        <select name="coach" class="select w-100" id="inputCoach">
                                                            @foreach(\App\Models\Coach::Active()->notMyCoach($client->id)->get() as $coach)
                                                                <option
                                                                    value="{{$coach->id}}">{{ $coach->first_name }} {{ $coach->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <br>
                                                        <br>
                                                        <button class="btn-primary btn" id="btnCoach"
                                                                data-client="{{ $client->id }}">Enregistré
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-white">
                                        <div class="card-header">
                                            <div class="card-title">
                                                Synchronisation Wordpress
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <div class="row clearfix">
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group form-group-default {{ $errors->has('id_client') ? 'has-error' : '' }}"
                                                        aria-required="true">
                                                        <label>ID client Wordpress</label>
                                                        <input type="text"
                                                               value="{{ $client->id_client ?? old('id_client')}}"
                                                               class="form-control" name="id_client">
                                                        @if ($errors->has('id_client'))
                                                            <div class="help-block">
                                                                <strong>{{ $errors->first('id_client') }}</strong>
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
                        <div class="tab-pane" id="tab-produit" aria-expanded="false">
                            <div class="row">
                                @foreach($client->getProduct() as $product)
                                    @if($product instanceof \App\Models\ProductUser)
                                        <div class="col-md-6">
                                            <div class="card card-product">
                                                <div class="card-header ">
                                                    <div
                                                        class="card-title d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <b>Produit</b> :
                                                            #P{{str_pad($product->id, 5, '0', STR_PAD_LEFT)}}
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            @if((int)unitUse($product, $client->id) >= $product->time_unit)
                                                                <span
                                                                    class="badge badge-danger">
                                                            Produit épuisé
                                                        </span>
                                                            @else
                                                                <span
                                                                    class="badge {{ $product->stop ? 'badge-danger' : 'badge-success' }}">
                                                            {{ $product->stop ? 'Produit arréter' : 'Produit en cours' }}
                                                        </span>
                                                            @endif
                                                            <a class="text-primary icon ml-3 cursor"
                                                               href="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'editProduct'],[$client->id, $product->id]) }}"><i
                                                                    class="fa fa-edit"></i></a>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="card-block d-flex flex-column align-items-start ">
                                                    <div class="mt-2">
                                                        <hr>
                                                        <div class="card-title">Valeurs Initiales du produit</div>
                                                        <b>
                                                            {{ $product->name }}
                                                        </b>
                                                        <p>
                                                        <div class="my-1">-
                                                            <b>Prix</b>
                                                            (en euros) :
                                                            <span
                                                                class="badge badge-info badge-product">{{ $product->init_price }}€</span>
                                                        </div>
                                                        <div class="my-1">-
                                                            <b>Acheté le </b>:
                                                            <span class="badge badge-info badge-product">{{ $product->created_at }}</span>
                                                        </div>
                                                        <div class="my-1">-
                                                            <b>Commencé le </b>:
                                                            <span class="badge badge-info badge-product">{{ $product->start_abonnement }}</span>
                                                        </div>
                                                        <div class="my-1">-
                                                            <b>{{ $product->type === \App\Models\Product::ABONNEMENT ? 'Engagement' : 'Validité' }}</b>
                                                            (en mois) :
                                                            <span
                                                                class="badge badge-info badge-product">{{ countMonth($product->created_at, $product->init_validity) }} mois </span>
                                                            <span
                                                                class="badge badge-info badge-product">Fin le {{ $product->init_validity }}</span>
                                                        </div>

                                                        <div class="my-1">-
                                                            <b>Nombre de payeur</b>
                                                            (en nombre) :

                                                            <span
                                                                class="badge badge-info badge-product">{{ $product->init_buyer }}</span>
                                                        </div>
                                                        <div class="my-1">-
                                                            <b>{{ $product->type === \App\Models\Product::ABONNEMENT ? \App\Models\Product::TIME_UNIT_ABONNEMENT : \App\Models\Product::TIME_UNIT }} </b>
                                                            (en tranche de 30 min) :

                                                            <span
                                                                class="badge badge-info badge-product">{{ $product->init_time_unit }}</span>
                                                        </div>
                                                        </p>
                                                    </div>
                                                    <div class="mt-2">
                                                        <hr>
                                                        <div class="card-title">Valeurs actuelles du produit</div>

                                                        <p>
                                                        <div class="my-1">-
                                                            <b>Prix</b>
                                                            (en euros) :
                                                            <span
                                                                class="badge badge-info badge-product">{{ $product->price }} €</span>
                                                        </div>
                                                        <div class="my-1">-
                                                            <b>{{ $product->type === \App\Models\Product::ABONNEMENT ? 'Engagement' : 'Validité' }}</b>
                                                            (en mois) :
                                                            <span
                                                                class="badge badge-info badge-product">{{ countMonth($product->created_at, $product->validity) }} mois </span>
                                                            <span
                                                                class="badge badge-info badge-product">Fin le {{ $product->validity }}</span>
                                                        </div>
                                                        <div class="my-1">-
                                                            <b>Nombre de payeur</b>
                                                            (en nombre) :

                                                            <span
                                                                class="badge badge-info badge-product">{{ $product->buyer }}</span>
                                                        </div>
                                                        <div class="my-1">-
                                                            <b>{{ $product->type === \App\Models\Product::ABONNEMENT ? \App\Models\Product::TIME_UNIT_ABONNEMENT : \App\Models\Product::TIME_UNIT }} </b>
                                                            (en tranche de 30 min) :
                                                            <span
                                                                class="badge badge-info badge-product">{{ $product->time_unit }}</span>
                                                        </div>
                                                        </p>
                                                    </div>
                                                    <div class="mt-2">
                                                        <hr>
                                                        <div class="card-title font-weight-bold">Utilisation (en tranche de 30 min) :</div>
                                                        <div class="my-1">-
                                                            <b>{{ $product->type === \App\Models\Product::ABONNEMENT ? \App\Models\Product::TIME_UNIT_ABONNEMENT : \App\Models\Product::TIME_UNIT }} </b>
                                                            utilisées {{ $product->type === \App\Models\Product::ABONNEMENT ? 'ce mois-ci :' : '' }}
                                                            <span class="badge badge-info badge-product">{{ unitUse($product, $client->id) }} / {{ $product->time_unit }}  PROGRAMMEE</span>
                                                            <span class="badge badge-info badge-product">{{ unitUseProgram($product, $client->id) }} / {{ $product->time_unit }} REEL</span>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-6">
                                            <div class="card card-product">
                                                <div class="card-header ">
                                                    <div class="card-title">Produit :
                                                        #P{{str_pad($product['id'], 5, '0', STR_PAD_LEFT)}}</div>
                                                </div>

                                                <div class="card-block d-flex flex-column align-items-start ">
                                                    <b>
                                                        {{ $product['name'] }}
                                                    </b>
                                                    <div class="mt-2">

                                                        <div class="card-title">Options</div>

                                                        <p>
                                                        @foreach($product['options'] as $option )
                                                            <div class="my-1">- <b>{{ $option->name }}</b>
                                                                (en {{ $option->unit }}) : <span
                                                                    class="badge badge-info">{{ $option->value }}</span>
                                                            </div>
                                                            @endforeach
                                                            </p>
                                                    </div>
                                                    {{--                                <img src="{{ $event->getFile ? $event->getFile->file : 'N/A' }}" alt="" height="250">--}}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-scéances" aria-expanded="false">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">

                                    <div class="card card-white ">
                                        <div class="card-header cursor " id="headerPanning">
                                            <div class="card-title">Scéances à venir :</strong>
                                            </div>
                                        </div>

                                        <div class="card-block">
                                            @foreach($client->getSeancesIncomming as $seance)

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
                                            <div class="card-title">Historique :</strong>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            @foreach($client->getSeancesPassed as $seance)
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
                        <div class="tab-pane" id="tab-offers" aria-expanded="false">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">

                                    <div class="card card-white ">
                                        <div class="card-header cursor " id="headerPanning">
                                            <div class="card-title">Offres en attente :</strong>
                                            </div>
                                        </div>

                                        <div class="card-block">
                                            @foreach($client->getOffersPending as $offer)

                                                <div class="form-group form-group-default "
                                                     aria-required="true">
                                                    #OF{{ $offer->id ? str_pad($offer->id, 5, '0', STR_PAD_LEFT) : 'XXX'}}
                                                    -- {{$offer->getSeance->name}}
                                                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\WallOfferController::class, 'edit'],$offer->id) }}"
                                                       class="btn btn-primary float-right">Voir l'offre</a></div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6">
                                    <div class="card card-white ">
                                        <div class="card-header cursor " id="headerPanning">
                                            <div class="card-title">Offres en cours :</strong>
                                            </div>
                                        </div>

                                        <div class="card-block">
                                            @foreach($client->getOffersNotFound as $offer)
                                                <div class="form-group form-group-default "
                                                     aria-required="true">
                                                    OF{{ $offer->id ? str_pad($offer->id, 5, '0', STR_PAD_LEFT) : 'XXX'}}
                                                    -- {{$offer->getSeance->name}}
                                                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\WallOfferController::class, 'edit'],$offer->id) }}"
                                                       class="btn btn-primary float-right">Voir l'offre</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-factures" aria-expanded="false">
                            <div class="row">
                                <table class="w-100 table table-hover demo-table-search table-responsive-block"
                                       id="tableWithSearch">
                                    <thead>
                                    <tr>
                                        {{--                            <th>Identifiant</th>--}}
                                        <th class="idcolumn">Id</th>
                                        <th>date</th>
                                        <th>Type</th>
                                        <th>Produit</th>
                                        <th>HT</th>
                                        <th>TVA</th>
                                        <th>TTC</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($client->getFactures() AS $facture)
                                        <tr data-id="{{ $facture['id'] }}" class="cursor facture_theard">
                                            <td class="v-align-middle idcolumn">
                                            {{$facture->year}}{{str_pad($facture->month, 2, '0', STR_PAD_LEFT)}}-{{$facture->id}}</td>
                                            <td class="v-align-middle">
                                            {{$facture->ordered_at}}
                                            </td>
                                            <td class="v-align-middle">
                                            {{$facture->getProductUser()->first()->type}}
                                            </td>
                                            <td class="v-align-middle">
                                            #P{{str_pad($facture->fk_product_user_id, 5, '0', STR_PAD_LEFT)}} - {{$facture->description}} - {{DateTime::createFromFormat('!m', $facture->month)->format('F')}} {{$facture->year}}</td>
                                            <td class="v-align-middle">
                                            {{round($facture->mustcoach_part+$facture->coach_part,2)}} €</td>
                                            <td class="v-align-middle">
                                            {{round($facture->mustcoach_part_tva, 2)}} €</td>
                                            <td class="v-align-middle">
                                            {{round($facture->total_price, 2)}} €</td>
                                            <td class="v-align-middle semi-bold">
                                                <a target="_blank"
                                                   href="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'pdf'], $facture->id) }}"
                                                   class="btn btn-primary">Télécharger</a>
                                                   <a target="_blank"
                                                   href="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'regenerateInvoice'], $facture->id) }}"
                                                   class="btn btn-primary">Régénérer</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-alertes" aria-expanded="false">
                            <div class="row">

                                <table class="w-100 table table-hover demo-table-search table-responsive-block"
                                       id="tableWithSearch">
                                    <thead>
                                    <tr>
                                        {{--                            <th>Identifiant</th>--}}
                                        <th>Id</th>
                                        <th>date</th>
                                        <th>Statut</th>
                                        <th>Contenu</th>
                                        {{--                            <th>Actions</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($client->getAlertes AS $key => $item)
                                        <tr data-id="{{ $item->id }}" class="cursor alertes_threads">
                                            <td class="v-align-middle">
                                                #F{{str_pad($item->id, 5, '0', STR_PAD_LEFT)}}</td>
                                            <td class="v-align-middle">{{ $item->trigger }}</td>
                                            <td class="v-align-middle">

                                                {{\Carbon\Carbon::now()->isAfter($item->trigger) ? 'Finis' : 'En cours'}}
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
            </div>
        </div>
        <form id="form"
              action="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'filterPlanning']) }}"
              class="d-none" method="POST">
            {{ csrf_token() }}
            <input type="hidden" value="{{$client->id}}" name="client">
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
                $('select').select2()

                $('#myDatepicker').datepicker();
                $('#timepicker').timepicker().on('show.timepicker', function (e) {
                    var widget = $('.bootstrap-timepicker-widget');
                    widget.find('.glyphicon-chevron-up').removeClass().addClass('pg-arrow_maximize');
                    widget.find('.glyphicon-chevron-down').removeClass().addClass('pg-arrow_minimize');
                });

                function onOff(it) {
                    if ($(it).is(":checked")) {
                        $('#activeClient').prop("checked", false);
                    } else {
                        $('#activeClient').prop("checked", true);

                    }
                }

                $(document).ready(function () {
                    $('.alertes_threads').on('click', function () {
                        const id = $(this).data('id');
                        console.log(id, '----');

                        window.location = '/alerts/' + id + '/edit';
                    });
                });

                var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
                // Success color: #10CFBD
                elems.forEach(function (html) {
                    var switchery = new Switchery(html, {color: '#10CFBD'});
                });
            </script>
            <script>
                $(document).ready(function () {

                    $('.seanceClick').on('click', function () {
                        const id = $(this).data('date');
                        const idSeance = $(this).data('id');
                        window.location.href = "/plannings?date=" + id + '&seance=' + idSeance;
                    });

                    $('#deleteCoach').on('click', function () {
                        const coach = $(this).data('coach');
                        const client = $(this).data('client');
                        console.log(coach);
                        $.ajax({
                            url: `/clients/coach/delete/${client}/${coach}`,
                            type: 'POST',
                            dataType: 'json',
                            success: function (data, status) {
                                console.log(data);
                                if (data[0] === "succes") {
                                    notie.alert(1, 'Coach Supprimée', 8);
                                    window.location.reload()
                                }
                            },
                            error: function (result, status, error) {
                                console.log(result);
                            }
                        })
                    })

                    $('#btnCoach').on('click', function () {
                        const coach = $('#inputCoach').val();
                        const client = $(this).data('client');
                        $.ajax({
                            url: `/clients/coach/${client}/`,
                            type: 'POST',
                            data: {
                                'coach': coach
                            },
                            dataType: 'json',
                            success: function (data, status) {
                                console.log(data);
                                if (data[0] === "succes") {
                                    notie.alert(1, 'Coach attribué', 8);
                                    window.location.reload()
                                }
                            },
                            error: function (result, status, error) {
                                console.log(result);
                            }
                        })
                    });

                    $('#myDatepicker').datepicker();
                    $('#timepicker').timepicker().on('show.timepicker', function (e) {
                        var widget = $('.bootstrap-timepicker-widget');
                        widget.find('.glyphicon-chevron-up').removeClass().addClass('pg-arrow_maximize');
                        widget.find('.glyphicon-chevron-down').removeClass().addClass('pg-arrow_minimize');
                    });

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
