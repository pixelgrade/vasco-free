import * as Masonry from 'masonry-layout';
import $ from 'jquery';
import { BaseTheme, JQueryExtended } from '../../../components/base/ts/BaseTheme';
import { Helper } from '../../../components/base/ts/services/Helper';
import { SearchOverlay } from '../../../components/base/ts/components/SearchOverlay';

export class Bobo extends BaseTheme {
  public SearchOverlay: SearchOverlay;

  constructor() {
    super();

    this.handleContent();
  }

  public bindEvents() {
    super.bindEvents();
  }

  public onLoadAction() {
    super.onLoadAction();
    this.SearchOverlay = new SearchOverlay();
    this.adjustLayout();
  }

  public onResizeAction() {
    super.onResizeAction();
    this.adjustLayout();
  }

  public onJetpackPostLoad() {
    const $container = ($( '#posts-container' ) as JQueryExtended );

    this.handleContent( $container );
    this.adjustLayout();
  }

  public handleContent( $container: JQuery = this.$body ) {

    Helper.unwrapImages( $container.find( '.entry-content' ) );
    Helper.wrapEmbeds( $container.find( '.entry-content' ) );
    Helper.handleVideos( $container );
    Helper.handleCustomCSS( $container );

    this.handleGalleries( $container );
    this.eventHandlers( $container );

    const $commentForm = $container.find( '.comment-form' );

    if ( $commentForm.length ) {
      const $commentFormFooter = $( '<div class="comment-form-subscriptions"></div>' ).appendTo( $commentForm );
      $commentForm.find( '.comment-subscription-form' ).appendTo( $commentFormFooter );
    }
  }

  public handleGalleries( $container: JQuery = Helper.$body ) {
    $container.find( '.u-gallery-type--masonry' ).each( (index, element) => {
      new Masonry( element, { transitionDuration: 0 } );
    });
  }

  private adjustLayout() {
  }

}
