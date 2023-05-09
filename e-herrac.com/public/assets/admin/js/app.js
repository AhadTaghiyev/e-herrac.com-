// Begin Jquery fileuploader
if ($.fileuploader) {
    // Begin for multiple files
    $('input[data-fileuploader="multiple"]').fileuploader({
        addMore: true,
        extensions: ['jpg', 'jpeg', 'png', 'gif', 'svg'],
        thumbnails: {
            onItemShow: function (item) {
                // add sorter button to the item html
                item.html.find('.fileuploader-action-remove').before('<button type="button" class="fileuploader-action fileuploader-action-sort" title="Sort"><i class="fileuploader-icon-sort"></i></button>');
            }
        },
        sorter: {
            selectorExclude: null,
            placeholder: null,
            scrollContainer: window,
            onSort: function (list, listEl, parentEl, newInputEl, inputEl) {
                // onSort callback
            }
        },
    });
    // End for multiple files

    // Begin for single file
    $('input[data-fileuploader="single"]').fileuploader({
        limit: 1,
        extensions: ['jpg', 'jpeg', 'png', 'gif', 'svg'],
        changeInput: ' ',
        theme: 'thumbnails',
        enableApi: true,
        addMore: true,
        thumbnails: {
            box: '<div class="fileuploader-items">' +
                '<ul class="fileuploader-items-list">' +
                '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner"><i>+</i></div></li>' +
                '</ul>' +
                '</div>',
            item: '<li class="fileuploader-item">' +
                '<div class="fileuploader-item-inner">' +
                '<div class="type-holder">${extension}</div>' +
                '<div class="actions-holder">' +
                '<button type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></button>' +
                '</div>' +
                '<div class="thumbnail-holder">' +
                '${image}' +
                '<span class="fileuploader-action-popup"></span>' +
                '</div>' +
                '<div class="content-holder"><h5>${name}</h5><span>${size2}</span></div>' +
                '<div class="progress-holder">${progressBar}</div>' +
                '</div>' +
                '</li>',
            item2: '<li class="fileuploader-item">' +
                '<div class="fileuploader-item-inner">' +
                '<div class="type-holder">${extension}</div>' +
                '<div class="actions-holder">' +
                '<a href="${file}" class="fileuploader-action fileuploader-action-download" title="${captions.download}" download><i class="fileuploader-icon-download"></i></a>' +
                '<button type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></button>' +
                '</div>' +
                '<div class="thumbnail-holder">' +
                '${image}' +
                '<span class="fileuploader-action-popup"></span>' +
                '</div>' +
                '<div class="content-holder"><h5 title="${name}">${name}</h5><span>${size2}</span></div>' +
                '<div class="progress-holder">${progressBar}</div>' +
                '</div>' +
                '</li>',
            startImageRenderer: true,
            canvasImage: false,
            _selectors: {
                list: '.fileuploader-items-list',
                item: '.fileuploader-item',
                start: '.fileuploader-action-start',
                retry: '.fileuploader-action-retry',
                remove: '.fileuploader-action-remove'
            },
            onItemShow: function (item, listEl, parentEl, newInputEl, inputEl) {
                var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                    api = $.fileuploader.getInstance(inputEl.get(0));

                plusInput.insertAfter(item.html)[api.getOptions().limit && api.getChoosedFiles().length >= api.getOptions().limit ? 'hide' : 'show']();

                if (item.format == 'image') {
                    item.html.find('.fileuploader-item-icon').hide();
                }
            },
            onItemRemove: function (html, listEl, parentEl, newInputEl, inputEl) {
                var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                    api = $.fileuploader.getInstance(inputEl.get(0));

                html.children().animate({ 'opacity': 0 }, 200, function () {
                    html.remove();

                    if (api.getOptions().limit && api.getChoosedFiles().length - 1 < api.getOptions().limit)
                        plusInput.show();
                });
            }
        },
        dragDrop: {
            container: '.fileuploader-thumbnails-input'
        },
        afterRender: function (listEl, parentEl, newInputEl, inputEl) {
            var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                api = $.fileuploader.getInstance(inputEl.get(0));

            plusInput.on('click', function () {
                api.open();
            });

            api.getOptions().dragDrop.container = plusInput;
        },
    });
    //End for single file
}
// End Jquery fileuploader


/* Select2 customization for select inputs */
if (typeof jQuery !== "undefined" && typeof $.fn.select2 !== "undefined") {
    (function($) {
        $.fn.selectInput = function(config) {
            let _config = {
                minimumResultsForSearch: -1,
                placeholder: 'Select an option',
                allowClear: false,
            };
            let hasRemoteData = false;
            let ajaxUrl = '/admin/select2';
            if (typeof $(this).attr('data-ajax') !== 'undefined') {
                hasRemoteData = true;
                ajaxUrl += '/' + $(this).attr('data-ajax');
            }
            if (typeof $(this).attr('data-rel_from') !== 'undefined') {
                hasRemoteData = true;
                ajaxUrl += '?value=' + $($(this).attr('data-rel_from')).val();
            }
            if (hasRemoteData) {
                _config.ajax = {
                    url: ajaxUrl,
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term,
                            page: params.page
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data,
                            pagination: {
                                more: false
                            }
                        };
                    },
                    // initSelection: function (element, callback) {
                    //     callback($.map(element.val().split(','), function (id) {
                    //         return { id: id, text: id };
                    //     }));
                    // },
                    cache: false
                }
            }
            return $(this).select2(typeof config === 'string' ? config : Object.assign(_config, config));
            }

    })(jQuery);
} else {
    if (typeof jQuery === "undefined") {
        alert("jQuery selectInput: missing dependency (jQuery)");
    } else if (typeof $.fn.select2 === "undefined") {
        alert("jQuery selectInput: missing dependency (select2.js)");
    }
}
