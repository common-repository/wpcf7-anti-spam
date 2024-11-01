function setCookie(name, value, options) {
	  options = options || {};
	  var expires = options.expires;
	  if (typeof expires == "number" && expires) {
  		var d = new Date();
  		d.setTime(d.getTime() + expires * 100000);
  		expires = options.expires = d;
	  }
	  if (expires && expires.toUTCString) {
		  options.expires = expires.toUTCString();
	  }
	  value = encodeURIComponent(value);
	  var updatedCookie = name + "=" + value;
	  for (var propName in options) {
  		updatedCookie += "; " + propName;
  		var propValue = options[propName];
  		if (propValue !== true) {
  		  updatedCookie += "=" + propValue;
  		}
	  }
	  document.cookie = updatedCookie;
} 

setCookie('_gag', '1', {
  expires: 100000,
  path: "/",
  domain: "." + window.location.hostname
});

function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
	"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function deleteCookie(name) {
  setCookie(name, "", {
	expires: -1
  })
}

function appendAntiSpamField(){
  var forms = document.getElementsByTagName("form");
  for(var i = 0,l = forms.length;i < l;i++){
      var inp = document.createElement('input');
      inp.setAttribute("type","hidden");
      inp.setAttribute("name","_weight_i");
      var d = new Date();
      //Случайное значение
      //inp.value = "_weight_i_"+d.getMilliseconds();
      forms[i].appendChild(inp);

  	inp.value = "spam";
  }
	var d = new Date();
  var n = d.getTime();
	//setCookie( 'weight_i', n, { 'expires' : 30 } );
}

appendAntiSpamField();

jQuery(function($){
  $( "input" ).mousemove(function( event ) {
  	$(':input[name=_weight_i]').val('');
  	
  });
});


/* REDIRECT TO THANK-YOU PAGE AFTER SUBMIT */
document.addEventListener( 'wpcf7mailsent', function( event ) {
    location = '/thank-you';
    window.location.pathname = '/thank-you';
}, false );