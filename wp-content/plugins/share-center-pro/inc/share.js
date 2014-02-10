 jQuery( document ).ready( function( document, undefined ) {

    var tag = 'script';

    //insert facebook script into header (or it won't work)
    var widgetScript;
    var firstjs = document.getElementsByTagName( tag )[0];
    var redditDiv = document.getElementById( 'redditDiv' );

    if ( jQuery( 'div.scpBuffer' ).length ) {

        widgetScript = document.createElement( tag ); 
        widgetScript.id = 'scp-Buffer';
        widgetScript.async = 'true';
        widgetScript.type = 'text/javascript';
        widgetScript.src = '//static.bufferapp.com/js/button.js';
        firstjs.parentNode.insertBefore( widgetScript, firstjs );

    }

    if ( jQuery( 'div.scpPinterest' ).length ) {

        widgetScript = document.createElement( tag ); 
        widgetScript.id = 'scp-Pinterest';
        widgetScript.async = 'true';
        widgetScript.type = 'text/javascript';
        widgetScript.src = '//assets.pinterest.com/js/pinit.js';
        firstjs.parentNode.insertBefore( widgetScript, firstjs );

    }

    if ( jQuery( 'div.scpFacebook' ).length ) {

        widgetScript = document.createElement( tag ); 
        widgetScript.id = 'scp-Facebook';
        widgetScript.async = 'true';
        widgetScript.type = 'text/javascript';
        widgetScript.src = '//connect.facebook.net/en_US/all.js#xfbml=1';
        firstjs.parentNode.insertBefore( widgetScript, firstjs );

    }

    if ( jQuery( 'div.scpGoogle' ).length ) {

        widgetScript = document.createElement( tag ); 
        widgetScript.id = 'scp-GooglePlus';
        widgetScript.async = 'true';
        widgetScript.type = 'text/javascript';
        widgetScript.src = 'https://apis.google.com/js/plusone.js';
        firstjs.parentNode.insertBefore( widgetScript, firstjs );

    }

    if ( jQuery( 'div.scpLinkedin' ).length ) {

        widgetScript = document.createElement( tag ); 
        widgetScript.id = 'scp-Linkedin';
        widgetScript.async = 'true';
        widgetScript.type = 'text/javascript';
        widgetScript.src = '//platform.linkedin.com/in.js';
        firstjs.parentNode.insertBefore( widgetScript, firstjs );

    }

    if ( jQuery( 'div.scpStumbleupon' ).length ) {

        widgetScript = document.createElement( tag ); 
        widgetScript.id = 'scp-Stumbleupon';
        widgetScript.async = 'true';
        widgetScript.type = 'text/javascript';
        widgetScript.src = '//platform.stumbleupon.com/1/widgets.js';
        firstjs.parentNode.insertBefore( widgetScript, firstjs );

    }

    if ( jQuery( 'div.scpTwitter' ).length ) {

        widgetScript = document.createElement( tag ); 
        widgetScript.id = 'scp-Twitter';
        widgetScript.async = 'true';
        widgetScript.type = 'text/javascript';
        widgetScript.src = '//platform.twitter.com/widgets.js';
        firstjs.parentNode.insertBefore( widgetScript, firstjs );

    }

  }( document ) );
