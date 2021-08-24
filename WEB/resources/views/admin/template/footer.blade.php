</div>
</div>

@if(Auth::check())
    <script src="{{ asset('js/admin.js') }}"></script>
    <div class="modal fade slide-up disable-scroll show" id="resetPassword" tabindex="-1" role="dialog"
         aria-hidden="true" style="overflow: scroll !important;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="pg-close fs-14"></i>
                        </button>
                        <h5><span class="semi-bold">Modifier</span> mon mot de passe</h5>
                    </div>
                    {{--                    <form action="{{ action([AccountController::class,'store', request()->user()->id) }}" method="post">--}}
                    {{--                        {{ csrf_field() }}--}}
                    {{--                        {{ method_field('post') }}--}}
                    {{--                        <div class="modal-body">--}}
                    {{--                            <div class="row">--}}
                    {{--                                <div class="col-md-12">--}}
                    {{--                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} form-group-default">--}}
                    {{--                                        <label>--}}
                    {{--                                            Mot de passe--}}
                    {{--                                        </label>--}}
                    {{--                                        <input type="password" class="form-control" name="password"--}}
                    {{--                                               value="{{ old('password') }}" placeholder="Mot de passe">--}}
                    {{--                                        @if ($errors->has('password'))--}}
                    {{--                                            <div class="help-block">--}}
                    {{--                                                <strong>{{ $errors->first('password') }}</strong>--}}
                    {{--                                            </div>--}}
                    {{--                                        @endif--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="m-t-10 sm-m-t-10">--}}
                    {{--                                <button type="submit" class="btn btn-primary btn-block m-t-5">--}}
                    {{--                                    Valider le changement--}}
                    {{--                                </button>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </form>--}}
                </div>
            </div>
        </div>
    </div>
@endif

<script src="{{ asset('pages-assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/jquery/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/modernizr.custom.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/tether/js/tether.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/jquery/jquery-easy.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/jquery-unveil/jquery.unveil.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/jquery-ios-list/jquery.ioslist.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/jquery-actual/jquery.actual.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/classie/classie.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/switchery/js/switchery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/nvd3/lib/d3.v3.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/nvd3/nv.d3.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/nvd3/src/utils.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/nvd3/src/tooltip.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/nvd3/src/interactiveLayer.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/nvd3/src/models/axis.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/nvd3/src/models/line.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/nvd3/src/models/lineWithFocusChart.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/mapplic/js/hammer.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/mapplic/js/jquery.mousewheel.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/mapplic/js/mapplic.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/rickshaw/rickshaw.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/skycons/skycons.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/pages/js/pages.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/js/notie.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/datatables-responsive/js/datatables.responsive.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/sweetalert/sweetalert2.all.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/js/datatables.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/js/scripts.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/bootstrap3-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ asset('plugins/ckeditor/js/ckeditor.js') }}"></script>
<script src="{{ asset('plugins/ckeditor/js/adapters/jquery.js') }}"></script>
{{--<script src="{{ asset('pages-assets/js/gallery.js') }}" type="text/javascript"></script>--}}
<script src="{{ asset('pages-assets/plugins/jquery-metrojs/MetroJs.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('pages-assets/plugins/jquery-isotope/isotope.pkgd.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/codrops-dialogFx/dialogFx.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/owl-carousel/owl.carousel.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/jquery-nouislider/jquery.nouislider.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/jquery-nouislider/jquery.liblink.js') }}" type="text/javascript"></script>
<script src="{{ asset('pages-assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js') }}"
        type="text/javascript"></script>
<script type="text/javascript"
        src="{{ asset('pages-assets/plugins/bootstrap-form-wizard/js/jquery.bootstrap.wizard.min.js') }}"></script>
{{--<script src="{{ asset('pages-assets/pages/js/pages.email.js') }}" type="text/javascript"></script>--}}

@yield('modals')
@yield('js')
@include('admin.partials.notifications')

<script>

    $(function () {
        $('.editor').ckeditor(function () {
            // Callback function code.
        }, {
            // Config options here
        });

    })

    $(document).ready(function () {

        var table = $('#tableWithSearch');
        console.log(table);
        var settings = {
            "sDom": "<t><'row'<p i>>",
            "destroy": true,
            "pageLength": 50,
            "columnDefs": [
                { orderable: false, targets: 0 }
            ],
            "scrollCollapse": true,
            "language": {
                "sLengthMenu": "_MENU_ ",
                // "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
                "lengthMenu": "Voir _MENU_",
                "search": "Recherche",
                // "info": "Voir _START_  _END_ of _TOTAL_ "
                "info": "",
                "searchPlaceholder": 'Recherche'
            },
            "iDisplayLength": 10
        };

        table.dataTable(settings);

        // search box for table
        $('#search-table').keyup(function () {
            table.fnFilter($(this).val());
        });

        $('#search-table-name').keyup(function () {
            table.fnFilter($(this).val(), 1);
        });

        $('#search-table-lastname').keyup(function () {
            table.fnFilter($(this).val(), 2);
        });

        $('#search-table-society').keyup(function () {
            table.fnFilter($(this).val(), 3);
        });
    });
</script>

</body>
</html>
