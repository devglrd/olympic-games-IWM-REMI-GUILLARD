<div class="page-container">
    <div class="header">
        <a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-menu" data-toggle="sidebar"></a>
        <div class="">
            <div class="brand inline m-l-10">
                <a href="{{ action([\App\Http\Controllers\Admin\DashboardController::class,'dashboard']) }}">
                    <img src="{{asset('images/logo_connexion.png')}}" alt="" width="150px">
                </a>
            </div>
        </div>

        <div class="d-flex align-items-center user-infos">
            <div class="pull-left p-r-10 fs-14 font-heading hidden-md-down">
                <span class="bold user-infos-name">
                    {{ ucfirst(auth()->user()->name) }}
                </span>
            </div>
            <div class="dropdown pull-right hidden-md-down">
                <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    <span class="thumbnail-wrapper d32 circular inline  navbar-avatar">
                      <img src="{{ isset($avatar) ? $avatar : asset('pages-assets/img/profiles/avatar.jpg') }}" alt=""
                           data-src="{{ isset($avatar) ? $avatar : asset('pages-assets/img/profiles/avatar.jpg') }}"
                           data-src-retina="{{ isset($avatar) ? $avatar : asset('pages-assets/img/profiles/avatar.jpg') }}"
                           width="32"
                           height="32">
                    </span>
                </button>

                <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                    <a href="{{ action([\App\Http\Controllers\Admin\Cms\UsersController::class, 'edit'], ucfirst(auth()->user()->id)) }}" class="dropdown-item">
                        Mon profil
                    </a>
                    <a href="{{ action([\App\Http\Controllers\Admin\Auth\LoginController::class, 'logout']) }}"
                       class="clearfix bg-master-lighter dropdown-item">
                        <span class="pull-left">Deconnexion</span>
                        <span class="pull-right">
                            <i class="pg-power"></i>
                        </span>
                    </a>
                </div>
            </div>
            <a href="#" class="header-icon pg pg-alt_menu btn-link m-l-10 sm-no-margin d-inline-block" data-toggle="quickview" data-toggle-element="#quickview"></a>
            <div class="ap"><div class="badge badge-success text-white text-center">{{ countNotif() }}</div></div>
        </div>
    </div>
    <div class="page-content-wrapper full-height">

    <div id="quickview" class="quickview-wrapper" data-pages="quickview">
      <div class="view-port clearfix" id="alerts">
        <!-- BEGIN Alerts View !-->
        <div class="view bg-white">
          <!-- BEGIN View Header !-->
          <div class="navbar navbar-default navbar-sm">
            <div class="navbar-inner">
              <!-- END Header Controler !-->
              <div class="view-heading">
                Notications <div class="badge badge-success text-white text-center">{{ countNotif() }}</div>
              </div>
              <!-- BEGIN Header Controler !-->
              <a class="btn-link quickview-toggle" data-toggle-element="#quickview" data-toggle="quickview">
                <i class="pg-close"></i>
              </a>
              <!-- END Header Controler !-->
            </div>
          </div>
          <!-- END View Header !-->
          <!-- BEGIN Alert List !-->
          <div data-init-list-view="ioslist" class="list-view boreded no-top-border">
            <!-- BEGIN List Group !-->
            <div class="list-view-group-container">
              <!-- BEGIN List Group Header!-->
              <div class="list-view-group-header text-uppercase">
                Aujourd'hui
              </div>
              <!-- END List Group Header!-->
              <ul>
                <!-- BEGIN List Group Item!-->
                  @foreach(getAlertes() as $index => $alert)
                      <li class="alert-list">
                          <!-- BEGIN Alert Item Set Animation using data-view-animation !-->
                          <a href="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'showAlert'], $alert->id) }}" class="align-items-center">
                              <p class="">
                                  <span class="text-warning fs-10"><i class="fa fa-circle"></i></span>
                              </p>
                              <p class="p-l-10 overflow-ellipsis fs-12">
                                  <span class="text-master">{{ $alert->getClient->name }} {{ $alert->getClient->first_name }}</span>
                                  <br>
                                  <span class="text-master">{{ $alert->content }}</span>
                              </p>
                              <p class="p-r-10 ml-auto fs-12 text-right">
                                  <span class="text-warning">Today <br></span>
                              </p>
                          </a>
                          <!-- END Alert Item!-->
                          <!-- BEGIN List Group Item!-->
                      </li>
                  @endforeach
                <!-- END List Group Item!-->
              </ul>
            </div>
              <div class="list-view-group-container">
                  <!-- BEGIN List Group Header!-->
                  <div class="list-view-group-header text-uppercase">
                      Plus tôt
                  </div>
                  <!-- END List Group Header!-->
                  <ul>
                      <!-- BEGIN List Group Item!-->
                      @foreach(getAlertesUnSeen() as $index => $alert)
                          <li class="alert-list">
                              <!-- BEGIN Alert Item Set Animation using data-view-animation !-->
                              <a href="{{ action([\App\Http\Controllers\Admin\Cms\ClientController::class, 'showAlert'], $alert->id) }}" class="align-items-center">
                                  <p class="">
                                      <span class="text-warning fs-10"><i class="fa fa-circle"></i></span>
                                  </p>
                                  <p class="p-l-10 overflow-ellipsis fs-12">
                                      <span class="text-master">{{ $alert->getClient->name }} {{ $alert->getClient->first_name }}</span>
                                      <br>
                                      <span class="text-master">{{ $alert->content }}</span>
                                  </p>
                                  <p class="p-r-10 ml-auto fs-12 text-right">
                                      <span class="text-warning">{{$alert->trigger}} <br></span>
                                  </p>
                              </a>
                              <!-- END Alert Item!-->
                              <!-- BEGIN List Group Item!-->
                          </li>
                  @endforeach
                  <!-- END List Group Item!-->
                  </ul>
              </div>
            <!-- END List Group !-->
          </div>
          <!-- END Alert List !-->
        </div>
        <!-- EEND Alerts View !-->
      </div>
    </div>

