{{--<li>--}}
{{--    --}}
{{--</li>--}}
<li class="m-t-30">
    <a href="{{action('Salary\SalaryController@dashboard')}}">
        <span class="title">Home</span>
    </a>
    <span class="bg-success icon-thumbnail">
                    <i class="pg-home"></i>
                </span>
</li>
<li>
    <a href="{{ action('Salary\SalaryController@show') }}">Mon profil</a>
    <span class="icon-thumbnail"><i class="fa fa-user"></i></span>
</li>
{{--<li>--}}
{{--    <a href="{{ action('Salary\SalaryController@payment') }}" title="Mes informations de paiement">Mes informations de paiement</a>--}}
{{--    <span class="icon-thumbnail"><i class="fa fa-money"></i></span>--}}
{{--</li>--}}

<li>
    <a href="{{ action('Salary\SalaryController@insurance') }}" title="Assurance & maintenance">Assurance & maintenance</a>
    <span class="icon-thumbnail"><i class="fa fa-wrench"></i></span>
</li>

<li>
    <a href="{{ action('Salary\SalaryController@provider') }}" title="Trouver mon deux-roues">Trouver mon
        deux-roues</a>
    <span class="icon-thumbnail"><i class="fa fa-search"></i></span>
</li>

<li>
    <a href="javascript:;">
        <span class="title">Mes achats</span>
        <span class="arrow"></span>
    </a>
    <span class="icon-thumbnail">
                    <i class="pg-bag"></i>
                </span>
    <ul class="sub-menu">
        <li>
            <a href="{{ route('salary.order.index', ['type' =>'running']) }}">Mes achats en cours</a>
            <span class="icon-thumbnail"><i class="fa fa-money"></i></span>
        </li>
        <li>
            <a href="{{ route('salary.order.index', ['type' =>'done']) }}">Mes achats finalisés</a>
            <span class="icon-thumbnail"><i class="fa fa-money"></i></span>
        </li>
    </ul>
</li>

<li>
    <a href="{{ action('Salary\SalaryController@subventions') }}" title="Mes contributions publiques">Mes subventions publiques</a>
    <span class="icon-thumbnail"><i class="fa fa-money"></i></span>
</li>

