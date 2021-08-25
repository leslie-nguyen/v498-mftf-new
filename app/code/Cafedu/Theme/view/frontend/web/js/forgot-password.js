define([
  'jquery',
  'ko',
  'uiComponent',
  'mage/translate',
  'mage/validation',
  'Magento_Ui/js/modal/modal',
  'Magento_Ui/js/model/messageList',
  ], function ($, ko, Component, $t, validation, modal, globalMessageList) {
    'use strict';

    return Component.extend({
      modalWindow: null,
      isLoading: ko.observable(false),
      autocomplete: ko.observable(false),
      actionUrl: window.forgotPassword.actionUrl,

      defaults: {
        template: 'Cafedu_Theme/forgotpassword-popup'
      },

      /** init **/
      initialize: function () {
        this._super();
      },

      /** create modal popup **/
      forgotPasswordModal: function (element) {
        this.modalWindow = element;
        var options = {
          'type': 'popup',
          'modalClass': 'popup-authentication cafedu-authentication-popup',
          'focus': '[name=email]',
          'responsive': true,
          'innerScroll': true,
          'trigger': '.trigger-forgot-password-popup',
          'buttons': []
        };

        modal(options, $(this.modalWindow));
      },

      /** create account action **/
      forgotPasswordAction: function(passwordForm) {
        var self = this,
            formDataArray = $(passwordForm).serialize();

        if($(passwordForm).validation() && $(passwordForm).validation('isValid')) {
          self.isLoading(true);
          $.ajax({
            url: this.actionUrl,
            type: 'POST',
            data: formDataArray,
          }).done(function (response) {
            if (response.error) {
              globalMessageList.addErrorMessage(response);
              self.isLoading(false);
            } else {
              globalMessageList.addSuccessMessage(response);
              $('#cafedu-forgot-password-form-validate').trigger("reset");
              self.isLoading(false);
            }
          }).fail(function () {
            globalMessageList.addErrorMessage({'message': 'Could not reset password. Please try again later'});
            self.isLoading(false);
          });
        }
      },
    });
  }
);
