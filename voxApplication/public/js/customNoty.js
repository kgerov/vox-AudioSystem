var adsNoty = function (isSuccess, text) {
	var nType = '';
	var time = 3000;

	if (isSuccess) {
		nType = 'success';
	} else {
		nType = 'error';
		time = 5000;
	}

	var n = noty({
    	layout: 'bottom',
	    theme: 'custom',
	    type: nType,
	    text: safe_tags(text),
	    timeout: time
	});

	function safe_tags(str) {
    	return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
	}	
}