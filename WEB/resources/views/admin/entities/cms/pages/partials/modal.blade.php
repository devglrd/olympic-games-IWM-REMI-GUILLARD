<div class="modal fade slide-up disable-scroll" id="createFolderModal" tabindex="-1" role="dialog"
     aria-hidden="false">
    <div class="modal-dialog ">
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="modal-header clearfix text-left">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="pg-close fs-14"></i>
                    </button>
                    <h5>Créer un <span class="semi-bold">dossier</span></h5>
                    <p class="p-b-10">Les dossiers permettent de mieux catégoriser les blocs</p>
                </div>
                <div class="modal-body">
                    <form id="createFolderForm" method="POST"
                          action="{{ action('Admin\Cms\BlocksController@createFolder', $page->id) }}"
                            {{--                              data-endpoint="{{ action('Admin\Cms\BlocksController@createFolder', $page->id) }}">--}}>
                        {{ csrf_field() }}
                        <div class="form-group-attached">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <label>Nom du dossier</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 m-t-10 sm-m-t-10">
                                <button type="submit" class="btn btn-primary btn-block m-t-5">
                                    Créer le dossier
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade slide-up disable-scroll" id="createBlockModal" tabindex="-1" role="dialog"
     aria-hidden="false">
    <div class="modal-dialog ">
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="modal-header clearfix text-left">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="pg-close fs-14"></i>
                    </button>
                    <h5>Créer un <span class="semi-bold">bloc</span></h5>
                </div>
                <div class="modal-body">
                    <form id="createBlockForm" method="post" enctype="multipart/form-data"
                          action="{{ action('Admin\Cms\BlocksController@createBlock', $page->id) }}">
                        {{ csrf_field() }}
                        <div class="form-group-attached">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                        <label>Nom du bloc</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-group-default mt-1">
                                        <label>Type de bloc</label>
                                        <select name="type" class="form-control" id="selectCreateType">
                                            <option value="">Merci de choisir une valeur</option>
                                            <option value="text">Texte</option>
                                            {{--<option value="image">Image</option>--}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="form-group form-group-default">
                                        <label>Catégorie de bloc</label>
                                        <select name="category" class="form-control">
                                            <option value="">Merci de choisir une valeur</option>
                                            @foreach($page->getCategories AS $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{--<div class="col-md-12 mt-2" id="imageSelected" style="display:none;">--}}
                                    {{--<div class="form-group form-group-default">--}}
                                        {{--<label>Votre image</label>--}}
                                        {{--<input type="file" name="image">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="col-md-12 mt-2" id="textSelected" style="">
                                    <div class="form-group form-group-default">
                                        <label>Votre texte</label>
                                        <textarea name="content" class="form-control" style="height:100px;"
                                                  placeholder="Contenu de votre bloc"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 m-t-10 sm-m-t-10">
                                <button type="submit" class="btn btn-primary btn-block m-t-5">
                                    Créer le bloc
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>