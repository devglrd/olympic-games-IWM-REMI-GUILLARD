@extends('admin')

@section('js')
@stop

@section('content')
    <div class="content">
        <div class="jumbotron mb-0" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
                <div class="inner">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            Evaluations
                        </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="container-fluid container-fixed-lg bg-white">
            <div class="card card-transparent">
                <div class="card-header ">
                    <div class="pull-right">
                        <div class="col-xs-12">
                            <input type="text" id="search-table" class="form-control pull-right"
                                   placeholder="Search">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="card-block">
                    <table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
                        <thead>
                        <tr>
                            <th class="dateColumn">Date</th>
                            <th>Status</th> 
                            <th>Coach</th>
                            <th>Client</th>
                            <th>Ressentit</th>
                            <th>Rythme</th>
                            <th class="dateColumn">Prochain Rdv</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($evals AS $eval)
     
                            <tr data-id="{{ $eval->id }}">

                                <td class="v-align-middle semi-bold text-center dateColumn {{$eval->status ? '' : 'pending'}}" >

                                    {{ $eval->date ? $eval->date : '—'}}
                                </td>

                                <td class="v-align-middle semi-bold text-center {{$eval->status ? '' : 'pending'}}">
                                    {{ $eval->status ?  'Evalué' : 'En attente ('.$eval->retard.' jours)'}}
                                </td>

                                <td class="v-align-middle text-center semi-bold text-center {{$eval->status ? '' : 'pending'}}">
                                    {{ $eval->coach  ?  $eval->coach : '—'}}
                                </td>
                                
                                <td class="v-align-middle text-center {{$eval->status ? '' : 'pending'}}">
                                    {{ $eval->client  ?  $eval->client : '—'}}
                                </td>
                                
                                <td class="v-align-middle text-center {{$eval->status ? '' : 'pending'}}">
                                    {{ $eval->star ?  $eval->star : '—' }}
                                </td>
                                
                                <td class="v-align-middle text-center {{$eval->status ? '' : 'pending'}}">
                                    {{ $eval->rythme ?  $eval->rythme : '—' }}
                                </td>
                                
                                <td class="v-align-middle text-center dateColumn {{$eval->status ? '' : 'pending'}}">
                                    {{ $eval->next_seance ?  $eval->next_seance : '—' }}
                                </td>

                                <td class="v-align-middle text-center {{$eval->status ? '' : 'pending'}}">
                                @if(!$eval->status)
                                    <span id="relancer" data-id="{{$eval->id}}"
                                                            class="btn btn-danger">Relancer</span>
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
@stop
