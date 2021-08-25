define([
    "jquery"
], function ($) {
    'use strict';
    $.widget('cafedu.showPopup', {
        _create: function () {
            $(".mobileshowcart").on('click', function () {
                $('.page-header').addClass('minicart-modal');
            });

            $(".mobile-search-icon").on('click', function () {
                $('#header-search-popup').addClass('popup_show');
            });
        }
    });
    return $.cafedu.showPopup;
});
