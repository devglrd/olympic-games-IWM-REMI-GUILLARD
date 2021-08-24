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
                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\ProductController::class, 'index']) }}">Mes Produits</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\OptionController::class, 'index']) }}">Mes Options</a>
                </li>
                <li class="breadcrumb-item active">Ajouter une option</li>
            </ol>
            <form action="{{ action([\App\Http\Controllers\Admin\Cms\OptionController::class, 'store']) }}"
                  method="POST"
                  data-toggle="validator"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                <div class="col-xl-12 col-lg-12">
                        <div class="card card-transparent">
                            <div class="card-block">
                                <button type="submit" class="btn btn-primary btn-cons">
                                    Ajouter
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
                                            <label>Type de l'option</label>
                                            <select name="type" id="" class="form-control">
                                                @foreach($option as $slug => $value)
                                                    <option value="{{ $slug }}">{{ $slug }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default required"
                                            aria-required="true">
                                            <label>Valeur de l'option</label>
                                            <input type="text" name="option" class="form-control">
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
    <script src="{{ asset('pages-assets/plugins/jquery-autonumeric/autoNumeric.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-typehead/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('pages-assets/plugins/bootstrap-typehead/typeahead.jquery.min.js') }}"></script>
    <script>
        var selectFinal = "Pack";
        var priceFinal, optionFinal = '';
        var optionelect = [];
        var clicked = [];
        const optionArray = "{{ implode(',',\App\Models\Option::all()->map(function($item){ return implode('.',['id' => $item->id, 'name' => $item->name, 'value' => $item->value]);})->toArray()) }}".split(',').map((e) => e.split('.'));

        $(document).ready(function () {
            console.log(optionArray);
            $('select').select2();
            $('.autonumeric').autoNumeric('init');
            setTitle('Pack');
            $('#select').on('change', function () {
                setSelect($('#select').val())
            });
            $('#price').on('change', function () {
                setPrice($('#price').val())
            });
            // $('input[type="checkbox"]').on('change', function () {
            //     const id = $(this).val();
            //     const find = clicked.find(e => e === id);
            //     if(find){
            //         console.log(optionelect);
            //         delete optionelect[id];
            //         console.log(optionFinal);
            //     }else{
            //         const retur = optionArray.find((e) => e.find(a => a[0] === id.toString()))
            //         const already = optionelect.find(e => e === retur[1])
            //         if (already){
            //             // setCheck(idStr)
            //             return false;
            //         }
            //
            //         optionelect.push(retur[1]);
            //         optionFinal += `${retur[1]} = ${retur[2]}`;
            //         setoption(optionFinal);
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
                format: 'dd/mm/yyyy', // FORMAT - Documentation : http://bootstrap-datepicker.readthedocs.io/en/latest/option.html#format
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

        function setCheck(id) {
            const tem = optionelect.map((e) => {
                const all = $(`*[data-type="${e}"]`);
                return all;
            })
            const tem2 = tem.map((e) => {
                return e.map(a => {
                    return $(e[a]).attr('id');
                })
            }).flat();

        }

        function setSelect(select) {
            selectFinal = select
            setTitle(selectFinal, priceFinal, optionFinal);
        }

        function setPrice(price) {
            priceFinal = price;
            setTitle(selectFinal, priceFinal, optionFinal);
        }

        function setoption(option) {
            setTitle(selectFinal, priceFinal, option);
        }

        function setTitle(type, price, option) {
            const typeStr = type ? 'Type : ' + type : '';
            const priceStr = price ? ', Prix : ' + price : '';
            const optiontr = option ? ', option : ' + option : '';

            $('#title').val(`${typeStr} ${priceStr} ${optiontr}`);
        }
    </script>
@stop
