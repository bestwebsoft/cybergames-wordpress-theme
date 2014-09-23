(function( $ ) {
	$( document ).ready(function() { 
		/** select section restyle**/
		var test = $( 'select' ).size();
		for ( var k = 0; k < test; k++ ) {
			$( 'select' ).eq( k ).css( 'display', 'none' );
			$( 'select' ).eq( k ).after( CreateSelect( k ) );
		}
		// functional of new select
		$( '.cbg-select' ).click(function () {
			if ( $( this ).find( '.cbg-options' ).css( 'display' ) == 'none' ) {
				$( this ).css( 'z-index', '100' );
				$( this ).find( '.cbg-options' ).css( {
					'display': 'block'
				});
			} else {
				$( this ).css( 'z-index', '10' );
				$( this ).find( '.cbg-options' ).css( {
					'display': 'none'
				});
			}
		});
		$( '.cbg-select' ).find( '.cbg-option' ).click( function () {
			// write text to active opt
			$( this ).parent().parent().find( '.cbg-active-opt' ).find( 'div:first' ).text( $( this ).text() );
			// remove active option from init select
			$( this ).parent().parent().prev( 'select' ).find( 'option' ).removeAttr( 'selected' );
			// add atrr selected to select	
			$( this ).parent().parent().prev( 'select' ).find( 'option' ).eq( ( $( this ).attr( 'name' ) ) ).attr( 'selected', 'selected' );
		});
		// correct dropdowns widgets
		$( '.widget_meta' ).children( 'select' ).wrap( '<div class="cbg-dropdown-widget"></div>' );
		var drops = $( '.widget_meta' ).children( '.cbg-select' ).size();
		var current;
		var target;
		for ( var i = 0; i < 2; i++ ) {
			current = $( '.widget_meta' ).find( '.cbg-select' ).eq( i );
			target = $( current ).prev( '.cbg-dropdown-widget' );
			$( current ).detach();
			$( current ).appendTo( $( target ) );
		};
		// archive-dropdown widget functional
		$( '[name=archive-dropdown]' ).next( '.cbg-select' ).find( '.cbg-option' ).click( function () {
			location.href = $( this ).attr( 'value' );
		});
		// category-dropdown widget functional
		$( '#cat' ).next( '.cbg-select' ).find( '.cbg-option' ).click( function () {
			location.href = cybergamesScript_localization.cbg_home_url + '?cat=' + $( this ).attr( 'value' );
		});

/**search**/
		$( '.serch-txt' ).focus(function() {
			if ( $( this ).val() == this.defaultValue ) {
				$( this ).val( '' )
			}
		} );
		$( '.serch-txt' ).blur(function() {
			if ( $( this ).val() == '' ) {
				$( this ).val( this.defaultValue );
			}
		} );
		$( '.cbg-sub' ).on( 'mousedown', function( e ) {
			$( '.cbg-sub' ).data( 'mouseDown', true );
		});
		$( '.cbg-sub' ).on( 'mouseup', function( e ) {
			$( '.cbg-sub' ).data( 'mouseDown', false );
		});
		$( '.cbg-sub' ).css( {'opacity':0} )
		$( '.cbg-sub' ).removeClass( 'cbg-submit' );
		$( '#search' ).removeClass( 'text' );
		$( '.widget .search:first-child' ).parent().css( {
			backgroundColor: '#181E21',
			paddingBottom: '0px',
			paddingTop: '0px'
		} );

/**checkbox**/
		$( 'input[type="checkbox"]' ).each(function() {
			$this = $( this );
			var label = $( 'label[for="' + $this.attr( 'id' ) + '"]' );
			if ( label.length > 0 ) {//this input has a label associated with it
				label.after( '<div class="clear"></div>' );
			};
		});
		$( 'input[type="checkbox"]' ).addClass( 'check1' )
		$( '.check1' ).wrap( '<div class="cbg-chek">' );
			$( '.cbg-chek' ).click(function() {
			//Reads the value of the selected item
			if( $( this ).attr( 'class' )=='cbg-chek' ) {
				$( this ).addClass( 'active' );
				$( this ).find( 'input' ).attr( 'checked', true );
			}
			else{
				$( this ).removeClass( 'active' );
			}
		});
		$( this ).find( '.check1' ).css( {'opacity':0} );
		$( this ).find( '.check1' ).css( {'cursor':'pointer'} );
		$( '.cbg-chek' ).wrap( '<div class="clear"></div>' );

/**cbg-radio**/
$( 'input:checked' ).removeAttr( 'checked' );
		$( 'input[type="radio"]' ).each(function() {
			$this = $( this );
			var label = $( 'label[for="' + $this.attr( 'id' ) + '"]' );
			if ( label.length > 0 ) {//this input has a label associated with it
				label.after( '<div class="clear"></div>' );
			};
		});
		$( 'input[type="radio"]' ).addClass( 'radio1' );
		$( '.radio1' ).wrap( '<div class="cbg-radio">' );
		$( '.cbg-radio' ).click(function(){
			//Reads the value of the selected item
			$( '.cbg-radio' ).removeClass( 'active' );
			$( this ).removeAttr( 'checked' );
			//remove all of the selection
			if ( $( this ).attr( 'class' )=='cbg-radio' ){
				$( this ).addClass( 'active' );
				$( this ).find( 'input' ).attr( 'checked', true );
			}
			else {
				$( this ).removeClass( 'active' );
				$( this ).find( 'input' ).removeAttr( 'checked' );
				$( this ).find( 'input' ).attr( 'checked', true );
			}
		});
		$( this ).find( '.radio1' ).css( {'cursor':'pointer'} );
		$( this ).find( '.radio1' ).css( {'opacity':0} );
		$( '.cbg-radio' ).wrap( '<div class="clear"></div>' );

/**file input**/
		$( 'input[type="file"]' ).css( {'opacity':0} ).wrap( '<div class="cbg-file"></div>' );
		$( '.cbg-file' ).wrap( '<div class="file"></div>' );
		$( '.cbg-file' ).append( '<div class="cbg-text-file">Choose file ...</div>' );
		$( '.cbg-file' ).after( '<span class="cbg-text">File is not selected.</span>' );
		$( 'input[type="file"]' ).on( 'change', function() {
			var path = $( this ).val();
			if ( path ) {
				$( this ).siblings( '.cbg-text-file' ).text( path );
				$( this ).parent().siblings( '.cbg-text' ).text( 'File Selected' );
			} else {
				$( this ).siblings( '.cbg-text-file' );
				$( this ).parent().siblings( '.cbg-text' ).text( 'File is not selected.' );
			}
		});
		$( '.cbg-text-file' ).click(function() {
			$( this ).siblings( 'input[type="file"]' ).trigger( 'click' );
		});

/**clear**/
		$( 'input[type="reset"]' ).click(function () {
			$( 'input[type="text"]' ).each(function(){$( this ).val( '' );} );
			$( 'textarea' ).each(function() {$( this ).val( '' );} );
			$( 'select' ).each( function(){ 
				$( this ).val( '' );
				$( this ).children( 'option' ).removeAttr( 'selected' );
				$( this ).children( 'option:first' ).attr( 'selected', 'selected' );
				$( this ).next( '.cbg-select' ).find( '.cbg-active-opt div:first' ).text( $( this ).children( 'option:first' ).text() );
			});
			$( 'input[type="radio"]' ).each(function() {
				$( this ).checked = false;
				if( $( this ).parent().hasClass( 'active' ) ) {
					$( this ).parent().removeClass( 'active' );
					$( this ).removeAttr( 'active' );
				}
			});
			$( 'input[type="checkbox"]' ).each(function() { 
				if( $( this ).parent().hasClass( 'active' ) ) {
					$( this ).parent().removeClass( 'active' );
					$( this ).removeAttr( 'active' );
				}
			});
			$( 'input[type="file"]' ).each(function() {
				if ( $.browser.msie ) {
					$( this ).after( $( this ).clone( true ) ).remove(); /* create clone for ie as val ( '' )  doesn't work in it  */
				}
				 else {
					$( this ).val( '' );
				}
				$( '.cbg-file-text' ).text( 'File is not selected.' );
				$( '.cbg-text-file' ).text( 'Choose file ...' );
			});
		});

/**input, tags**/
		$( '.cbg-form p' ).css( {'clear':'both'} );
		$( 'input[type="submit"]' ).addClass( 'cbg-submit' );
		$( 'input[type="submit"]' ).addClass( 'cbg-submit' );
		$( 'input[type="reset"]' ).addClass( 'cbg-cler' );
		$( 'input[type="text"]' ).addClass( 'text' );
		$( 'input[type="password"]' ).addClass( 'text' );
		$( 'form' ).addClass( 'cbg-form' );
		$( '#search' ).removeClass( 'text' );
		$( '.post .cbg-top:first-child' ).css( {'display':'none'} );

/**pre**/
		$( 'pre' ).wrap( '<div class="cbg-greey"></div>' );
		$( '.reply' ).after( '<div class="clear"></div>' );

/**blockquote**/
		$( 'blockquote' ).children( 'p' ).before( '<div class="cbg-blockquote"></div>' );
		$( '#ie7 blockquote' ).each(function() {
			'\"' + $(  this  ).children( 'p' ) + '\"';
		});

/**slides**/
		var size = $( '.slidesjs-slide' ).length;
		if ( size > 1 ) {
			$( '#slides' ).slidesjs( {
				height: 360,
				play: {
					active: true,
					auto: true,
					interval: 4000,
					swap: true
				}
			});
		}
		else {
			$( '#slides' ).slidesjs({
				height: 360,
				play: {
					active: true,
					interval: 4000,
					swap: true
				}
			});
		}

/**top animate**/
		$( '.cbg-top' ).click(function() {
			$( 'html' ).animate({
				scrollTop:0}, 800
			 )
		});
	});
})( jQuery );

// function for custom select
function CreateSelect( k ) {
	// create select division
	var sel = document.createElement( 'div' );
	( function ( $ ) {
		$( sel ).addClass( 'cbg-select' );
		// create active-option division
		var active_opt = document.createElement( 'div' );
		$( active_opt ).addClass( 'cbg-active-opt' );
		$( active_opt ).append( '<div></div>' );
		$( active_opt ).append( '<div class="cbg-select-button"></div>' );
		if ( $( 'select' ).eq( k ).find( 'option[selected]' ).length > 0 ) {
			$( active_opt ).find( 'div:first' ).text( $( 'select' ).eq( k ).find( 'option[selected]' ).first().text() );
		} else {
			$( active_opt ).find( 'div:first' ).text( $( 'select' ).eq( k ).find( 'option' ).first().text() );
		};
		// create options division
		var option_array = document.createElement( 'div' );
		$( option_array ).addClass( 'cbg-options' );
		// create array of optgroups
		var count = $( 'select' ).eq( k ).find( 'optgroup' ).size();
		var optgroups = [];
		// create options division
		if ( count ) {
			var z = 0;
			for ( var i = 0; i < count; i++ ) {
				optgroups[i] = document.createElement( 'div' );
				$( optgroups[i] ).addClass( 'cbg-optgroup' );
				$( optgroups[i] )
					.text( $( 'select' ).eq( k ).find( 'optgroup' ).eq( i ).attr( 'label' ) );
			};
			for ( var i = 0; i < count; i++ ) {
				$( option_array ).append( optgroups[i] );
				for ( var j = 0; j < $( 'select' ).eq( k ).find( 'optgroup' ).eq( i ).children().size(); j++ ) {
					var opt = document.createElement( 'div' );
					$( opt ).addClass( 'cbg-option' );
					$( opt ).attr( 'value', $( 'select' ).eq( k ).find( 'optgroup' ).eq( i ).children().eq( j ).attr( 'value' ) );
					$( opt ).text( $( 'select' ).eq( k ).find( 'optgroup' ).eq( i ).children().eq( j ).text() );
					$( opt ).attr( 'name', z );
					z++;
					$( option_array ).append( opt );
				};
			};
		} else {
			for ( var i = 0; i < $( 'select' ).eq( k ).find( 'option' ).size(); i++ ) {
				var opt = document.createElement( 'div' );
				$( opt ).addClass( 'cbg-option' );
				$( opt ).attr( 'value', $( 'select' ).eq( k ).find( 'option' ).eq( i ).attr( 'value' ) );
				$( opt ).attr( 'name', i );
				$( opt ).text( $( 'select' ).eq( k ).find( 'option' ).eq( i ).text() );
				$( option_array ).append( opt );
			};
		};
		$( sel ).append( active_opt );
		$( sel ).append( option_array );
	} )( jQuery );
	return sel;
}






























