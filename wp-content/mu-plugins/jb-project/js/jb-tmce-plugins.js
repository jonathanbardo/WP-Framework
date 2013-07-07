(function() {
 
	tinymce.create('tinymce.plugins.jb_tmce_plugins', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished its initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
 			//--------------------------------------------------------------------------
 			// Expand collapse
 			//--------------------------------------------------------------------------
			//this command will be executed when the button in the toolbar is clicked
			ed.addCommand('jb_expand_collapse', function() {
 	
				selection = tinyMCE.activeEditor.selection.getContent();

				selection = tinyMCE.activeEditor.selection.getContent();
				if(selection != '')
					tinyMCE.activeEditor.selection.setContent('[show-hide]' + selection + '[/show-hide]');
 
			});
 
			ed.addButton('jb_tmce_expand_collapse', {
				title : 'Mettre le texte sélectioné dans une section afficher/masquer',
				cmd : 'jb_expand_collapse',
				image : 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoTWFjaW50b3NoKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDoxNTc0QjA4M0JDQTkxMUUyODJCQkU3NkM4QkI2RjE2MSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDoxNTc0QjA4NEJDQTkxMUUyODJCQkU3NkM4QkI2RjE2MSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjE1NzRCMDgxQkNBOTExRTI4MkJCRTc2QzhCQjZGMTYxIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjE1NzRCMDgyQkNBOTExRTI4MkJCRTc2QzhCQjZGMTYxIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+ychXqQAAAMpJREFUeNrslOENwiAQRsEwABvoCIxgN3AER+gG6gSO0FHoBrqBbuAI+F1yNEiOljT8q5e8lKPHy9E0p0IIKgfhgJf2wFk6E9kpOSw4Fvb2aiZMmmitHR90nEfpU1WGyfJ71pnnZ1cr/LkyvkEHdBTQmhlXCVtESfgG1zVCI23iiiS8teyw+ZX/wk0IaTAADwZgs3cW9OCSDJDpJy7Cg+IDHqCncjBwHqTZOCtk6SERRF404sT6JSFLLXcWeKTZYm2NMBGflmq+AgwAb9QHprB8XP4AAAAASUVORK5CYII='
			});


			//--------------------------------------------------------------------------
			// Button charts
			//--------------------------------------------------------------------------
			ed.addCommand('jb_chart', function() {
 				ed.windowManager.open({
					id : 'jb_tmce_chart',
					width : 480,
					height : "auto",
					wpDialog : true,
					title : 'Ajouter un graphique'
				}, {
					plugin_url : url
				});
			});

			ed.addButton('jb_tmce_chart', {
				title : 'Outil de création de tableau',
				cmd : 'jb_chart',
				image : 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoTWFjaW50b3NoKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo2NUIwM0E2NUJDQ0ExMUUyQTVDOUZCRkFFMjRCMEMwQiIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo2NUIwM0E2NkJDQ0ExMUUyQTVDOUZCRkFFMjRCMEMwQiI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjY1QjAzQTYzQkNDQTExRTJBNUM5RkJGQUUyNEIwQzBCIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjY1QjAzQTY0QkNDQTExRTJBNUM5RkJGQUUyNEIwQzBCIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+GYWGYQAAAK5JREFUeNpi3LlzJwMO4AnEM7GI90MxVsDCgBvwArEsFnExPHoYmPDI/cEh/pNcA8kCQ9tAsiwDxXIlELOjid8C4o/kGtiGRfw8EJfg0MNIyMBPQMyHJv4Uj5f/AjEHELNhkfvPQoavHgNxORAXYZF7Qo6BIBfyYPEVCAiTE5OMeHLRr9GcMkgN5MUizoWn8GXFklVhgAek6ToWQx8B8RdoIkYHH4D4FQ65ZwABBgChCBviTgE7DQAAAABJRU5ErkJggg=='
			});
 
		},//End init 

		parseChart : function(form){
			tinyMCEPopup.close();

			node = tinyMCE.activeEditor.selection.getNode();
 			parentNode = tinyMCE.activeEditor.dom.getParent(node, 'table');
 			if(parentNode != null){
	 			tinyMCE.activeEditor.dom.remove(parentNode);
 				selection = tinyMCE.DOM.getOuterHTML(parentNode);
				shortcode = '[chart type="';
				shortcode += form.graphic_type.value + '" ';
				shortcode += 'etiquette="'+form.legend.value+'" ]';
				tinyMCE.activeEditor.selection.setContent(shortcode + selection + '[/chart]');
 			}else{
 				tinyMCE.activeEditor.windowManager.alert('Aucun tableau de données trouvé');
 			}
		},

		putCellFront : function(){
			node = tinyMCE.activeEditor.selection.getNode();
			if(node.nodeName == 'TD')
				tinyMCE.activeEditor.dom.setAttrib(node, 'class', 'important-data');

			tinyMCEPopup.close();
		},

		hideColumnLoad : function(){
			node = tinyMCE.activeEditor.selection.getNode();
			if(node.nodeName == 'TH')
				tinyMCE.activeEditor.dom.setAttrib(node, 'class', 'hide-onload');

			tinyMCEPopup.close();
		}
 
	});

	// Register plugin
	tinymce.PluginManager.add('jb_tmce_plugins', tinymce.plugins.jb_tmce_plugins);
})();