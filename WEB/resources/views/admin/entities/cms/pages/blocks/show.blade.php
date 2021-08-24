@extends('admin')

@section('js')
    <script type="text/javascript">
        {{--$(function () {--}}
        {{--// Create folder--}}
        {{--$('#createFolderForm').on('submit', function (e) {--}}
        {{--e.preventDefault()--}}
        {{--$.ajax({--}}
        {{--url: $(this).data('endpoint'),--}}
        {{--method: 'POST',--}}
        {{--type: 'json',--}}
        {{--data: $(this).serialize()--}}
        {{--})--}}
        {{--.done(function (data) {--}}
        {{--showFoldersList()--}}
        {{--})--}}
        {{--$(this).closest('.modal').modal('hide')--}}
        {{--});--}}
        
        {{--// Click on a folder : Open first menu part--}}
        {{--$(document).on('click', '.singleFolder', function () {--}}
        {{--$.ajax({--}}
        {{--url: $(this).data('endpoint'),--}}
        {{--method: 'GET',--}}
        {{--type: 'json',--}}
        {{--}).done(function (data) {--}}
        {{--$('#blocks').html('');--}}
        {{--$.each(data.blocks, function (i, item) {--}}
        {{--createTextBlock(item)--}}
        {{--});--}}
        {{--$('#currentFolder').text(data.folder.name);--}}
        {{--$('#list').show()--}}
        {{--})--}}
        {{--$(this).closest('.modal').modal('hide')--}}
        {{--});--}}
        
        {{--// Click on a block : Open details part--}}
        {{--$(document).on('click', '.item', function () {--}}
        {{--var block = $(this).data('block')--}}
        {{--$('#currentBlockIdValue').val(block.id)--}}
        {{--$('#currentBlockIdValueForImage').val(block.id)--}}
        {{--$('#currentBlockKey').html(block.key)--}}
        {{--$('#currentBlockTime').html(time_ago(block.updated_at))--}}
        {{--if (block.type === 'text') {--}}
        {{--$('#currentBlockText').show()--}}
        {{--$('#currentBlockImage').hide()--}}
        {{--console.log(block.value.{!! app()->getLocale() !!})--}}
        {{--$('#currentBlockTextValue').val(block.value.{!! app()->getLocale() !!})--}}
        {{--} else {--}}
        {{--$('#currentBlockText').hide()--}}
        {{--$('#currentBlockImage').show()--}}
        {{--}--}}
        {{--$('#details').show()--}}
        {{--});--}}
        
        
        {{--$(document).on('keyup change', '#currentBlockTextValue', throttle(function () {--}}
        {{--var form = $(this).closest('form');--}}
        {{--$.ajax({--}}
        {{--url: form.attr('action'),--}}
        {{--method: 'POST',--}}
        {{--cache: false,--}}
        {{--data: form.serialize()--}}
        {{--}).done(function (data) {--}}
        {{--$('.item[data-folder=' + data.id + '] .subject').html(data.value.{{ app()->getLocale() }})--}}
        {{--})--}}
        {{--}));--}}
        
        {{--$(document).on('change', '#createBlockForm [name="type"]', function () {--}}
        {{--if ($(this).val() == 'text') {--}}
        {{--$('#imageSelected').hide();--}}
        {{--$('#textSelected').show();--}}
        {{--} else if ($(this).val() == 'image') {--}}
        {{--$('#imageSelected').show();--}}
        {{--$('#textSelected').hide();--}}
        {{--} else {--}}
        {{--$('#imageSelected').hide();--}}
        {{--$('#textSelected').hide();--}}
        {{--}--}}
        {{--});--}}
        
        {{--$(document).on('submit', '#createBlockForm', function (e) {--}}
        {{--if ($('#selectCreateType').val() == 'text') {--}}
        {{--e.preventDefault()--}}
        {{--}--}}
        
        {{--$.ajax({--}}
        {{--method: 'POST',--}}
        {{--url: $(this).attr('action'),--}}
        {{--type: 'json',--}}
        {{--data: $(this).serialize(),--}}
        {{--cache: false--}}
        {{--}).done(function (data) {--}}
        {{--//                    console.log(data);--}}
        {{--//createTextBlock(data)--}}
        {{--})--}}
        {{--$(this).closest('.modal').modal('hide')--}}
        {{--});--}}
        
        {{--function throttle(f, delay) {--}}
        {{--var timer = null;--}}
        {{--return function () {--}}
        {{--var context = this, args = arguments;--}}
        {{--clearTimeout(timer);--}}
        {{--timer = window.setTimeout(function () {--}}
        {{--f.apply(context, args);--}}
        {{--},--}}
        {{--delay || 500);--}}
        {{--};--}}
        {{--}--}}
        
        {{--function showFoldersList() {--}}
        {{--$.ajax({--}}
        {{--url: '{!! action('Admin\Cms\BlocksController@retrieveFolders', $page->id) !!}',--}}
        {{--method: 'GET',--}}
        {{--cache: false,--}}
        {{--type: 'json'--}}
        {{--}).done(function (data) {--}}
        {{--$('#folders').html('');--}}
        {{--$('#createBlockForm [name="category"]').html('');--}}
        {{--$.each(data.folders, function (i, item) {--}}
        {{--$('#folders').append(--}}
        {{--' <a href="#" class="singleFolder" data-title="' + item.name + '"' +--}}
        {{--'data-endpoint="' + item.link + '"' +--}}
        {{--'data-id="' + item.id + '">' +--}}
        {{--'<span class="title">' +--}}
        {{--'<i class="pg-folder"></i>' +--}}
        {{--item.name +--}}
        {{--'</span>' +--}}
        {{--'<span class="badge pull-right">5</span>' +--}}
        {{--'</a>'--}}
        {{--)--}}
        
        {{--var o = new Option(item.name, item.id);--}}
        {{--$(o).html(item.name);--}}
        {{--$('#createBlockForm [name="category"]').append(o)--}}
        {{--})--}}
        {{--$('#folders').show();--}}
        
        {{--})--}}
        {{--}--}}
        
        {{--function createTextBlock(data) {--}}
        {{--$('#list').show()--}}
        
        {{--if (data.type == 'text') {--}}
        {{--var icon = 'pg-text_style'--}}
        {{--} else {--}}
        {{--var icon = 'pg-image'--}}
        {{--}--}}
        
        {{--$('#blocks').append('<li class="item padding-15" data-folder="' + data.id + '" data-block="' + escapeHtml(JSON.stringify(data)) + '">' +--}}
        {{--'<div class="thumbnail-wrapper d32 circular">' +--}}
        {{--'<i class="' + icon + '"></i>' +--}}
        {{--'</div>' +--}}
        {{--'<div class="inline m-l-15">' +--}}
        {{--'<p class="recipients no-margin hint-text small">' +--}}
        {{--'Clé: <strong>' + data.key + '</strong>' +--}}
        {{--'</p>' +--}}
        {{--'<p class="recipients no-margin hint-text small">' +--}}
        {{--'Type: <strong>' + data.type + '</strong>' +--}}
        {{--'</p>' +--}}
        {{--'<p class="subject no-margin">' + data.value . {{ app()->getLocale() }} + '</p>' +--}}
        {{--'</div>' +--}}
        {{--'<div class="datetime">' + time_ago(data.updated_at) + '</div>' +--}}
        {{--'<div class="clearfix"></div>' +--}}
        {{--'</li>'--}}
        {{--).show();--}}
        {{--}--}}
        
        {{--function time_ago(time) {--}}
        
        {{--switch (typeof time) {--}}
        {{--case 'number':--}}
        {{--break;--}}
        {{--case 'string':--}}
        {{--time = +new Date(time);--}}
        {{--break;--}}
        {{--case 'object':--}}
        {{--if (time.constructor === Date) time = time.getTime();--}}
        {{--break;--}}
        {{--default:--}}
        {{--time = +new Date();--}}
        {{--}--}}
        {{--var time_formats = [--}}
        {{--[60, 'secondes', 1], // 60--}}
        {{--[120, 'il y a 1 minute', '1 minute from now'], // 60*2--}}
        {{--[3600, 'minutes', 60], // 60*60, 60--}}
        {{--[7200, 'Il y a 1 heure ', '1 hour from now'], // 60*60*2--}}
        {{--[86400, 'heures', 3600], // 60*60*24, 60*60--}}
        {{--[172800, 'Hier', 'Tomorrow'], // 60*60*24*2--}}
        {{--[604800, 'jours', 86400], // 60*60*24*7, 60*60*24--}}
        {{--[1209600, 'La semaine dernière', 'Next week'], // 60*60*24*7*4*2--}}
        {{--[2419200, 'semaines', 604800], // 60*60*24*7*4, 60*60*24*7--}}
        {{--[4838400, 'Le mois dernier', 'Next month'], // 60*60*24*7*4*2--}}
        {{--[29030400, 'mois', 2419200], // 60*60*24*7*4*12, 60*60*24*7*4--}}
        {{--[58060800, 'L\'année dernière', 'Next year'], // 60*60*24*7*4*12*2--}}
        {{--[2903040000, 'années', 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12--}}
        {{--[5806080000, 'Last century', 'Next century'], // 60*60*24*7*4*12*100*2--}}
        {{--[58060800000, 'centuries', 2903040000] // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100--}}
        {{--];--}}
        {{--var seconds = (+new Date() - time) / 1000,--}}
        {{--token = 'il y a',--}}
        {{--list_choice = 1;--}}
        
        {{--if (seconds == 0) {--}}
        {{--return 'Maintenant'--}}
        {{--}--}}
        {{--if (seconds < 0) {--}}
        {{--seconds = Math.abs(seconds);--}}
        {{--token = 'from now';--}}
        {{--list_choice = 2;--}}
        {{--}--}}
        {{--var i = 0,--}}
        {{--format;--}}
        {{--while (format = time_formats[i++])--}}
        {{--if (seconds < format[0]) {--}}
        {{--if (typeof format[2] == 'string')--}}
        {{--return format[list_choice];--}}
        {{--else--}}
        {{--return token + ' ' + Math.floor(seconds / format[2]) + ' ' + format[1];--}}
        {{--}--}}
        {{--return time;--}}
        {{--}--}}
        
        {{--function escapeHtml(string) {--}}
        {{--var entityMap = {--}}
        {{--'&': '&amp;',--}}
        {{--'<': '&lt;',--}}
        {{--'>': '&gt;',--}}
        {{--'"': '&quot;',--}}
        {{--"'": '&#39;',--}}
        {{--'/': '&#x2F;',--}}
        {{--'`': '&#x60;',--}}
        {{--'=': '&#x3D;'--}}
        {{--};--}}
        
        {{--return String(string).replace(/[&<>"'`=\/]/g, function (s) {--}}
        {{--return entityMap[s];--}}
        {{--});--}}
        {{--}--}}
        
        {{--// Init--}}
        {{--showFoldersList();--}}
        {{--})--}}
    </script>
@stop

@section('content')
    <style>
        .page-container .page-content-wrapper .content {
            padding-bottom: 0;
        }
        
        .copyright {
            display: none;
        }
        
        .no-uppercase {
            text-transform: none !important;
        }
    </style>
    <div class="content full-height">
        <nav class="secondary-sidebar">
            <div class="m-b-30 m-l-30 m-r-30 hidden-sm-down">
                <button class="btn btn-complete btn-block btn-compose no-uppercase" data-toggle="modal"
                        data-target="#createBlockModal">
                    Ajouter un bloc
                </button>
            </div>
            <p class="menu-title">Tous les dossiers de cette page</p>
            <ul class="main-menu">
                
                <li>
                    <a href="#" data-toggle="modal" data-target="#createFolderModal">
                        <span class="title">
                            Ajouter un nouveau dossier
                        </span>
                    </a>
                </li>
                
                <li class="" id="folders">
                    {{-- Avoid waiting --}}
                    @foreach($page->getCategories AS $category)
                        <a href="{{ action('Admin\Cms\BlocksController@showBlocks', [$page->id, $category->slug]) }}" class="singleFolder"
                           data-id="{{ $category->id }}">
                    <span class="title">
                    <i class="pg-folder"></i>
                        {{ $category->name }}
                    </span>
                            <span class="badge pull-right">5</span>
                        </a>
                    @endforeach
                </li>
            </ul>
            {{--<p class="menu-title m-t-20 all-caps">Les autres pages</p>--}}
            {{--<ul class="sub-menu no-padding">--}}
                {{--@foreach($pages AS $children)--}}
                {{--<li>--}}
                {{--<a href="{{ action('Admin\Cms\BlocksController@index', $children->id) }}">--}}
                {{--<span class="title">{{ $children->title }}</span>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--@endforeach--}}
            {{--</ul>--}}
        </nav>
        
        <div class="inner-content full-height">
            <div class="split-view">
                
                <div style="display: none;" id="list" class="split-list">
                    <div data-email="list" class="boreded no-top-border list-view">
                        <h2 class="list-view-fake-header">
                            Dossier: <strong id="currentFolder">{{ $page->title }}</strong>
                            {{-- TODO --}}
                        </h2>
                        <div style="position: absolute; right:10px; z-index:999">
                            <form action="#">
                                {{ csrf_field() }}
                                <input type="hidden" name="folder" required>
                                <button>
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                        </div>
                        <div class="list-view-wrapper">
                            <div class="list-view-group-container">
                                <ul class="no-padding" id="blocks">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="details" class="split-details" style="display: none;">
                    <div class="email-content-wrapper">
                        <div class="actions-wrapper menuclipper bg-master-lightest">
                            <ul class="actions menuclipper-menu no-margin p-l-20">
                                <li class="no-padding">
                                    <a href="#" class="text-danger">
                                        Supprimer ce bloc
                                    </a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="email-content">
                            <div class="email-content-header">
                                <div class="thumbnail-wrapper d48 circular">
                                    <i class="pg-text_style"></i>
                                </div>
                                <div class="sender inline m-l-10">
                                    <p class="name no-margin bold" id="currentBlockKey"></p>
                                    <p class="datetime no-margin">Dernière mise à jour :
                                        <span id="currentBlockTime"></span>
                                    </p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="email-content-body m-t-20">
                            </div>
                            <div class="b-a b-grey m-t-30">
                                {{--<form action="{{ action('Admin\Cms\BlocksController@updateBlock', $page->id) }}"--}}
                                {{--id="currentBlockText" style="display: none" method="post">--}}
                                {{--{{ csrf_field() }}--}}
                                {{--<input type="hidden" name="block" id="currentBlockIdValue">--}}
                                {{--<textarea class="form-control" placeholder="Valeur" name="value"--}}
                                {{--id="currentBlockTextValue"></textarea>--}}
                                {{--</form>--}}
                                {{--<form action="{{ action('Admin\Cms\BlocksController@updateBlock', $page->id) }}"--}}
                                {{--id="currentBlockImage" style="display: none" method="post"--}}
                                {{--enctype="multipart/form-data">--}}
                                {{--{{ csrf_field() }}--}}
                                {{--<input type="hidden" name="block" id="currentBlockIdValueForImage">--}}
                                {{--<input type="file" name="image" id="currentBlockImageValue">--}}
                                {{--<button type="submit" class="btn btn-primary">Envoyer</button>--}}
                                {{--</form>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.entities.cms.pages.partials.modal')
@stop