import * as Masonry from 'masonry-layout';
import $ from 'jquery';
import CircleType from 'circletype';
import { BaseTheme, JQueryExtended } from '../../../components/base/ts/BaseTheme';
import { Helper } from '../../../components/base/ts/services/Helper';
import { SearchOverlay } from '../../../components/base/ts/components/SearchOverlay';
import { Header } from '../../../components/header/ts/Header';

export class Bobo extends BaseTheme {
  public SearchOverlay: SearchOverlay;
  public Header: Header;

  constructor() {
    super();

    this.handleContent();
  }

  public bindEvents() {
    super.bindEvents();
  }

  public onLoadAction() {
    super.onLoadAction();

    this.Header = new Header();
    this.SearchOverlay = new SearchOverlay();
    this.addNavigationClasses();

    this.adjustLayout();
    this.initStamp();
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

  private addNavigationClasses() {
    const $pagination = $('ul.page-numbers');
    const $paginationItems = $pagination.find('li');

    $pagination.append('<div class="page-numbers__left"></div>');
    $pagination.append('<div class="page-numbers__middle"></div>');
    $pagination.append('<div class="page-numbers__right"></div>');

    $paginationItems.each((index, element) => {
      const $element = $(element);
      if ($element.find('.prev').length) {
        $pagination.find('.page-numbers__left').append($element);
      }
      if ($element.find('.next').length) {
        $pagination.find('.page-numbers__right').append($element);
      }
      if (!$element.find('.next').length && !$element.find('.prev').length) {
        $pagination.find('.page-numbers__middle').append($element);
      }
    });
    $pagination.css( 'opacity', 1 );
  }

  private initStamp() {
    const $stamps = $('.c-stamp');
    let circleType = null;

    $stamps.each((index, element) => {
      const $element = $(element);
      const $text = $element.find('.c-stamp__text').first();

      circleType = new CircleType($text[0]);
      circleType.radius(88).dir(-1);

    });
  }

}
