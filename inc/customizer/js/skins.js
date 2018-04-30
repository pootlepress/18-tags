// region Set up
etps = {};
etpSkins = 'object' === typeof etpSkins && etpSkins ? etpSkins : {};
// endregion

( function ( $ ) {

	etps.prepMaps = function () {
		var count, supportedTypes;
		etps.settingsMaps = {};
		count = 0;
		supportedTypes = ['theme_mod'];
		$.each( wp.customize.settings.controls, function ( k, control ) {
			var ref, setting, settingId;
			if ( control && control.settings && control.settings["default"] ) {
				settingId = control.settings["default"];
				if ( wp.customize.settings.settings[settingId] ) {
					setting = wp.customize.settings.settings[settingId];
					if ( 0 > settingId.indexOf( 'etp_skins' ) ) {
						if ( supportedTypes.indexOf( setting.type ) >= 0 ) {
							count ++;
							etps.settingsMaps[settingId] = k;
						}
					}
				}
			}
			return void 0;
		} );
		return console.log( count + ' settings mapped' );
	};
	etps.get = function ( id ) {
		if ( wp.customize.control.value( id ) ) {
			return wp.customize.control.value( id ).setting.get();
		} else {
			return 'etp_skins_no_value';
		}
	};
	etps.set = function ( id, val ) {
		if ( val === 'false' ) {
			val = '';
		}
		if ( wp.customize.control.value( id ) ) {
			return wp.customize.control.value( id ).setting.set( val );
		} else {
			return console.log( 'Couldn\'t set ' + id );
		}
	};

	etps.notice = function ( message ) {
		if ( ! message ) {
			return;
		}
		$( '#etp-skins-notice' )
			.html( '<div id="etp-skins-notice-message">' + message + '</div>' )
			.fadeIn( 250 );

		setTimeout( function () {
			return $( '#etp-skins-notice' ).html( '' ).fadeOut( 250 );
		}, 2500 );

	};

	etps.applySkin = function ( skn ) {
		if ( skn ) {
			$.each( skn.data, function ( setID, value ) {
				var settingId;
				settingId = 'string' === typeof etps.settingsMaps[setID] ? etps.settingsMaps[setID] : etps.settingsMaps[setID + ']'];
				if ( settingId ) {
					etps.set( settingId, value );
				} else {
					console.log( 'Couldn\'t find setting for ' + setID );
				}
			} );
			return etps.notice( 'Generating skin preview...' );
		}
	};

	etps.getSkinValues = function () {
		var values = {};
		$.each( etps.settingsMaps, function ( setID, conID ) {

			var val = etps.get( conID );

			if ( val !== 'etp_skins_no_value' ) {
				if ( val === 'false' ) {
					val = '';
				}
				if ( typeof val === 'string' ) {
					values[setID] = val;
				}
			}

		} );
		return values;
	};

	$( function () {
		etps.prepMaps();

		if ( typeof etpApplySkin === 'object' && etpApplySkin ) {
			etps.applySkin( etpApplySkin );
		}
	} )
} )( jQuery );