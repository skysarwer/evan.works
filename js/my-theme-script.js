jQuery(document).ready(function($) {
    function bindButton() {
        var $titleBannerEditor = $( '.title-banner-editor' );
        $( '#add-title-banner-blocks' ).on( 'click', function() {
            var titleBanner = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ 'title_banner' ];
            wp.data.dispatch( 'core/editor' ).editPost( { meta: { title_banner: titleBanner } } );
            wp.data.dispatch( 'core/edit-post' ).openModal( 'edit-post/block' );
        });
    }

    $(document).on( 'click', '.editor-post-publish-panel__toggle', function(){
        var updatedTitleBanner = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'meta' )[ 'title_banner' ];
        var data = {
            action: 'save_title_banner',
            title_banner: updatedTitleBanner,
            post_id: my_plugin_data.title_banner_post_id,
            nonce: my_plugin_data.title_banner_nonce
        };
        $.post( ajaxurl, data, function( response ) {
            console.log(response);
        });
    });
});