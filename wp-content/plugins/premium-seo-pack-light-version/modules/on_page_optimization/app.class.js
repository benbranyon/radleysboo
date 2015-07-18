/*
Document   :  On Page Optimization
Author     :  Andrei Dinca, AA-Team http://codecanyon.net/user/AA-Team
*/
// Initialization and events code for the app
pspOnPageOptimization = (function ($) {
    "use strict";

    // public
    var debug_level = 0;
    var maincontainer = null;
    var loading = null;
    var IDs = [];
    var loaded_page = 0;
    var selected_element = [];

	// init function, autoload
	(function init() {
		// load the triggers
		$(document).ready(function(){
			maincontainer = $("#psp-wrapper");
			loading = maincontainer.find("#main-loading");

			triggers();
		});
	})();
	
	function do_progress_bar( row, score ) {
		score = score || 0;

		var progress_bar = row.find(".psp-progress-bar");
		//progress_bar.attr('class', 'psp-progress-bar');

		//var width = 100; //width = progress_bar.width();
		//width = parseFloat( parseFloat( parseFloat( score / 100 ).toFixed(2) ) * width ).toFixed(1);

		var size_class = 'size_';

		if ( score >= 20 && score < 40 ){
			size_class += '20_40';
		}
		else if ( score >= 40 && score < 60 ){
			size_class += '40_60';
		}
		else if( score >= 60 && score < 80 ){
			size_class += '60_80';
		}
		else if( score >= 80 && score <= 100 ){
			size_class += '80_100';
		}
		else{
			size_class += '0_20';
		}

		progress_bar
		.addClass( size_class )
		.width( score + '%' );

		row.find('.psp-progress').find(".psp-progress-score").text( score + "%" );
	}

	function row_loading( row, status )
	{
		if( status == 'show' ){
			if( row.size() > 0 ){
				if( row.find('.psp-row-loading-marker').size() == 0 ){
					var row_loading_box = $('<div class="psp-row-loading-marker"><div class="psp-row-loading"><div class="psp-meter psp-animate" style="width:30%; margin: 10px 0px 0px 30%;"><span style="width:100%"></span></div></div></div>')
					row_loading_box.find('div.psp-row-loading').css({
						'width': row.width(),
						'height': row.height()
					});

					row.find('td').eq(0).append(row_loading_box);
				}
				row.find('.psp-row-loading-marker').fadeIn('fast');
			}
		}else{
			row.find('.psp-row-loading-marker').fadeOut('fast');
		}
	}

	function fixMetaBoxLayout()
	{
		//meta boxes
		var meta_box 		= $(".psp-meta-box-container .psp-dashboard-box-content.psp-seo-status-container"),
			meta_box_width 	= $(".psp-meta-box-container").width() - 100,
			row				= meta_box.find(".psp-seo-rule-row");
 
		row.width(meta_box_width - 40);
		row.find(".right-col").width( meta_box_width - 180 );
		row.find(".message-box").width(meta_box_width - 45);
		row.find(".right-col .message-box").width( meta_box_width - 180 );


		$("#psp_onpage_optimize_meta_box #psp-meta-box-preload").hide();
		$("#psp_onpage_optimize_meta_box .psp-meta-box-container").fadeIn('fast');

		$("#psp_onpage_optimize_meta_box").on('click', '.psp-tab-menu a', function(e){
			e.preventDefault();

			var that 	= $(this),
				open 	= $("#psp_onpage_optimize_meta_box .psp-tab-menu a.open"),
				href 	= that.attr('href').replace('#', '');

			$("#psp_onpage_optimize_meta_box .psp-meta-box-container").hide();

			$("#psp_onpage_optimize_meta_box #psp-tab-div-id-" + href ).show();

			// close current opened tab
			var rel_open = open.attr('href').replace('#', '');

			$("#psp_onpage_optimize_meta_box #psp-tab-div-id-" + rel_open ).hide();

			$("#psp_onpage_optimize_meta_box #psp-meta-box-preload").show();

			$("#psp_onpage_optimize_meta_box #psp-meta-box-preload").hide();
			$("#psp_onpage_optimize_meta_box .psp-meta-box-container").fadeIn('fast');

			open.removeClass('open');
			that.addClass('open');
		});
		
		$(".psp-dashboard-box").on('click', '#psp-edit-focus-keywords', function(e){
			e.preventDefault();
			
			$(".psp-tab-menu a[href='#page_meta']").click();
			$("#psp-field-focuskw").focus();
		});
		
		$(".psp-dashboard-box").on('click', '#psp-btn-metabox-autofocus2', function(e){
			e.preventDefault();
			
			$(".psp-tab-menu a[href='#page_meta']").click();
			metaboxAutofocus();
		});
		$("#psp-tab-div-id-page_meta").on('click', '#psp-btn-metabox-autofocus', function(e){
			e.preventDefault();
			
			metaboxAutofocus();
		});
	}
	
	function snippetPreview()
	{
		var focus_kw 	= $("#psp-field-focuskw").val(),
			title 		= $("#psp-field-title").val(),
			title_fb 	= $("#psp-field-facebook-titlu").val(),
			desc 		= $("#psp-field-metadesc").val(),
			link		= $("#sample-permalink").text(),
			prev_box 	= $(".psp-prev-box"),
			post_title	= title;
			
		var $title = $("input[name='post_title']"), $titleTax = $(".form-table").find("input[name='name']");

		if ( $title.length > 0 )
			post_title = $title.val();
		else if ( $titleTax.length >0 )
			post_title = $titleTax.val();
		
		if( $.trim(post_title) == 'Auto Draft' ){
			post_title = '';
		}
		
		/*if ( $.trim( focus_kw ) == '' )
			$("#psp-field-focuskw").val( post_title );
		if ( $.trim( title ) == '' )
			$("#psp-field-title").val( post_title );
		if ( $.trim( title_fb ) == '' )
			$("#psp-field-facebook-titlu").val( post_title );*/

		prev_box.find(".psp-prev-focuskw").text( $("#psp-field-focuskw").val() );
		prev_box.find(".psp-prev-title").text( $("#psp-field-title").val() );
		prev_box.find(".psp-prev-desc").text( desc );
		prev_box.find(".psp-prev-url").text( link );
		
		$("#psp-field-title").pspLimitChars( $("#psp-field-title-length") );
	}
	
	function metaboxAutofocus() {
		var $box = $('.psp-meta-box-container .psp-tab-container'), $boxData = $('.psp-meta-box-container #psp-inline-row-data');

		var postData = {};
		postData.title 			= $boxData.find('.psp-post-title').text();
		postData.gen_desc		= $boxData.find('.psp-post-gen-desc').text();
		postData.gen_kw			= $boxData.find('.psp-post-gen-keywords').text();
		postData.meta_title 	= $boxData.find('.psp-post-meta-title').text();
		postData.meta_desc 		= $boxData.find('.psp-post-meta-description').text();
		postData.meta_kw 		= $boxData.find('.psp-post-meta-keywords').text();
		postData.focus_kw 		= $boxData.find('.psp-post-meta-focus-kw').text();
 
		if ( $.trim( $box.find('input[name="psp-field-focuskw"]').val() ) == '' )
		$box.find('input[name="psp-field-focuskw"]').val( postData.title );

		if ( $.trim( $box.find('input[name="psp-field-title"]').val() ) == '' )
		$box.find('input[name="psp-field-title"]').val( postData.title );

		if ( $.trim( $box.find('textarea[name="psp-field-metadesc"]').val() ) == '' )
		$box.find('textarea[name="psp-field-metadesc"]').val( postData.gen_desc );

		if ( $.trim( $box.find('textarea[name="psp-field-metakewords"]').val() ) == '' ) {
			var __keywords = [];
			if ( $.trim( $box.find('input[name="psp-field-focuskw"]').val() ) != '' )
				__keywords.push( $box.find('input[name="psp-field-focuskw"]').val() );
			if ( $.trim( postData.gen_kw ) != '' )
				__keywords.push( postData.gen_kw );
			__keywords = __keywords.join(', ');
			$box.find('textarea[name="psp-field-metakewords"]').val( __keywords );
		}
		
		//facebook
		/*if ( $.trim( $box.find('input[name="psp-field-facebook-titlu"]').val() ) == '' )
		$box.find('input[name="psp-field-facebook-titlu"]').val( postData.title );

		if ( $.trim( $box.find('textarea[name="psp-field-facebook-desc"]').val() ) == '' )
		$box.find('textarea[name="psp-field-facebook-desc"]').val( postData.gen_desc );*/
	}
	
	function charsLeft() {

		$("#psp-field-metadesc").pspLimitChars( $("#psp-field-metadesc-length") );
		$("#psp-field-metakeywords").pspLimitChars( $("#psp-field-metakeywords-length") );
		$("#psp-field-title").pspLimitChars( $("#psp-field-title-length") );
	}
	
	function triggers()
	{
		// metaboxAutofocus();
		
		snippetPreview();
		setInterval(function(){
			snippetPreview();
		}, 2000);
		
		// init google suggest
		$('input.psp-text-field-kw').googleSuggest({
			service: 'web'
		});
		
		// init google suggest
		$('input#psp-field-focuskw').googleSuggest({
			service: 'web'
		});
		
		$(".psp-dashboard-box").each(function(){
			var that = $(this),
				rel = that.attr('rel');
			if( rel != "" ){
				var rel_elm = $("#" + rel);
				if( rel_elm.size() > 0 ){
					var elmHeight = that.height();
					var relHeight = rel_elm.height();

					if( elmHeight > relHeight ){
						rel_elm.height( elmHeight );
					}else if ( relHeight > elmHeight ) {
						that.height( relHeight );
					}
				}
			}
		});

		fixMetaBoxLayout();
		
		charsLeft();
	}
	
	// external usage
	return {
    }
})(jQuery);

(function ($) {
	$.fn.googleSuggest = function (opts) {
	    opts = $.extend({
	        service: 'web',
	        secure: false
	    }, opts);

	    var services = {
	        youtube: {
	            client: 'youtube',
	            ds: 'yt'
	        },
	        books: {
	            client: 'books',
	            ds: 'bo'
	        },
	        products: {
	            client: 'products-cc',
	            ds: 'sh'
	        },
	        news: {
	            client: 'news-cc',
	            ds: 'n'
	        },
	        images: {
	            client: 'img',
	            ds: 'i'
	        },
	        web: {
	            client: 'psy',
	            ds: ''
	        },
	        recipes: {
	            client: 'psy',
	            ds: 'r'
	        }
	    }, service = services[opts.service];

	    opts.source = function (request, response) {
	        $.ajax({
	            url: 'http' + (opts.secure ? 's' : '') + '://www.google.com/complete/search',
	            dataType: 'jsonp',
	            data: {
	                q: request.term,
	                nolabels: 't',
	                client: service.client,
	                ds: service.ds
	            },
	            success: function (data) {
	                response($.map(data[1], function (item) {
	                    return {
	                        value: $("<span>")
	                            .html(item[0])
	                            .text()
	                    };
	                }));
	            }
	        });
	    };

	    return this.each(function () {
	        $(this)
	            .autocomplete(opts);
	    });
	}
})(jQuery);

(function($) {
	$.fn.extend( {
		pspLimitChars: function(charsLeftElement, maxLimit) {
			$(this).on("keyup focus", function() {
				countChars($(this), charsLeftElement);
			});
			function countChars(element, charsLeftElement) {
				if ( typeof element == 'undefined' || typeof element.val() == 'undefined' ) return false;

				maxLimit = maxLimit || parseInt( element.attr('maxlength') );
				var currentChars = element.val().length;
				if ( currentChars > maxLimit ) {
					//element.value = element.val( substr(0, maxLimit) );
					element.value = pspFreamwork.substr_utf8_bytes(element.val(), 0, maxLimit);
					currentChars = maxLimit;
				}
				charsLeftElement.html( maxLimit - currentChars );
			}
			countChars($(this), charsLeftElement);
		}
	} );
})(jQuery);