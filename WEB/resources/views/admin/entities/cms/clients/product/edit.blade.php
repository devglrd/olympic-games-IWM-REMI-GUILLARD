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
                <li class="breadcrumb-item active"><a
                        href="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'edit'], $client->id) }}">
                        Client #CL{{str_pad($client->id, 5, '0', STR_PAD_LEFT)}}
                    </a></li>
                <li class="breadcrumb-item active">Surcharge produit</li>
            </ol>
            <div class="my-3    ">
                <a href="{{ action([\App\Http\Controllers\Admin\Cms\ProductController::class, 'stopProduct'], $product->id) }}"
                   class="btn btn-{{ $product->stop ? 'success' : 'danger' }} text-white btn-cons">
                    {{ $product->stop ? 'Redémarrer' : 'Stopper' }} le produit
                </a>
                <button id="submit" class="btn btn-primary btn-cons">
                    Surcharger le produit
                </button>
            </div>
            <form
                action="{{ action([\App\Http\Controllers\Admin\Cms\ProductController::class, 'surchargeProduct'], $product->id) }}"
                method="POST" id="post"
                data-toggle="validator"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">


                    <div class="col-xl-12 col-lg-12 ">
                        <div class="card card-product">
                            <div class="card-header ">
                                <div
                                    class="card-title d-flex justify-content-between align-items-center">
                                    <div>
                                        <b>Produit</b> : <b>{{ $product->type === \App\Models\Product::ABONNEMENT ? 'Abonnement' : 'Pack' }}</b>
                                        #P{{str_pad($product->id, 5, '0', STR_PAD_LEFT)}}
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span
                                            class="badge {{ $product->stop ? 'badge-danger' : 'badge-success' }}">
                                            {{ $product->stop ? 'Produit arréter' : 'Produit en cours' }}
                                        </span>
                                    </div>

                                </div>
                            </div>
                            <div class="card-block d-flex flex-column align-items-start ">

                                <div class="mt-2">
                                    <hr>
                                    <div class="card-title font-weight-bold">Valeurs Initiales du produit</div>
                                    <b>
                                        {{ $product->name }}
                                    </b>
                                    <div class="my-1">-
                                        <b>Prix</b>
                                        (en euros) :
                                        <span
                                            class="badge badge-info badge-product">{{ $product->init_price }} €</span>
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
                                    @if ($product->type === \App\Models\Product::ABONNEMENT)
                                        <div class="my-1">-
                                            <b>Résiliation</b> :
                                            @if ($product->termination)
                                                <span class="badge badge-info badge-product"> le {{ $product->termination }}</span>
                                            @else
                                                <span class="badge badge-info badge-product"> illimité </span>
                                            @endif
                                        </div>
                                    @endif
                                    <div class="my-1">-
                                        <b>Nombre de payeur</b> :
                                        <span class="badge badge-info badge-product">{{ $product->init_buyer }}</span>
                                    </div>
                                    <div class="my-1">-
                                        <b>{{ $product->type === \App\Models\Product::ABONNEMENT ? \App\Models\Product::TIME_UNIT_ABONNEMENT : \App\Models\Product::TIME_UNIT }} </b>
                                        (en tranche de 30 min) :

                                        <span
                                            class="badge badge-info badge-product">{{ $product->init_time_unit }}</span>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <hr>
                                    <div class="card-title font-weight-bold">Valeurs actuelles du produit</div>
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
                                        <b>Nombre de payeur</b> :
                                        <span
                                            class="badge badge-info badge-product">{{ $product->buyer }}</span>
                                    </div>
                                    <div class="my-1">-
                                        <b>{{ $product->type === \App\Models\Product::ABONNEMENT ? \App\Models\Product::TIME_UNIT_ABONNEMENT : \App\Models\Product::TIME_UNIT }} </b>
                                        (en tranche de 30 min) :
                                        <span
                                            class="badge badge-info badge-product">{{ $product->time_unit }}</span>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <hr>
                                    <div class="card-title font-weight-bold">Utilisation (en tranche de 30 min) :</div>
                                    <div class="my-1">-
                                        <b>{{ $product->type === \App\Models\Product::ABONNEMENT ? \App\Models\Product::TIME_UNIT_ABONNEMENT : \App\Models\Product::TIME_UNIT }} </b>
                                        utilisées {{ $product->type === \App\Models\Product::ABONNEMENT ? 'ce mois-ci :' : '' }}

                                        <span class="badge badge-info badge-product">{{ unitUse($product, $product->getClient) }} / {{ $product->time_unit }}  PROGRAMMEE</span>
                                        <span class="badge badge-info badge-product">{{ unitUseProgram($product, $product->getClient) }} / {{ $product->time_unit }} REEL</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card card-white">
                            <div class="card-header ">
                                <div class="card-title d-flex justify-content-between align-items-center">
                                        <b>Modifier les valeurs globales du produit</b>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row clearfix">
                                    @if($product->type === \App\Models\Product::ABONNEMENT)
                                        <div class="col-md-3">
                                    @else
                                        <div class="col-md-4">
                                    @endif
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default "
                                        >
                                            <label>le prix actuel</label>
                                            <input type="text" name="surcharge_price" class="form-control"
                                                id="priceInput" value="{{$product->price}}">
                                        </div>
                                    </div>
                                    @if($product->type === \App\Models\Product::ABONNEMENT)
                                        <div class="col-md-3">
                                    @else
                                        <div class="col-md-4">
                                    @endif
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default " >
                                            <label>l'unité de temps actuel</label>
                                            <input type="text" name="free_time" class="form-control" id="timeInput"
                                                value="{{$product->time_unit}}">
                                        </div>
                                    </div>
                                    @if($product->type === \App\Models\Product::ABONNEMENT)
                                        <div class="col-md-3">
                                    @else
                                        <div class="col-md-4">
                                    @endif
                                        <div
                                            class="form-group {{ $errors->has('title') ? 'has-error' : '' }} form-group-default ">
                                            <label>date
                                                d{{ $product->type === \App\Models\Product::ABONNEMENT ? '\'engagement' : 'e validité' }}</label>
                                            <div id="myDatepickerMove" class="input-group date">
                                                <input type="text" name="date_start" class="form-control"
                                                    value="">
                                                <span class="input-group-addon"><i
                                                        class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    @if($product->type === \App\Models\Product::ABONNEMENT)
                                    <div class="col-md-3">
                                        <div class="form-group form-group-default ">
                                            <label>La date de résiliation</label>
                                            <div id="myDatepickerResiliation" class="input-group date">
                                            <input type="text" name="date" class="form-control"
                                                    value="{{ \Carbon\Carbon::parse($product->termination)->toDateString() }}">
                                                <span class="input-group-addon"><i
                                                        class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if($product->type === \App\Models\Product::ABONNEMENT)
                        <div class="card card-white">
                            <div class="card-header ">
                                <div class="card-title d-flex justify-content-between align-items-center">
                                        <b>Vos Echéances à venir</b>
                                </div>
                            </div>
                            <div class="card-block">
                                <table class="table table-hover demo-table-search table-responsive-block">
                                    <thead>
                                    <tr>
                                        <th><b>Month</b></th>
                                        <th><b>Montant</b></th>
                                        <th><b>Action</b></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($echeancier AS $key => $echeance)
                                        <tr data-id="{{ $echeance->dateId }}" class="cursor mounth_year">
                                            <td class="v-align-left text-left {{!$echeance->lock ? '' : 'locked'}}">
                                                {{ $echeance->dateId ? $echeance->dateId : '—' }}
                                                @if($echeance->last)
                                                    <span class="text-danger"> (Résiliation)</span>
                                                @endif
                                            </td>
                                            <td class="v-align-left text-left {{!$echeance->lock ? '' : 'locked'}} {{!$echeance->overide ? '' : 'text-primary'}}">
                                                {{ $echeance->price ? $echeance->price : '—' }} €
                                            </td>
                                            <td class="v-align-left text-left {{!$echeance->lock ? '' : 'locked'}}">
                                                <input type="number" id="input_field_{{$echeance->dateId}}">
                                                <span id="editRules" data-id="{{$echeance->dateId}}" data-productid="{{$product->id}}"
                                                            class="btn btn-info">Modifier</span>

                                                @if($echeance->overide)
                                                    <span id="deleteRules" data-id="{{$echeance->id}}"
                                                            class="btn btn-danger">Réinitialiser</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
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
        $('#myDatepickerMove').datepicker({
            format: 'yyyy-mm-dd', // FORMAT - Documentation : http://bootstrap-datepicker.readthedocs.io/en/latest/options.html#format
            language: 'fr',
            todayHight: true
        }).on("show", function () {
            const val = "{{$product->validity}}"
            $(this).val(val).datepicker('update');
        });

        $('#myDatepickerResiliation').datepicker({
            format: 'yyyy-mm-dd', // FORMAT - Documentation : http://bootstrap-datepicker.readthedocs.io/en/latest/options.html#format
            language: 'fr',
            todayHight: true
        }).on("show", function () {
            const val = "{{$product->resiliation}}"
            $(this).val(val).datepicker('update');
        });


        function setSeanceSelect(id) {
            // $('#seanceSelect').empty()

            // $.ajax({
            //     url: `/api/product/${id}`,
            //     type: 'GET',
            //     dataType: 'json',
            //     success: function (data, status) {
            //         if (data.type === "ABONNEMENT") {
            //             const vali = data.get_options.find(e => e.name === "Engagement");
            //             const price = data.price
            //             const time = data.get_options.find(e => e.name === "Unité de temps");
            //             console.log(vali);
            //             console.log(price);
            //             console.log(time);
            //             $('#validityInput').val(vali.value);
            //             $('#priceInput').val(price);
            //             $('#timeInput').val(time.value);
            //         } else {
            //
            //         }
            //     },
            //     error: function (result, status, error) {
            //         console.log(result);
            //     }
            // });
            //
            // $.ajax({
            //     url: `/api/product/${id}/seance`,
            //     type: 'GET',
            //     dataType: 'json',
            //     success: function (data, status) {
            //         console.log(data);
            //         data.forEach((e) => {
            //
            //             $('#seanceSelect').append('<option value="' + e.id + '">' + e.name + '</option>');
            //         })
            //     },
            //     error: function (result, status, error) {
            //         console.log(result);
            //     }
            // });
        }

        $(document).ready(function () {

            $('#editRules').on('click', function () {
                const idDate = $(this).data('id');
                const idProduct = $(this).data('productid');

                const value = document.getElementById(`input_field_${idDate}`).value;

                $.ajax({
                    url: `/clients/product/rules/edit`,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "dateid" : idDate,
                        "productid": idProduct,
                        "value": value
                    },
                    success: function (data, status) {
                        if (data[0] === "succes") {
                            notie.alert(1, 'Echéance modifié', 8);
                            window.location.reload()
                        }
                    },
                    error: function (result, status, error) {
                        console.log(result);
                    }
                })
            })

            $('#deleteRules').on('click', function () {
                const idRules = $(this).data('id');

                $.ajax({
                    url: `/clients/product/rules/delete/${idRules}`,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (data, status) {
                        if (data[0] === "succes") {
                            notie.alert(1, 'Echéance réinitialisé', 8);
                            window.location.reload()
                        }
                    },
                    error: function (result, status, error) {
                        console.log(result);
                    }
                })
            })

            $('#submit').on('click', function () {
                $('#post').submit()
            });

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
