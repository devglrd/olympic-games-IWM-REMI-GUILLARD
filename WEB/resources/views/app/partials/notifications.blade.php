{{--
	Differents types :
		- Success
		- Warning
		- Error
		- Information
--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/notie/4.3.1/notie.min.js"></script>

@if(Session::has('success') || Session::has('error') || Session::has('warning') || Session::has('info') )
    @if(Session::has('success'))
        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    notie.alert({type: 1, text: "{{ session()->get('success') }}", time: 3})
                }, 500);
            });
        </script>
    @elseif(Session::has('warning'))
        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    notie.alert({type: 2, text: "{{ session()->get('warning') }}", time: 3})
                }, 500);
            });
        </script>
    @elseif(Session::has('error'))
        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    notie.alert({type: 3, text: "{{ session()->get('error') }}", time: 3})
                }, 500);
            });
        </script>
    @elseif(Session::has('info'))
        <script>
            $(document).ready(function () {
                setTimeout(function () {
                    notie.alert({type: 4, text: "{{ session()->get('info') }}", time: 3})

                }, 500);
            });
        </script>
    @endif

@endif
