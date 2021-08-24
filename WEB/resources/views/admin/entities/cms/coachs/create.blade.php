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

    <link media="screen" type="text/css" rel="stylesheet"
          href="{{ asset('pages-assets/assets/plugins/switchery/css/switchery.min.css')}}">
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
                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'index']) }}">Coachs</a>
                </li>
                <li class="breadcrumb-item active">Ajouter un coach</li>
            </ol>
            @if ($errors->any())
                <div class="alert alert-danger my-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>  
            @endif
            <form action="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'store']) }}" method="POST"
                  data-toggle="validator"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xl-7 col-lg-6 ">
                        <div class="card card-transparent">
                            <div class="card-block">
                                <button type="submit" class="btn btn-primary btn-cons">
                                    Ajouter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-7 col-lg-6 ">
                        <div class="card card-white">
                            <div class="card-header">
                                <div class="row clearfix flex-column align-items-start">
                                    <div class="row w-100">
                                        <div class="col-md-6">
                                            <div class="card-title">
                                                Informations d'identité
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
                                                               checked="{{ old('sexe') === "h" ? 'checked' :'' }}"
                                                               name="sexe" id="sexe_homme" value="h">
                                                        <label for="sexe_homme">Homme</label>
                                                    </div>
                                                    <div class="d-table-cell px-2">
                                                        <input type="radio"
                                                               checked="{{ old('sexe') === "f" ? 'checked' :'' }}"
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
                                        <div
                                            class="form-group form-group-default {{ $errors->has('name') ? 'has-error' : '' }} "
                                            aria-required="true">
                                            <label>Nom *</label>
                                            <input type="text" value="{{ old('name') }}"
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
                                            <input type="text" value="{{ old('first_name') }}"
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
                                            <input type="text" value="{{ old('email') }}"
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
                                            <input type="tel" value="{{ old('tel') }}"
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
                                            <input type="tel" value="{{ old('tel_2') }}"
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
                                            <input type="text" value="{{ old('address') }}"
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
                                            <input type="text" value="{{ old('postalCode') }}"
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
                                            <input type="text" value="{{ old('city') }}"
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
                                            <input type="date" value="{{ old('birthday_date') }}"
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
                                            <input type="text" value="{{ old('age') }}"
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
                                            <input type="text" value="{{ old('height') }}"
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
                                            <input type="text" value="{{ old('weight') }}"
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
                                        <div class="form-group form-group-default"
                                             aria-required="true">
                                            <label>Compétences sportives</label>
                                            <select name="activity[]" class="form-control" id="" multiple>
                                                @foreach(\App\Models\SoftSkill::all() as $skill)
                                                    <option
                                                        value="{{$skill->id}}">{{ $skill->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group form-group-default"
                                             aria-required="true">
                                            <label>Traits de caractère</label>
                                            <select name="skill[]" class="form-control" id="" multiple>
                                                @foreach(\App\Models\Skill::all() as $skill)
                                                    <option
                                                        value="{{$skill->id}}">{{ $skill->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
                                            <input type="text" value="{{ old('siret') }}"
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
                                            <label>Iban</label>
                                            <input type="text" value="{{ old('iban') }}"
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
    <script type="text/javascript" src="{{ asset('pages-assets/plugins/switchery/js/switchery.min.js') }}"></script>
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
