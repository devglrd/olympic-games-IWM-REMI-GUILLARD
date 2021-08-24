<li class="m-t-30">
    <a href="{{action([\App\Http\Controllers\Admin\DashboardController::class,'dashboard'])}}">
        <span class="title">Dashboard</span>
    </a>
    <span class="bg-success icon-thumbnail">
                    <i class="pg-home"></i>
                </span>
</li>




<li>
<a href="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'index']) }}">Clients</a>
    <span class="icon-thumbnail"><i class="fa fa-user"></i></span>
</li>

<li>
    <a href="javascript:;">
        <span class="title">Coachs</span>
        <span class="arrow pr-0"></span>
    </a>
    <span class="icon-thumbnail">
                    <i class="fa fa-male"></i>
                </span>
    <ul class="sub-menu">
        <li>
            <a href="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'index']) }}">Coachs</a>
            <span class="icon-thumbnail"><i class="fa fa-male"></i></span>
        </li>
        <li>
            <a href="{{ action([\App\Http\Controllers\SskController::class, 'index']) }}">Compétences de coaching</a>
            <span class="icon-thumbnail"><i class="fa  fa-mortar-board"></i></span>
        </li>

        <li>
            <a href="{{ action([\App\Http\Controllers\Admin\Cms\SkillController::class, 'index']) }}">Traits de
                caractère de coach</a>
            <span class="icon-thumbnail"><i class="fa fa-gittip"></i></span>
        </li>
    </ul>
</li>

<li>
    <a href="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'eval']) }}">Evaluations</a>
    <span class="icon-thumbnail"><i class="fa fa-calendar"></i></span>
</li>
<li>
    <a href="{{ action([\App\Http\Controllers\Admin\Cms\CoachController::class, 'planning']) }}">Planning</a>
    <span class="icon-thumbnail"><i class="fa fa-calendar"></i></span>
</li>

<li>
    <a href="{{ action([\App\Http\Controllers\Admin\Cms\WallOfferController::class, 'index']) }}">Offres</a>
    <span class="icon-thumbnail"><i class="fa fa-newspaper-o"></i></span>
</li>

<!--
<li>
    <a href="javascript:;">
        <span class="title">Offres de Coaching</span>
        <span class="arrow p-r-0"></span>
    </a>
    <span class="icon-thumbnail">
                    <i class="fa fa-user"></i>
                </span>
    <ul class="sub-menu">
        <li>
            <a href="{{ action([\App\Http\Controllers\Admin\Cms\WallOfferController::class, 'index']) }}">Offres en attente</a>
            <span class="icon-thumbnail">pgs</span>
        </li>
        <li>
            <a href="{{ action([\App\Http\Controllers\Admin\Cms\WallOfferController::class, 'notFound']) }}">Offres publiées</a>
            <span class="icon-thumbnail">pgs</span>
        </li>
        <li>
            <a href="{{ action([\App\Http\Controllers\Admin\Cms\WallOfferController::class, 'indexFound']) }}">Offres validées</a>
            <span class="icon-thumbnail">pgs</span>
        </li>
    </ul>
</li>

-->

<li>
    <a href="{{ action([\App\Http\Controllers\Admin\Cms\AlertController::class, 'index']) }}">Mes alertes clients</a>
    <span class="icon-thumbnail"><i class="fa fa-bullhorn"></i></span>
</li>

<li>
    <a href="{{ action([\App\Http\Controllers\Admin\Cms\ProductController::class, 'index'], ['abonnement' => true]) }}">Produits</a>
    <span class="icon-thumbnail"><i class="fa  fa fa-cubes"></i></span>

</li>

<li>
    <a href="{{ action([\App\Http\Controllers\Admin\DashboardController::class, 'indexVente']) }}">Ventes</a>
    <span class="icon-thumbnail"><i class="fa  fa-money"></i></span>

</li>

<li>
    <a href="{{ action([\App\Http\Controllers\Admin\DashboardController::class, 'typeSeance']) }}">Types de séance</a>
    <span class="icon-thumbnail"><i class="fa fa-shekel"></i></span>
</li>
<li>
    <a href="{{ action([\App\Http\Controllers\Admin\Cms\ActivityController::class, 'index']) }}">Activités</a>
    <span class="icon-thumbnail"><i class="fa  fa-soccer-ball-o"></i></span>
</li>


<li>
    <a href="{{ action([\App\Http\Controllers\Admin\Cms\UsersController::class, 'index']) }}">Admins</a>
    <span class="icon-thumbnail"><i class="fa fa-star"></i></span>
</li>

<li>
    <a href="{{ action([\App\Http\Controllers\Admin\Cms\ExportController::class, 'index']) }}">Export</a>
    <span class="icon-thumbnail"><i class="fa fa-exchange"></i></span>
</li>


{{--<li>--}}
{{--    <a href="{{ action([\App\Http\Controllers\Admin\Cms\UsersController::class, 'index']) }}">Facturation</a>--}}
{{--    <span class="icon-thumbnail"><i class="fa fa-user"></i></span>--}}
{{--</li>--}}


{{--<li>--}}
{{--    <a href="javascript:;">--}}
{{--        <span class="title">Blog</span>--}}
{{--        <span class="arrow"></span>--}}
{{--    </a>--}}
{{--    <span class="icon-thumbnail">--}}
{{--                    <i class="fa fa-user"></i>--}}
{{--                </span>--}}
{{--    <ul class="sub-menu">--}}
{{--        <li class="">--}}
{{--            <a href="javascript:;" class="w-100"><span class="title">Post</span>--}}
{{--                <span class="arrow"></span></a>--}}
{{--            <ul class="sub-menu">--}}
{{--                <li>--}}
{{--                    <a href="{{ action('Admin\Cms\Blog\PostController@create') }}">Ajouter un article</a>--}}
{{--                    <span class="icon-thumbnail">pgs</span>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="{{ action('Admin\Cms\Blog\PostController@index') }}">Tout les articles</a>--}}
{{--                    <span class="icon-thumbnail">pgs</span>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li class="">--}}
{{--            <a href="javascript:;" class="w-100"><span class="title">Categorie</span>--}}
{{--                <span class="arrow"></span></a>--}}
{{--            <ul class="sub-menu">--}}
{{--                <li>--}}
{{--                    <a href="{{ action('Admin\Cms\Blog\CategoriesController@create') }}">Ajouter une--}}
{{--                        categorie</a>--}}
{{--                    <span class="icon-thumbnail">pgs</span>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="{{ action('Admin\Cms\Blog\CategoriesController@index') }}">Toutes les--}}
{{--                        categories</a>--}}
{{--                    <span class="icon-thumbnail">pgs</span>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--    </ul>--}}

{{--</li>--}}
