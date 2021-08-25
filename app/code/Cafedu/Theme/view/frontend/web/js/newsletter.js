define([
    'jquery',
    "changeEmailPassword",
    "mage/mage",
    "validation"
], function ($) {
    'use strict';

    $.widget('cdc.newsletter', {
        _create: function () {
            var $widget = this;
            this.element.on('submit', function (e) {
                return $widget.submitOmetria($widget, $(this));
            });
        },
        submitOmetria: function ($widget, form) {
            $.ajax({
                url : $widget.options.ometriaLink,
                type : 'POST',
                async: false,
                data : {
                    "__form_id": $widget.options.ometriaFormId,
                    "@account": $widget.options.ometriaAccount,
                    "@subscription_status": "SUBSCRIBED",
                    "ue": form.find('[name="email"]').val(),
                    "country": form.find('[name="country"]').val(),
                    "gender": form.find('[name="gender"]').val()
                },
                dataType: 'json'
            }).done(function (data) {
                return true;
            }).fail(function (data) {
                return false;
            });
        },
        isEmail: function (email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
    });
    return $.cdc.newsletter;
});
