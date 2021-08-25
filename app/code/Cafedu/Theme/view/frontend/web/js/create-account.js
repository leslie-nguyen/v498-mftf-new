define([
        'jquery',
        'ko',
        'uiComponent',
        'mage/translate',
        'mage/validation',
        'Magento_Ui/js/modal/modal',
        'Magento_Ui/js/model/messageList',
        'formCustom',
    ], function ($, ko, Component, $t, validation, modal, globalMessageList) {
        'use strict';

        return Component.extend({
            modalWindow: null,
            isLoading: ko.observable(false),
            autocomplete: ko.observable(false),
            formKey: $.cookie('form_key'),

            defaults: {
                template: 'Cafedu_Theme/createaccount-popup'
            },

            /** init **/
            initialize: function () {
                this._super();
            },

            isJpStore: function() {
                return document.documentElement.lang === "ja";
            },

            /** create modal popup **/
            createAccountModal: function (element) {
                this.modalWindow = element;
                var options = {
                    'type': 'popup',
                    'modalClass': 'popup-authentication cafedu-authentication-popup',
                    'focus': '[name=firstname]',
                    'responsive': true,
                    'innerScroll': true,
                    'trigger': '.trigger-create-accout-popup',
                    'buttons': []
                };

                modal(options, $(this.modalWindow));
                //$("#cafedu-create-account-gender-m").click();
                $("#cafedu-create-account-gender-m, #cafedu-create-account-gender-f, #cafedu-create-account-is-subscribed, #cafedu-create-account-subscribed").fancyfields({
                    onCheckboxChange: function (input, isChecked) {
                        $("#cafedu-create-account-is-subscribed").triggerHandler('change');
                    }
                });

            },

            /** create account action **/
            createAccountAction: function(createForm, e) {
                var self = this,
                    formDataArray = $(createForm).serialize();

                if($(createForm).validation() && $(createForm).validation('isValid')) {
                    self.isLoading(true);
                    $.ajax({
                        url: self.actionUrl,
                        type: 'POST',
                        data: formDataArray,
                    }).done(function (response) {
                        if (response.error) {
                            globalMessageList.addErrorMessage(response);
                            self.isLoading(false);
                        } else {
                            globalMessageList.addSuccessMessage(response);
                            $('#cafedu-create-account-form-validate').trigger("reset");
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                            self.isLoading(false);
                        }
                    }).fail(function () {
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                        self.isLoading(false);
                    });
                }
            },
        });
    }
);
