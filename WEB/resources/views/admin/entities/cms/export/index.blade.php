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
<div class="content">
        <div class="container">
            <h1>
                <span
                    class="bold">Export</span>
            </h1>
            <div class="row">
                <div class="col-md-4">
                        <div class="card card-white card-dashboard">
                            <div class="card-header text-center">
                                <div class="card-title bold">Export coachs</div>
                            </div>
                            <div class="card-block text-center">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <a href="{{ action([\App\Http\Controllers\Admin\DashboardController::class, 'xlsCoach']) }}"
                                        class="btn btn-primary">Generer le xml des coachs</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-white card-dashboard">
                            <div class="card-header text-center">
                                <div class="card-title bold">Export clients</div>
                            </div>
                            <div class="card-block text-center">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <a href="{{ action([\App\Http\Controllers\Admin\DashboardController::class, 'xlsClient']) }}"
                                        class="btn btn-primary">Generer le xml des clients</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-white card-dashboard">
                            <div class="card-header text-center">
                                <div class="card-title bold">Export séances</div>
                            </div>
                            <div class="card-block text-center">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                    <a href="{{ action([\App\Http\Controllers\Admin\DashboardController::class, 'xlsSeance']) }}"
                                    class="btn btn-primary">Generer le xml des seances</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-white card-dashboard">
                            <div class="card-header text-center">
                                <div>
                                    <h4 class="bold">Export Factures</h1>
                                </div>
                            </div>
                            <div class="card-block text-center">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <form
                                            action="{{ action([\App\Http\Controllers\Admin\DashboardController::class, 'xlsInvoiceClient']) }}"
                                            method="POST" class="row">
                                            {{ csrf_field() }}
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <div class="form-group form-group-default"
                                                         aria-required="true">
                                                        <label>Mois d'export</label>
                                                        <select name="date" id="" class="form-control select">
                                                            @foreach(array_reverse(\Carbon\CarbonPeriod::create(\Carbon\Carbon::now()->subMonths(12), '1 month', \Carbon\Carbon::now())->toArray()) as $dt)
                                                                <option value="{{ $dt->format('Y-m') }}">{{DateTime::createFromFormat('!m', $dt->month)->format('F')}} {{$dt->year}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-1"></div>
                                                <div class="col-md-12">
                                                    <button class="mt-2 btn btn-primary">Generer le xls facture client</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@stop

@section('js')
@stop

@section('js')
@stop
