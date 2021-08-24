@include('admin.template.header')
@if(!isset($noNavBar) || !$noNavBar)
    @include('admin.template.navbar')
@endif
@include('admin.template.navtop', ['space' => session()->get('space'), 'avatar' => session()->get('avatar'),'name' => session()->get('name'), 'lastname' => session()->get('lastname')])


@yield('content')

@include('admin.template.footer')
