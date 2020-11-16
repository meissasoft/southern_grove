(function($) {
	"use strict";

    $(document).ready(function() {
        qodefTwitterRequestToken();
    });

    function qodefTwitterRequestToken() {
        if($('#qodef-tw-request-token-btn').length) {
            $('#qodef-tw-request-token-btn').on('click',function(e) {
                e.preventDefault();

                var that = $(this);
                var currentPageUrl = $('input[data-name="current-page-url"]').val();

                //@TODO get this from data attr
                $(this).text('Working...');

                var data = {
                    action: 'qode_twitter_obtain_request_token',
                    currentPageUrl: currentPageUrl,
	                twitter_connect_nonce: $('input[name="qodef_twitter_connect_nonce"]').val()
                };

                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        if(typeof response.status !== 'undefined' && response.status) {
                            $(that).text('Redirect to Twitter...');

                            if(typeof response.redirectURL !== 'undefined' && response.redirectURL !== '') {
                                window.location = response.redirectURL;
                            }
                        } else {
                            alert(response.message);
                        }
                    }
                });
            });
        }
    }
})(jQuery);
