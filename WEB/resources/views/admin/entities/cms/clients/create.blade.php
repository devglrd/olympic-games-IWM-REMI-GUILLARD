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
                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'index']) }}">Clients</a>
                </li>
                <li class="breadcrumb-item active">Ajouter un client</li>
            </ol>

            <form action="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'store']) }}"
                  method="POST"
                  data-toggle="validator"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="card card-transparent">
                        <div class="card-block">
                            <button type="submit" class="btn btn-primary btn-cons">
                                Ajouter
                            </button>
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row">
                    <div class="col-xl-7 col-lg-6 ">
                        <div class="card card-white">
                            <div class="card-header">
                                <div class="row clearfix flex-column align-items-start">
                                    <div class="row w-100">
                                        <div class="col-md-6">
                                            <div class="card-title">
                                                Information d'identité
                                            </div>
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
                                                               {{ old('sexe') === "h" ? 'checked="checked"' :'' }}
                                                               name="sexe" id="sexe_homme" value="h">
                                                        <label for="sexe_homme">Homme</label>
                                                    </div>
                                                    <div class="d-table-cell px-2">
                                                        <input type="radio"
                                                               {{ old('sexe') === "f" ? 'checked="checked"' :'' }}
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
                                        <div class="form-group form-group-default {{ $errors->has('name') ? 'has-error' : '' }} "
                                             aria-required="true">
                                            <label>Nom *</label>

                                            <input type="text" class="form-control" name="name" value="{{old("name")}}"
                                                   placeholder="Nom de famille"
                                                   required>
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
                                        <div class="form-group form-group-default {{ $errors->has('first_name') ? 'has-error' : '' }} "
                                             aria-required="true">
                                            <label>Prénom *</label>
                                            <input type="text" class="form-control" name="first_name" value="{{old("first_name")}}"
                                                   placeholder="Prénom"
                                                   required>
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
                                        <div class="form-group form-group-default {{ $errors->has('email') ? 'has-error' : '' }}"
                                             aria-required="true">
                                            <label>Email *</label>
                                            <input type="text" class="form-control" name="email" value="{{old("email")}}"
                                                   placeholder="email"
                                                   required>
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
                                        <div class="form-group form-group-default {{ $errors->has('tel') ? 'has-error' : '' }}"
                                             aria-required="true">
                                            <label>Tel</label>
                                            <input type="tel" class="form-control" name="tel" value="{{old("tel")}}"
                                                   placeholder="numéro de téléphone">
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
                                        <div class="form-group form-group-default {{ $errors->has('tel_2') ? 'has-error' : '' }}"
                                             aria-required="true">
                                            <label>Tel portable</label>
                                            <input type="tel" class="form-control" name="tel_2" value="{{old("tel_2")}}"
                                                   placeholder="numéro de téléphone portable">
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
                                        <div class="form-group form-group-default {{ $errors->has('address') ? 'has-error' : '' }}"
                                             aria-required="true">
                                            <label>Adresse</label>
                                            <input type="text" class="form-control" name="address" value="{{old("address")}}"
                                                   placeholder="Nom et Numéro de voie">
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
                                        <div class="form-group form-group-default {{ $errors->has('address') ? 'has-error' : '' }}"
                                             aria-required="true">
                                            <label>Code postal</label>
                                            <input type="text" class="form-control" name="postalCode" value="{{old("postalCode")}}"
                                                   placeholder="Code postale">
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
                                        <div class="form-group form-group-default {{ $errors->has('city') ? 'has-error' : '' }}"
                                             aria-required="true">
                                            <label>Ville</label>
                                            <input type="text" class="form-control" name="city" value="{{old("city")}}"
                                                   placeholder="Votre ville">
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
                                        <div class="form-group form-group-default {{ $errors->has('job') ? 'has-error' : '' }}"
                                             aria-required="true">
                                            <label>Proffession</label>
                                            <input type="text" class="form-control" name="job" value="{{old("job")}}"
                                                   placeholder="Proffession">
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
                                        <div class="form-group form-group-default {{ $errors->has('birthday_date') ? 'has-error' : '' }}"
                                             aria-required="true">
                                            <label>Date de naissance</label>
                                            <input type="date" class="form-control" name="birthday_date" value="{{old("birthday_date")}}"
                                                   placeholder="Date de naissance">
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
                                        <div class="form-group form-group-default "
                                             aria-required="true">
                                            <label>Antécédants médicaux</label>
                                            <textarea type="text" class="form-control editor"
                                                      name="medical_content"
                                                      placeholder="Antécédants médicaux du client"
                                                      style="height: 100px;"
                                                      required>{{ old('medical_content') }}</textarea>
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
                                        <div class="form-group form-group-default {{ $errors->has('age') ? 'has-error' : '' }}"
                                             aria-required="true">
                                            <label>Age</label>
                                            <input type="number" class="form-control" name="age" value="{{old("age")}}"
                                                   placeholder="Age">
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
                                        <div class="form-group form-group-default {{ $errors->has('height') ? 'has-error' : '' }}"
                                             aria-required="true">
                                            <label>Taille (cm)</label>
                                            <input type="number" class="form-control" name="height" value="{{old("height")}}"
                                                   placeholder="Taille">
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
                                        <div class="form-group form-group-default {{ $errors->has('weight') ? 'has-error' : '' }}"
                                             aria-required="true">
                                            <label>Poids (kg)</label>
                                            <input type="number" class="form-control" name="weight" value="{{old("weight")}}"
                                                   placeholder="Poids">
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
                                        <div class="form-group form-group-default {{ $errors->has('sport') ? 'has-error' : '' }}"
                                             aria-required="true">
                                            <label>Sport pratiqué</label>
                                            <input type="text" class="form-control" name="sport" value="{{old("sport")}}"
                                                   placeholder="Liste de sport pratiqué">
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
                                        <div class="form-group form-group-default "
                                             aria-required="true">
                                            <label>Objectif Sportif</label>
                                            <select name="activity[]" id="select" class="form-control" multiple>
                                                @foreach(\App\Models\Activity::all() as $s)
                                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default {{ $errors->has('precision_sportif') ? 'has-error' : '' }}"
                                            aria-required="true">
                                        <label>Précision Objectif</label>
                                        <input type="text" value="{{ old('precision_sportif')}}" class="form-control" name="precision_sportif">
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
                                        <div class="form-group form-group-default {{ $errors->has('coaching_place') ? 'has-error' : '' }}"
                                             aria-required="true">
                                            <label>Lieu de coaching</label>
                                            <input type="text" class="form-control" name="coaching_place" value="{{old("coaching_place")}}"
                                                   placeholder="Proffession">
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
                                        <div class="form-group form-group-default {{ $errors->has('nb_coaching') ? 'has-error' : '' }}"
                                             aria-required="true">
                                            <label>Fréquence de coaching souhaité</label>
                                            <input type="number" class="form-control" name="nb_coaching" value="{{old("nb_coaching")}}">
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
                                        <div class="form-group form-group-default {{ $errors->has('materiel_sportif') ? 'has-error' : '' }}"
                                             aria-required="true">
                                            <label>Matériel Sportif</label>
                                            <input type="text" class="form-control" name="materiel_sportif" value="{{old("materiel_sportif")}}"
                                                   placeholder="Matériel disponible">
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
                       <!--
                        <div class="card card-white">
                            <div class="card-header">
                                <div class="card-title">
                                    Assigner un coach
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="row clearfix">
                                            <div class="col-md-12">
                                                <div
                                                    class="form-group {{ $errors->has('tel') ? 'has-error' : '' }} form-group-default required"
                                                    aria-required="true">
                                                    <label>Coachs</label>
                                                    <select name="coach" id="select" class="form-control">
                                                        @foreach(\App\Models\Coach::active()->get() as $s)
                                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        -->
                        <div class="card card-white">
                            <div class="card-header">
                                <div class="card-title">
                                   Synchronisation Wordpress
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default {{ $errors->has('id_client') ? 'has-error' : '' }}"
                                                aria-required="true">
                                            <label>ID client Wordpress</label>
                                            <input type="text" class="form-control" name="id_client" value="{{old("id_client")}}"
                                                   placeholder="L'identifiant Wordpress du client">
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
                </div>
            </form>
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
    <script src="{{asset('pages-assets/plugins/moment/moment.min.js')}}"></script>
    <script>
        var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
        // Success color: #10CFBD
        elems.forEach(function (html) {
            var switchery = new Switchery(html, {color: '#10CFBD'});
        });
        $(document).ready(function () {
            $('input[name="birthday_date"]').on('change', function () {
                const val = $(this).val();
                console.log(val);
                const mo = moment(val)
                const now = moment();
                const age = now.diff(mo, 'y');
                console.log(age);
                $('input[name="age"]').val(age);
            });
            $('select').select2();
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
