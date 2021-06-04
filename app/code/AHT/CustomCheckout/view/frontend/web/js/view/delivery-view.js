define([
    'jquery',
    'ko',
    'uiComponent',
    'underscore',
    'Magento_Checkout/js/model/step-navigator',
    'mage/url',
    'Magento_Checkout/js/model/url-builder',
    'Magento_Customer/js/model/customer',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/error-processor',
    'Magento_Checkout/js/model/cart/cache'
], function ($, ko, Component, _, stepNavigator, urlBuilder, urlBuilderCheckout, customer, quote, errorProcessor, cartCache) {
    'use strict';

    /**
     * mystep - is the name of the component's .html template,
     * <Vendor>_<Module>  - is the name of your module directory.
     */
    return Component.extend({
        defaults: {
            template: 'AHT_CustomCheckout/delivery-step'
        },
        
        // add here your logic to display step,
        isVisible: ko.observable(true),

        /**
         * @returns {*}
         */
        initialize: function () {
            this._super();
            // register your step
            stepNavigator.registerStep(
                // step code will be used as step content id in the component template
                'delivery_step',
                // step alias
                null,
                // step title value
                'Delivery Step',
                // observable property with logic when display step or hide step
                this.isVisible,
                
                _.bind(this.navigate, this),

                /**
                 * sort order value
                 * 'sort order value' < 10: step displays before shipping step;
                 * 10 < 'sort order value' < 20 : step displays between shipping and payment step
                 * 'sort order value' > 20 : step displays after payment step
                 */
                15
            );

            return this;
        },

        /**
         * The navigate() method is responsible for navigation between checkout steps
         * during checkout. You can add custom logic, for example some conditions
         * for switching to your custom step
         * When the user navigates to the custom step via url anchor or back button we_must show step manually here
         */
        navigate: function () {
            this.isVisible(true);
        },

        

        /**
         * @returns void
         */
        navigateToNextStep: function () {
            // event click submit
            var formDataClick = {
                'delivery_data': $('[name="delivery_data"]').val(),
                'delivery_comment': $('[name="delivery_comment"]').val()
            }
            var quoteId = quote.getQuoteId();
            var isCustomer = customer.isLoggedIn();
            var url;
            if (isCustomer) {
                url = urlBuilderCheckout.createUrl('/carts/mine/set-order-custom-fields', {});
            } else {
                url = urlBuilderCheckout.createUrl('/guest-carts/:cartId/set-order-custom-field', {cartId: quoteId});
            }

            var payload = {
                cartId: quoteId,
                customFields: formDataClick
            };
          
            var result = true;

            $.ajax({
                url: urlBuilder.build(url),
                data: JSON.stringify(payload),
                global: false,
                contentType: 'application/json',
                type: 'PUT',
                async: true
            }).done(
                function (response) {
                    cartCache.set('custom-form-deli', null);
                    cartCache.set('custom-form-deli', formDataClick);
                    console.log(cartCache.get('custom-form-deli'));
                    result = true;
                }
            ).fail(
                function (response) {
                    result = false;
                    errorProcessor.process(response);
                }
            );
            stepNavigator.next();
        }
    });
});