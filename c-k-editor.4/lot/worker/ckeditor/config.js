CKEDITOR.editorConfig = function(config) {
	config.toolbarGroups = [
		{
      name: 'styles',
      groups: ['styles']
    }, {
      name: 'basicstyles',
      groups: ['basicstyles']
    }, {
      name: 'paragraph',
      groups: ['list', 'blocks']
    }, {
      name: 'links',
      groups: ['links']
    }, {
      name: 'insert',
      groups: ['insert']
    }, {
      name: 'clipboard',
      groups: ['undo']
    }
	];
  config.format_tags = 'p;h1;h2;h3;h4;h5;h6;pre';
	config.removeButtons = 'Outdent,Indent,Anchor,Strike,Underline,Paste,Copy,Cut';
};