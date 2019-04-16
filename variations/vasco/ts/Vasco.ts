import * as Masonry from 'masonry-layout';
import $ from 'jquery';
import CircleType from 'circletype';
import Cookies from 'js-cookie';
import { BaseTheme, JQueryExtended } from '../../../components/base/ts/BaseTheme';
import { Helper } from '../../../components/base/ts/services/Helper';
import { SearchOverlay } from '../../../components/base/ts/components/SearchOverlay';
import { Header } from '../../../components/header/ts/Header';
import { Gallery } from '../../../components/base/ts/components/Gallery';
import { ExtendedWindow, GlobalService } from '../../../components/base/ts/services/global.service';
import { Blob } from '../../../components/base/ts/components/blob';

import { takeWhile, debounceTime } from 'rxjs/operators';

const ANNOUNCEMENT_COOKIE_NAME: string = 'announcementClosed';

export class Vasco extends BaseTheme {
  public SearchOverlay: SearchOverlay;
  public Header: Header;
  public $announcementBar: JQueryExtended;
  public $siteHeader: JQueryExtended;
  public $toolbar: JQueryExtended;
  public $contentPaddingContainer: JQueryExtended;
  public isLoggedIn: boolean = $('body').hasClass('logged-in');
  public windowDimensions: { width: number, height: number } = {
    height: this.$window.height(),
    width: this.$window.width()
  };

  private blobs: Blob[] = [];

  constructor() {
    super();

    this.$announcementBar =  $('.c-announcement-bar');
    this.$siteHeader =  $('.site-header');
    this.$toolbar = $('.c-toolbar');
    this.$contentPaddingContainer = $('.u-header-height-padding-top');

    if ( this.isLoggedIn ) {
      this.clearAnnouncementCookie();
    }
    setTimeout(() => {
      this.initAnnouncementBar();
    }, 2000);

    this.handleContent();
    this.groupWidgets();
    this.generateBlobs();

    GlobalService
      .onCustomizerRender()
      .pipe( debounceTime( 300 ) )
      .pipe( takeWhile( () => this.subscriptionActive ) )
      .subscribe( () => {
        this.groupWidgets();
        this.prepareFeatureHover();
        this.initStamp();
      } );

    GlobalService
      .onCustomizerChange()
      .pipe( debounceTime( 300 ) )
      .pipe( takeWhile( () => this.subscriptionActive ) )
      .subscribe( () => {
        this.prepareFeatureHover();
        this.initStamp();
        this.updateBlobParameters();
      } );
  }

  public addBrowserClasses() {
    const extWindow: ExtendedWindow = window;

    $( 'body' ).toggleClass( 'is-safari', !! extWindow.safari );
  }

  public updateBlobParameters() {
    const extWindow: ExtendedWindow = window;
    const wp = extWindow.wp;

    const complexity = parseInt( wp.customize( 'vasco_options[blobs_complexity]' )(), 10 ) / 100;
    const smoothness = parseInt( wp.customize( 'vasco_options[blobs_smoothness]' )(), 10 ) / 100;
    const preset = parseInt( wp.customize( 'vasco_options[blobs_preset]' )(), 10 );

    this.blobs.forEach( ( blob ) => {
      blob.morph({complexity, preset, smoothness});
    });
  }

  public bindEvents() {
    super.bindEvents();
    this.handleFeatureCardMobileClick();
  }

  public handleFeatureCardMobileClick() {
    if (Helper.above( 'lap' )) { return; }
    const $featureWidgets = $('.widget_feature_card');

    $featureWidgets.on('click', (event: JQueryEventObject) => {
      const $actionButton = $(event.currentTarget).find('.c-feature__action').find('a');
      const href = $actionButton.attr('href');
      if (href) {
        window.location.href = $actionButton.attr('href');
      }
    } );
  }

  public onLoadAction() {
    super.onLoadAction();

    this.Header = new Header();
    this.SearchOverlay = new SearchOverlay();
    this.addNavigationClasses();
    this.addBrowserClasses();
    this.adjustLayout();
    this.initStamp();
  }

  public onResizeAction() {
    super.onResizeAction();
    this.adjustLayout();
    // Fix for iOS Safari because it triggers and Resize event when scrolling in page and the address bar hides.
    // The window dimensions don't change, only the event is triggered
    if ( this.windowDimensions.width !== this.$window.width()
      || this.windowDimensions.height !== this.$window.height() ) {
      this.windowDimensions = {
        height: this.$window.height(),
        width: this.$window.width(),
      };
      this.positionAnnouncementBar();
    }
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
    this.handleCards( $container );

    const $commentForm = $container.find( '.comment-form' );

    if ( $commentForm.length ) {
      const $commentFormFooter = $( '<div class="comment-form-subscriptions"></div>' ).appendTo( $commentForm );
      $commentForm.find( '.comment-subscription-form' ).appendTo( $commentFormFooter );
    }

    $container.find( '.c-gallery' ).not( '.c-gallery--widget' ).each((index, element) => {
      new Gallery( $( element ) );
    });
  }

  public handleCards( $container: JQuery = this.$body ) {
    const $cards = $container.find( '.c-card' );

    $cards.each((i, obj) => {
      const $card = $(obj);
      const $meta = $card.find( '.c-card__meta' ).detach();
      const $primary = $( '<div class="c-card__meta">' );
      const $secondary = $primary.clone();

      $meta.find( '.c-meta__primary' ).wrap( '<div class="c-meta">' ).parent().appendTo( $primary );
      $meta.find( '.c-meta__secondary' ).wrap( '<div class="c-meta">' ).parent().appendTo( $secondary );

      $primary.prependTo( $card );
      $secondary.appendTo( $card.find( '.c-card__aside' ) );

      $meta.remove();
    });
  }

  public generateBlobs() {
    const preset = parseInt( $( 'body' ).data( 'blobs-preset' ), 10 );
    const complexity = parseInt( $( 'body' ).data( 'blobs-complexity' ), 10 ) / 100;
    const smoothness = parseInt( $( 'body' ).data( 'blobs-smoothness' ), 10 ) / 100;

    $( '.blob--shape-1' ).each( (i, obj) => {
      const $obj = $(obj);
      const blob = new Blob(preset, complexity, smoothness);

      this.blobs.push( blob );
      $obj.append( blob.getSvg() );
    });

    $( '.blob--shape-2' ).each( (i, obj) => {
      const $obj = $(obj);
      const blob = new Blob(preset, complexity, smoothness, 1);

      this.blobs.push( blob );
      $obj.append( blob.getSvg() );
    });

    $( '.blob--shape-3' ).each( (i, obj) => {
      const $obj = $(obj);
      const blob = new Blob(preset, complexity, smoothness, 2);

      this.blobs.push( blob );
      $obj.append( blob.getSvg() );
    });

    setTimeout(() => {
      window.requestAnimationFrame(() => {
        $( '.blob--shape' ).closest( '.blob' ).addClass( 'blob--loaded' );
      });
    }, 500);
  }

  public groupWidgets() {

    if ( ! $( 'body.is-customizer-preview' ).length ) {
      return;
    }

    const $sidebars = $('.widget-area--front-page-1, .widget-area--footer-featured');

    $sidebars.each((index, obj) => {
      const $sidebar = $(obj);
      const $widgets = $sidebar.find('.widget');

      const featureWidgetSelector = '.widget_feature_card';
      const stampWidgetSelector = '.widget_stamp';
      const newsletterWidgetSelector = '.widget_mc4wp_form_widget';
      const socialWidgetSelector = '.widget_wpcom_social_media_icons_widget, .jetpack_widget_social_icons';
      const instagramWidgetSelector = '.null-instagram-feed';
      const groupDefaultClass = 'widget-group';

      $sidebar.children( '.' + groupDefaultClass ).children().unwrap();
      // @todo check why there are still
      $sidebar.children( '.' + groupDefaultClass ).remove();

      for ( let i = 0; i < $widgets.length; i++ ) {
        const $widget = $widgets.eq(i);
        const $second = $widget.next();
        const $third = $second.next();
        const $fourth = $third.next();

        let $group;
        let groupClass;
        let offset = 0;

        if ( $widget.is( featureWidgetSelector ) && $second.is( featureWidgetSelector ) ) {
          $group = $widget.add( $second );
          groupClass = 'feature-group-2';
          offset = 1;
          if ( $third.is( featureWidgetSelector ) ) {
            $group = $group.add( $third );
            groupClass = 'feature-group-3';
            offset = 2;
            if ( $fourth.is( featureWidgetSelector ) ) {
              $group = $group.add( $fourth );
              groupClass = 'feature-group-4';
              offset = 3;
            }
          }
        }

        if ( $widget.is( newsletterWidgetSelector ) && $second.is( stampWidgetSelector ) ||
          $widget.is( stampWidgetSelector ) && $second.is( newsletterWidgetSelector ) ) {
          $group = $widget.add( $second );
          groupClass = 'stamp-newsletter-group';
          offset = 1;
        }

        if ( $widget.is( socialWidgetSelector ) && $second.is( instagramWidgetSelector ) ||
          $widget.is( instagramWidgetSelector ) && $second.is( socialWidgetSelector ) ) {
          $group = $widget.add( $second );
          groupClass = 'social-instagram-group';
          offset = 1;
        }

        if ( $group ) {
          $group.wrapAll( '<div class="' + groupClass + ' ' + groupDefaultClass + '">' );
        }

        i += offset;
      }
    });
  }

  public handleGalleries( $container: JQuery = Helper.$body ) {
    $container.find( '.js-masonry, .u-gallery-type--masonry' ).each( (index, element) => {
      new Masonry( element, { transitionDuration: 0 } );
    });
  }

  private prepareFeatureHover() {
    $( '.c-feature' ).each((i, obj) => {
      const $obj = $(obj);
      const objOffset = $obj.offset();
      const objHeight = $obj.outerHeight();
      const $title = $obj.find( '.c-feature__title' ).css( {
        transform: '',
        transition: 'none'
      } );
      const titleOffset = $title.offset();
      const titleHeight = $title.outerHeight();
      const distanceTop = objOffset.top - titleOffset.top;
      const distanceBottom = titleOffset.top + titleHeight - ( objOffset.top + objHeight );
      const $target = $obj.find( '.c-feature__title, .c-feature__description, .c-feature__action' );
      const transformString = 'translate3d(0,' + ( distanceTop / 2 - distanceBottom / 2 ) + 'px ,0)';

      $target.css({
        transform: transformString,
        transition: 'none'
      });

      $title.css( 'opacity', 1 );
      requestAnimationFrame(() => {
        $target.css('transition', '');
      });
    });
  }

  private makeStampInGroupSquare() {
    $( '.stamp-newsletter-group' ).each( (i, obj) => {
      const $obj = $(obj);
      const $stampWidget = $obj.find( '.widget_stamp' ).css( 'width', '' );

      // requestAnimationFrame( () => {
      $stampWidget.outerWidth( $stampWidget.outerHeight() );
      // });
    });
  }

  private profileWidget() {
    const $widgets = $( '.c-profile' );

    $widgets.each((i, obj) => {
      const $widget = $(obj);
      const widgetHeight = $widget.outerHeight();

      $widget.find( '.c-profile__dropcap' ).css( 'fontSize', widgetHeight * 0.8 );
    });
  }

  private adjustLayout() {
    this.profileWidget();
    this.prepareFeatureHover();
    this.makeStampInGroupSquare();
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
    const $stamps = $('.c-stamp.c-stamp--auto');
    let circleType = null;

    $stamps.each((index, element) => {
      const $element = $(element);
      const $text = $element.find('.c-stamp__text').first();
      circleType = new CircleType($text[0]);
      circleType.radius(89).dir(-1);
      if ($element.parent().hasClass('blob-container')) {
        $element.addClass('c-stamp--rotated');
      }
      setTimeout(() => {
        $element.css('opacity', 0.9);
      }, 200);
    });
  }

  private clearAnnouncementCookie() {
    Cookies.remove(ANNOUNCEMENT_COOKIE_NAME);
  }

  private initAnnouncementBar() {
    this.positionAnnouncementBar();
    this.$announcementBar.removeClass('c-announcement-bar--hidden');
    $('.js-announcement-bar__close').on('click', this.onAnnouncementClose.bind(this));
  }

  private positionAnnouncementBar() {
    const isDisabled = Cookies.get('announcementClosed') === 'true';

    if (isDisabled) {
      return;
    }

    const adminBarHeight = $( '#wpadminbar' ).outerHeight();
    const announcementBarHeight = this.$announcementBar.outerHeight();

    this.$siteHeader.css( 'top', announcementBarHeight + adminBarHeight);
    this.$toolbar.css( 'top', announcementBarHeight + adminBarHeight );
    this.$contentPaddingContainer.css( 'marginTop', announcementBarHeight );
    this.$announcementBar.css( 'top', adminBarHeight );
  }

  private revertAnnouncementChanges() {
    this.$siteHeader.css( 'top', '' );
    this.$toolbar.css( 'top', '' );
    this.$contentPaddingContainer.css( 'marginTop', '' );
  }

  private onAnnouncementClose(event: JQueryEventObject) {
    event.preventDefault();

    this.revertAnnouncementChanges();
    this.$announcementBar.addClass('c-announcement-bar--hidden');

    if ( ! this.isLoggedIn ) {
      Cookies.set(ANNOUNCEMENT_COOKIE_NAME, 'true', { expires: 1 });
    }
  }

}
