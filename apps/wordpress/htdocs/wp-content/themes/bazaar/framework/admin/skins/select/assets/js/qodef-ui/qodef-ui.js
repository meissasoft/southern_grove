(function ($) {
	"use strict";

	var $portfolio_image;
	var $thumbs_wrap;
	var $input_gallery_items;
	var $portfolio_item;
	var $portfolio_videos;
	var hidden_elements_array;
	var shown_elements_array;
	var $slide_element;

    $(document).ready(function () {
        //plugins init goes here
        qodefInitSelectChange();
        qodefInitSwitch();
        qodefInitSaveCheckBoxesValue();
        qodefCheckBoxMultiSelectInitState();
        qodefInitCheckBoxMultiSelectChange();
        qodefInitTooltips();
        qodefInitColorpicker();
        qodefInitRangeSlider();
        qodefInitMediaUploader();
        qodefInitGalleryUploader();
        if ($('.qodef-page-form').length > 0) {
            qodefInitAjaxForm();
            qodefInitSearchFloat();
            qodefScrollToAnchorSelect();
            qodefCheckVisibilityOfAnchorOptions();
            qodefCheckOptionAnchorsOnDependencyChange();
            qodefChangedInput();
            qodefInitSelectPicker();
        }
        qodefInitPortfolioImagesVideosBox();
        qodeInitPortfolioMediaAcc();
        qodefInitPortfolioItemsBox();
        qodeInitPortfolioItemAcc();
        qodeInitSlideElementItemAcc();
        qodefInitSlideElementItemsBox();
        qodefInitDatePicker();
        qodefShowHidePostFormats();
        qodefPageTemplatesMetaBoxDependency();
        qodefRepeater();
        qodefInitSortable();
        qodefImportOptions();
        qodefImportCustomSidebars();
        qodefImportWidgets();
        qodefInitImportContent();
        qodefSelect2();
    });

    function qodefChangedInput() {
        $('.qodef-tabs-content').on('change keyup keydown', 'input:not([type="submit"]), textarea, select:not(#qodef-select-anchor)', function (e) {
            $('.qodef-input-change').addClass('yes');
            checkBottomPaddingOfFormWrapDiv();
        });

        $('.field.switch label:not(.selected)').on('click',function () {
            $('.qodef-input-change').addClass('yes');
            checkBottomPaddingOfFormWrapDiv();
        });

        $(window).on('beforeunload', function () {
            if ($('.qodef-input-change.yes').length) {
                return 'You haven\'t saved your changes.';
            }
        });

        $('#anchornav input').on('click',function () {
            if ($('.qodef-input-change.yes').length) {
                $('.qodef-input-change.yes').removeClass('yes');
            }
            $('.qodef-changes-saved').addClass('yes');
            checkBottomPaddingOfFormWrapDiv();
            setTimeout(function () {
                $('.qodef-changes-saved').removeClass('yes');
                checkBottomPaddingOfFormWrapDiv();
            }, 3000);
        });
    }

    function qodefScrollToAnchorSelect() {
        var selectAnchor = $('#qodef-select-anchor');
        selectAnchor.on('change', function () {

            var selectAnchor = $('option:selected', '#qodef-select-anchor');
            if (typeof selectAnchor.data('anchor') !== 'undefined') {
                qodefScrollToPanel(selectAnchor.data('anchor'));
            }
        });
    }

    function qodefScrollToPanel(panel) {
        var adminBarHeight = $('#wpadminbar').height();
        var panelTopPosition = $(panel).offset().top - adminBarHeight;

        $('html, body').animate({
            scrollTop: panelTopPosition
        }, 1000);

        return false;
    }

    function qodefCheckVisibilityOfAnchorOptions() {
        $('.qodef-page-form > div:hidden').each(function () {
            var $panelID = $(this).attr('id');
            $('#qodef-select-anchor option').each(function () {
                if ($(this).data('anchor') == '#' + $panelID) {
                    $(this).hide();//hide <li>s
                }
            });
        })
    }

    function qodefGetArrayOfHiddenElements(changedElement) {
        var hidden_elements_string = changedElement.data('hide');
        hidden_elements_array = [];
        if (typeof hidden_elements_string !== 'undefined' && hidden_elements_string.indexOf(",") >= 0) {
            var hidden_elements_array = hidden_elements_string.split(',');
        } else {
            var hidden_elements_array = new Array(hidden_elements_string);
        }

        return hidden_elements_array;
    }

    function qodefGetArrayOfShownElements(changedElement) {
        //check for links to show
        var shown_elements_string = changedElement.data('show');
        shown_elements_array = [];
        if (typeof shown_elements_string !== 'undefined' && shown_elements_string.indexOf(",") >= 0) {
            var shown_elements_array = shown_elements_string.split(',');
        } else {
            var shown_elements_array = new Array(shown_elements_string);
        }

        return shown_elements_array;
    }

    function qodefGetArrayOfHiddenElementsSelectBox(changedElement, changedElementValue) {
        var hidden_elements_string = changedElement.data('hide-' + changedElementValue);
        hidden_elements_array = [];
        if (typeof hidden_elements_string !== 'undefined' && hidden_elements_string.indexOf(",") >= 0) {
            var hidden_elements_array = hidden_elements_string.split(',');
        } else {
            var hidden_elements_array = new Array(hidden_elements_string);
        }

        return hidden_elements_array;
    }

    function qodefGetArrayOfShownElementsSelectBox(changedElement, changedElementValue) {
        //check for links to show
        var shown_elements_string = changedElement.data('show-' + changedElementValue);
        shown_elements_array = [];
        if (typeof shown_elements_string !== 'undefined' && shown_elements_string.indexOf(",") >= 0) {
            var shown_elements_array = shown_elements_string.split(',');
        } else {
            var shown_elements_array = new Array(shown_elements_string);
        }

        return shown_elements_array;
    }

    function checkBottomPaddingOfFormWrapDiv() {
        //check bottom padding of form wrap div, since bottom holder is changing its height because of the info messages
        setTimeout(function () {
            $('.qodef-page-form').css('padding-bottom', $('.form-button-section').height());
        }, 350);
    }

    function qodefCheckOptionAnchorsOnDependencyChange() {
        $(document).on('click', '.cb-enable.dependence, .cb-disable.dependence', function () {
            var hidden_elements_array = qodefGetArrayOfHiddenElements($(this));
            var shown_elements_array = qodefGetArrayOfShownElements($(this));

            if (typeof(hidden_elements_array) !== 'undefined') {
                //show all buttons, but hide unnecessary ones
                $.each(hidden_elements_array, function (index, value) {
                    $('#qodef-select-anchor option').each(function () {

                        if ($(this).data('anchor') == value) {
                            $(this).hide();//hide option
                        }
                    });
                });
            }

            if (typeof(shown_elements_array) !== 'undefined') {
                $.each(shown_elements_array, function (index, value) {
                    $('#qodef-select-anchor option').each(function () {
                        if ($(this).data('anchor') == value) {
                            $(this).show();//show option
                        }
                    });
                });
            }

            $('#qodef-select-anchor').selectpicker('refresh');
        });

        $(document).on('change', '.qodef-form-element.dependence', function () {
            hidden_elements_array = qodefGetArrayOfHiddenElementsSelectBox($(this), $(this).val());
            shown_elements_array = qodefGetArrayOfShownElementsSelectBox($(this), $(this).val());

            //show all buttons, but hide unnecessary ones
            $.each(hidden_elements_array, function (index, value) {
                $('#qodef-select-anchor option').each(function () {

                    if ($(this).data('anchor') == value) {
                        $(this).hide();//hide option
                    }
                });
            });
            $.each(shown_elements_array, function (index, value) {
                $('#qodef-select-anchor option').each(function () {
                    if ($(this).data('anchor') == value) {
                        $(this).show();//show option
                    }
                });
            });

            $('#qodef-select-anchor').selectpicker('refresh');
        });
    }

    function qodefInitSearchFloat() {
        var $wrapForm = $('.qodef-page-form'),
            $controls = $('.form-button-section'),
            $buttonSection = $('.form-button-section')

        function initControlsSize() {
            $('#anchornav').css({
                "width": $wrapForm.width()
            });
            checkBottomPaddingOfFormWrapDiv();
        };

        function initControlsFlow() {
            var wrapBottom = $wrapForm.offset().top + $wrapForm.outerHeight(),
                viewportBottom = $(window).scrollTop() + $(window).height();

            if (viewportBottom <= wrapBottom) {
                $controls.addClass('flow');
            }
            else {
                $controls.removeClass('flow');
            }
            ;
        };

        initControlsSize();
        initControlsFlow();

        $(window).on("scroll", function () {
            initControlsFlow();
        });

        $(window).on("resize", function () {
            initControlsSize();
        });
    }

    function qodefInitSelectChange() {
        var selectBox = $('select.dependence');
        selectBox.each(function() {
            initialHide($(this), this);
        });
        selectBox.on('change', function (e) {
            initialHide($(this), this);
        });

        function initialHide(selectField, selectObject) {
            var valueSelected = selectObject.value.replace(/ /g, '');
            $(selectField.data('hide-'+valueSelected)).fadeOut();
            $(selectField.data('show-'+valueSelected)).fadeIn();
        }

        var switchers = $('select.qodef-switcher');
        switchers.each(function() {
            changeActions($(this), $(this).val(), true);
        });

        switchers.on('change', function (e) {
            var valueSelected = this.value.replace(/ /g, '');
            changeActions($(this), valueSelected, false);
        });

        function changeActions(selectField, valueSelected, initialCall) {
            var switchType = selectField.data('switch-type');
            var switchProperty = selectField.data('switch-property');
            var switchEnabled = selectField.data('switch-enabled');

            if (switchType === 'single_yesno') {
                var switchers = $('.switch-' + switchProperty);
                if (switchEnabled === valueSelected) {
                    switchers.addClass('qodef-switch-single-mode');
                    switchers.attr('data-switch-selector', switchProperty);
                } else {
                    switchers.removeClass('qodef-switch-single-mode');
                    switchers.removeAttr('data-switch-selector');
                }

                //On property change leave only one switcher enabled
                if(!initialCall) {
                    var oneSwitcherEnabled = false;
                    switchers.removeClass('switcher-auto-enabled');
                    switchers.each(function () {
                        var switcher = $(this);
                        var enabled = $(this).find('.cb-enable');
                        if (!oneSwitcherEnabled && enabled.hasClass('selected')) {
                            oneSwitcherEnabled = true;
                            $(this).addClass('switcher-auto-enabled');
                        }
                        if (!switcher.hasClass('switcher-auto-enabled')) {
                            switcher.find('.cb-disable').addClass('selected');
                            switcher.find('.cb-enable').removeClass('selected');
                            switcher.find('.checkbox').attr('checked', false);
                            switcher.find('.checkboxhidden_yesno').val("no");
                        }
                    });
                }
            }
        }

    }

    function qodefInitSwitch() {
        //Logic for setting element initial to be no
        var yesNoElements = $(".switch");
        yesNoElements.each(function () {
            var element = $(this);
            if (element.parents('.qodef-repeater-field') && !element.find('input[type="hidden"]').val()) {
                element.find('.cb-enable').removeClass('selected');
                element.find('.cb-disable').addClass('selected');
            }
        });
        $(".cb-enable").on('click',function(){
            var parent = $(this).parents('.switch');
            //This condition is if only one element can be active, developed for repeater purposes
            //First disable all yes/no elements...
            if(parent.hasClass('qodef-switch-single-mode')) {
                var selector = '.switch-'+ parent.data('switch-selector');
                var switchers = $(selector);
                switchers.each(function() {
                    var switcher = $(this);
                    switcher.find('.cb-disable').addClass('selected');
                    switcher.find('.cb-enable').removeClass('selected');
                    switcher.find('.checkbox').attr('checked', false);
                    switcher.find('.checkboxhidden_yesno').val("no");
                });
                //Then enable the one that is clicked
                $('.cb-disable', parent).removeClass('selected');
                $(this).addClass('selected');
                $('.checkbox',parent).attr('checked', true);
                $('.checkboxhidden_yesno',parent).val("yes");
            } else {
                $('.cb-disable', parent).removeClass('selected');
                $(this).addClass('selected');
                $('.checkbox', parent).attr('checked', true);
                $('.checkboxhidden_yesno', parent).val("yes");
                $('.checkboxhidden_onoff', parent).val("on");
                $('.checkboxhidden_portfoliofollow', parent).val("portfolio_single_follow");
                $('.checkboxhidden_zeroone', parent).val("1");
                $('.checkboxhidden_imagevideo', parent).val("image");
                $('.checkboxhidden_yesempty', parent).val("yes");
                $('.checkboxhidden_flagpost', parent).val("post");
                $('.checkboxhidden_flagpage', parent).val("page");
                $('.checkboxhidden_flagmedia', parent).val("attachment");
                $('.checkboxhidden_flagportfolio', parent).val("portfolio_page");
                $('.checkboxhidden_flagproduct', parent).val("product");
            }
        });
        $(".cb-disable").on('click',function(){
            var parent = $(this).parents('.switch');
            //If only one element can be active, than no value shouldn't be clickable
            if(!parent.hasClass('qodef-switch-single-mode')) {
                $('.cb-enable', parent).removeClass('selected');
                $(this).addClass('selected');
                $('.checkbox', parent).attr('checked', false);
                $('.checkboxhidden_yesno', parent).val("no");
                $('.checkboxhidden_onoff', parent).val("off");
                $('.checkboxhidden_portfoliofollow', parent).val("portfolio_single_no_follow");
                $('.checkboxhidden_zeroone', parent).val("0");
                $('.checkboxhidden_imagevideo', parent).val("video");
                $('.checkboxhidden_yesempty', parent).val("");
                $('.checkboxhidden_flagpost', parent).val("");
                $('.checkboxhidden_flagpage', parent).val("");
                $('.checkboxhidden_flagmedia', parent).val("");
                $('.checkboxhidden_flagportfolio', parent).val("");
                $('.checkboxhidden_flagproduct', parent).val("");
            }
        });
        $(".cb-enable.dependence").on('click',function(){
            $($(this).data('hide')).fadeOut();
            $($(this).data('show')).fadeIn();
        });
        $(".cb-disable.dependence").on('click',function(){
            $($(this).data('hide')).fadeOut();
            $($(this).data('show')).fadeIn();
        });
    }

    function qodefInitSaveCheckBoxesValue(){
        var checkboxes = $('.qodef-single-checkbox-field');
        checkboxes.change(function(){
            qodefDisableHidden($(this));
        });
        checkboxes.each(function(){
            qodefDisableHidden($(this));
        });
        function qodefDisableHidden(thisBox){
            if(thisBox.is(':checked')){
                thisBox.siblings('.qodef-checkbox-single-hidden').prop('disabled', true);
            }else{
                thisBox.siblings('.qodef-checkbox-single-hidden').prop('disabled', false);
            }
        }
    }

    function qodefCheckBoxMultiSelectInitState(){
        var element = $('input[type="checkbox"].dependence.multiselect');
        if(element.length){
            element.each(function() {
                var thisItem = $(this);
                qodefInitCheckBox(thisItem);
            });
        }
    }

    function qodefInitCheckBoxMultiSelectChange() {
        var element = $('input[type="checkbox"].dependence.multiselect');
        element.on('change', function(){
            var thisItem = $(this);
            qodefInitCheckBox(thisItem);
        });
    }

    function qodefInitCheckBox(checkBox){

        var thisItem = checkBox;
        var checked = thisItem.attr('checked');
        var dataShow = thisItem.data('show');

        if(checked === 'checked'){
            if(typeof(dataShow)!== 'undefined' && dataShow !== '') {
                var elementsToShow = dataShow.split(',');

                $.each(elementsToShow, function(index, value) {
                    $(value).fadeIn();
                });
            }
        }
        else{
            if(typeof(dataShow)!== 'undefined' && dataShow !== '') {
                var elementsToShow = dataShow.split(',');

                $.each(elementsToShow, function(index, value) {
                    $(value).fadeOut();
                });
            }
        }

    }

    function qodefInitTooltips() {
        $('.qodef-tooltip').tooltip();
    }

    function qodefInitColorpicker() {
        $('.qodef-page .my-color-field').wpColorPicker({
            change: function (event, ui) {
                $('.qodef-input-change').addClass('yes');
            }
        });
    }

    /**
     * Function that initializes
     */
    function qodefInitRangeSlider() {
        if ($('.qodef-slider-range').length) {

            $('.qodef-slider-range').each(function () {
                var Link = $.noUiSlider.Link;

                var start = 0;            //starting position of slider
                var min = 0;            //minimal value
                var max = 100;          //maximal value of slider
                var step = 1;            //number of steps to snap to
                var orientation = 'horizontal';   //orientation. Could be vertical or horizontal
                var prefix = '';           //prefix to the serialized value that is written field
                var postfix = '';           //postfix to the serialized value that is written to field
                var thousand = '';           //separator for thousand
                var decimals = 2;            //number of decimals
                var mark = '.';          //decimal separator

                //is data-start attribute set for current instance?
                if ($(this).data('start') != null && $(this).data('start') !== "" && $(this).data('start') != "0.00") {
                    start = $(this).data('start');
                    if (start == "1.00") start = 1;
                    if (parseInt(start) == start) {
                        start = parseInt(start);
                    }
                }

                //is data-min attribute set for current instance?
                if ($(this).data('min') != null && $(this).data('min') !== "") {
                    min = $(this).data('min');
                }

                //is data-max attribute set for current instance?
                if ($(this).data('max') != null && $(this).data('max') !== "") {
                    max = $(this).data('max');
                }

                //is data-step attribute set for current instance?
                if ($(this).data('step') != null && $(this).data('step') !== "") {
                    step = $(this).data('step');
                }

                //is data-orientation attribute set for current instance?
                if ($(this).data('orientation') != null && $(this).data('orientation') !== "") {
                    //define available orientations
                    var availableOrientations = ['horizontal', 'vertical'];

                    //is data-orientation value in array of available orientations?
                    if (availableOrientations.indexOf($(this).data('orientation'))) {
                        orientation = $(this).data('orientation');
                    }
                }

                //is data-prefix attribute set for current instance?
                if ($(this).data('prefix') != null && $(this).data('prefix') !== "") {
                    prefix = $(this).data('prefix');
                }

                //is data-postfix attribute set for current instance?
                if ($(this).data('postfix') != null && $(this).data('postfix') !== "") {
                    postfix = $(this).data('postfix');
                }

                //is data-thousand attribute set for current instance?
                if ($(this).data('thousand') != null && $(this).data('thousand') !== "") {
                    thousand = $(this).data('thousand');
                }

                //is data-decimals attribute set for current instance?
                if ($(this).data('decimals') != null && $(this).data('decimals') !== "") {
                    decimals = $(this).data('decimals');
                }

                //is data-mark attribute set for current instance?
                if ($(this).data('mark') != null && $(this).data('mark') !== "") {
                    mark = $(this).data('mark');
                }

                $(this).noUiSlider({
                    start: start,
                    step: step,
                    orientation: orientation,
                    range: {
                        'min': min,
                        'max': max
                    },
                    serialization: {
                        lower: [
                            new Link({
                                target: $(this).prev('.qodef-slider-range-value')
                            })
                        ],
                        format: {
                            // Set formatting
                            thousand: thousand,
                            postfix: postfix,
                            prefix: prefix,
                            decimals: decimals,
                            mark: mark
                        }
                    }
                }).on({
                    change: function () {
                        $('.qodef-input-change').addClass('yes');
                    }
                });
            });
        }
    }

    function qodefInitMediaUploader() {
        if ($('.qodef-media-uploader').length) {
            $('.qodef-media-uploader').each(function () {
                var fileFrame;
                var uploadUrl;
                var uploadHeight;
                var uploadWidth;
                var uploadImageHolder;
                var attachment;
                var removeButton;

                //set variables values
                uploadUrl = $(this).find('.qodef-media-upload-url');
                uploadHeight = $(this).find('.qodef-media-upload-height');
                uploadWidth = $(this).find('.qodef-media-upload-width');
                uploadImageHolder = $(this).find('.qodef-media-image-holder');
                removeButton = $(this).find('.qodef-media-remove-btn');

                if (uploadImageHolder.find('img').attr('src') != "") {
                    removeButton.show();
                    qodefInitMediaRemoveBtn(removeButton);
                }

                $(this).on('click', '.qodef-media-upload-btn', function () {
                    //if the media frame already exists, reopen it.
                    if (fileFrame) {
                        fileFrame.open();
                        return;
                    }

                    //create the media frame
                    fileFrame = wp.media.frames.fileFrame = wp.media({
                        title: $(this).data('frame-title'),
                        button: {
                            text: $(this).data('frame-button-text')
                        },
                        multiple: false
                    });

                    //when an image is selected, run a callback
                    fileFrame.on('select', function () {
                        attachment = fileFrame.state().get('selection').first().toJSON();
                        removeButton.show();
                        qodefInitMediaRemoveBtn(removeButton);
                        //write to url field and img tag
                        if (attachment.hasOwnProperty('url') && attachment.hasOwnProperty('sizes')) {
                            uploadUrl.val(attachment.url);
                            if (attachment.sizes.thumbnail)
                                uploadImageHolder.find('img').attr('src', attachment.sizes.thumbnail.url);
                            else
                                uploadImageHolder.find('img').attr('src', attachment.url);
                            uploadImageHolder.show();
                        } else if (attachment.hasOwnProperty('url')) {
                            uploadUrl.val(attachment.url);
                            uploadImageHolder.find('img').attr('src', attachment.url);
                            uploadImageHolder.show();
                        }

                        //write to hidden meta fields
                        if (attachment.hasOwnProperty('height')) {
                            uploadHeight.val(attachment.height);
                        }

                        if (attachment.hasOwnProperty('width')) {
                            uploadWidth.val(attachment.width);
                        }
                        $('.qodef-input-change').addClass('yes');
                    });

                    //open media frame
                    fileFrame.open();
                });
            });
        }

        function qodefInitMediaRemoveBtn(btn) {
            btn.on('click', function () {
                //remove image src and hide it's holder
                btn.siblings('.qodef-media-image-holder').hide();
                btn.siblings('.qodef-media-image-holder').find('img').attr('src', '');

                //reset meta fields
                btn.siblings('.qodef-media-meta-fields').find('input[type="hidden"]').each(function (e) {
                    $(this).val('');
                });

                btn.hide();
            });
        }
    }

    function qodefInitGalleryUploader() {
        var $qodef_upload_button = jQuery('.qodef-gallery-upload-btn');
        var $qodef_clear_button = jQuery('.qodef-gallery-clear-btn');

        wp.media.customlibEditGallery1 = {
            frame: function () {
                if (this._frame)
                    return this._frame;

                var selection = this.select();

                this._frame = wp.media({
                    id: 'qode_portfolio-image-gallery',
                    frame: 'post',
                    state: 'gallery-edit',
                    title: wp.media.view.l10n.editGalleryTitle,
                    editing: true,
                    multiple: true,
                    selection: selection
                });

                this._frame.on('update', function () {
                    var controller = wp.media.customlibEditGallery1._frame.states.get('gallery-edit');
                    var library = controller.get('library');
                    // Need to get all the attachment ids for gallery
                    var ids = library.pluck('id');

                    $input_gallery_items.val(ids);

                    jQuery.ajax({
                        type: "post",
                        url: ajaxurl,
                        data: "action=bazaar_qodef_gallery_upload_get_images&ids=" + ids,
                        success: function (data) {
                            $thumbs_wrap.empty().html(data);
                        }
                    });
                });

                return this._frame;
            },

            init: function () {
                $qodef_upload_button.on('click',function (event) {
                    $thumbs_wrap = $(this).parent().prev().prev();
                    $input_gallery_items = $thumbs_wrap.next();

                    event.preventDefault();
                    wp.media.customlibEditGallery1.frame().open();
                });

                $qodef_clear_button.on('click',function (event) {
                    $thumbs_wrap = $qodef_upload_button.parent().prev().prev();
                    $input_gallery_items = $thumbs_wrap.next();

                    event.preventDefault();
                    $thumbs_wrap.empty();
                    $input_gallery_items.val("");
                });
            },

            // Gets initial gallery-edit images. Function modified from wp.media.gallery.edit
            // in wp-includes/js/media-editor.js.source.html
            select: function () {
                var shortcode = wp.shortcode.next('gallery', '[gallery ids="' + $input_gallery_items.val() + '"]'),
                    defaultPostId = wp.media.gallery.defaults.id,
                    attachments, selection;

                // Bail if we didn't match the shortcode or all of the content.
                if (!shortcode)
                    return;

                // Ignore the rest of the match object.
                shortcode = shortcode.shortcode;

                if (_.isUndefined(shortcode.get('id')) && !_.isUndefined(defaultPostId))
                    shortcode.set('id', defaultPostId);

                attachments = wp.media.gallery.attachments(shortcode);
                selection = new wp.media.model.Selection(attachments.models, {
                    props: attachments.props.toJSON(),
                    multiple: true
                });

                selection.gallery = attachments.gallery;

                // Fetch the query's attachments, and then break ties from the
                // query to allow for sorting.
                selection.more().done(function () {
                    // Break ties with the query.
                    selection.props.set({
                        query: false
                    });
                    selection.unmirror();
                    selection.props.unset('orderby');
                });

                return selection;
            }
        };
        $(wp.media.customlibEditGallery1.init);
    }

    function qodeInitPortfolioItemAcc() {
        //remove portfolio item
        $(document).on('click', '.remove-portfolio-item', function (event) {
            event.preventDefault();
            var $toggleHolder = $(this).parent().parent().parent();
            $toggleHolder.fadeOut(300, function () {
                $(this).remove();

                //after removing portfolio image, set new rel numbers and set new ids/names
                $('.qodef-portfolio-additional-item').each(function (i) {
                    $(this).attr('rel', i + 1);
                    $(this).find('.number').text($(this).attr('rel'));
                    qodefSetIdOnRemoveItem($(this), i + 1);
                });
                //hide expand all button if all items are removed
                noPortfolioItemShown();
            });
            return false;
        });

        //hide expand all button if there is no items
        noPortfolioItemShown();
        function noPortfolioItemShown() {
            if ($('.qodef-portfolio-additional-item').length == 0) {
                $('.qodef-toggle-all-item').hide();
            }
        }

        //expand all additional sidebar items on click on 'expand all' button
        $(document).on('click', '.qodef-toggle-all-item', function (event) {
            event.preventDefault();
            $('.qodef-portfolio-additional-item').each(function (i) {
                var $toggleContent = $(this).find('.qodef-portfolio-toggle-content');
                var $this = $(this).find('.toggle-portfolio-item');
                if ($toggleContent.is(':visible')) {
                }
                else {
                    $toggleContent.slideToggle();
                    $this.html('<i class="fa fa-caret-down"></i>')
                }
            });
            return false;
        });
        //toggle for portfolio additional sidebar items
        $(document).on('click', '.qodef-portfolio-additional-item .qodef-portfolio-toggle-holder', function (event) {
            event.preventDefault();

            var $this = $(this);
            var $caret_holder = $this.find('.toggle-portfolio-item');
            $caret_holder.html('<i class="fa fa-caret-up"></i>');
            var $toggleContent = $this.next();
            $toggleContent.slideToggle(function () {
                if ($toggleContent.is(':visible')) {
                    $caret_holder.html('<i class="fa fa-caret-up"></i>')
                }
                else {
                    $caret_holder.html('<i class="fa fa-caret-down"></i>')
                }
                //hide expand all button function in case of all boxes revealed
                checkExpandAllBtn();
            });
            return false;
        });
        //hide expand all button when it's clicked
        $(document).on('click', '.qodef-toggle-all-item', function (event) {
            event.preventDefault();
            $(this).hide();
        });

        function checkExpandAllBtn() {
            if ($('.qodef-portfolio-additional-item .qodef-portfolio-toggle-content:hidden').length == 0) {
                $('.qodef-toggle-all-item').hide();
            } else {
                $('.qodef-toggle-all-item').show();
            }
        }
    }

    function qodefInitPortfolioItemsBox() {
        var qode_portfolio_additional_item = $('.qodef-portfolio-additional-item-holder').clone().html();
        $portfolio_item = '<div class="qodef-portfolio-additional-item" rel="">' + qode_portfolio_additional_item + '</div>';

        $('.qodef-portfolio-add a.qodef-add-item').on('click',function (event) {
            event.preventDefault();
            $(this).parent().before($($portfolio_item).hide().fadeIn(500));
            var portfolio_num = $(this).parent().siblings('.qodef-portfolio-additional-item').length;
            $(this).parent().siblings('.qodef-portfolio-additional-item:last').attr('rel', portfolio_num);
            qodefSetIdOnAddItem($(this).parent(), portfolio_num);
            $(this).parent().prev().find('.number').text(portfolio_num);
        });
    }

    function qodefSetIdOnAddItem(addButton, portfolio_num) {
        addButton.siblings('.qodef-portfolio-additional-item:last').find('input[type="text"], input[type="hidden"], select, textarea').each(function () {
            var name = $(this).attr('name');
            var new_name = name.replace("_x", "[]");
            var new_id = name.replace("_x", "_" + portfolio_num);
            $(this).attr('name', new_name);
            $(this).attr('id', new_id);
        });
    }

    function qodefSetIdOnRemoveItem(portfolio, portfolio_num) {
        if (portfolio_num == undefined) {
            var portfolio_num = portfolio.attr('rel');
        } else {
            var portfolio_num = portfolio_num;
        }

        portfolio.find('input[type="text"], input[type="hidden"], select, textarea').each(function () {
            var name = $(this).attr('name').split('[')[0];
            var new_name = name + "[]";
            var new_id = name + "_" + portfolio_num;
            $(this).attr('name', new_name);
            $(this).attr('id', new_id);
        });
    }

    function qodeInitPortfolioMediaAcc() {
        //remove portfolio media
        $(document).on('click', '.remove-portfolio-media', function (event) {
            event.preventDefault();
            var $toggleHolder = $(this).parent().parent().parent();
            $toggleHolder.fadeOut(300, function () {
                $(this).remove();

                //after removing portfolio image, set new rel numbers and set new ids/names
                $('.qodef-portfolio-media').each(function (i) {
                    $(this).attr('rel', i + 1);
                    $(this).find('.number').text($(this).attr('rel'));
                    qodefSetIdOnRemoveMedia($(this), i + 1);
                });
                //hide expand all button if all medias are removed
                noPortfolioMedia()
            });
            return false;
        });

        //hide 'expand all' button if there is no media
        noPortfolioMedia();
        function noPortfolioMedia() {
            if ($('.qodef-portfolio-media').length == 0) {
                $('.qodef-toggle-all-media').hide();
            }
        }

        //expand all portfolio medias (video and images) onClick on 'expand all' button
        $(document).on('click', '.qodef-toggle-all-media', function (event) {
            event.preventDefault();
            $('.qodef-portfolio-media').each(function (i) {

                var $toggleContent = $(this).find('.qodef-portfolio-toggle-content');
                var $this = $(this).find('.toggle-portfolio-media');
                if ($toggleContent.is(':visible')) {
                }
                else {
                    $toggleContent.slideToggle();
                    $this.html('<i class="fa fa-caret-down"></i>')
                }

            });
            return false;
        });
        //toggle for portfolio media (images or videos)
        $(document).on('click', '.qodef-portfolio-media .qodef-portfolio-toggle-holder', function (event) {
            event.preventDefault();
            var $this = $(this);
            var $caret_holder = $this.find('.toggle-portfolio-media');
            $caret_holder.html('<i class="fa fa-caret-up"></i>');
            var $toggleContent = $(this).next();
            $toggleContent.slideToggle(function () {
                if ($toggleContent.is(':visible')) {
                    $caret_holder.html('<i class="fa fa-caret-up"></i>')
                }
                else {
                    $caret_holder.html('<i class="fa fa-caret-down"></i>')
                }
                //hide expand all button function in case of all boxes revealed
                checkExpandAllMediaBtn();
            });
            return false;
        });
        //hide expand all button when it's clicked
        $(document).on('click', '.qodef-toggle-all-media', function (event) {
            event.preventDefault();
            $(this).hide();
        });
        function checkExpandAllMediaBtn() {
            if ($('.qodef-portfolio-media .qodef-portfolio-toggle-content:hidden').length == 0) {
                $('.qodef-toggle-all-media').hide();
            } else {
                $('.qodef-toggle-all-media').show();
            }
        }
    }

    function qodefInitPortfolioImagesVideosBox() {
        var qodef_portfolio_images = $('.qodef-hidden-portfolio-images').clone().html();
        $portfolio_image = '<div class="qodef-portfolio-images qodef-portfolio-media" rel="">' + qodef_portfolio_images + '</div>';
        var qodef_portfolio_videos = $('.qodef-hidden-portfolio-videos').clone().html();

        $portfolio_videos = '<div class="qodef-portfolio-videos qodef-portfolio-media" rel="">' + qodef_portfolio_videos + '</div>';
        $('a.qodef-add-image').on('click',function (e) {
            e.preventDefault();
            $(this).parent().before($($portfolio_image).hide().fadeIn(500));
            var portfolio_num = $(this).parent().siblings('.qodef-portfolio-media').length;
            $(this).parent().siblings('.qodef-portfolio-media:last').attr('rel', portfolio_num);
            qodefInitMediaUploaderAdded($(this).parent());
            qodefSetIdOnAddMedia($(this).parent(), portfolio_num);
            $(this).parent().prev().find('.number').text(portfolio_num);
        });

        $('a.qodef-add-video').on('click',function (e) {
            e.preventDefault();
            $(this).parent().before($($portfolio_videos).hide().fadeIn(500));
            var portfolio_num = $(this).parent().siblings('.qodef-portfolio-media').length;
            $(this).parent().siblings('.qodef-portfolio-media:last').attr('rel', portfolio_num);
            qodefInitMediaUploaderAdded($(this).parent());
            qodefSetIdOnAddMedia($(this).parent(), portfolio_num);
            $(this).parent().prev().find('.number').text(portfolio_num);
        });

        $(document).on('click', '.qodef-remove-last-row-media', function (event) {
            event.preventDefault();
            $(this).parent().prev().fadeOut(300, function () {
                $(this).remove();

                //after removing portfolio image, set new rel numbers and set new ids/names
                $('.qodef-portfolio-media').each(function (i) {
                    $(this).attr('rel', i + 1);
                    qodefSetIdOnRemoveMedia($(this), i + 1);
                });
            });

        });
        qodefShowHidePorfolioImageVideoType();
        $(document).on('change', 'select.qodef-portfoliovideotype', function (e) {
            qodefShowHidePorfolioImageVideoType();
        });
    }

    function qodefSetIdOnAddMedia(addButton, portfolio_num) {
        addButton.siblings('.qodef-portfolio-media:last').find('input[type="text"], input[type="hidden"], select, textarea').each(function () {
            var name = $(this).attr('name');
            var new_name = name.replace("_x", "[]");
            var new_id = name.replace("_x", "_" + portfolio_num);
            $(this).attr('name', new_name);
            $(this).attr('id', new_id);
        });

        qodefShowHidePorfolioImageVideoType();
    }

    function qodefSetIdOnRemoveMedia(portfolio, portfolio_num) {
        if (portfolio_num == undefined) {
            var portfolio_num = portfolio.attr('rel');
        } else {
            var portfolio_num = portfolio_num;
        }

        portfolio.find('input[type="text"], input[type="hidden"], select, textarea').each(function () {
            var name = $(this).attr('name').split('[')[0];
            var new_name = name + "[]";
            var new_id = name + "_" + portfolio_num;
            $(this).attr('name', new_name);
            $(this).attr('id', new_id);
        });
    }

    function qodefShowHidePorfolioImageVideoType() {
        $('.qodef-portfoliovideotype').each(function (i) {
            var $selected = $(this).val();

            if ($selected == "self") {
                $(this).parent().parent().parent().find('.qodef-video-id-holder').hide();
                $(this).parent().parent().parent().parent().find('.qodef-media-uploader').show();
                $(this).parent().parent().parent().find('.qodef-video-self-hosted-path-holder').show();
            } else {
                $(this).parent().parent().parent().find('.qodef-video-id-holder').show();
                $(this).parent().parent().parent().parent().find('.qodef-media-uploader').hide();
                $(this).parent().parent().parent().find('.qodef-video-self-hosted-path-holder').hide();
            }
        });
    }

    function qodefInitMediaUploaderAdded(addButton) {
        addButton.siblings('.qodef-portfolio-media:last, .qodef-slide-element-additional-item:last').find('.qodef-media-uploader').each(function () {
            var fileFrame;
            var uploadUrl;
            var uploadHeight;
            var uploadWidth;
            var uploadImageHolder;
            var attachment;
            var removeButton;

            //set variables values
            uploadUrl = $(this).find('.qodef-media-upload-url');
            uploadHeight = $(this).find('.qodef-media-upload-height');
            uploadWidth = $(this).find('.qodef-media-upload-width');
            uploadImageHolder = $(this).find('.qodef-media-image-holder');
            removeButton = $(this).find('.qodef-media-remove-btn');

            if (uploadImageHolder.find('img').attr('src') != "") {
                removeButton.show();
                qodefInitMediaRemoveBtn(removeButton);
            }

            $(this).on('click', '.qodef-media-upload-btn', function () {
                //if the media frame already exists, reopen it.
                if (fileFrame) {
                    fileFrame.open();
                    return;
                }

                //create the media frame
                fileFrame = wp.media.frames.fileFrame = wp.media({
                    title: $(this).data('frame-title'),
                    button: {
                        text: $(this).data('frame-button-text')
                    },
                    multiple: false
                });

                //when an image is selected, run a callback
                fileFrame.on('select', function () {
                    attachment = fileFrame.state().get('selection').first().toJSON();
                    removeButton.show();
                    qodefInitMediaRemoveBtn(removeButton);
                    //write to url field and img tag
                    if (attachment.hasOwnProperty('url') && attachment.hasOwnProperty('sizes')) {
                        uploadUrl.val(attachment.url);
                        if (attachment.sizes.thumbnail)
                            uploadImageHolder.find('img').attr('src', attachment.sizes.thumbnail.url);
                        else
                            uploadImageHolder.find('img').attr('src', attachment.url);
                        uploadImageHolder.show();
                    } else if (attachment.hasOwnProperty('url')) {
                        uploadUrl.val(attachment.url);
                        uploadImageHolder.find('img').attr('src', attachment.url);
                        uploadImageHolder.show();
                    }

                    //write to hidden meta fields
                    if (attachment.hasOwnProperty('height')) {
                        uploadHeight.val(attachment.height);
                    }

                    if (attachment.hasOwnProperty('width')) {
                        uploadWidth.val(attachment.width);
                    }
                    $('.qodef-input-change').addClass('yes');
                });

                //open media frame
                fileFrame.open();
            });
        });

        function qodefInitMediaRemoveBtn(btn) {
            btn.on('click', function () {
                //remove image src and hide it's holder
                btn.siblings('.qodef-media-image-holder').hide();
                btn.siblings('.qodef-media-image-holder').find('img').attr('src', '');

                //reset meta fields
                btn.siblings('.qodef-media-meta-fields').find('input[type="hidden"]').each(function (e) {
                    $(this).val('');
                });

                btn.hide();
            });
        }
    }

    /**
     Slide elements script - start
     */
    function qodeInitSlideElementItemAcc() {
        //remove slide-element item
        $(document).on('click', '.remove-slide-element-item', function (event) {
            event.preventDefault();
            var $toggleHolder = $(this).parent().parent().parent();
            $toggleHolder.fadeOut(300, function () {
                $(this).remove();

                //after removing slide-element image, set new rel numbers and set new ids/names
                $('.qodef-slide-element-additional-item').each(function (i) {
                    $(this).attr('rel', i + 1);
                    $(this).find('.number').text($(this).attr('rel'));
                    qodefSetIdOnRemoveElement($(this), i + 1);
                });
                //hide expand all button if all items are removed
                noSlideElementItemShown();
            });
            return false;
        });

        //hide expand all button if there is no items
        noSlideElementItemShown();
        function noSlideElementItemShown() {
            if ($('.qodef-slide-element-additional-item').length == 0) {
                $('.qodef-toggle-all-item').hide();
            }
        }

        //expand all additional items on click on 'expand all' button
        $(document).on('click', '.qodef-toggle-all-item', function (event) {
            event.preventDefault();
            $('.qodef-slide-element-additional-item').each(function (i) {

                var $toggleContent = $(this).find('.qodef-slide-element-toggle-content');
                var $this = $(this).find('.toggle-slide-element-item');
                if ($toggleContent.is(':visible')) {
                }
                else {
                    $toggleContent.slideToggle();
                    $this.html('<i class="fa fa-caret-down"></i>')
                }
            });
            return false;
        });
        //toggle for slide-element item
        $(document).on('click', '.qodef-slide-element-additional-item .qodef-slide-element-toggle-holder', function (event) {
            event.preventDefault();

            var $this = $(this);
            var $caret_holder = $this.find('.toggle-slide-element-item');
            $caret_holder.html('<i class="fa fa-caret-up"></i>');
            var $toggleContent = $this.next();
            $toggleContent.slideToggle(function () {
                if ($toggleContent.is(':visible')) {
                    $caret_holder.html('<i class="fa fa-caret-up"></i>')
                }
                else {
                    $caret_holder.html('<i class="fa fa-caret-down"></i>')
                }
                //hide expand all button function in case of all boxes revealed
                checkExpandAllBtn();
            });
            return false;
        });
        //hide expand all button when it's clicked
        $(document).on('click', '.qodef-toggle-all-item', function (event) {
            event.preventDefault();
            $(this).hide();
        });

        //reveal only the fields for custom positioning of elements
        $(document).on('change', '#qodef_qodef_slide_holder_elements_alignment select', function (event) {
            var meta_box = $(this).parents('#qodef-meta-box-qodef_slides_elements');
            if ($(this).find('option:selected').attr('value') == 'custom') {
                meta_box.find('.qodef-slide-element-custom-only').slideDown(300);
                meta_box.find('.qodef-slide-element-all-but-custom').slideUp(300);
            }
            else {
                meta_box.find('.qodef-slide-element-all-but-custom').slideDown(300);
                meta_box.find('.qodef-slide-element-custom-only').slideUp(300);
            }
        });

        //reveal only the fields for certain type of the element
        $(document).on('change', '.qodef-slide-element-type-selector', function (event) {
            var type_fields_holders = $(this).parents('.qodef-slide-element-additional-item').find('.qodef-slide-element-type-fields');
            type_fields_holders.not('.qodef-setf-' + $(this).find('option:selected').attr('value')).slideUp(300);
            type_fields_holders.filter('.qodef-setf-' + $(this).find('option:selected').attr('value')).slideDown(300);
        });

        // reveal advanced text options
        $(document).on('change', '.qodef-slide-element-options-selector-text', function (event) {
            if ($(this).find('option:selected').attr('value') == 'advanced') {
                $(this).parents('.qodef-slide-element-additional-item').find('.qodef-slide-elements-advanced-text-options').slideDown(300);
                $(this).parents('.qodef-slide-element-additional-item').find('.qodef-slide-elements-simple-text-options').slideUp(300);
            }
            else {
                $(this).parents('.qodef-slide-element-additional-item').find('.qodef-slide-elements-advanced-text-options').slideUp(300);
                $(this).parents('.qodef-slide-element-additional-item').find('.qodef-slide-elements-simple-text-options').slideDown(300);
            }
        });

        // reveal responsive text options
        $(document).on('change', '.qodef-slide-element-responsive-selector', function (event) {
            if ($(this).find('option:selected').attr('value') == 'yes') {
                $(this).parents('.qodef-slide-element-type-fields').find('.qodef-slide-element-scale-factors').slideDown(300);
            }
            else {
                $(this).parents('.qodef-slide-element-type-fields').find('.qodef-slide-element-scale-factors').slideUp(300);
            }
        });

        // reveal responsive element options
        $(document).on('change', '.qodef-slide-element-responsiveness-selector', function (event) {
            if ($(this).find('option:selected').attr('value') == 'stages') {
                $(this).closest('.row').siblings('.qodef-slide-responsive-scale-factors').slideDown(300);
            }
            else {
                $(this).closest('.row').siblings('.qodef-slide-responsive-scale-factors').slideUp(300);
            }
        });

        //update the default screen width in elements
        $(document).on('change keyup', "input[name='qodef_slide_elements_default_width']", function (event) {
            $(this).parents('#qodef-meta-box-qodef_slides_elements').find('.qodef-slide-dynamic-def-width').html($(this).attr('value'));
        });

        // reveal proper icon picker
        $(document).on('change', '.qodef-slide-element-button-icon-pack', function (event) {
            var icon_pack = $(this).find('option:selected').attr('value');
            if (icon_pack == 'no_icon') {
                $(this).parents('.qodef-slide-element-additional-item').find('.qodef-slide-element-button-icon-collection').slideUp(300);
            }
            else {
                $(this)
                    .parents('.qodef-slide-element-additional-item')
                    .find('.qodef-slide-element-button-icon-collection.' + icon_pack).slideDown(300)
                    .siblings('.qodef-slide-element-button-icon-collection').slideUp(300);
            }
        });

        function checkExpandAllBtn() {
            if ($('.qodef-slide-element-additional-item .qodef-slide-element-toggle-content:hidden').length == 0) {
                $('.qodef-toggle-all-item').hide();
            } else {
                $('.qodef-toggle-all-item').show();
            }
        }
    }

    function qodefInitSlideElementItemsBox() {
        $('.qodef-slide-element-add a.qodef-add-item').on('click',function (event) {
            var qodef_slide_element = $('.qodef-slide-element-additional-item-holder').clone().html();
            $slide_element = '<div class="qodef-slide-element-additional-item" rel="">' + qodef_slide_element + '</div>';
            event.preventDefault();
            $(this).parent().before($($slide_element).hide().fadeIn(500));
            qodefInitMediaUploaderAdded($(this).parent());
            var elem_num = $(this).parent().siblings('.qodef-slide-element-additional-item').length;
            var item = $(this).parent().siblings('.qodef-slide-element-additional-item:last');
            item.attr('rel', elem_num);
            item.find('.wp-picker-container').each(function () {
                var picker = $(this);
                var input = picker.find('input[type="text"]');
                picker.before('<input type="text" id="' + input.attr('id') + '" name="' + input.attr('name') + '" value="" class="my-color-field"/>').remove();
            });
            item.find('.my-color-field').wpColorPicker();
            qodefSetIdOnAddElement($(this).parent(), elem_num);
            $(this).parent().prev().find('.number').text(elem_num);
        });
    }

    function qodefSetIdOnAddElement(addButton, elem_num) {
        addButton.siblings('.qodef-slide-element-additional-item:last').find('input[type="text"], input[type="hidden"], select, textarea').each(function () {
            var name = $(this).attr('name');
            var new_name = name.replace("_x", "[]");
            var new_id = name.replace("_x", "_" + elem_num);
            $(this).attr('name', new_name);
            $(this).attr('id', new_id);
        });
    }

    function qodefSetIdOnRemoveElement(element, elem_num) {
        if (elem_num == undefined) {
            var elem_num = element.attr('rel');
        } else {
            var elem_num = elem_num;
        }

        element.find('input[type="text"], input[type="hidden"], select, textarea').each(function () {
            var name = $(this).attr('name').split('[')[0];
            var new_name = name + "[]";
            var new_id = name + "_" + elem_num;
            $(this).attr('name', new_name);
            $(this).attr('id', new_id);
        });
    }

    /**
     Slide elements script - end
     */
    function qodefInitAjaxForm() {
        $('#qodef_top_save_button').on('click',function () {
            $('.qodef_ajax_form').submit();
            if ($('.qodef-input-change.yes').length) {
                $('.qodef-input-change.yes').removeClass('yes');
            }
            $('.qodef-changes-saved').addClass('yes');
            setTimeout(function () {
                $('.qodef-changes-saved').removeClass('yes');
            }, 3000);
            return false;
        });
        $(document).delegate(".qodef_ajax_form", "submit", function (a) {
            var b = $(this);
            var c = {
                action: "bazaar_qodef_save_options"
            };
            jQuery.ajax({
                url: ajaxurl,
                cache: !1,
                type: "POST",
                data: jQuery.param(c, !0) + "&" + b.serialize()
            }), a.preventDefault(), a.stopPropagation()
        })
    }

    function qodefInitDatePicker() {
        $(".qodef-input.datepicker").datepicker({dateFormat: "MM dd, yy"});
    }

    function qodefInitSelectPicker() {
        $(".qodef-selectpicker").selectpicker();
    }

    function qodefShowHidePostFormats() {
        $('input[name="post_format"]').each(function () {
            var id = $(this).attr('id');
            if (id !== '' && id !== undefined) {
                var metaboxName = id.replace(/-/g, '_');
                $('#qodef-meta-box-' + metaboxName + '_meta').hide();
            }
        });

        var selectedId = $("input[name='post_format']:checked").attr("id");
        if (selectedId !== '' && selectedId !== undefined) {
            var selected = selectedId.replace(/-/g, '_');
            $('#qodef-meta-box-' + selected + '_meta').fadeIn();
        }

        $("input[name='post_format']").change(function () {
            qodefShowHidePostFormats();
        });
    }

    function qodefPageTemplatesMetaBoxDependency() {
        if ($('#page_template').length) {
            var selected = $('#page_template').val();
            var template_name_parts = selected.split("-");

            if (template_name_parts[0] !== 'blog') {
                $('#qodef-meta-box-blog-meta').hide();
            } else {
                $('#qodef-meta-box-blog-meta').show();
            }
            $('select[name="page_template"]').change(function () {
                qodefPageTemplatesMetaBoxDependency();
            });
        }
    }

    function qodefRepeater(){
        var wrapper = $('.qodef-repeater-wrapper');

        if(wrapper.length) {
            wrapper.each(function() {
                var thisWrapper = $(this);
                initCoreRepeater(thisWrapper);
            });
        }

        function initCoreRepeater(wrapper) {
            initRemoveRow(wrapper);
            initEmptyRow(wrapper);

            //Init add new button
            var addNew = wrapper.find('> .qodef-repeater-add .qodef-clone'); // add new button
            addNew.on('click', function (e) {
                e.preventDefault();
                var thisAddNew = $(this);
                initCloneRow(wrapper, thisAddNew);
            });
        }

        function initRemoveRow(wrapper){
            var removeBtn = wrapper.find('.qodef-clone-remove');
            removeBtn.on('click', function (e) {
                e.preventDefault();
                var thisRemoveBtn = $(this);
                var parentRow = thisRemoveBtn.closest('.qodef-repeater-fields-row');
                var fieldsHolder = thisRemoveBtn.closest('.qodef-repeater-fields-holder');
                var parentChildRepeater = !!fieldsHolder.hasClass('qodef-enable-pc');
                var thisHolderRows;

                if(fieldsHolder.hasClass('qodef-table-layout')) {
                    thisHolderRows = fieldsHolder.find('tbody tr.qodef-repeater-fields-row');
                } else {
                    if(parentChildRepeater) {
                        var name = thisRemoveBtn.data("name");
                        thisHolderRows = fieldsHolder.find('> .qodef-repeater-fields-row[data-name=' + name + ']');
                    } else {
                        thisHolderRows = fieldsHolder.find('> .qodef-repeater-fields-row');
                    }
                }

                if (thisHolderRows.length == 1) {
                    parentRow.find(':input').val('').removeAttr('checked').removeAttr('selected');
                    parentRow.hide();
                } else {
                    parentRow.remove();
                }
            });
        }

        function initEmptyRow(wrapper) {
            var fieldsHolder = wrapper.find('> .qodef-repeater-fields-holder');
            var thisHolderRows;
            if(fieldsHolder.hasClass('qodef-table-layout')) {
                thisHolderRows = fieldsHolder.find('tbody tr.qodef-repeater-fields-row');
            } else {
                thisHolderRows = fieldsHolder.find('> .qodef-repeater-fields-row');
            }

            thisHolderRows.each(function() {
                var row = $(this);
                if (row.hasClass('qodef-initially-hidden')) {
                    row.hide();
                }
            });
        }

        function initCloneRow(wrapper, button) {
            var fieldsHolder = wrapper.find('> .qodef-repeater-fields-holder');
            var parentChildRepeater = !!fieldsHolder.hasClass('qodef-enable-pc');
            var rows;
            if(fieldsHolder.hasClass('qodef-table-layout')) {
                rows = fieldsHolder.find('tbody tr.qodef-repeater-fields-row');
            } else {
                if(parentChildRepeater) {
                    var name = button.data("name");
                    rows = fieldsHolder.find('> .qodef-repeater-fields-row[data-name=' + name + ']');
                } else {
                    rows = fieldsHolder.find('> .qodef-repeater-fields-row');
                }
            }
            var append = true; // flag for showing or appending new row
            if (rows.length == 1 && rows.css('display') == 'none') {
                rows.show();
                append = false;
            }
            if (append) {
                var child = rows.eq(0);
                //FIND FIRST ELEMENT AND DESTROY INITIALIZED SCRIPTS
                child.find('.qodef-repeater-field').each(function () {
                    var thisField = $(this);
                    thisField.find('select').each(function () {
                        var thisInput = $(this);
                        if(thisInput.hasClass('qodef-select2')) {
                            $('select.qodef-select2').select2("destroy");
                        }
                    });
                });

                var rowIndex = button.data('count'); // number of rows for changing id stored as data of add new button
                var firstChild = rows.eq(0).clone(); // clone first row
                var colorPicker = false; // flag for initializing color picker - calling wpColorPicker
                var mediaUploader = false; // flag for initializing media uploader - calling mediaUploader
                var yesNoSwitcher = false; // flag for initializing yes no switcher - calling initSwitch
                var select2 = false; // flag for initializing select2 - calling select2
                var innerRepeater = false; // flag for initializing select2 - calling select2

                firstChild.find('.qodef-repeater-field').each(function () {
                        var thisField = $(this);
                        var id = thisField.attr('id');
                        if (typeof id !== 'undefined') {
                            thisField.attr('id', id.slice(0, -1) + rowIndex); // change id - first row will have 0 as the last char
                        }
                        thisField.find(':input').each(function () {
                            var thisInput = $(this);
                            if (thisInput.hasClass('my-color-field')) { // if input type is color picker
                                thisInput.parents('.wp-picker-container').html(thisInput); // overwrite added html with field html- wpColorPicker adds it on initialization
                                colorPicker = true;
                            }
                            else if (thisInput.hasClass('qodef-media-upload-url')) {// if input type is media uploader
                                mediaUploader = true;
                                var btn = thisInput.parent().siblings('.qodef-media-remove-btn');
                                qodefInitMediaRemoveBtn(btn); // get and init new remove btn
                                btn.trigger('click'); // trigger click to reset values
                            }
                            else if(thisInput.hasClass('checkbox')) {
                                yesNoSwitcher = true;
                            }
                            thisInput.val('').removeAttr('checked').removeAttr('selected'); //empty fields values
                            if(thisInput.is(':radio')){
                                thisInput.val(fieldsHolder.find(':radio').length);
                            }
                        });
                        thisField.find('select').each(function () {
                            var thisInput = $(this);
                            if(thisInput.hasClass('qodef-select2')) {
                                select2 = true;
                            }
                        });
                    }
                );
                rows.each(function () {
                    if($(this).find('.qodef-repeater-wrapper').length) {
                        innerRepeater = true;
                    }
                });
                button.data('count', rowIndex + 1); //increase number of rows
                firstChild.appendTo(fieldsHolder); // append html
                initCoreRepeater(firstChild.find('.qodef-repeater-wrapper'));
                initRemoveRow(firstChild);
                if (colorPicker) { // reinit colorpickers
                    $('.qodef-page .my-color-field').wpColorPicker();
                }
                if (mediaUploader) {
                    // deregister click on all media buttons (multiple frames will be opened otherwise)
                    $('.qodef-media-uploader').off('click', '.qodef-media-upload-btn');
                    qodefInitMediaUploader();
                }
                if (yesNoSwitcher) {
                    qodefInitSwitch(); //init yes no switchers
                }
                if (select2) {
                    qodefSelect2(); //init select2 script
                }
            }
        }
    }

    function qodefInitSortable() {
        var sortingHolder = $('.qodef-sortable-holder');
        var enableParentChild = sortingHolder.hasClass('qodef-enable-pc');
        sortingHolder.sortable({
            handle: '.qodef-repeater-sort',
            cursor: 'move',
            placeholder: "placeholder",
            start: function(event, ui) {
                ui.placeholder.height(ui.item.height());
                if(enableParentChild) {
                    if (ui.helper.hasClass('second-level')) {
                        ui.placeholder.removeClass('placeholder');
                        ui.placeholder.addClass('placeholder-sub');
                    }
                    else {
                        ui.placeholder.removeClass('placeholder-sub');
                        ui.placeholder.addClass('placeholder');
                    }
                }
            },
            sort: function(event, ui) {
                if(enableParentChild) {
                    var pos;
                    if (ui.helper.hasClass('second-level')) {
                        pos = ui.position.left + 50;
                    }
                    else {
                        pos = ui.position.left;
                    }
                    if (pos >= 75 && !ui.helper.hasClass('second-level') && !ui.helper.hasClass('qodef-sort-parent')) {
                        ui.placeholder.removeClass('placeholder');
                        ui.placeholder.addClass('placeholder-sub');
                        ui.helper.addClass('second-level');
                    }
                    else if (pos < 30 && ui.helper.hasClass('second-level') && !ui.helper.hasClass('qodef-sort-child')) {
                        ui.placeholder.removeClass('placeholder-sub');
                        ui.placeholder.addClass('placeholder');
                        ui.helper.removeClass('second-level');
                    }
                }
            }
        });
    }

    function qodefImportOptions() {
        if ($('.qodef-backup-options-page-holder').length) {
            var qodefImportBtn = $('#qodef-import-theme-options-btn');
            qodefImportBtn.on('click', function (e) {
                e.preventDefault();
                if (confirm('Are you sure, you want to import Options now?')) {
                    qodefImportBtn.blur();
                    qodefImportBtn.text('Please wait');
                    var importValue = $('#import_theme_options').val();
                    var importNonce = $('#qodef_import_theme_options_secret').val();
                    var data = {
                        action: 'qodef_core_import_theme_options',
                        content: importValue,
                        nonce: importNonce
                    };
                    $.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: data,
                        success: function (data) {
                            var response = JSON.parse(data);
                            if (response.status == 'error') {
                                alert(response.message);
                            } else {
                                qodefImportBtn.text('Import');
                                $('.qodef-bckp-message').text(response.message);
                            }
                        }
                    });
                }
            });
        }
    }

    function qodefImportCustomSidebars() {
        if ($('.qodef-backup-options-page-holder').length) {
            var qodefImportBtn = $('#qodef-import-custom-sidebars-btn');
            qodefImportBtn.on('click', function (e) {
                e.preventDefault();
                if (confirm('Are you sure, you want to import Custom Sidebars now?')) {
                    qodefImportBtn.blur();
                    qodefImportBtn.text('Please wait');
                    var importValue = $('#import_custom_sidebars').val();
                    var importNonce = $('#qodef_import_custom_sidebars_secret').val();
                    var data = {
                        action: 'qodef_core_import_custom_sidebars',
                        content: importValue,
                        nonce: importNonce
                    };
                    $.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: data,
                        success: function (data) {
                            var response = JSON.parse(data);
                            if (response.status == 'error') {
                                alert(response.message);
                            } else {
                                qodefImportBtn.text('Import');
                                $('.qodef-bckp-message').text(response.message);
                            }
                        }
                    });
                }
            });
        }
    }

    function qodefImportWidgets() {
        if ($('.qodef-backup-options-page-holder').length) {
            var qodefImportBtn = $('#qodef-import-widgets-btn');
            qodefImportBtn.on('click', function (e) {
                e.preventDefault();
                if (confirm('Are you sure, you want to import Widgets now?')) {
                    qodefImportBtn.blur();
                    qodefImportBtn.text('Please wait');
                    var importValue = $('#import_widgets').val();
                    var importNonce = $('#qodef_import_widgets_secret').val();
                    var data = {
                        action: 'qodef_core_import_widgets',
                        content: importValue,
                        nonce: importNonce
                    };
                    $.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: data,
                        success: function (data) {
                            var response = JSON.parse(data);
                            if (response.status == 'error') {
                                alert(response.message);
                            } else {
                                qodefImportBtn.text('Import');
                                $('.qodef-bckp-message').text(response.message);
                            }
                        }
                    });
                }
            });
        }
    }

    function qodefInitImportContent() {
        var qodefImportHolder = $('.qodef-import-page-holder');

        if (qodefImportHolder.length) {
            var qodefImportBtn = $('#qodef-import-demo-data');
            var confirmMessage = qodefImportHolder.data('confirm-message');
            qodefImportBtn.on('click', function (e) {
                e.preventDefault();

                if (confirm(confirmMessage)) {
                    $('.qodef-import-load').css('display', 'block');
                    var progressbar = $('#progressbar');
                    var import_opt = $('#import_option').val();
                    var import_expl = $('#import_example').val();
                    var p = 0;

                    if (import_opt == 'content') {
                        for (var i = 1; i < 10; i++) {
                            var str;
                            if (i < 10) str = 'bazaar_content_0' + i + '.xml';
                            else str = 'bazaar_content_' + i + '.xml';
                            jQuery.ajax({
                                type: 'POST',
                                url: ajaxurl,
                                data: {
                                    action: 'qodef_core_data_import',
                                    xml: str,
                                    example: import_expl,
                                    import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
                                },
                                success: function (data, textStatus, XMLHttpRequest) {
                                    p += 10;
                                    $('.progress-value').html((p) + '%');
                                    progressbar.val(p);
                                    if (p == 90) {
                                        str = 'bazaar_content_10.xml';
                                        jQuery.ajax({
                                            type: 'POST',
                                            url: ajaxurl,
                                            data: {
                                                action: 'qodef_core_data_import',
                                                xml: str,
                                                example: import_expl,
                                                import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
                                            },
                                            success: function (data, textStatus, XMLHttpRequest) {
                                                p += 10;
                                                $('.progress-value').html((p) + '%');
                                                progressbar.val(p);
                                                $('.progress-bar-message').html('<div class="alert alert-success"><strong>Import is completed</strong></div>');
                                            }
                                        });
                                    }
                                }
                            });
                        }
                    } else if (import_opt == 'widgets') {
                        $.ajax({
                            type: 'POST',
                            url: ajaxurl,
                            data: {
                                action: 'qodef_core_widgets_import',
                                example: import_expl
                            },
                            success: function (data, textStatus, XMLHttpRequest) {
                                $('.progress-value').html((100) + '%');
                                progressbar.val(100);
                            }
                        });
                        $('.progress-bar-message').html('<div class="alert alert-success"><strong>Import is completed</strong></div>');
                    } else if (import_opt == 'options') {
                        jQuery.ajax({
                            type: 'POST',
                            url: ajaxurl,
                            data: {
                                action: 'qodef_core_options_import',
                                example: import_expl
                            },
                            success: function (data, textStatus, XMLHttpRequest) {
                                $('.progress-value').html((100) + '%');
                                progressbar.val(100);
                            }
                        });
                        $('.progress-bar-message').html('<div class="alert alert-success"><strong>Import is completed</strong></div>');
                    } else if (import_opt == 'complete_content') {
                        for (var i = 1; i < 10; i++) {
                            var str;
                            if (i < 10) str = 'bazaar_content_0' + i + '.xml';
                            else str = 'bazaar_content_' + i + '.xml';
                            jQuery.ajax({
                                type: 'POST',
                                url: ajaxurl,
                                data: {
                                    action: 'qodef_core_data_import',
                                    xml: str,
                                    example: import_expl,
                                    import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
                                },
                                success: function (data, textStatus, XMLHttpRequest) {
                                    p += 10;
                                    $('.progress-value').html((p) + '%');
                                    progressbar.val(p);
                                    if (p == 90) {
                                        str = 'bazaar_content_10.xml';
                                        jQuery.ajax({
                                            type: 'POST',
                                            url: ajaxurl,
                                            data: {
                                                action: 'qodef_core_data_import',
                                                xml: str,
                                                example: import_expl,
                                                import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
                                            },
                                            success: function (data, textStatus, XMLHttpRequest) {
                                                jQuery.ajax({
                                                    type: 'POST',
                                                    url: ajaxurl,
                                                    data: {
                                                        action: 'qodef_core_other_import',
                                                        example: import_expl
                                                    },
                                                    success: function (data, textStatus, XMLHttpRequest) {
                                                        //alert(data);
                                                        $('.progress-value').html((100) + '%');
                                                        progressbar.val(100);
                                                        $('.progress-bar-message').html('<div class="alert alert-success">Import is completed.</div>');
                                                    }
                                                });
                                            }
                                        });
                                    }
                                }
                            });
                        }
                    }
                }
                return false;
            });
        }
    }

    function qodefSelect2() {
        if ($('select.qodef-select2').length) {
            $('select.qodef-select2').select2({
                allowClear: true
            });
        }
    }

})(jQuery);
