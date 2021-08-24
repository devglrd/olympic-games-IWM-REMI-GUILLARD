<li class="m-t-30">
    <a href="{{action('Provider\ProviderController@dashboard')}}">
        <span class="title">Home</span>
    </a>
    <span class="bg-success icon-thumbnail">
                    <i class="pg-home"></i>
                </span>
</li>
<li>
    <a href="{{ action('Provider\ProviderController@edit') }}">Mon profil</a>
    <span class="icon-thumbnail"><i class="fa fa-user"></i></span>
</li>

<li class="">
    <a href="{{ action('Provider\ProductController@index') }}"><span class="title">Mes produits</span></a>
    <span class="icon-thumbnail"><i class="fa fa-briefcase"></i></span>
</li>
<li class="">
    <a href="{{ route('provider.order.index') }}"><span class="title">Mes commandes</span></a>
    <span class="icon-thumbnail"><i class="fa fa-money"></i></span>
</li>
<li class="">
    <a href="{{ action('Provider\SalaryController@index') }}"><span class="title">Module de ventes</span></a>
    <span class="icon-thumbnail"><i class="pg-search"></i></span>
</li>
<li class="">
    <a href="{{ action('Provider\FacturationController@index') }}"><span class="title">Facturation</span></a>
    <span class="icon-thumbnail"><i class="fa fa-money"></i></span>
</li>

