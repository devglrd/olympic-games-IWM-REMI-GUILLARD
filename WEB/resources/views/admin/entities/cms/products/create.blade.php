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
                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\ProductController::class, 'index']) }}">Mes
                        Produits</a>
                </li>
                <li class="breadcrumb-item active">Ajouter un produit</li>
            </ol>
            <form action="{{ action([\App\Http\Controllers\Admin\Cms\ProductController::class, 'store']) }}"
                  method="POST"
                  data-toggle="validator"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-12">
                        <div class="card card-transparent">
                            <div class="card-block">
                                <button type="submit" class="btn btn-primary btn-cons">
                                    Ajouter un produit
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6 ">
                        <div class="card card-white">
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required"
                                            aria-required="true">
                                            <label>Nom du produit (automatique)</label>
                                            <input type="text" name="title" id="title" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required"
                                            aria-required="true">
                                            <label>Type</label>
                                            <select name="type" id="select" class="form-control">
                                                <option
                                                    value="{{ \App\Models\Product::PACK }}">{{ \App\Models\Product::PACK }}</option>
                                                <option
                                                    value="{{ \App\Models\Product::ABONNEMENT }}">{{ \App\Models\Product::ABONNEMENT }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required"
                                            aria-required="true">
                                            <label>Prix</label>
                                            <input type="text" name="price" id="price" data-a-sign="€ "
                                                   class="autonumeric form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group required"
                                            aria-required="true">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-white " id="cardOption">
                            <div class="card-header">
                                <div class="card-title">
                                    Type de séance associée
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div
                                        class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required"
                                        aria-required="true">
                                        <label>Seances</label>
                                        <select name="seances[]" multiple class="form-control" id="">
                                            @foreach(\App\Models\Seance::all() as $seance)
                                                <option value="{{$seance->id}}">{{ $seance->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6 ">

                        <div class="card card-white " id="cardOption">
                            <div class="card-header">
                                <div class="card-title">
                                    Options
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    @foreach($options as $index=> $option)
                                        <div
                                            class="col-md-6 mb-3 {{ $index === \App\Models\Product::TIME_UNIT ? 'time' : '' }} {{$index === \App\Models\Product::TIME_UNIT_ABONNEMENT ? ' mensuelle d-none' : '' }} {{$index === 'Validité' ? ' validity' : '' }} {{$index === 'Engagement' ? 'd-none engagement' : '' }}">
                                            <p>{{ $index }} (en {{getUnit($index)}}) :  </p>
                                        </div>
                                        <div
                                            class="col-md-6 mb-3 {{ $index === \App\Models\Product::TIME_UNIT ? 'time' : '' }} {{$index === \App\Models\Product::TIME_UNIT_ABONNEMENT ? ' mensuelle d-none' : '' }}  {{$index === 'Validité' ? ' validity' : '' }} {{$index === 'Engagement' ? 'd-none engagement' : '' }}">
                                            <select name="options[{{$index}}]" id="" class="form-control w-100">
                                                <option value="null" selected="selected">Aucune</option>
                                                @foreach($option as $opt)
                                                    <option value="{{ $opt->id }}">{{$opt->value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{--                                        <div class="col-md-6 mb-0">--}}
                                        {{--                                            <div class="checkbox check-success ">--}}
                                        {{--                                                <input type="checkbox" name="options[]" value="{{ $option->id }}"--}}
                                        {{--                                                       id="checkbox-{{$index}}" data-type="{{ $option->name }}">--}}
                                        {{--                                                <label for="checkbox-{{$index}}">{{$option->name}}--}}
                                        {{--                                                    : {{$option->value}}</label>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                    @endforeach
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
    <script src="{{ asset('pages-assets/plugins/jquery-autonumeric/autoNumeric.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-typehead/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-typehead/typeahead.jquery.min.js') }}"></script>
    <script>
        var selectFinal = "Pack";
        var priceFinal, optionsFinal = '';
        var optionSelect = [];
        var clicked = [];
        const optionsArray = "{{ implode(',',\App\Models\Option::all()->map(function($item){ return implode('.',['id' => $item->id, 'name' => $item->name, 'value' => $item->value]);})->toArray()) }}".split(',').map((e) => e.split('.'));

        $(document).ready(function () {
            $('select').select2()

            // $('#cardOption').
            console.log(optionsArray);
            $('.autonumeric').autoNumeric('init');
            // setTitle('Pack');
            $('#select').on('change', function () {
                $('#cardOption').removeClass('d-none');
                console.log($('#select').val());
                if ($('#select').val() === "ABONNEMENT") {
                    console.log('la');
                    $('.engagement').removeClass('d-none');
                    $('.validity').addClass('d-none');
                    $('.time').addClass('d-none');
                    $('.mensuelle').removeClass('d-none');
                } else {
                    $('.engagement').addClass('d-none');
                    $('.validity').removeClass('d-none');
                    $('.time').removeClass('d-none');
                    $('.mensuelle').addClass('d-none');
                }
            });

            // $('input[type="checkbox"]').on('change', function () {
            //     const id = $(this).val();
            //     const find = clicked.find(e => e === id);
            //     if(find){
            //         console.log(optionSelect);
            //         delete optionSelect[id];
            //         console.log(optionsFinal);
            //     }else{
            //         const retur = optionsArray.find((e) => e.find(a => a[0] === id.toString()))
            //         const already = optionSelect.find(e => e === retur[1])
            //         if (already){
            //             // setCheck(idStr)
            //             return false;
            //         }
            //
            //         optionSelect.push(retur[1]);
            //         optionsFinal += `${retur[1]} = ${retur[2]}`;
            //         setOptions(optionsFinal);
            //     }
            //     clicked.push(id);
            //
            // });
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

        function setCheck(id){
            const tem  = optionSelect.map((e) => {
                const all = $(`*[data-type="${e}"]`);
                return all;
            })
            const tem2 = tem.map((e) => {
                return e.map(a => {
                    return $(e[a]).attr('id');
                })
            }).flat();

        }

        // function setSelect(select) {
        //     selectFinal = select
        //     setTitle(selectFinal, priceFinal, optionsFinal);
        // }
        //
        // function setPrice(price) {
        //     priceFinal = price;
        //     setTitle(selectFinal, priceFinal, optionsFinal);
        // }
        //
        // function setOptions(options) {
        //     setTitle(selectFinal, priceFinal, options);
        // }
        //
        // function setTitle(type, price, options) {
        //     const typeStr = type ? 'Type : ' + type : '';
        //     const priceStr = price ? ', Prix : ' + price : '';
        //     const optionStr = options ? ', Options : ' + options : '';
        //
        //     $('#title').val(`${typeStr} ${priceStr} ${optionStr}`);
        // }
    </script>
@stop
