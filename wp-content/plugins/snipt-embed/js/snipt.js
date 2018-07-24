function edInsertSniptCode()
{
	var sniptURL = prompt('Please enter the full snipt embed URL or script code below: \nIncluding the <script> tags\nE.G. <script type="text/javascript" src="http://snipt.net/embed/58af3fd81b5b7047d2fef8930c8d478b"></script>.\n\nOr just the URL\nE.G. http://snipt.net/embed/58af3fd81b5b7047d2fef8930c8d478b','Enter your snipt embed code here');

	if (sniptURL)
	{
		var snipt = new RegExp(/http:\/\/snipt\.net\/embed\/([\w-]+)/);
	
		var m = snipt.exec(sniptURL);
		if (m == null) {
		   alert("Snipt plugin doesn't recognise this URL");
		 } else {
			snipt_settext('[snipt code="' + m[1] + '"]');
		  }
	}
}

function snipt_settext(text) {
	if (document.getElementById("quicktags").style.display == "none") {
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, text);
		tinyMCE.execCommand("mceCleanup");
	} 
	else {
		edInsertContent(edCanvas, text);
	}
}