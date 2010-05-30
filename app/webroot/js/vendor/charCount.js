/*
 * 	Character Count Plugin - jQuery plugin
 * 	Dynamic character count for text areas and input fields
 *	written by Alen Grakalic	
 *	http://cssglobe.com/post/7161/jquery-plugin-simplest-twitterlike-dynamic-character-count-for-textareas
 *
 *	Copyright (c) 2009 Alen Grakalic (http://cssglobe.com)
 *	Dual licensed under the MIT (MIT-LICENSE.txt)
 *	and GPL (GPL-LICENSE.txt) licenses.
 *
 *	Built for jQuery library
 *	http://jquery.com
 *
 *  modify author @cypher-works.com
 *  modify 2010-05-29
 */
 
(function($) {

	$.fn.charCount = function(options){
	  
		// default configuration properties
		var defaults = {	
			allowed: 140,		
			warning: 25,
            targetId: '#counter',
			cssWarning: 'warning',
			cssExceeded: 'exceeded'
		}; 
			
		var options = $.extend(defaults, options); 
		
		function calculate(obj){
            
			var count = $(obj).val().length;
			var available = options.allowed - count;
			if(available <= options.warning && available >= 0){
                $( options.targetId ).addClass( options.cssWarning );
			} else {
                $( options.targetId ).removeClass( options.cssWarning );
			}
			if(available < 0){
                $( options.targetId ).addClass( options.cssExceeded );
			} else {
                $( options.targetId ).removeClass( options.cssExceeded );
			}
            $( options.targetId ).html( available );
		};
				
		this.each(function() {  			
			calculate(this);
			$(this).keyup(function(){calculate(this)});
			$(this).change(function(){calculate(this)});
		});
	  
	};

})(jQuery);
