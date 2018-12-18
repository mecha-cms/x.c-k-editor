(function(win, doc) {

    // The upload adapter
    var UploadAdapter = function(loader, urlOrObject, t) {

        var $ = this;

        $.loader = loader;
        $.url = urlOrObject;
        $.t = t;

        $.upload = function() {
            return new Promise(function(resolve, reject) {
                $._initRequest();
                $._initListeners(resolve, reject);
                $._sendRequest();
            });
        };

        $.abort = function() {
            $.xhr && $.xhr.abort();
        };

        $._initRequest = function() {
            $.xhr = new XMLHttpRequest();
            var url = $.url, headers;
                if (typeof url === "object") {
                      url = url.url;
                      headers = url.headers;
                }
            $.xhr.withCredentials = true;
            $.xhr.open('POST', url, true);
                if (headers) {
                      for (var key in headers) {
                            if (typeof headers[key] === "function") {
                                  $.xhr.setRequestHeader(key, headers[key]());
                            } else {
                                  $.xhr.setRequestHeader(key, headers[key]);
                            }
                      }
                }
            $.xhr.responseType = 'json';
        };

        $._initListeners = function(resolve, reject) {
            var xhr = $.xhr,
                loader = $.loader,
                t = $.t,
                genericError = t('Cannot upload file:') + ' ' + loader.file.name;
            xhr.addEventListener('error', function() {
                reject(genericError);
            });
            xhr.addEventListener('abort', reject);
            xhr.addEventListener('load', function() {
                var response = xhr.response;
                if (!response || !response.uploaded) {
                    return reject(response && response.error && response.error.message ? response.error.message : genericError);
                }
                resolve({
                    'default': response.url
                });
            });
            if (xhr.upload) {
                xhr.upload.addEventListener('progress', function(evt) {
                    if (evt.lengthComputable) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                });
            }
        }

        $._sendRequest = function() {
            var data = new FormData();
            data.append('upload', $.loader.file);
            $.xhr.send(data);
        };

    };

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

    /*
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
    */

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
                /*
                config = CKEDITOR.tools.extend({
                    uiColor: hex(win.getComputedStyle(t).getPropertyValue('background-color')),
                    height: height * 1.5,
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
                */
                reset.call(t); // Destroy first to prevent duplicate instance
                ClassicEditor.create(t, config || {}).then(function(editor) {
                    var editable = editor.ui.view.editable.editableElement;
                    editable.style.minHeight = (height * 1.5) + 'px';
                    editable.style.resize = 'vertical';
                    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                        return new UploadAdapter(loader, editor.config.get('uploadUrl'), editor.t);
                    };
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