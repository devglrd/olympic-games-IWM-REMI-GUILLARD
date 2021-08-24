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
                <li class="breadcrumb-item active">Assigner un produit à un client</li>
            </ol>
            <form action="{{ action([\App\Http\Controllers\Admin\Cms\ProductController::class, 'assignPost']) }}"
                  method="POST"
                  data-toggle="validator"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div>
                    <div class="col-xl-5 col-lg-6">
                        <div class="card card-transparent">
                            <div class="card-block">
                                <button type="submit" class="btn btn-primary btn-cons">
                                    Assigner le produit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 ">
                        <div class="card card-white">
                            <div class="card-block">
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default "
                                        >
                                            <label>Client</label>


                                            <select name="client" id="select" class="form-control">
                                                @if(request()->has('client'))
                                                    <option
                                                        value="{{\App\Models\Client::findOrFail(request()->get('client'))->id}}"> {{\App\Models\Client::findOrFail(request()->get('client'))->first_name}} {{\App\Models\Client::findOrFail(request()->get('client'))->name}}</option>

                                                @else
                                                    @foreach(\App\Models\Client::get() as $pr)
                                                        <option value="{{$pr->id}}"> {{$pr->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default "
                                            aria-required="true">
                                            <label>Produit</label>
                                            <select name="product" id="selectProduit" class="form-control">
                                                @foreach(\App\Models\Product::all() as $pr)
                                                    <option value="{{$pr->id}}"> {{$pr->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default "
                                        >
                                            <label>Prix</label>
                                            <input type="number" name="surcharge_price" class="form-control"
                                                   id="priceInput">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default "
                                        >
                                            <label>Unité de pack / abonnement</label>
                                            <input type="text" name="free_time" class="form-control" id="timeInput">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default ">
                                            <label>Validité / Engagement</label>
                                            <input type="text" name="free_validity" class="form-control"
                                                   id="validityInput">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default "
                                        >
                                            <label>Mode de paiement</label>
                                            <select name="paiement" id="select2M" class="form-control">
                                                <option value="cb">CB</option>
                                                <option value="virement"> Virement</option>
                                                <option value="cheque"> Chèque</option>
                                                <option value="prelevement"> Prélèvement</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="PayMulti">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default ">
                                            <label>Paiement en plusieurs fois</label>
                                            <select name="paiementMany" id="select" class="form-control">
                                                <option value="1"> 1 fois</option>
                                                <option value="2"> 2 fois</option>
                                                <option value="3"> 3 fois</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-none" id="prelevementDisplay">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default ">
                                            <label>Prix (mensualité pour les abonnements)</label>
                                            <input type="text" name="priceforabo" class="form-control"
                                                   id="priceInput2">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row clearfix d-none" id="dateAbo">
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default "
                                        >
                                            <label>Date de début de l'abonnement</label>
                                            <input id="datepicker" type="text" class="form-control"
                                                   name="dateStartAbonnement"
                                                   value="{{ Carbon\Carbon::now()->addMonths(1)->startOfMonth()->format('d/m/Y')}}">
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
        var priceFinal, optionsFinal = '';
        var optionSelect = [];
        var clicked = [];
        const optionsArray = "{{ implode(',',\App\Models\Option::all()->map(function($item){ return implode('.',['id' => $item->id, 'name' => $item->name, 'value' => $item->value]);})->toArray()) }}".split(',').map((e) => e.split('.'));

        function setSeanceSelect(id) {
            $('#seanceSelect').empty()

            $.ajax({
                url: `/api/product/${id}`,
                type: 'GET',
                dataType: 'json',
                success: function (data, status) {
                    if (data.type === "ABONNEMENT") {
                        $('#PayMulti').addClass('d-none');
                        $('#select2M').val("prelevement");
                        $('#select2M').trigger('change');
                        $('#prelevementDisplay').removeClass("d-none");
                        $('#dateAbo').removeClass("d-none");
                        const vali = data.get_options.find(e => e.name === "Engagement");
                        const price = data.price
                        const time = data.get_options.find(e => e.name === "Unité d'abonnement");
                        {{--                        {{ $product->type === \App\Models\Product::ABONNEMENT ? \App\Models\Product::TIME_UNIT_ABONNEMENT : \App\Models\Product::TIME_UNIT }}--}}
                        console.log(vali);
                        console.log(price);
                        console.log(time);
                        $('#validityInput').val(vali.value);
                        $('#priceInput').val(price);
                        $('#timeInput').val(time.value);
                    } else {
                        $('#PayMulti').removeClass('d-none');
                        $('#dateAbo').addClass("d-none");
                        $('#prelevementDisplay').addClass("d-none");
                        const vali = data.get_options.find(e => e.name === "Validité");
                        const price = data.price
                        const time = data.get_options.find(e => e.name === "Unité de pack");
                        {{--                        {{ $product->type === \App\Models\Product::ABONNEMENT ? \App\Models\Product::TIME_UNIT_ABONNEMENT : \App\Models\Product::TIME_UNIT }}--}}
                        console.log(vali);
                        console.log(price);
                        console.log(time);
                        $('#validityInput').val(vali.value);
                        $('#priceInput').val(price);
                        $('#timeInput').val(time.value);
                    }
                },
                error: function (result, status, error) {
                    console.log(result);
                }
            });

            $.ajax({
                url: `/api/product/${id}/seance`,
                type: 'GET',
                dataType: 'json',
                success: function (data, status) {
                    console.log(data);
                    data.forEach((e) => {

                        $('#seanceSelect').append('<option value="' + e.id + '">' + e.name + '</option>');
                    })
                },
                error: function (result, status, error) {
                    console.log(result);
                }
            });
        }

        $(document).ready(function () {

            setSeanceSelect($('#selectProduit').val());
            $('#selectProduit').on('change', function () {
                console.log($(this).val());
                setSeanceSelect($(this).val());
            });
            $('select').select2();
            console.log(optionsArray);
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

        function setCheck(id) {
            const tem = optionSelect.map((e) => {
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
            setTitle(selectFinal, priceFinal, optionsFinal);
        }

        function setPrice(price) {
            priceFinal = price;
            setTitle(selectFinal, priceFinal, optionsFinal);
        }

        function setOptions(options) {
            setTitle(selectFinal, priceFinal, options);
        }

        function setTitle(type, price, options) {
            const typeStr = type ? 'Type : ' + type : '';
            const priceStr = price ? ', Prix : ' + price : '';
            const optionStr = options ? ', Options : ' + options : '';

            $('#title').val(`${typeStr} ${priceStr} ${optionStr}`);
        }
    </script>
@stop
