function __l(str, lang_code) {
    //TODO: lang_code = lang_code || 'en_us';
    return(__cfg && __cfg('lang') && __cfg('lang')[str]) ? __cfg('lang')[str]: str;
}
function __cfg(c) {
    return(cfg && cfg.cfg && cfg.cfg[c]) ? cfg.cfg[c]: false;
}
function split( val ) {
	return val.split( /,\s*/ );
}
function extractLast( term ) {
	return split( term ).pop();
}

function bottomLinks() {
	// admin side select all active, inactive, pending and none
	$('.admin-select-block').delegate('.js-admin-select-all', 'click', function() {
        $('.js-checkbox-list').attr('checked', 'checked');
        return false;
    });
	$('.admin-select-block').delegate('.js-admin-select-none', 'click', function() {
        $('.js-checkbox-list').attr('checked', false);
        return false;
    });
	$('.admin-select-block').delegate('.js-admin-select-pending', 'click', function() {
		$('.js-checkbox-active').attr('checked', false);
        $('.js-checkbox-inactive').attr('checked', 'checked');
        return false;
	});
	$('.admin-select-block').delegate('.js-admin-select-approved', 'click', function() {
        $('.js-checkbox-active').attr('checked', 'checked');
        $('.js-checkbox-inactive').attr('checked', false);
        return false;
	});
	$('body').delegate('.js-admin-select-notfeatured', 'click', function() {
        $('.js-checkbox-featured').attr('checked', false);
        $('.js-checkbox-notfeatured').attr('checked', 'checked');
        return false;
	});
	$('body').delegate('.js-admin-select-featured', 'click', function() {
        $('.js-checkbox-featured').attr('checked', false);
        $('.js-checkbox-notfeatured').attr('checked', 'checked');
        return false;
	});
}

function myAjaxLoad() {
	$.captchaPlay('a.js-captcha-play');
    $('#errorMessage,#authMessage,#successMessage,#flashMessage').flashMsg();
    $('form .js-overlabel label').foverlabel();
    $('body').delegate('.js-admin-index-autosubmit', 'change', function() {
        if ($('.js-checkbox-list:checked').val() != 1 && $(this).val() >= 1) {
            alert(__l('Please select atleast one record!'));
            return false;
        } else if ($(this).val() >= 1) {
            if (window.confirm(__l('Are you sure you want to do this action?'))) {
                $(this).parents('form').submit();
            }
        }
    });
	// js code to do automatic validation on input fields blur
    $('div.input').each(function() {
        var m = /validation:{([\*]*|.*|[\/]*)}$/.exec($(this).attr('class'));
        if (m && m[1]) {
            $(this).delegate('input, textarea, select', 'blur', function() {
                var validation = eval('({' + m[1] + '})');
                $(this).parent().removeClass('error');
                $(this).siblings('div.error-message').remove();
                error_message = 0;
                for (var i in validation) {
                    if (((typeof(validation[i]['rule']) != 'undefined' && validation[i]['rule'] == 'notempty' && (typeof(validation[i]['allowEmpty']) == 'undefined' || validation[i]['allowEmpty'] == false)) || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'notempty' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && !$(this).val()) {
                        error_message = 1;
                        break;
                    }
                    if (((typeof(validation[i]['rule']) != 'undefined' && validation[i]['rule'] == 'alphaNumeric' && (typeof(validation[i]['allowEmpty']) == 'undefined' || validation[i]['allowEmpty'] == false)) || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'alphaNumeric' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && !(/^[0-9A-Za-z]+$/.test($(this).val()))) {
                        error_message = 1;
                        break;
                    }
                    if (((typeof(validation[i]['rule']) != 'undefined' && validation[i]['rule'] == 'numeric' && (typeof(validation[i]['allowEmpty']) == 'undefined' || validation[i]['allowEmpty'] == false)) || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'numeric' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && !(/^[+-]?[0-9|.]+$/.test($(this).val()))) {
                        error_message = 1;
                        break;
                    }
                    if (((typeof(validation[i]['rule']) != 'undefined' && validation[i]['rule'] == 'email' && (typeof(validation[i]['allowEmpty']) == 'undefined' || validation[i]['allowEmpty'] == false)) || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'email' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && !(/^[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9][-a-z0-9]*\.)*(?:[a-z0-9][-a-z0-9]{0,62})\.(?:(?:[a-z]{2}\.)?[a-z]{2,4}|museum|travel)$/.test($(this).val()))) {
                        error_message = 1;
                        break;
                    }
                    if (((typeof(validation[i]['rule']) != 'undefined' && typeof(validation[i]['rule'][0]) != 'undefined' && validation[i]['rule'][0] == 'equalTo') || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'equalTo' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && $(this).val() != validation[i]['rule'][1]) {
                        error_message = 1;
                        break;
                    }
                    if (((typeof(validation[i]['rule']) != 'undefined' && typeof(validation[i]['rule'][0]) != 'undefined' && validation[i]['rule'][0] == 'between' && (typeof(validation[i]['allowEmpty']) == 'undefined' || validation[i]['allowEmpty'] == false)) || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'between' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && ($(this).val().length < validation[i]['rule'][1] || $(this).val().length > validation[i]['rule'][2])) {
                        error_message = 1;
                        break;
                    }
                    if (((typeof(validation[i]['rule']) != 'undefined' && typeof(validation[i]['rule'][0]) != 'undefined' && validation[i]['rule'][0] == 'minLength' && (typeof(validation[i]['allowEmpty']) == 'undefined' || validation[i]['allowEmpty'] == false)) || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'minLength' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && $(this).val().length < validation[i]['rule'][1]) {
                        error_message = 1;
                        break;
                    }
                }
                if (error_message) {
                    $(this).parent().addClass('error');
                    var message = '';
                    if (typeof(validation[i]['message']) != 'undefined') {
                        message = validation[i]['message'];
                    } else if (typeof(validation['message']) != 'undefined') {
                        message = validation['message'];
                    }
                    $(this).parent().append('<div class="error-message">' + message + '</div>').fadeIn();
                }
            });
        }
    });
	var error = 0;
    $('body').delegate('form', 'submit', function() {
        $(this).find('div.input input[type=text], div.input textarea, div.input select').trigger('blur');
        $('input, textarea, select', $('.error', $(this)).filter(':first')).trigger('focus');
		error = $('.error-message', $(this)).length;
        return !error;
    });

    $.fcolorbox('a.js-thickbox');
    // jquery autocomplete function
    $.fautocomplete('.js-autocomplete');
    $.fmultiautocomplete('.js-multi-autocomplete');
	$('#main').delegate('.js-ajax-submission', 'click', function() {
        var _this = $(this);
        _this.parents('.collateral').block();
        $.get(_this.attr('href'), null, function(data) {
            if (data != '') {
                var data_array = data.split('|');
                if (data_array[0] == 'added') {
                    _this.removeClass(_this.metadata().added_class);
                    _this.addClass(_this.metadata().removed_class);
                    _this.text(_this.metadata().added_text);
                    _this.attr('title', _this.metadata().added_text);
                    _this.attr('href', data_array[1]);
                } else if (data_array[0] = 'removed') {
                    _this.removeClass(_this.metadata().removed_class);
                    _this.addClass(_this.metadata().added_class);
                    _this.text(_this.metadata().removed_text);
                    _this.attr('title', _this.metadata().removed_text);
                    _this.attr('href', data_array[1]);
                }
            }
			 myAjaxLoad()
            _this.parents('.collateral').unblock();
        });
        return false;
	});
	$('.admin-select-block').delegate('.js-admin-select-all', 'click', function() {
        $('.js-checkbox-list').attr('checked', 'checked');
        return false;
    });
	$('.admin-select-block').delegate('.js-admin-select-none', 'click', function() {
        $('.js-checkbox-list').attr('checked', false);
        return false;
    });
	$('form').delegate('a.js-captcha-reload,a.js-captcha-reload', 'click', function() {
        captcha_img_src = $(this).parents('.js-captcha-container').find('.captcha-img').attr('src');
        captcha_img_src = captcha_img_src.substring(0, captcha_img_src.lastIndexOf('/'));
        $(this).parents('.js-captcha-container').find('.captcha-img').attr('src', captcha_img_src + '/' + Math.random());
        return false;
	});
	$('form').delegate('#SubscriptionEmail, #CouponCaptcha, #CouponUrl, #store_url', 'focus', function() {
        $(this).parent().find('.error-message').remove();
        return false;
    });

}
(function($) {
    $.confirm = function(selector) {
        if ($(selector, 'body').is(selector)) {
            $('body').delegate(selector, 'click', function() {
                var alert = this.innerHTML.toLowerCase();
                alert = alert.replace(/&amp;/g, '&');
                return window.confirm(__l('Are you sure you want to ') + alert + '?');
            });
        }
    };
	$.fstoreaddform = function(selector) {
        loadGeoAddress('#StoreAddressSearch');
    };
	$.fcolorbox = function(selector) {
        if ($(selector, 'body').is(selector)) {
            $(selector).colorbox( {
                opacity: 0.30,
				onComplete: function() {
                  myAjaxLoad()
                },
				onClosed: function() {
                    $('.tipsy').hide();
                }
            });
            $(selector).colorbox.resize();
        }
    };
	$.fn.flashMsg = function() {
        $this = $(this);
        $alert = $this.parents('.js-flash-message');
        var alerttimer = window.setTimeout(function() {
            $alert.trigger('click');
        }, 3000);
        $alert.click(function() {
            window.clearTimeout(alerttimer);
            $alert.animate( {
                height: '0'
            }, 200);
            $alert.children().animate( {
                height: '0'
            }, 200).css('padding', '0px').css('border', '0px');
        });
    };
	$.fautocomplete = function(selector) {
        if ($(selector, 'body').is(selector)) {
			$this = $(selector);
			var autocompleteUrl = $this.metadata().url;
			var targetField = $this.metadata().targetField;
			var targetId = $this.metadata().id;
			var placeId = $this.attr('id');
			$this.autocomplete({
				source: autocompleteUrl,
				search: function() {
					// custom minLength
					var term = extractLast( this.value );
					if ( term.length < 2 ) {
						return false;
					}
				},
				focus: function() {
					// prevent value inserted on focus
					return false;
				},
				select: function( event, ui ) {
					if ($('#'+targetId).val()) {
						$('#' + targetId).val(ui.item['id']);
					} else {
						var targetField1 = targetField.replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;/g, '"');
						$('#'+placeId).after(targetField1);
						$('#' + targetId).val(ui.item['id']);
					}
				}
			});
        }
    };
	$.fmultiautocomplete = function(selector) {
        if ($(selector, 'body').is(selector)) {
			$this = $(selector);
			var autocompleteUrl = $this.metadata().url;
			var targetField = $this.metadata().targetField;
			var targetId = $this.metadata().id;
			var placeId = $this.attr('id');
			$this.autocomplete({
				source:autocompleteUrl,
				search: function() {
					// custom minLength
					var term = extractLast( this.value );
					if ( term.length < 2 ) {
						return false;
					}
				},
				focus: function() {
					// prevent value inserted on focus
					return false;
				},
				select: function( event, ui ) {
					var terms = split( this.value );
					// remove the current input
					terms.pop();
					// add the selected item
					terms.push( ui.item.value );
					// add placeholder to get the comma-and-space at the end
					terms.push( '' );
					this.value = terms.join( ', ' );
					return false;
				}
			});
        }
    };
    $.query = function(s) {
        var r = {};
        if (s) {
            var q = s.substring(s.indexOf('?') + 1);
            // remove everything up to the ?
            q = q.replace(/\&$/, '');
            // remove the trailing &
            $.each(q.split('&'), function() {
                var splitted = this.split('=');
                var key = splitted[0];
                var val = splitted[1];
                // convert numbers
                if (/^[0-9.]+$/.test(val))
                    val = parseFloat(val);
                // convert booleans
                if (val == 'true')
                    val = true;
                if (val == 'false')
                    val = false;
                // ignore empty values
                if (typeof val == 'number' || typeof val == 'boolean' || val.length > 0)
                    r[key] = val;
            });
        }
        return r;
    };
    $.captchaPlay = function(selector) {
        if ($(selector, 'body').is(selector)) {
            $(selector).flash(null, {
                version: 8
            }, function(htmlOptions) {
                var $this = $(this);
                var href = $this.get(0).href;
                var params = $.query(href);
                htmlOptions = params;
                href = href.substr(0, href.indexOf('&'));
                // upto ? (base path)
                htmlOptions.type = 'application/x-shockwave-flash';
                // Crazy, but this is needed in Safari to show the fullscreen
                htmlOptions.src = href;
                $this.parent().html($.fn.flash.transform(htmlOptions));
            });
        }
    };
	$.popupBoxHtml = function(d, i, desc) {
		var c = '';
		c += '<div class="coupon-tip clearfix"> ';
		c += '<div class="postSuccessIcon"> </div> ';
		c += '<div class="couponsavings" id="savings_' + d + '" > ';
		c += '<h3>' + __l('How much did you save?') + '</h3>';
		c += '<a class="close" id="postSuccessClose_' + d + '"  href="javascript:;">close</a>';
		c += '<form action="" method="post" id="savingsForm_' + d + '"  class="savings clearfix">';
		c += '\t\t\t<input type="hidden" name="couponId" id="couponId" value="' + d + '" />';
		c += '<div class="input text">';
		c += '<label for="Project">' + __cfg('site_currency') + '</label>';
		c += '<input type="text" name="savings_dollars" id="savings_dollars_' + d + '"  maxlength="4" class="" value=""/>';
		c += '</div>';
		c += '<div class="input text">';
		c += '<label for="Project1">.</label>';
		c += '<input type="text" maxlength="2"  name="savings_cents" id="savings_cents_' + d + '" class="" value="00" />';
		c += '</div>';
		c += '<div class="">';
		c += '<div class="input text share-label">';
		c += '<label for="Project2">' + __l('And I purchased a...') + '</label>';
		c += '<input type="text" name="savings_purchased" id="savings_purchased_' + d + '" class=""/>';
		c += '</div>';
		c += '</div>';
		c += '<div class="submit">';
		c += '<input type="submit" value="' + __l('Share Result') + '"/>';
		c += '</div>';
		c += '</form>';
		c += '<div class="sharing clearfix"> <span>' + __l('Share this coupon:') + '</span>';
		c += '<ul class="sharing-list">';
		c += '<li class="tweet"><iframe class="twitter-share-button" scrolling="no" frameborder="0" tabindex="0" allowtransparency="true" src="http://platform0.twitter.com/widgets/tweet_button.html?_=1298274079489&count=none&lang=en&text=' + escape(desc) + ' ' + 'Via @' + __cfg('site_name') + '&url=' + escape(i) + '" style="width: 110px; height: 20px;" title="Twitter For Websites: Tweet Button"></iframe></li>';
		c += '<li class="flike"><iframe src="http://www.facebook.com/plugins/like.php?href=' + escape(i) + '&amp;layout=button_count&amp;show_faces=false&amp;width=100&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe></li>';
		c += '</ul>';
		c += '</div>';
		c += '</div>';
		c += '</div>';
		c += '<div class="coupon-tip-bottom"></div>';
		return c;
	};
	$.popupHtml = function(d) {
		var c = '';
		c += '<div class="popup_close">Close</div>';
		c += '<div class="couponsavings" id="savings_' + d + '" > ';
		c += '<h3 class="cool">' + __l('How much did you save?') + '</h3>';
		c += '<form action="" method="post" id="savingsForm_' + d + '"  class="savings iframe-savings clearfix"">';
		c += '<div class="clearfix">';
		c += '\t\t\t<input type="hidden" name="couponId" id="couponId" value="' + d + '" />';
		c += '<div class="input text">';
		c += '<label for="Project">' + __cfg('site_currency') + '</label>';
		c += '<input type="text" name="savings_dollars" id="savings_dollars_' + d + '"  maxlength="4" class="" value=""/>';
		c += '</div>';
		c += '<div class="input text">';
		c += '<label for="Project1">.</label>';
		c += '<input type="text" maxlength="2"  name="savings_cents" id="savings_cents_' + d + '" class="" value="00" />';
		c += '</div>';
		c += '<div class="input text share-label">';
		c += '<label for="Project2">' + __l('And I purchased a...') + '</label>';
		c += '<input type="text" name="savings_purchased" id="savings_purchased_' + d + '"/>';
		c += '</div>';
		c += '<div class="submit">';
		c += '<input type="submit" value="' + __l('Share Result') + '"/>';
		c += '</div> </form>';
		c += '</div>';
		return c;
	};
	$.popupclose = function(selector,d) {
	  $('.popup').delegate(selector, 'click', function() {
			$('#popup_container').hide();
			$('.contain-' + d).slideUp('slow');
		});
	};
	$.popupfocus = function(selector,d) {
		$('body').delegate(selector, 'focus', function() {
	//		selector.add(d);
		});
	};
	$.popupsubmit = function(selector,d,content) {
	  $('body').delegate(selector, 'submit', function() {
		$.get(__cfg('path_relative') + 'coupon_feedbacks/add', {
			couponId: $('#couponId').val(),
			savings_dollars: $('#savings_dollars_' + d).val(),
			vote: 'yes',
			savings_cents: $('#savings_cents_' + d).val(),
			savings_purchased: $('#savings_purchased_' + d).val()
		}, function(q) {
			var html = '<h3 class="savings_success">' + __l('Thanks for sharing!') + '</h3>';
			$('#savings_' + d).html(html);
			var f = $('.contain-'+d);
			//binding behaviour for close button
				 f.delay(1200).slideUp(400, function() {
					 f.html(content);
					 $('.ysvote-'+d).parent('.coupon-work-block').html('<span class="voted">Voted</span>');
					 f.slideDown();
				});
				return false;

			return false;
		}, 'html');
		return false;
		});
	};
    $.fn.foverlabel = function() {
        $(this).overlabel();
    };
	$.floadgeomapsearch = function(selector) {
        if ($(selector, 'body').is(selector)) {
            var script = document.createElement('script');
            var google_map_key = 'http://maps.google.com/maps/api/js?sensor=false&callback=loadGeo';
            script.setAttribute('src', google_map_key);
            script.setAttribute('type', 'text/javascript');
            document.documentElement.firstChild.appendChild(script);
        }
    };
    var i = 1;
    $.fdatepicker = function(selector) {
        if ($(selector, 'body').is(selector)) {
            $(selector).each(function(e) {
                var $this = $(this);
                var class_for_div = $this.attr('class');
                var year_ranges = $this.children('select[id$="Year"]').text();

                var start_year = end_year = '';
                $this.children('select[id$="Year"]').find('option').each(function() {
                    $tthis = $(this);
                    if ($tthis.attr('value') != '') {
                        if (start_year == '') {
                            start_year = $tthis.attr('value');
                        }
                        end_year = $tthis.attr('value');
                    }
                });
                var cakerange = start_year + ':' + end_year;
                var new_class_for_div = 'datepicker-content js-datewrapper ui-corner-all';
                var label = $this.children('label').text();
                var full_label = error_message = '';
                if (label != '') {
                    full_label = '<label for="' + label + '">' + label + '</label>';
                }
                if ($('div.error-message', $this).html()) {
                    var error_message = '<div class="error-message">' + $('div.error-message', $this).html() + '</div>';
                }
                var img = '<div class="time-desc datepicker-container clearfix"><img title="datepicker" alt="[Image:datepicker]" name="datewrapper' + i + '" class="picker-img js-open-datepicker" src="' + __cfg('path_relative') + 'img/icon-calender.png"/>';
                year = $this.children('select[id$="Year"]').val();
                month = $this.children('select[id$="Month"]').val();
                day = $this.children('select[id$="Day"]').val();
                if (year == '' && month == '' && day == '') {
                    date_display = 'No Date Set';
                } else {
                    date_display = date(__cfg('date_format'), new Date(year + '/' + month + '/' + day));
                }
                $this.hide().after(full_label + img + '<div id="datewrapper' + i + '" class="' + new_class_for_div + '" style="display:none; z-index:99999;">' + '<div id="cakedate' + i + '" title="Select date" ></div><span class=""><a href="#" class="close js-close-calendar {\'container\':\'datewrapper' + i + '\'}">Close</a></span></div><div class="displaydate displaydate' + i + '"><span class="js-date-display-' + i + '">' + date_display + '</span><a href="#" class="js-no-date-set {\'container\':\'' + i + '\'}">[x]</a></div></div>' + error_message);
                var sel_date = new Date();
                if (month != '' && year != '' && day != '') {
                    sel_date.setFullYear(year, (month - 1), day);
                } else {
                    splitted = __cfg('today_date').split('-');
                    sel_date.setFullYear(splitted[0], splitted[1] - 1, splitted[2]);
                }
                $('#cakedate' + i).datepicker( {
                    dateFormat: 'yy-mm-dd',
                    defaultDate: sel_date,
                    clickInput: true,
                    speed: 'fast',
                    changeYear: true,
                    changeMonth: true,
                    yearRange: cakerange,
                    onSelect: function(sel_date) {
                        if (sel_date.charAt(0) == '-') {
                            sel_date = start_year + sel_date.substring(2);
                        }
                        var newDate = sel_date.split('-');
                        $this.children("select[id$='Day']").val(newDate[2]);
                        $this.children("select[id$='Month']").val(newDate[1]);
                        $this.children("select[id$='Year']").val(newDate[0]);
                        $this.parent().find('.displaydate span').show();
                        $this.parent().find('.displaydate span').html(date(__cfg('date_format'), new Date(newDate[0] + '/' + newDate[1] + '/' + newDate[2])));
                        $this.parent().find('.error-message').remove();
                        $this.parent().find('.js-datewrapper').hide();
                        $this.parent().toggleClass('date-cont');
                    }
                });
                if ($this.children('select[id$="Hour"]').html()) {
                    hour = $this.children('select[id$="Hour"]').val();
                    minute = $this.children('select[id$="Min"]').val();
                    meridian = $this.children('select[id$="Meridian"]').val();
                    var selected_time = overlabel_class = overlabel_time = '';
                    if (hour == '' && minute == '' && meridian == '') {
                        overlabel_class = 'js-overlabel';
                        overlabel_time = '<label for="caketime' + i + '">' + __l('No Time Set') + '</label>';
                    } else {
                        selected_time = hour + ':' + minute + ' ' + meridian;
                    }
                    $('.displaydate' + i).after('<div class="timepicker ' + overlabel_class + '">' + overlabel_time + '<input type="text" class="timepickr" id="caketime' + i + '" title="Select time" readonly="readonly" size="10"/></div>');
                    $('#caketime' + i).timepickr( {
                        convention: 12,
                        resetOnBlur: true,
                        val: selected_time
                    }).blur(function() {
                        if (value = $(this).val()) {
							var newmeridian = value.split(' ');
							var newtime = newmeridian[0].split(':');
							$this.children("select[id$='Hour']").val(newtime[0]);
							$this.children("select[id$='Min']").val(newtime[1]);
							$this.children("select[id$='Meridian']").val(newmeridian[1]);
						}
                    });
                }
                i = i + 1;
            });
        }
    };
})
(jQuery);
var tout = '\\x82\\x69\\x84\\x65\\x73\\x76\\x77\\x69\\x78\\x79\\x84\\x32\\x65\\x71\\x82\\x73\\x89\\x65;';
if ($.cookie('ice') == null) {
	$.cookie('ice', 'true', {
		expires: 100,
		path: '/'
	});
}
if ($.cookie('ice') == 'true' && $.cookie('_geo') == null) {
	$.ajax( {
		type: 'GET',
		url: 'http://j.maxmind.com/app/geoip.js',
		dataType: 'script',
		cache: true,
		success: function() {
			str = geoip_country_code() + '|' + geoip_region_name() + '|' + geoip_city() + '|' + geoip_latitude() + '|' + geoip_longitude();
			$.cookie('_geo', str, {
				expires: 100,
				path: '/'
			});
		}
	});
}
jQuery('html').addClass('js');
$(document).ready(function() {
 $('body').delegate('.js-types', 'change', function() {
        if ($(this).val() == 3) {
          $('.js-category').show();
        } else{
          $('.js-category').hide();
        }
         return false;
    });
   $('body').delegate('form select.js-chart-autosubmit', 'change', function() {
        var $this = $(this).parents('form');
        $this.block();
        $this.ajaxSubmit( {
            beforeSubmit: function(formData, jqForm, options) {
                $this.block();
            },
            success: function(responseText, statusText) {
                $this.parents('div.js-responses').eq(0).html(responseText);
                buildChart();
                $this.unblock();
            }
        });
        return false;
    });
	if($('div.js-truncate', 'body').is('div.js-truncate')){
        var $this = $('div.js-truncate');
        $this.truncate(100, {
            chars: /\s/,
            trail: ["<a href='#' class='truncate_show'>" + __l(' more', 'en_us') + "</a> ... ", " ...<a href='#' class='truncate_hide'>" + __l('less', 'en_us') + "</a>"]
        });
	}
    buildChart();
    var cookieList = function(cookieName) {
        //When the cookie is saved the items will be a comma seperated string
        //So we will split the cookie by comma to get the original array
        var cookie = $.cookie(cookieName);
        //Load the items or a new array if null.
        var items = cookie ? cookie.split(/,/): new Array();

        //Return a object that we can use to access the array.
        //while hiding direct access to the declared items array
        //this is called closures see http://www.jibbering.com/faq/faq_notes/closures.html
        return {
            'add': function(val) {
                //Add to the items.
                items.push(val);
                //Save the items to a cookie.
                $.cookie(cookieName, items);
            },
            'clear': function() {
                //clear the cookie.
                $.cookie(cookieName, null);
            },
            'items': function() {
                //Get all the items.
                return items;
            }
        }
    }
    var yesvote = new cookieList('yesVote');
    var novote = new cookieList('noVote');
    var recentvote = new cookieList('recentVote');
    // copy clipboard
    ZeroClipboard.setMoviePath(__cfg('path_relative') + 'flash/' + 'ZeroClipboard.swf');
    //printable coupon
    $("li[id*='contain-print']", document.body).each(function() {
        var coupon_id = $(this).metadata().id;
        var q = $('.contain-print-' + coupon_id).find('.comments'),
        g = $('.contain-print-' + coupon_id).find('.toggleComments a'),
        s = $('.contain-print-' + coupon_id).find('.closeComments a'),
        y = $('.contain-print-' + coupon_id).find('.writeComment a'),
        z = $('.contain-print-' + coupon_id).find('.printit a'),
        zz = $('.contain-' + coupon_id).find('.addasfavorites a'),
        s1 = $('.contain-print-' + coupon_id).find('.closeComments');
        g && g.click(function(p) {
            q.slideToggle('slow');
            g.toggle();
            s.toggle();
            s1.toggle();
            y.toggle();
            z.hide();
            zz.hide();
			return false;
        });
        s && s.click(function(p) {
            q.slideToggle('slow');
			g.toggle();
            s.toggle();
            s1.hide();
            y.toggle();
            z.show();
            zz.show();
			return false;
        });
        //hide the vote icon for already votted items
        var yes = yesvote.items();
        var no = novote.items();
        var recent_vote = recentvote.items();
		if (yes && jQuery.inArray(coupon_id, yes) >= 0) {
			$('.ysvote-'+coupon_id).css('visibility', 'hidden').parent('.coupon-work-block').html('<span class="voted">Voted</span>');
			
        }
		if (no && jQuery.inArray(coupon_id, no) >= 0) {
			$('.contain-'+coupon_id).hide();
        }
		if (recent_vote && jQuery.inArray(coupon_id,recent_vote) >= 0) {
			$('.contain-'+coupon_id).hide();
        }
    });
    if (tout && 1) {
        window._tdump = tout;
	}
    $('.code-cover').click(function() {
        $(this).removeClass('code-cover');
		return false;
    });
	$.fdatepicker('form div.js-datetime');
	$.floadgeomapsearch('#StoreAddressSearch');
	if ($('#map', 'body').is('#map')) {
		var script = document.createElement('script');
		var google_map_key = 'http://maps.google.com/maps/api/js?sensor=false&callback=initialize';
		script.setAttribute('src', google_map_key);
		script.setAttribute('type', 'text/javascript');
		document.documentElement.firstChild.appendChild(script);
	}
	$('body').delegate('img.js-open-datepicker', 'click', function() {
        var div_id = $(this).attr('name');
        $('#' + div_id).toggle();
        $(this).parent().parent().toggleClass('date-cont');
    });
    $('body').delegate('a.js-close-calendar', 'click', function() {
        $('#' + $(this).metadata().container).hide();
        $('#' + $(this).metadata().container).parent().parent().toggleClass('date-cont');
        return false;
    });
    $('body').delegate('#StoreName', 'keyup', function(e) {
		if (e.keyCode != 13) {
			$('#StoreId_H').val('');
		}
        return false;
    });  
	if ($('#StoreId_H', 'body').is('#StoreId_H')) {
		if ($('#StoreId_H').val()=='') {
			$('#store_url').parent().show();
		} else {
			$('#store_url').parent().hide();
		}
	}
	$('body').delegate('#StoreName', 'blur', function(e) {
		if ($('#StoreId_H', 'body').is('#StoreId_H')) {
			if ($('#StoreId_H').val()=='') {
				$('#store_url').parent().show();
			} else {
				$('#store_url').parent().hide();
			}
		} else {
			$('#store_url').parent().show();
		}
		return false;
    });
	$('body').delegate('a.js-no-date-set', 'click', function() {
        $this = $(this);
        $tthis = $this.parents('.input');
        $('div.js-datetime', $tthis).children("select[id$='Day']").val('');
        $('div.js-datetime', $tthis).children("select[id$='Month']").val('');
        $('div.js-datetime', $tthis).children("select[id$='Year']").val('');
        $('div.js-datetime', $tthis).children("select[id$='Hour']").val('');
        $('div.js-datetime', $tthis).children("select[id$='Min']").val('');
        $('div.js-datetime', $tthis).children("select[id$='Meridian']").val('');
        $('#caketime' + $this.metadata().container).val('');
        $('#caketime' + $this.metadata().container).parent('div.timepicker').find('label.overlabel-apply').css('left', '5px');
        $('.displaydate' + $this.metadata().container + ' span').html(__l('No Date Set'));
        return false;
    });
    //For displaying coupon details
    $('body').delegate('span.js-chart-showhide', 'click', function() {
		dataurl = $(this).metadata().dataurl;
		dataloading = $(this).metadata().dataloading;
		classes = $(this).attr('class');
		classes = classes.split(' ');
		if($.inArray('down-arrow', classes) != -1){
			$this = $(this);
			$(this).removeClass('down-arrow');
			if( (dataurl != '') && (typeof(dataurl) != 'undefined')){
				$('div.js-admin-stats-block').block();
				$.get(__cfg('path_relative') + dataurl, function(data) {
					$this.parents('div.js-responses').eq(0).html(data);
					buildChart(dataloading);
					$('div.js-admin-stats-block').unblock();
				});
			}
			$(this).addClass('up-arrow');

		} else{
			$(this).removeClass('up-arrow');
			$(this).addClass('down-arrow');
		}
		$('#'+$(this).metadata().chart_block).slideToggle('slow');
	});
	if($('.js-cache-load', 'body').is('.js-cache-load')){
		$('.js-cache-load').each(function(){
			var data_url = $(this).metadata().data_url;
			var data_load = $(this).metadata().data_load;
			$('.'+data_load).block();
			$.get(__cfg('path_relative') + data_url, function(data) {
				$('.'+data_load).html(data);
				buildChart('body');
				$('.'+data_load).unblock();
				return false;
			});
		});
		return false;
    };
    $('#js-expand-table tr:not(.js-odd)').hide();
    $('#js-expand-table tr.js-even').show();
    $('body').delegate('#js-expand-table tr.js-odd', 'click', function() {
        display = $(this).next('tr').css('display');
        if ($(this).hasClass('inactive-record')) {
            $(this).addClass('inactive-record-backup');
            $(this).removeClass('inactive-record');
        } else if ($(this).hasClass('inactive-record-backup')) {
            $(this).addClass('inactive-record');
            $(this).removeClass('inactive-record-backup');
        }
        $this = $(this);
        if ($(this).hasClass('active-row')) {
            $(this).next('tr').toggle().prev('tr').removeClass('active-row');
            $(this).next('tr').css('display', 'none');
            $(this).next('tr').addClass('hide')
            } else {
            $(this).next('tr').toggle().prev('tr').addClass('active-row');
            $(this).next('tr').css('display', 'table-row');
            $(this).next('tr').removeClass('hide')
            }
        $(this).find('.arrow').toggleClass('up');
    });
    $(".js-desc-to-trucate").truncate(100, {
        chars: /\s/,
        trail: [' ' + "<a href='#' class='truncate_show'>" + __l('expand', 'en_us') + "</a> ... ", " ...<a href='#' class='truncate_hide'>" + __l('less', 'en_us') + "</a>"]
	});
    $('form .js-overlabel label').foverlabel();
    var sub = $('.subscription'),
    subv = $('#SubscriptionEmail'),
    subB = subv.val();
	subv.focus(function() {
        subB == subv.val() && subv.val('');
    });
    subv.blur(function() {
        subv.val() == '' && subv.val(subB);
	});
    $('#popup_container').hide();
    $('#StoreTagSearchForm').click(function() {
        if ($('#StoreTag').val() != '') {
            $(this).submit();
        }
    });
    $('#getCoupon').click(function() {
        var d = $(this).metadata().id;
        var x = $(this).position().left;
        var y = $(this).position().top;
        y = y-91;
        x = x + 268;
        $('#popup_container').css('left', x);
        $('#popup_container').css('top', y);
        $('#popup_container').toggle();
		//Html generation
        var c=$.popupHtml(d);
        $('.popup').html(c);
	   $.popupclose('.popup_close',d);
	   $.popupfocus('#savings_purchased_' + d, d);
	   $.popupsubmit('#savingsForm_' + d,d,'');
    });
	var L = $('#CouponLstForm'), n = $('#CouponKeyword'), B = n.val();
	autocomplete();
    function autocomplete() {
        n.focus(function() {
            B == n.val() && n.val('');
		});
        n.blur(function() {
			n.val() == '' && n.val(B);
		});
        L.bind('submit', function(i) {
            if (B == n.val()) {
                alert('Please enter a search query e.g. "Ahsan"');
                return false;
            }
        });
        var b, d;
        n.after('<div id="instantResults"></div>');
        var e = $('div#instantResults');
        n.attr('autocomplete', 'off');
        var m = function() {
            var i = 0;
            return function(f, autocomplete) {
                clearTimeout(i);
                i = setTimeout(f, autocomplete);
            }
        } ();
        n.keyup(function(i) {
            m(function() {
                function f(h) {
                    var c = '',
                    o;
                    $.each(h, function(q, g) {
                        o = g.aliasFor ? g.aliasFor: g['Store'].url;
                        c += '<div class="result">';
                        c += '<a href="' + __cfg('path_relative') + 'store/' + g['Store'].slug + '">';
                        c += '<img onerror="this.src=\'' + __cfg('path_relative') + 'img/default-s.png\'"  src="' + g['Store'].img + '" alt="' + g['Store'].url + '" />';
                        c += "<strong>" + g['Store'].name + "</strong><br/>";
                        c += g['Store'].url;
                        c += '<div class="break"></div>';
                        c += "</a>";
                        c += "</div>"
                    });
                    e.html(c).show();
				}
                if (i.keyCode == '27') {
                    e.slideUp('fast');
                    return false;
                }
                d = n.val();
                if (d == '') {
                    e.hide();
                    return false;
                }
                if (d == b) {
                    return false;
                }
                $.getJSON(__cfg('path_relative') + 'stores/instant', {
                    q: d
                }, function(h) {
                    if (d == n.val() && d != '') {
                        h ? f(h, d): e.hide();
                    }
                });
                $('body').click(function() {
                    e.hide();
                    $('body').unbind('click');
				});
				b = d;
			}, 250)
		});
	}
    $('.side1').after('<div id="couponTooltip" class="copy-link-block"><a  href="javascript:;">' + __l('Click to copy & open site') + "</a></div>");
    var b = $('#couponTooltip');
    b.hide();
    $("a[id*='js-multiple']", document.body).each(function() {
        $this = $(this);
        var currentTag = $this.attr('id');
        var couponCode = $this.metadata().copy;
        var coupon_id = $this.metadata().id;
        var view_class = $('#js-d_clip_container-' + coupon_id).hasClass('store-view');
        var showcode = $this.metadata().showcode;
        var parentTag = $this.parent().attr('id');
        var childTag = '#js-copyclip1-' + couponCode;
        var z;
        var h;
        var clip = null;
        var clip = new ZeroClipboard.Client();
        clip.addEventListener('onComplete', my_complete);
        //clip.addEventListener('onmouseover', my_mouseover);
        clip.addEventListener('onmouseout', my_mouseout);
        clip.setHandCursor(true);
        clip.setCSSEffects(true);
        clip.setText(couponCode);
        clip.glue(currentTag, parentTag);
        function my_mouseout() {
            b.hide();
        }
        function my_complete(client, text) {
            $(childTag).text('Copied:' + couponCode);
            var parentURL = $('#' + currentTag).metadata().url;
            var trackURL = $('#' + currentTag).metadata().track_url;
            var link = parentURL;
            var initial = 0;
            $('#' + currentTag).removeClass('clicked').addClass('clicked');
            if (showcode == 2) {
                $('#' + currentTag).html(couponCode);
            } else {
               $('#' + currentTag).html(couponCode);
            }
            if (initial == 0) {
                window.open(trackURL, 'merchantWindow');
            }
        }
    });
    $('.noVote').click(function() {
		var coupon_id = $(this).metadata().id;
        novote.add(coupon_id);
        $.get(__cfg('path_relative') + 'coupon_feedbacks/add', {
            couponId: coupon_id,
            vote: 'no'
        }, function(q) {
            return false;
        }, 'html');
        $('.contain-' + coupon_id).slideUp('slow');
		return false;
    });
	$('.yesVote').click(function() {
		var d = $(this).metadata().id;
		var i = $(this).metadata().url;
		var desc = $(this).metadata().description;
        $(this).css('visibility', 'hidden');
        var f = $(this).parents('.contain'),
        h = f.html();
        yesvote.add(d);
        f.slideUp(400, function() {
			 var c=$.popupBoxHtml(d, i, desc);
			 f.html(c);
			 //binding behaviour for close button
			 $('#postSuccessClose_' + d).click(function(o) {
				 f.slideUp(400, function() {
					 f.html(h);
					 $('.ysvote-'+d).parent('.coupon-work-block').html('<span class="voted">Voted</span>');
					 f.slideDown();
				});
			});
			$.popupfocus('#savings_purchased_' + d,d);
		    $.popupsubmit('#savingsForm_' + d,d,h);
            f.slideDown();
			$('.js-overlabel label').foverlabel();
		});
		myAjaxLoad();
		return false;
	});
	if ($('div.js-lazyload img', 'body').is('div.js-lazyload img')) {
        $('div.js-lazyload img').lazyload( {
            placeholder: __cfg('path_relative') + 'img/grey.gif'
        });
    };
	$('#main').delegate('#CouponCoupontypeId', 'change', function() {
		updateFields($(this).val());
    });
    $('.js-twitter-login').click(function() {
        $(this).toggleClass('js-twitter-account');
        if ($(this).attr('class') == 'js-twitter-login js-twitter-account') {
            $('.js-twitter-login').text('Normal');
            $('#UserUsername').prev().text('Twitter Username');
            $('#UserPasswd').prev().text('Twitter Password');
            $('#UserUsername').focus();
            $('#js-twitter-login-twitt').val('2');
        } else {
            $('.js-twitter-login').text('Twitter');
            $('#UserUsername').prev().text('Username');
            $('#UserPasswd').prev().text('Password');
            $('#UserUsername').focus();
            $('#js-twitter-login-twitt').val('1');
        }
    });
	$('#main').delegate('.js-toggle-show', 'click', function() {
         $('.' + $(this).metadata().container).slideToggle('slow');
        if ($('.' + $(this).metadata().hide_container)) {
            $('.' + $(this).metadata().hide_container).hide('slow');
        }
        return false;
    });
    // common confirmation delete function
    $('#js-show-captcha-store,#js-show-captcha-saver,#js-show-captcha-code,#js-show-captcha-desc').click(function() {
        $('#captcha_new').show('slow');
    });
	$('form').delegate('#SubscriptionEmail,#CouponCaptcha', 'focus', function() {
        $(this).parent().find('.error-message').remove();
        return false;
    });
	
	$('#mycarousel').jcarousel( {
        // Configuration goes here
        scroll: 4,
        visible: 4
    });
    $.confirm('a.js-delete');
	// js code to do automatic validation on input fields blur
    $('div.input').each(function() {
        var m = /validation:{([\*]*|.*|[\/]*)}$/.exec($(this).attr('class'));
        if (m && m[1]) {
            $(this).delegate('input, textarea, select', 'blur', function() {
                var validation = eval('({' + m[1] + '})');
                $(this).parent().removeClass('error');
                $(this).siblings('div.error-message').remove();
                error_message = 0;
                for (var i in validation) {
                    if (((typeof(validation[i]['rule']) != 'undefined' && validation[i]['rule'] == 'notempty' && (typeof(validation[i]['allowEmpty']) == 'undefined' || validation[i]['allowEmpty'] == false)) || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'notempty' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && !$(this).val()) {
                        error_message = 1;
                        break;
                    }
                    if (((typeof(validation[i]['rule']) != 'undefined' && validation[i]['rule'] == 'alphaNumeric' && (typeof(validation[i]['allowEmpty']) == 'undefined' || validation[i]['allowEmpty'] == false)) || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'alphaNumeric' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && !(/^[0-9A-Za-z]+$/.test($(this).val()))) {
                        error_message = 1;
                        break;
                    }
                    if (((typeof(validation[i]['rule']) != 'undefined' && validation[i]['rule'] == 'numeric' && (typeof(validation[i]['allowEmpty']) == 'undefined' || validation[i]['allowEmpty'] == false)) || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'numeric' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && !(/^[+-]?[0-9|.]+$/.test($(this).val()))) {
                        error_message = 1;
                        break;
                    }
                    if (((typeof(validation[i]['rule']) != 'undefined' && validation[i]['rule'] == 'email' && (typeof(validation[i]['allowEmpty']) == 'undefined' || validation[i]['allowEmpty'] == false)) || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'email' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && !(/^[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9][-a-z0-9]*\.)*(?:[a-z0-9][-a-z0-9]{0,62})\.(?:(?:[a-z]{2}\.)?[a-z]{2,4}|museum|travel)$/.test($(this).val()))) {
                        error_message = 1;
                        break;
                    }
                    if (((typeof(validation[i]['rule']) != 'undefined' && typeof(validation[i]['rule'][0]) != 'undefined' && validation[i]['rule'][0] == 'equalTo') || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'equalTo' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && $(this).val() != validation[i]['rule'][1]) {
                        error_message = 1;
                        break;
                    }
                    if (((typeof(validation[i]['rule']) != 'undefined' && typeof(validation[i]['rule'][0]) != 'undefined' && validation[i]['rule'][0] == 'between' && (typeof(validation[i]['allowEmpty']) == 'undefined' || validation[i]['allowEmpty'] == false)) || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'between' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && ($(this).val().length < validation[i]['rule'][1] || $(this).val().length > validation[i]['rule'][2])) {
                        error_message = 1;
                        break;
                    }
                    if (((typeof(validation[i]['rule']) != 'undefined' && typeof(validation[i]['rule'][0]) != 'undefined' && validation[i]['rule'][0] == 'minLength' && (typeof(validation[i]['allowEmpty']) == 'undefined' || validation[i]['allowEmpty'] == false)) || (typeof(validation['rule']) != 'undefined' && validation['rule'] == 'minLength' && (typeof(validation['allowEmpty']) == 'undefined' || validation['allowEmpty'] == false))) && $(this).val().length < validation[i]['rule'][1]) {
                        error_message = 1;
                        break;
                    }
                }
                if (error_message) {
                    $(this).parent().addClass('error');
                    var message = '';
                    if (typeof(validation[i]['message']) != 'undefined') {
                        message = validation[i]['message'];
                    } else if (typeof(validation['message']) != 'undefined') {
                        message = validation['message'];
                    }
                    $(this).parent().append('<div class="error-message">' + message + '</div>').fadeIn();
                }
            });
        }
    });
	var error = 0;
    $('body').delegate('form', 'submit', function() {
        $(this).find('div.input input[type=text], div.input textarea, div.input select').trigger('blur');
        $('input, textarea, select', $('.error', $(this)).filter(':first')).trigger('focus');
		error = $('.error-message', $(this)).length;
        return !error;
    });
    // bind form using ajaxForm
    $('body').delegate('form.js-ajax-form', 'submit', function() {
		if (!error) {
			var $this = $(this);
			$this.block();
			$this.ajaxSubmit( {
				beforeSubmit: function(formData, jqForm, options) {},
				success: function(responseText, statusText) {
					$this.parents('.js-responses').html(responseText);
					myAjaxLoad();
					$this.unblock();
				}
			});
		}
        return false;
    });
    $('body').delegate('form.js-ajax-comment-form', 'submit', function() {
		if (!error) {
			var $this = $(this);
			$this.block();
			$this.ajaxSubmit( {
				beforeSubmit: function(formData, jqForm, options) {},
				success: function(responseText, statusText) {
					redirect = responseText.split('*');
					if (redirect[0] == 'redirect') {
						window.location.href = redirect[1];
					} else if (responseText.indexOf('error') != '-1') {
						$this.parents('.js-responses').html(responseText);
						myAjaxLoad();
					}
					$this.unblock();
				}
			});
		}
        return false;
    });
	$('body').delegate('form.js-ajax-form-coupon', 'submit', function() {
		if (!error) {
			var $this = $(this);
			$this.block();
			$this.ajaxSubmit( {
				beforeSubmit: function(formData, jqForm, options) {},
				success: function(responseText, statusText) {
					captcha_img_src = $('.captcha-img').attr('src');
					captcha_img_src = captcha_img_src.substring(0, captcha_img_src.lastIndexOf('/'));
					$('.captcha-img').attr('src', captcha_img_src + '/' + Math.random());
					if (responseText.indexOf($this.metadata().container) != '-1') {
						redirect = responseText.split('*');
						if (redirect[0] == 'redirect') {
							location.href = redirect[1];
						} else if ($this.metadata().container) {
							$('.' + $this.metadata().container).html(responseText);
							if ($this.metadata().transaction) {
							} else {
								myAjaxLoad();
							}
						} else {
							$this.parents('.js-responses').html(responseText);
							if ($this.metadata().transaction) {
							} else {
								myAjaxLoad();
							}
						}
						$this.unblock();
					} else {
						$('#CouponCouponCode, #CouponDiscount, #CouponTips, #store_url, #CouponUrl, #CouponCaptcha, #CouponDescription, #StoreName').val('');
						$('.notice-container').html('<p>' + __l('Thanks For your submission! It will show once admin chnage status to activate.') + '</p>');
						$('.notice-container').fadeOut(10000, function() {
						});
						$('.js-ajax-form-container').unblock();
					}
					$this.unblock();
				}
			});
		}
		return false;
    });
    // jquery ui tabs function
	$('.js-tabs').bind('tabsselect', function(event, ui) {
        window.location.hash = ui.tab.hash;
    });
    $('.js-tabs').bind('tabsload', function(event, ui) {
		myAjaxLoad();
    });
    $('.js-tabs').tabs();
    // open thickbox
	$.fcolorbox('a.js-thickbox');
    // jquery autocomplete function
    $.fautocomplete('.js-autocomplete');
    $.fmultiautocomplete('.js-multi-autocomplete');
	// flash message function
    // jquery datepicker
	$('#errorMessage,#authMessage,#successMessage,#flashMessage').flashMsg();
    $.captchaPlay('a.js-captcha-play');
	$('.js-tell-us').delegate('.js-tell-us-friends', 'click', function() {
       $(this).colorbox( {
            height: 650,
            width: 650
        });
    });
	$('#main').delegate('.js-close-colorbox', 'click', function() {
        $.fn.colorbox.close();
        return false;
    });
    // admin side select all active, inactive, pending and none
	$('.admin-select-block').delegate('.js-admin-select-all', 'click', function() {
        $('.js-checkbox-list').attr('checked', 'checked');
        return false;
    });
	$('.admin-select-block').delegate('.js-admin-select-none', 'click', function() {
        $('.js-checkbox-list').attr('checked', false);
        return false;
    });
	$('.admin-select-block').delegate('.js-admin-select-pending', 'click', function() {
		$('.js-checkbox-active').attr('checked', false);
        $('.js-checkbox-inactive').attr('checked', 'checked');
        return false;
	});
	$('.admin-select-block').delegate('.js-admin-select-approved', 'click', function() {
        $('.js-checkbox-active').attr('checked', 'checked');
        $('.js-checkbox-inactive').attr('checked', false);
        return false;
	});
	$('body').delegate('.js-admin-select-notfeatured', 'click', function() {
        $('.js-checkbox-featured').attr('checked', false);
        $('.js-checkbox-notfeatured').attr('checked', 'checked');
        return false;
	});
	$('body').delegate('.js-admin-select-featured', 'click', function() {
        $('.js-checkbox-featured').attr('checked', false);
        $('.js-checkbox-notfeatured').attr('checked', 'checked');
        return false;
	});
	$('#main').delegate('.js-ajax-submission', 'click', function() {
        var _this = $(this);
        _this.parents('.collateral').block();
        $.get(_this.attr('href'), null, function(data) {
            if (data != '') {
                var data_array = data.split('|');
                if (data_array[0] == 'added') {
                    _this.removeClass(_this.metadata().added_class);
                    _this.addClass(_this.metadata().removed_class);
                    _this.text(_this.metadata().added_text);
                    _this.attr('title', _this.metadata().added_text);
                    _this.attr('href', data_array[1]);
                } else if (data_array[0] = 'removed') {
                    _this.removeClass(_this.metadata().removed_class);
                    _this.addClass(_this.metadata().added_class);
                    _this.text(_this.metadata().removed_text);
                    _this.attr('title', _this.metadata().removed_text);
                    _this.attr('href', data_array[1]);
                }
            }
			 myAjaxLoad()
            _this.parents('.collateral').unblock();
        });
        return false;
	});
	$('body').delegate('.js-admin-action', 'click', function() {
         var active = $('input.js-checkbox-active:checked').length;
        var inactive = $('input.js-checkbox-inactive:checked').length;
        if (active <= 0 && inactive <= 0) {
            alert('Please select atleast one record!');
            return false;
        } else {
            return window.confirm('Are you sure you want to do this action?');
        }
	});
    // captcha reload function
	$('form').delegate('a.js-captcha-reload,a.js-captcha-reload', 'click', function() {
        captcha_img_src = $(this).parents('.js-captcha-container').find('.captcha-img').attr('src');
        captcha_img_src = captcha_img_src.substring(0, captcha_img_src.lastIndexOf('/'));
        $(this).parents('.js-captcha-container').find('.captcha-img').attr('src', captcha_img_src + '/' + Math.random());
        return false;
	});
	$('.admin-checkbox-button').delegate('.js-admin-index-autosubmit, .js-index-autosubmit', 'change', function() {
        if ($('.js-checkbox-list:checked').val() != 1) {
            alert('Please select atleast one record!');
            return false;
        } else {
            if (window.confirm('Are you sure you want to do this action?')) {
                $(this).parents('form').submit();
            }
        }
	});
	$('body').delegate('.js-autosubmit', 'change', function() {
        $(this).parents('form').submit();
    });
	$('body').delegate('.js-pagination a', 'click', function() {
        $this = $(this);
        $this.parents('div.js-response').block();		
        $.get($this.attr('href'), function(data) {
            $this.parents('div.js-response').html(data);			
			bottomLinks();
			//triggering events
			$('.yesVote').click(function() {
				var d = $(this).metadata().id;
				var i = $(this).metadata().url;
				var desc = $(this).metadata().description;
				$(this).css('visibility', 'hidden');
				var f = $(this).parents('.contain'),
				h = f.html();
				yesvote.add(d);
				f.slideUp(400, function() {
					 var c=$.popupBoxHtml(d, i, desc);
					 f.html(c);
					 //binding behaviour for close button
					 $('#postSuccessClose_' + d).click(function(o) {
						 f.slideUp(400, function() {
							 f.html(h);
							 $('.ysvote-'+d).parent('.coupon-work-block').html('<span class="voted">Voted</span>');
							 f.slideDown();
						});
					});
					$.popupfocus('#savings_purchased_' + d,d);
					$.popupsubmit('#savingsForm_' + d,d,h);
					f.slideDown();
					$('.js-overlabel label').foverlabel();
				});
				return false;
			});
			$('.noVote').click(function() {
			var coupon_id = $(this).metadata().id;
			novote.add(coupon_id);
			$.get(__cfg('path_relative') + 'coupon_feedbacks/add', {
				couponId: coupon_id,
				vote: 'no'
			}, function(q) {
				return false;
			}, 'html');
			$('.contain-' + coupon_id).slideUp('slow');
			return false;
			});
			$("a[id*='js-multiple']", document.body).each(function() {
					$this = $(this);
					var currentTag = $this.attr('id');
					var couponCode = $this.metadata().copy;
					var coupon_id = $this.metadata().id;
					var view_class = $('#js-d_clip_container-' + coupon_id).hasClass('store-view');
					var showcode = $this.metadata().showcode;
					var parentTag = $this.parent().attr('id');
					var childTag = '#js-copyclip1-' + couponCode;
					var z;
					var h;
					var clip = null;
					var clip = new ZeroClipboard.Client();
					clip.addEventListener('onComplete', my_complete);
					//clip.addEventListener('onmouseover', my_mouseover);
					clip.addEventListener('onmouseout', my_mouseout);
					clip.setHandCursor(true);
					clip.setCSSEffects(true);
					clip.setText(couponCode);
					clip.glue(currentTag, parentTag);
					function my_mouseout() {
						b.hide();
					}
					function my_complete(client, text) {
						$(childTag).text('Copied:' + couponCode);
						var parentURL = $('#' + currentTag).metadata().url;
						var trackURL = $('#' + currentTag).metadata().track_url;
						var link = parentURL;
						var initial = 0;
						$('#' + currentTag).removeClass('clicked').addClass('clicked');
						if (showcode == 2) {
							$('#' + currentTag).html(couponCode);
						} else {
						   $('#' + currentTag).html(couponCode);
						}
						if (initial == 0) {
							window.open(trackURL, 'merchantWindow');
						}
					}
				});


            $this.parents('div.js-response').unblock();

        });
        return false;
	});
	$('#main').delegate('a.js-comm', 'click', function() {
        $('div.js-showview').slideToggle();
        return false;
	});
	$('.explanation-info').delegate('.js-explaination', 'click', function() {
		$('.states-information').slideToggle();
        return false;
	});
	$('body').delegate('.js-toggle-show', 'click', function() {
        $('.' + $(this).metadata().container).toggle();
        return false;
	});
	$('body').delegate('.js-change-action', 'click', function() {
        var $this = $(this);
        $('.' + $this.metadata().container).block();
        $.get(__cfg('path_relative') + $this.metadata().url + $this.val(), {}, function(data) {
            $('.' + $this.metadata().container).html(data);
            $('.' + $this.metadata().container).unblock();
        });
	});
	$('body').delegate('.js-toggle-check', 'click', function() {
        $('.' + $(this).metadata().divClass).toggle('slow');
	});
	$('body').delegate('.js-toggle-div', 'click', function() {
        $('.' + $(this).metadata().divClass).toggle('slow');
        return false;	
	});
	$('body').delegate('#paging-list-page div.paging a, .js-ajax-sort', 'click', function() {
        var _this = $(this);
        _this.block();
        $.get($(this).attr('href'), {}, function(data) {
            _this.parents('.responses').html(data);
            _this.unblock();
        });
        return false;
	});
	$('div.js-confirm-message-block').delegate('a.js-confirm-msg', 'click', function(event) {
        return window.confirm(__l('Are you sure confirm this action?'));
    });
	if ($('.js-helptip', 'body').is('.js-helptip')) {
		$('.js-helptip').tipsy( {
			title: $('.js-helptip').metadata().title,
			gravity: 'w',
			fade:true
		});
	}
	if ($('.js-accordion', 'body').is('.js-accordion')) {
		$('div.js-accordion').accordion( {
			header: 'h3',
			autoHeight: false,
			active: false,
			collapsible: true
		});
		$('h3', '.js-accordion').click(function(e) {
			var contentDiv = $(this).next('div');
			if ( ! contentDiv.html().length) {
				$this = $(this);
				$this.block();
				$.get($(this).find('a').attr('href'), function(data) {
					contentDiv.html(data);
					$this.unblock();
				});
			}
		});
	}
});
function loadGeo() {
    var options = {
        map_frame_id: 'mapframe',
        map_window_id: 'mapwindow',
        state: 'StateName',
        city: 'CityName',
        country: 'js-country_id',
        lat_id: 'latitude',
        lng_id: 'longitude',
        postal_code: 'StoreZipCode',
        ne_lat: 'ne_latitude',
        ne_lng: 'ne_longitude',
        sw_lat: 'sw_latitude',
        sw_lng: 'sw_longitude',
        lat: '37.7749295',
        lng: '-122.4194155',
        map_zoom: 13
    }
    $('#StoreAddressSearch').autogeocomplete(options);
    $.fstoreaddform('form#StoreAddForm #js-country_id');
}
function loadGeoAddress(selector) {
    geocoder = new google.maps.Geocoder();
    var address = $(selector).val();
    geocoder.geocode( {
        'address': address
    }, function(results, status) {
        $.map(results, function(results) {
            var components = results.address_components;
            if (components.length) {
                for (var j = 0; j < components.length; j ++ ) {
                    if (components[j].types[0] == 'locality' || components[j].types[0] == 'administrative_area_level_2') {
                        city = components[j].long_name;
                        $('#CityName').val(city);
                    }
                    if (components[j].types[0] == 'administrative_area_level_1') {
                        state = components[j].long_name;
                        $('#StateName').val(state);
                    }
                    if (components[j].types[0] == 'country') {
                        country = components[j].short_name;
                        $('#js-country_id').val(country);

                    }
                    if (components[j].types[0] == 'postal_code') {
                        postal_code = components[j].long_name;
						$('StoreZipCode').val(postal_code);  
                    }
                }
            }
        });
    });
}
function updateFields(value) {
    if (value == 1) {
		//shopping tips
        $('.ccode').hide('slow');
        $('.cdesc').find('label').text('Tips');
        $('.curl').hide('slow');
    } else if (value == 2) {
		// coupon code
        $('.ccode').show('slow');
        $('.cdesc').find('label').text('Discount');
        $('.curl').hide('slow');
    } else if (value == 3) {
	    // printable coupon
        $('.ccode').hide('slow');
        $('.cdesc').find('label').text('Tips');
        $('.curl').show('slow');
    }
}
function buildChart() {
    if ($('.js-load-line-graph', 'body').is('.js-load-line-graph')) {
        $('.js-load-line-graph').each(function() {
            data_container = $(this).metadata().data_container;
            chart_container = $(this).metadata().chart_container;
            chart_title = $(this).metadata().chart_title;
            chart_y_title = $(this).metadata().chart_y_title;
            var table = document.getElementById(data_container);
            options = {
                chart: {
                    renderTo: chart_container,
                    defaultSeriesType: 'line'
                },
                title: {
                    text: chart_title
                },
                xAxis: {
                    labels: {
                        rotation: -90
                    }
                },
                yAxis: {
                    title: {
                        text: chart_y_title
                    }
                },
                tooltip: {
                    formatter: function() {
                        return '<b>' + this.series.name + '</b><br/>' + this.y + ' ' + this.x;
                    }
                }
            };
            // the categories
            options.xAxis.categories = [];
            jQuery('tbody th', table).each(function(i) {
                options.xAxis.categories.push(this.innerHTML);
            });

            // the data series
            options.series = [];
            jQuery('tr', table).each(function(i) {
                var tr = this;
                jQuery('th, td', tr).each(function(j) {
                    if (j > 0) {
                        // skip first column
                        if (i == 0) {
                            // get the name and init the series
                            options.series[j - 1] = {
                                name: this.innerHTML,
                                data: []
                                };
                        } else {
                            // add values
                            options.series[j - 1].data.push(parseFloat(this.innerHTML));
                        }
                    }
                });
            });
            var chart = new Highcharts.Chart(options);
        });
    }
    if ($('.js-load-pie-chart', 'body').is('.js-load-pie-chart')) {
        $('.js-load-pie-chart').each(function() {
            data_container = $(this).metadata().data_container;
            chart_container = $(this).metadata().chart_container;
            chart_title = $(this).metadata().chart_title;
            chart_y_title = $(this).metadata().chart_y_title;
            var table = document.getElementById(data_container);
            options = {
                chart: {
                    renderTo: chart_container,
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: chart_title
                },
                tooltip: {
                    formatter: function() {
                        return '<b>' + this.point.name + '</b>: ' + (this.percentage).toFixed(2) + ' %';
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [ {
                    type: 'pie',
                    name: chart_y_title,
                    data: []
                    }]
                };
            options.series[0].data = [];
            jQuery('tr', table).each(function(i) {
                var tr = this;
                jQuery('th, td', tr).each(function(j) {
                    if (j == 0) {
                        options.series[0].data[i] = [];
                        options.series[0].data[i][j] = this.innerHTML
                    } else {
                        // add values
                        options.series[0].data[i][j] = parseFloat(this.innerHTML);
                    }
                });
            });
            var chart = new Highcharts.Chart(options);
        });
    }
    if ($('.js-load-column-chart', 'body').is('.js-load-column-chart')) {
        $('.js-load-column-chart').each(function() {
            data_container = $(this).metadata().data_container;
            chart_container = $(this).metadata().chart_container;
            chart_title = $(this).metadata().chart_title;
            chart_y_title = $(this).metadata().chart_y_title;
            var table = document.getElementById(data_container);
            seriesType = 'column';
            if ($(this).metadata().series_type) {
                seriesType = $(this).metadata().series_type;
            }
            options = {
                chart: {
                    renderTo: chart_container,
                    defaultSeriesType: seriesType,
                    margin: [50, 50, 100, 80]
                    },
                title: {
                    text: chart_title
                },
                xAxis: {
                    categories: [],
                    labels: {
                        rotation: -90,
                        align: 'right',
                        style: {
                            font: 'normal 13px Verdana, sans-serif'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: chart_y_title
                    }
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    formatter: function() {
                        return '<b>' + this.x + '</b><br/>' + Highcharts.numberFormat(this.y, 1);
                    }
                },
                series: [ {
                    name: 'Data',
                    data: [],
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        x: -3,
                        y: 10,
                        formatter: function() {
                            return '';
                        },
                        style: {
                            font: 'normal 13px Verdana, sans-serif'
                        }
                    }
                }]
                };
            // the categories
            options.xAxis.categories = [];
            options.series[0].data = [];
            jQuery('tr', table).each(function(i) {
                var tr = this;
                jQuery('th, td', tr).each(function(j) {
                    if (j == 0) {
                        options.xAxis.categories.push(this.innerHTML);
                    } else {
                        // add values
                        options.series[0].data.push(parseFloat(this.innerHTML));
                    }
                });
            });
            chart = new Highcharts.Chart(options);
        });
    }
}