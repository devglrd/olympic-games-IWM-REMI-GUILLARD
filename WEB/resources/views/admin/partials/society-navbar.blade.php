<li class="m-t-30">
    <a href="{{action('Society\SocietyController@dashboard')}}">
        <span class="title">Home</span>
    </a>
    <span class="bg-success icon-thumbnail">
                    <i class="pg-home"></i>
                </span>
</li>
<li>
    <a href="{{ action('Society\SocietyController@edit') }}">Profil de l'entreprise</a>
    <span class="icon-thumbnail"><i class="fa fa-user"></i></span>
</li>
<li>
    <a href="{{ action('Society\SubventionController@edit') }}" title="Ma contribution entreprise">Ma contribution entreprise</a>
    <span class="icon-thumbnail"><i class="fa fa-money"></i></span>
</li>
<li>
    <a href="{{ action('Society\SalaryController@index') }}">Tous mes salariés</a>
    <span class="icon-thumbnail"><i class="fa fa-user"></i></span>
</li>

<li>
    <a href="{{ route('society.order.index') }}" title="Toutes les commandes">Toutes les commandes</a>
    <span class="icon-thumbnail"><i class="fa fa-user"></i></span>
</li>

