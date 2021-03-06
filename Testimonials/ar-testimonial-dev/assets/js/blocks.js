(function(blocks, element, editor){
	var el = element.createElement;
	var RichTextEditor = editor.RichText;

	blocks.registerBlockType('ar-plugin-dev/ar-block01', {
		title	: 'AR Block',
		icon	: 'admin-home',
		category: 'layout',
		attributes: {
			content: {
				type: 'array',
				source: 'children',
				selector: 'div'
			}
		},
		edit: function(prop){
			var content = prop.attributes.content;
			function editText(newText){
				prop.setAttributes({content: newText});
			}
			return el(RichTextEditor, {
				tagName: 'div',
				onChange: editText,
				className: prop.className,
				value: prop.attributes.content
			});
			// return el('p', {className: prop.className}, "Hello I'm in Editor")
		},
		save: function(prop){
			return el(RichTextEditor.Content, {
				tagName: 'div',
				value: prop.attributes.content,
			});
			// return el('p', {className: prop.className}, "Hello I'm in Front End")
		}
	});
}(window.wp.blocks, window.wp.element, window.wp.editor));