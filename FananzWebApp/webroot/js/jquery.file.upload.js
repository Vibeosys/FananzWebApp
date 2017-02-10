    (function( $ ){
  var settings = {
  		'prefix': 'prev_',
		'types': ['image/gif', 'image/png', 'image/jpeg'],
		'mime': {'jpe': 'image/jpeg', 'jpeg': 'image/jpeg', 'jpg': 'image/jpeg', 'gif': 'image/gif', 'png': 'image/png', 'x-png': 'image/png', 'tif': 'image/tiff', 'tiff': 'image/tiff'}
	};

  var methods = {
     init : function( options ) {
		settings = $.extend(settings, options);
		
		return this.each(function(){
			$(this).bind('change', methods.change);
		//	$('#'+settings['prefix']+this.id).html('').addClass(settings['prefix']+'container');
           // alert('after bind');
		});
     },
     destroy : function( ) {
		return this.each(function(){
			$(this).unbind('change');
		})
     },
     base64_encode: function(data) {
		var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
		var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
		ac = 0,
		enc = "",
		tmp_arr = [];

		if (!data) {
		return data;
		}

		do { // pack three octets into four hexets
		o1 = data.charCodeAt(i++);
		o2 = data.charCodeAt(i++);
		o3 = data.charCodeAt(i++);

		bits = o1 << 16 | o2 << 8 | o3;

		h1 = bits >> 18 & 0x3f;
		h2 = bits >> 12 & 0x3f;
		h3 = bits >> 6 & 0x3f;
		h4 = bits & 0x3f;

		// use hexets to index into b64, and append result to encoded string
		tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
		} while (i < data.length);

		enc = tmp_arr.join('');

		var r = data.length % 3;

		return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);

	},
    change : function(event) { 
       // alert(this.files.length);
     	var id = this.id
     	
     	$('#'+settings['prefix']+id).html('');
        
     	if(window.FileReader){
     		for(i=0; i<this.files.length; i++){
		 		if(!$.inArray(this.files[i].type, settings['types']) == -1){
		 			alert("File of not allowed type");	
		 			return false
		 		}
		 	}
        
            if(this.files.length > 0){
                for(i=0; i<this.files.length; i++){
                    var reader = new FileReader();
                    reader.onload = function (e) {
                       
                        $('<img>').attr('src', e.target.result).addClass(settings['prefix']+'thumb').appendTo($('#'+settings['prefix']+id));
                    };
                    reader.readAsDataURL(this.files[i]);
                }
            }
            else{
             $('<img>').attr('src','../../img/demoUpload.jpg').addClass(settings['prefix']+'thumb').appendTo($('#'+settings['prefix']+id));
            }
     	}else{
     		if(window.confirm('Internet Explorer do not support required HTML5 features. \nPleas, download better browser - Firefox, Google Chrome, Opera... \nDo you want to download and install Google Chrome now?')){ window.location("//google.com/chrome"); }
     	}
     }
  };

  $.fn.preimage = function( method ) {
    if ( methods[method] ) {
		return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else if ( typeof method === 'object' || ! method ) {
		return methods.init.apply( this, arguments );
    } else {
		$.error( 'Method ' +  method + ' does not exist on jQuery.preimage' );
    }    
  
  };

       
})( jQuery );