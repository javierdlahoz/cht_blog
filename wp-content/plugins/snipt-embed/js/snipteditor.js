(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('snipt');

	tinymce.create('tinymce.plugins.SniptPlugin', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			var icon = 'tag.png';
			
			var sniptHTML = '<img src="' + url + '/images/' + icon + '" class="sniptCode mceItemNoResize" title="Embedded Snipt code" />';
			var sniptHTMLalt = '<img src="' + url + '/images/' + icon + '" alt="$1" class="sniptCode mceItemNoResize" title="Embedded Snipt code" />';
			
			
			ed.addCommand('mceSnipt', function() {
				ed.execCommand('mceInsertContent', 0, sniptHTML);
			});

			// Register example button
			ed.addButton('snipt', {
				title : 'Embed Snipt code',
				cmd : 'mceSnipt',
				image : url + '/images/tag_blue.png',
				onclick : function() {
					edInsertSniptCode();
				}
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('snipt', n.nodeName == 'IMG');
			});
			
			// Replace morebreak with images
			ed.onBeforeSetContent.add(function(ed, o) {
				o.content = o.content.replace(/\[snipt code=[\"|\'](\w*?)[\"|\']\]/g, sniptHTMLalt);
			});

			// Replace images with morebreak
			ed.onPostProcess.add(function(ed, o) {
				if (o.get)
					o.content = o.content.replace(/<img[^>]+>/g, function(im) {
						if (im.indexOf('class="sniptCode') !== -1) {
							var m, moretext = (m = im.match(/alt="(.*?)"/)) ? m[1] : '';
							im = '[snipt code="'+moretext+'"]';
						}

						return im;
					});
			});
		},

		/**
		 * Creates control instances based in the incomming name. This method is normally not
		 * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
		 * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
		 * method can be used to create those.
		 *
		 * @param {String} n Name of the control to create.
		 * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
		 * @return {tinymce.ui.Control} New control instance or null if no control was created.
		 */
		createControl : function(n, cm) {
			return null;
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
				longname : 'Snipt plugin',
				author : 'barry@clearskys.net',
				authorurl : 'http://tinymce.moxiecode.com',
				infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/example',
				version : "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('snipt', tinymce.plugins.SniptPlugin);
})();