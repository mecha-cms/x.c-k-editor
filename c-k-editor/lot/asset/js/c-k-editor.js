(function(win, doc) {

    var form = doc.forms && doc.forms.editor,
        body = doc.body,
        contents = ['data[content]', 'file[?][page][content]', 'page[content]'],
        types = ['data[type]', 'file[?][page][type]', 'page[type]'];

    function hide() {
        types.forEach(function(name) {
            var $ = form && form[name];
            if ($) {
                $.setAttribute('data-value', $.value);
                // Force pre-defined page’s `type` value to `HTML`
                $.value = 'HTML';
                // `p < span < select`
                $.parentNode.parentNode.style.display = 'none';
            }
        });
    }

    function show() {
        types.forEach(function(name) {
            var $ = form && form[name];
            if ($) {
                $.value = $.getAttribute('data-value');
                $.parentNode.parentNode.style.display = "";
                $.removeAttribute('data-value');
            }
        });
    }

    contents.forEach(function(name) {
        var $ = form && form[name];
        if ($) {
            // Destroy previous custom editor if any
            $.editor && typeof $.editor.reset === "function" && $.editor.reset();
            $.editor = {'<>': $};
            function get() {
                return this['<>'];
            }
            function reset() {
                show();
                this.editor && this.editor.$ && this.editor.$.destroy();
            }
            function set(config) {
                var t = this,
                    tt = t.cloneNode(),
                    height;
                tt.style.visibility = 'visible';
                tt.style.display = 'block';
                body.appendChild(tt);
                height = tt.offsetHeight; // Get hidden `<textarea>` height
                tt.parentNode && body.removeChild(tt);
                reset.call(t); // Destroy first to prevent duplicate instance
                config = Object.assign({}, config || {});
                ClassicEditor.create(t, config).then(function(editor) {
                    var source = editor.sourceElement,
                        editable = editor.ui.view.editable.editableElement;
                    editable.style.minHeight = (height * 1.5) + 'px';
                    editable.style.resize = 'vertical';
                    // Fake placeholder
                    editable.setAttribute('placeholder', source.placeholder);
                    function isEmpty() {
                        var v = this.textContent;
                        this.classList[v ? 'remove' : 'add']('ck-editor__empty');
                    }
                    isEmpty.call(editable);
                    editable.addEventListener("blur", isEmpty, false);
                    t.editor.$ = editor;
                });
                return hide(), t.editor.$;
            }
            // Trigger once the editor creator
            set.call($);
            $.editor.get = get;
            // Add generic editor destroyer for this editor to be used by other editor(s) that want to override this editor
            $.editor.reset = function() {
                reset.call(this['<>']);
            };
            // Add generic editor creator for this editor
            $.editor.set = function(config) {
                return set.call(this['<>'], config);
            };
        }
    });

})(window, document);