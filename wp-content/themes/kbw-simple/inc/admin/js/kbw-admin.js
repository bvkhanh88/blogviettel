jQuery(document).ready(function ($) {
    //Custom Redux option: "redux-multi-text"
    $('.custom-sidebar input.regular-text ').each(function () {
        $(this).addClass('is-save').attr('readonly', 'readonly');

    });
    $('input[name="redux_save"]').on('click', function (e) {
        e.preventDefault();
        $('.custom-sidebar input.regular-text').addClass('is-save').attr('readonly', 'readonly');
        $('.edit-sidebar').text('Edit');
    });
    $('.is-save').after('<a href="javascript:void(0);" class="edit-sidebar redux-multi-text-edit">Edit</a>');
    $('.custom-sidebar .redux-multi-text-add').on('click', function () {
        $(this).parents('.redux-field').find('.redux-multi-text li').last().find('input').removeClass('is-save').removeAttr('readonly');
    });
    $('.custom-sidebar .edit-sidebar').bind('click', function () {
        if ($(this).prev().hasClass('is-save')) {
            $(this).text('Save');
            $(this).prev().removeClass('is-save').removeAttr('readonly');
        } else {
            $(this).text('Edit');
            $(this).prev().addClass('is-save').attr('readonly', 'readonly');
        }
    });

    //WOO
    $('#_product_notes').attr('readonly', 'readonly');
}); //End: jQuery(document).ready(function())


//--- Main Admin Script ---//
jQuery(document).ready(function ($) {
    // Panel Tabs
    $(".tabs-wrap").hide();
    $(".kbw-panel-tabs ul li:first").addClass("active").show();
    $(".tabs-wrap:first").show();
    $("li.kbw-tabs:not(.kbw-not-tab)").click(function () {
        $(".kbw-panel-tabs ul li").removeClass("active");
        $(this).addClass("active");
        $(".tabs-wrap").hide();
        var activeTab = $(this).find("a").attr("href");
        $(activeTab).fadeIn('fast');
        return false;
    });

    //Checkbox custom
    var emptyImg = kbwadmin.theme_url + '/inc/admin/images/empty.png';
    $('.on-of').checkbox({empty: emptyImg});

    // Del Preview Image
    $(document).on("click", ".del-img", function () {
        jQuery(this).parent().fadeOut(function () {
            jQuery(this).hide();
            jQuery(this).parent().find('input[class="img-path"]').attr('value', '');
        });
    });

    // Del Cats
    $(document).on("click", ".del-cat", function () {
        jQuery(this).parent().parent().addClass('removered').fadeOut(function () {
            jQuery(this).remove();
        });
    });

    // Tooltip
    $('.kbw-tooltip').each(function () {
        $(this).tooltip({
            content: function () {
                return $(this).prop('title');
            },
            tooltipClass: 'kbw-ui-tooltip',
            position: {
                my: 'center top',
                at: 'center bottom+10',
                collision: 'flipfit'
            },
            hide: {
                duration: 200
            },
            show: {
                duration: 200
            }
        });
    });

    //-- Ajax Save Option --//
    $('form#kbw_form_options').submit(function () {
        /* Disable Empty options */
        $('form#kbw_form_options input, form#kbw_form_options textarea, form#kbw_form_options select').each(function () {
            if (!$(this).val()) $(this).attr("disabled", true);
        });

        var data = $(this).serialize().replace(/%3C/g, '%3Ckbw-open-tag');

        /* Enable Empty options */
        $('form#kbw_form_options input:disabled, form#kbw_form_options textarea:disabled, form#kbw_form_options select:disabled').attr("disabled", false);

        //ajax...
        $.ajax({
            url: ajaxurl,
            type: "POST",
            data: data,
            success: function (response) {
                console.log(response);
                if (response === '1') {
                    jQuery('#save-options-alert').addClass('save-done');
                    t = setTimeout('fade_message()', 1000);
                } else if (response === '2') {
                    location.reload();
                } else {
                    $('#save-options-alert').addClass('save-error');
                    t = setTimeout('fade_message()', 1000);
                }
            }
        });

        return false;
    });

    // Save Settings Alert
    $(".kbw-panel-save").click(function () {
        $('#save-options-alert').fadeIn();
    });
});


// Hook up ACE editor to all textareas with data-editor attribute
jQuery(function () {
    jQuery('textarea[data-editor][data-kbw]').each(function () {
        var textarea = jQuery(this);
        var mode = textarea.data('editor');
        var editDiv = jQuery('<div>', {
            position: 'absolute',
            width: textarea.width(),
            height: textarea.height(),
            'class': textarea.attr('class')
        }).insertBefore(textarea);
        textarea.css('display', 'none');
        var editor = ace.edit(editDiv[0]);
        editor.renderer.setShowGutter(textarea.data('gutter'));
        editor.getSession().setValue(textarea.val());
        editor.getSession().setMode("ace/mode/" + mode);
        editor.setTheme("ace/theme/idle_fingers");

        // copy back to textarea on form submit...
        textarea.closest('form').submit(function () {
            textarea.val(editor.getSession().getValue());
        });

        editor.getSession().on('change', function(){
            textarea.val(editor.getSession().getValue());
        });
    });
});

// Image Uploader Functions
function kbw_set_uploader(field, styling) {
    // Instantiates the variable that holds the media library frame.
    var kbw_bg_uploader;

    // Runs when the image button is clicked.
    jQuery(document).on("click", "#upload_" + field + "_button", function (event) {
        // Prevents the default action from occuring.
        event.preventDefault();

        // If the frame already exists, re-open it.
        if (kbw_bg_uploader) {
            kbw_bg_uploader.open();
            return;
        }

        // Sets up the media library frame
        kbw_bg_uploader = wp.media.frames.kbw_bg_uploader = wp.media({
            title: 'Choose Image',
            library: {type: 'image'},
            button: {text: 'Select'},
            multiple: false
        });

        // Runs when an image is selected.
        kbw_bg_uploader.on('select', function () {
            var selection = kbw_bg_uploader.state().get('selection');
            selection.map(function (attachment) {
                attachment = attachment.toJSON();

                if (styling)
                    jQuery('#' + field + '-img').val(attachment.url);
                else
                    jQuery('#' + field).val(attachment.url);

                jQuery('#' + field + '-preview').show();
                jQuery('#' + field + '-preview img').attr("src", attachment.url);
            });
        });

        // Opens the media library frame.
        kbw_bg_uploader.open();
    });
}

function fade_message() {
    jQuery('#save-options-alert').fadeOut(function () {
        jQuery('#save-options-alert').removeClass('save-done');
    });
    clearTimeout(t);
}

// CheckBox
(function($){var i=function(e){if(!e)var e=window.event;e.cancelBubble=true;if(e.stopPropagation)e.stopPropagation()};$.fn.checkbox=function(f){try{document.execCommand('BackgroundImageCache',false,true)}catch(e){}var g={cls:'jquery-checkbox',empty:'empty.png'};g=$.extend(g,f||{});var h=function(a){var b=a.checked;var c=a.disabled;var d=$(a);if(a.stateInterval)clearInterval(a.stateInterval);a.stateInterval=setInterval(function(){if(a.disabled!=c)d.trigger((c=!!a.disabled)?'disable':'enable');if(a.checked!=b)d.trigger((b=!!a.checked)?'check':'uncheck')},10);return d};return this.each(function(){var a=this;var b=h(a);if(a.wrapper)a.wrapper.remove();a.wrapper=$('<span class="'+g.cls+'"><span class="mark"><img src="'+g.empty+'" /></span></span>');a.wrapperInner=a.wrapper.children('span:eq(0)');a.wrapper.hover(function(e){a.wrapperInner.addClass(g.cls+'-hover');i(e)},function(e){a.wrapperInner.removeClass(g.cls+'-hover');i(e)});b.css({position:'absolute',zIndex:-1,visibility:'hidden'}).after(a.wrapper);var c=false;if(b.attr('id')){c=$('label[for='+b.attr('id')+']');if(!c.length)c=false}if(!c){c=b.closest?b.closest('label'):b.parents('label:eq(0)');if(!c.length)c=false}if(c){c.hover(function(e){a.wrapper.trigger('mouseover',[e])},function(e){a.wrapper.trigger('mouseout',[e])});c.click(function(e){b.trigger('click',[e]);i(e);return false})}a.wrapper.click(function(e){b.trigger('click',[e]);i(e);return false});b.click(function(e){i(e)});b.bind('disable',function(){a.wrapperInner.addClass(g.cls+'-disabled')}).bind('enable',function(){a.wrapperInner.removeClass(g.cls+'-disabled')});b.bind('check',function(){a.wrapper.addClass(g.cls+'-checked')}).bind('uncheck',function(){a.wrapper.removeClass(g.cls+'-checked')});$('img',a.wrapper).bind('dragstart',function(){return false}).bind('mousedown',function(){return false});if(window.getSelection)a.wrapper.css('MozUserSelect','none');if(a.checked)a.wrapper.addClass(g.cls+'-checked');if(a.disabled)a.wrapperInner.addClass(g.cls+'-disabled')})}})(jQuery);
