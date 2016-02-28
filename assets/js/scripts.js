/*jshint browser:true */
/*!
* FitVids 1.1
*
* Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
*/
!function(t){"use strict";t.fn.fitVids=function(e){var i={customSelector:null,ignore:null};if(!document.getElementById("fit-vids-style")){var r=document.head||document.getElementsByTagName("head")[0],a=".fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}",d=document.createElement("div");d.innerHTML='<p>x</p><style id="fit-vids-style">'+a+"</style>",r.appendChild(d.childNodes[1])}return e&&t.extend(i,e),this.each(function(){var e=['iframe[src*="player.vimeo.com"]','iframe[src*="youtube.com"]','iframe[src*="youtube-nocookie.com"]','iframe[src*="kickstarter.com"][src*="video.html"]',"object","embed"];i.customSelector&&e.push(i.customSelector);var r=".fitvidsignore";i.ignore&&(r=r+", "+i.ignore);var a=t(this).find(e.join(","));a=a.not("object object"),a=a.not(r),a.each(function(e){var i=t(this);if(!(i.parents(r).length>0||"embed"===this.tagName.toLowerCase()&&i.parent("object").length||i.parent(".fluid-width-video-wrapper").length)){i.css("height")||i.css("width")||!isNaN(i.attr("height"))&&!isNaN(i.attr("width"))||(i.attr("height",9),i.attr("width",16));var a="object"===this.tagName.toLowerCase()||i.attr("height")&&!isNaN(parseInt(i.attr("height"),10))?parseInt(i.attr("height"),10):i.height(),d=isNaN(parseInt(i.attr("width"),10))?i.width():parseInt(i.attr("width"),10),o=a/d;if(!i.attr("id")){var h="fitvid"+e;i.attr("id",h)}i.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",100*o+"%"),i.removeAttr("height").removeAttr("width")}})})}}(window.jQuery||window.Zepto);

 /*------------------------------------------------------------------------------
	JS Document (https://developer.mozilla.org/en/JavaScript)

	project:    UX Rennes
	created:    2016-01-30
	author:     UX Rennes (http://uxrennes.co/)
	----------------------------------------------------------------------------- */
	;(function($, undefined){


		/*  =CONSTANTES
		----------------------------------------------------------------------------- */
		$.noConflict();

		var d 			= document,
			w 			= window,
			rm 			= {};

			


		/*  =UTILITIES
		----------------------------------------------------------------------------- */
		var log = function(x) {
			if (typeof console != 'undefined') {
				console.log(x);
			}
		};

		/*  =WINDOW.ONLOAD
		----------------------------------------------------------------------------- */
		$(document).ready(function(){

			$('.entry-content').fitVids();
			$('.js-clickbox').UXRclickBox();

		});

		/*  =WINDOW.RESIZE
		----------------------------------------------------------------------------- */
		var debounce;

		$(window).load(function(){

			$(window).on('resize', function() {

				if (!!debounce) { clearTimeout(debounce); }

				debounce = setTimeout(function()
				{
					

				}, 150);

			});
		});


		/*  =SLIDER
			@options cf. http://www.woothemes.com/flexslider/
		----------------------------------------------------------------------------- */
		// rm.slider = function(){


		// 	$('.js-flexslider').each(function(){

		// 		var $this 		= $(this),
		// 			total 		= $this.find('.rm-slide').length;

		// 		// behave
		// 		$this.flexslider({
					
		// 			// Dev only
		// 			slideshow: false,
		// 			//

		// 			slideshowSpeed: 3000,
		// 			namespace: 'rm-',
		// 			pauseOnHover: true,
		// 			selector: '.rm-slides > .rm-slide',
		// 			controlNav: false,
		// 			directionNav: false,
		// 			animationLoop: true,
		// 			start: function (slider) {
						
		// 				$('.rm-site-title').addClass('is-hidden');

		// 			},
		// 			after: function (slider) {

		// 				if ( slider.animatingTo != 0 && slider.animatingTo != total-1)
		// 				{
		// 					$('.rm-site-title').removeClass('is-hidden');
		// 				}
		// 				else 
		// 				{
		// 					$('.rm-site-title').addClass('is-hidden');
		// 				}
						
		// 			},
		// 			end: function (slider) {
						
		// 				$('.rm-site-title').addClass('is-hidden');
		// 			}
		// 		});

		// 		$this.find('.rm-nav-prev button').on('click.flexslider', function(e){
		// 			e.preventDefault();
		// 			$this.flexslider('prev');
		// 		});

		// 		$this.find('.rm-nav-next button').on('click.flexslider', function(e){
		// 			e.preventDefault();
		// 			$this.flexslider('next');
		// 		});

		// 		//var $currentSlider = $this.data('flexslider');

		// 		// now you can access all the methods for example flexAnimate
		// 		//$currentSlider.flexAnimate(..);

		// 	});

		// 	$('.js-link-home').on('click.flexslider', function(e){
		// 		e.preventDefault();
		// 		$('.js-flexslider').flexslider(0);
		// 	});

		// };

		/**
		   * CLICKABLE BLOCKS
		   * @author mhguillaumet
		   * @param node: node selector
		   * @return void
	 
	 
		   HTML sample:
	 
		   <div class="js-clickbox"> => the box to make entirely clickable
			   <div class="entry-header">
				   <h3 class="entry-title">
					   <a href="http://example.com/" class="js-clickbox_target"> => the link to extend
						   Titre de l'article
					   </a>
				   </h3>
			   </div>
			   <div class="entry-summary">
				   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer fringilla neque lectus, porta consequat quam fringilla ac. Nulla ut iaculis orci. Morbi cursus, augue sed imperdiet fringilla, dui dolor porta ipsum, vel gravida mi sapien quis arcu. Nullam convallis velit at risus condimentum porta ac id erat. Vivamus porttitor, nunc nec luctus vulputate, ante mi ultricies lacus, porttitor consectetur neque nunc vel lorem. Donec et dolor et justo convallis eleifend. Maecenas lacinia elit augue, et bibendum nibh dignissim quis. Curabitur ac libero vehicula, tristique urna sit amet, egestas dolor. Sed luctus ipsum id fringilla condimentum.</p>
			   </div>
			   <div className="js-clickbox_avoid"> => element which should keep its own click
				   <p>Curabitur ac <a href="http://example.com">libero vehicula</a>, tristique urna sit amet, egestas dolor. Sed luctus ipsum id fringilla condimentum.</p>
			   </div>
		   </div>
	 
		   ----------------------------------------------------------------------------- */
		   $.UXRclickBox = function(node)
		   {
			
			   var jBox            = $(node),
				   jLink           = jBox.find('.js-clickbox_target').length ? jBox.find('.js-clickbox_target') : jBox.find('a:first-of-type'),
				   jAvoid          = jBox.find('.js-clickbox_avoid'),
				   jHoverClass     = 'is-hover',
				   jActiveClass    = 'is-active';
	 
	 
			   if (jLink.length)
			   {
				   var jHref           = jLink.attr('href'),
					   jTarget         = jLink.attr('target');
	 
				   jBox.on('click',function(e)
				   {
					   e.preventDefault();
					   jBox.addClass(jActiveClass);
						
					   /** Si c'est un clic + CMD (Mac) ou un clic + CTRL (PC) */
					   if (jTarget !== undefined)  
					   {
						   window.open(jHref);
					   }
					   else
					   {
						   if(e.metaKey || e.ctrlKey) 
						   {
							   window.open(jHref);
						   }
						   else
						   {
							   window.location = jHref;
						   }
					   }
				   });
					
				   jBox.on('mouseenter', function()
				   {
					   $(node).removeClass(jHoverClass);
					   if (!jBox.hasClass(jHoverClass)) jBox.addClass(jHoverClass);
				   });
					
				   jBox.on('mouseleave', function()
				   {
					   jBox.removeClass(jHoverClass);
				   });
					
				   jAvoid.on('click',function(e)
				   {
					   e.stopPropagation();
				
					   /** Si c'est un clic + CMD (Mac) ou un clic + CTRL (PC) */
					   if(e.metaKey || e.ctrlKey) 
					   {
						   window.open($(this).attr('href'));
					   }
					   else 
					   {
						   window.location = $(this).attr('href');
					   }
				   });
					
				   jAvoid.on('mouseleave', function()
				   {
					   $(node).removeClass(jHoverClass);
					   if (!jBox.hasClass(jHoverClass)) jBox.addClass(jHoverClass);
				   });
				
				   jAvoid.on('mouseenter', function()
				   {
					   jBox.removeClass(jHoverClass);
				   });
					
					
					
				   /**
					   Si jBox contient des éléments jAvoid, on rétablit le clic 
					   sur les liens et les boutons que ce bloc contient, et on
					   supprime la classe .hover de jBox.
				   */
				   if (jAvoid.length)
				   {
					   jAvoid.find('a,button').on('click',function(e)
					   {
						   e.stopPropagation();
					   });
				   }
			   }
		   }
		   $.fn.UXRclickBox = function(){
			   return this.each(function(){
				   (new $.UXRclickBox(this));
			   });
		   };


		

	})(jQuery);