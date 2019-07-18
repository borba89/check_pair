$( document ).ready(function() {

});

function ajaxAutoComplete(options)
{
    var defaults = {
        inputId:null,
        ajaxUrl:false,
        data: {},
        minLength: 3
    };

    if (!callback) {
        var callback = function() {};
    }

    options = $.extend(defaults, options);
    var $input = $("#" + options.inputId);


    if (options.ajaxUrl){
        var $autocomplete = $('<ul id="ac" class="autocomplete-content dropdown-content"'
            + 'style="position:absolute"></ul>'),
            $inputDiv = $input.closest('.input-field'),
            request,
            runningRequest = false,
            timeout,
            liSelected;

        if ($inputDiv.length) {
            $inputDiv.append($autocomplete); // Set ul in body
        } else {
            $input.after($autocomplete);
        }

        var highlight = function (string, match) {
            var matchStart = string.toLowerCase().indexOf("" + match.toLowerCase() + ""),
                matchEnd = matchStart + match.length - 1,
                beforeMatch = string.slice(0, matchStart),
                matchText = string.slice(matchStart, matchEnd + 1),
                afterMatch = string.slice(matchEnd + 1);
            string = "<span>" + beforeMatch + "<span class='highlight'>" +
            matchText + "</span>" + afterMatch + "</span>";
            return string;

        };

        $autocomplete.on('click', 'li', function () {
            $input.val($(this).text().trim());
            $autocomplete.empty();
            $.fn.yiiListView.update(form_id, {
                data: $('.search-tabs-header *').serialize(),
                url: ajax_url,
                complete: callback
            });
        });

        $input.on('keyup', function (e) {

            if (timeout) { // comment to remove timeout
                clearTimeout(timeout);
            }

            if (runningRequest) {
                request.abort();
            }

            if (e.which === 13) { // select element with enter key
                liSelected[0].click();
                return;
            }

            // scroll ul with arrow keys
            if (e.which === 40) {   // down arrow
                if (liSelected) {
                    liSelected.removeClass('selected');
                    next = liSelected.next();
                    if (next.length > 0) {
                        liSelected = next.addClass('selected');
                    } else {
                        liSelected = $autocomplete.find('li').eq(0).addClass('selected');
                    }
                } else {
                    liSelected = $autocomplete.find('li').eq(0).addClass('selected');
                }
                return; // stop new AJAX call
            } else if (e.which === 38) { // up arrow
                if (liSelected) {
                    liSelected.removeClass('selected');
                    next = liSelected.prev();
                    if (next.length > 0) {
                        liSelected = next.addClass('selected');
                    } else {
                        liSelected = $autocomplete.find('li').last().addClass('selected');
                    }
                } else {
                    liSelected = $autocomplete.find('li').last().addClass('selected');
                }
                return;
            }

            // escape these keys
            if (e.which === 9 ||        // tab
                e.which === 16 ||       // shift
                e.which === 17 ||       // ctrl
                e.which === 18 ||       // alt
                e.which === 20 ||       // caps lock
                e.which === 35 ||       // end
                e.which === 36 ||       // home
                e.which === 37 ||       // left arrow
                e.which === 39) {       // right arrow
                return;
            } else if (e.which === 27) { // Esc. Close ul
                $autocomplete.empty();
                return;
            }

            var val = $input.val().toLowerCase();
            $autocomplete.empty();

            if (val.length > options.minLength) {

                timeout = setTimeout(function () { // comment this line to remove timeout
                    runningRequest = true;

                    request = $.ajax({
                        type: 'GET',
                        url: options.ajaxUrl + '?term=' + val,
                        success: function (data) {
                            if (!$.isEmptyObject(data)) { // (or other) check for empty result
                                var appendList = '';
                                for (var key in data) {
                                    if (data.hasOwnProperty(key)) {
                                        var li = '';
                                        if (!!data[key]) { // if image exists as in official docs
                                            li += '<li><img src="' + data[key] + '" class="left">';
                                            li += "<span>" + highlight(key, val) + "</span></li>";
                                        } else {
                                            li += '<li><span>' + highlight(key, val) + '</span></li>';
                                        }
                                        appendList += li;
                                    }
                                }
                                $autocomplete.append(appendList);
                            }else{
                                $autocomplete.append($('<li><span>No matches</span></li>'));
                            }
                        },
                        complete: function () {
                            runningRequest = false;
                        }
                    });
                }, 250);        // comment this line to remove timeout
            }
        });

        $(document).click(function (event) { // close ul if clicked outside
            if (!$(event.target).closest($autocomplete).length) {
                $autocomplete.empty();
                $.fn.yiiListView.update(form_id, {
                    data: $('.search-tabs-header *').serialize(),
                    url: ajax_url,
                    complete: callback
                });
            }
        });
    }
}