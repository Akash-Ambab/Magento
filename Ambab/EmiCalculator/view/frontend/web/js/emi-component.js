define(['jquery', 'uiComponent', 'ko'], function ($, Component, ko) {
    'use strict';
    return Component.extend({
        defaults: {
            template: 'Ambab_EmiCalculator/payment/payment-form'
        },
        initialize: function () {
            this._super();
        }
    });
}
);