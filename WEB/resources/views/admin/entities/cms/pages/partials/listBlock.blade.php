<div class="list-view-wrapper">
    <div class="list-view-group-container">
        <ul class="no-padding" id="blocks">
            @foreach($blocks as $block)
                <li class="item padding-15">
                    <a href="{{ action('Admin\Cms\BlocksController@showBlocksDetails', [$page->id, $category->slug, $block->id]) }}">
                        <div class="thumbnail-wrapper d32 circular">
                        </div>
                        <div class="inline m-l-15">
                            <span><strong>Clé :</strong>{{ $block->key }}</span>
                            <br>
                            <span><strong>Valeur :</strong></span>
                            <p class="recipients no-margin hint-text small">
                                {{ $block->value }}
                            </p>
                            <span><strong>Type :</strong>{{ $block->type }}</span>

                        </div>
                        
                        <div class="clearfix"></div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>