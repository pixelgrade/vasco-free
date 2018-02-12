import * as Masonry from 'masonry-layout';
import $ from 'jquery';
import CircleType from 'circletype';
import { BaseTheme, JQueryExtended } from '../../../components/base/ts/BaseTheme';
import { Helper } from '../../../components/base/ts/services/Helper';
import { SearchOverlay } from '../../../components/base/ts/components/SearchOverlay';
import { Header } from '../../../components/header/ts/Header';
import { Gallery } from '../../../components/base/ts/components/Gallery';
import { ExtendedWindow, GlobalService } from '../../../components/base/ts/services/global.service';
import { Blob } from '../../../components/base/ts/components/blob';

export class Bobo extends BaseTheme {
  public SearchOverlay: SearchOverlay;
  public Header: Header;

  private blobs: Blob[] = [];

  constructor() {
    super();

    this.handleContent();
    this.groupWidgets();
    this.generateBlobs();

    GlobalService
      .onCustomizerRender()
      .debounce( 300 )
      .takeWhile( () => this.subscriptionActive )
      .subscribe( () => {
        this.groupWidgets();
        this.prepareFeatureHover();
        this.initStamp();
      } );

    GlobalService
      .onCustomizerChange()
      .debounce( 300 )
      .takeWhile( () => this.subscriptionActive )
      .subscribe( () => {
        this.prepareFeatureHover();
        this.initStamp();
      } );

    GlobalService
      .onCustomizerChange()
      .takeWhile( () => this.subscriptionActive )
      .subscribe( () => {
        this.updateBlobParameters();
      } );
  }

  public updateBlobParameters() {
    const extWindow: ExtendedWindow = window;
    const wp = extWindow.wp;
    const $goo = $('#goo');

    const complexity = 1 - parseInt( wp.customize( 'bobo_options[blobs_complexity]' )(), 10 ) / 100;
    const smoothness = parseInt( wp.customize( 'bobo_options[blobs_smoothness]' )(), 10 );
    const seed = parseInt( wp.customize( 'bobo_options[blobs_seed]' )(), 10 );

    this.blobs.forEach( ( blob ) => {
      if ( blob.getSeed() !== seed ) {
        blob.setSides( Math.max( 5, Math.floor( Math.sqrt( seed ) ) ) );
        blob.setSeed( seed );
        blob.render();
      }
      blob.setComplexity( complexity );
    });

    requestAnimationFrame(() => {
      const stdDeviation = Math.max(smoothness, 0);
      const rgbaMatrix = '0 0 0 ' + (1 + smoothness) + ' -' + (smoothness / 3);

      $goo.find( 'feGaussianBlur' ).attr( 'stdDeviation', stdDeviation );
      $goo.find( 'feColorMatrix' )
        .attr( 'values', '1 0 0 0 0  0 1 0 0 0  0 0 1 0 0 ' + rgbaMatrix );
    });
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

    $container.find( '.c-gallery' ).not( '.c-gallery--widget' ).each((index, element) => {
      new Gallery( $( element ) );
    });
  }

  public generateBlobs() {
    const seed = parseInt( $( 'body' ).data( 'blobs-seed' ), 10 );
    const sides = Math.max( 5, Math.floor( Math.sqrt( seed ) ) );

    $( '.blob--shape-1' ).each( (i, obj) => {
      const $obj = $(obj);
      // const blob = new Blob(7, seed);
      const blob = new Blob(sides, seed);

      this.blobs.push( blob );
      $obj.append( blob.getSvg() );
    });

    $( '.blob--shape-2' ).each( (i, obj) => {
      const $obj = $(obj);
      // const blob = new Blob(9, seed);
      const blob = new Blob(sides, seed, 1);

      this.blobs.push( blob );
      $obj.append( blob.getSvg() );
    });

    $( '.blob--shape-3' ).each( (i, obj) => {
      const $obj = $(obj);
      // const blob = new Blob(12, seed);
      const blob = new Blob(sides, seed, 2);

      this.blobs.push( blob );
      $obj.append( blob.getSvg() );
    });

  }

  public groupWidgets() {

    if ( ! $( 'body.is-customizer-preview' ).length ) {
      return;
    }

    const $sidebar = $('.widget-area--front-page-1');
    const $widgets = $sidebar.find('.widget');

    const featureWidgetSelector = '.widget_feature_card';
    const stampWidgetSelector = '.widget_stamp';
    const newsletterWidgetSelector = '.widget_mc4wp_form_widget';
    const socialWidgetSelector = '.widget_wpcom_social_media_icons_widget';
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

}
