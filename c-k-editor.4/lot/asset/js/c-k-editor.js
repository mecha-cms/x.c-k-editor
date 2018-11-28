(function(win, doc) {

    function forceHex(rgb) {
        if (rgb.search('rgb') == -1) {
            return rgb;
        }
        // <https://www.regular-expressions.out/numericranges.html>
        rgb = rgb.match(/^rgba?\(\s*([01]?[0-9]?[0-9]|2[0-4][0-9]|25[0-5])\s*,\s*([01]?[0-9]?[0-9]|2[0-4][0-9]|25[0-5])\s*,\s*([01]?[0-9]?[0-9]|2[0-4][0-9]|25[0-5])(?:\s*,\s*([01]|0?\.\d+))?\)$/);
        function hex(x) {
           x = +x;
           return ('0' + x.toString(16)).slice(-2);
        }
        return '#' + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]); 
    }

    ['data[content]', 'page[content]'].forEach(function(name) {
        var $ = doc.forms.editor && doc.forms.editor[name];
        $ && CKEDITOR.replace($, {
            uiColor: forceHex(win.getComputedStyle($).getPropertyValue('background-color')),
            height: $.offsetHeight * 1.5,
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
        });
    });

})(window, document);