{{--
	Differents types :
		- Success
		- Warning
		- Error
		- Information
--}}
@if(Session::has('success') || Session::has('error') || Session::has('warning') || Session::has('info') )
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    notie.alert(1, '{{ e(Session::get('success')) }}', 8);
                }, 1500);
            });
        </script>
    @elseif(Session::has('warning'))
        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    notie.alert(2, '{{ e(Session::get('warning')) }}', 8);
                }, 1500);
            });
        </script>
    @elseif(Session::has('error'))
        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    notie.alert(3, '{{ e(Session::get('error')) }}', 8);
                }, 1500);
            });
        </script>
    @elseif(Session::has('info'))
        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    notie.alert(4, '{{ e(Session::get('info')) }}', 8);
                }, 1500);
            });
        </script>
    @endif

@endif