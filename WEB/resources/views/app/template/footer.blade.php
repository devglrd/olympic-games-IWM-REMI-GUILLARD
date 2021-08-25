</main>
</body>
<script src="{{ asset('js/app.js') }}"></script>

<!-- Start of HubSpot Embed Code -->
{{--<script src="{{ asset('pages-assets/js/notie.js') }}" type="text/javascript"></script>--}}

<!-- End of HubSpot Embed Code -->

@include('app.partials.notifications')
@yield('js')


@if(Session::has('close') && Session::get('close'))
    <script>
        $(document).ready(function () {
            window.close()
        });
    </script>
@endif

</html>


