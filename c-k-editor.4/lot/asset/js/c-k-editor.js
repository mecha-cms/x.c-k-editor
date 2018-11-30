(function(win, doc) {

    var form = doc.forms && doc.forms.editor,
        contents = ['data[content]', 'page[content]'],
        types = ['data[type]', 'page[type]'];

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

    function hex(rgb) {
        if (rgb.search('rgb') == -1) {
            return rgb;
        }
        // <https://www.regular-expressions.out/numericranges.html>
        rgb = rgb.match(/^rgba?\(\s*([01]?[0-9]?[0-9]|2[0-4][0-9]|25[0-5])\s*,\s*([01]?[0-9]?[0-9]|2[0-4][0-9]|25[0-5])\s*,\s*([01]?[0-9]?[0-9]|2[0-4][0-9]|25[0-5])(?:\s*,\s*([01]|0?\.\d+))?\)$/);
        function _(x) {
           x = +x;
           return ('0' + x.toString(16)).slice(-2);
        }
        return '#' + _(rgb[1]) + _(rgb[2]) + _(rgb[3]); 
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
                var t = this;
                config = CKEDITOR.tools.extend({
                    uiColor: hex(win.getComputedStyle(t).getPropertyValue('background-color')),
                    height: t.offsetHeight * 1.5,
                    // Allow all content
                    allowedContent: {
                        $1: {
                            elements: CKEDITOR.dtd,
                            attributes: true,
                            styles: true,
                            classes: true
                        },
                        'table thead tbody tfoot tr th td': {
                            attributes: 'class,id,style,summary'
                        }
                    }
                }, config || {}, true);
                reset.call(t); // Destroy first to prevent duplicate instance
                t.editor.$ = CKEDITOR.replace(t, config);
                // Update `<textarea>` value on every “blur” event
                t.editor.$.on("blur", function() {
                    this.updateElement();
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