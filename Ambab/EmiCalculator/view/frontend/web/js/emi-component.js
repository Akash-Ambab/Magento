define(['jquery', 'uiComponent', 'ko'], function ($, Component, ko) {
    'use strict';
    return Component.extend({
        defaults: {
            template: 'Ambab_EmiCalculator/payment/knockout-test'
        },
        initialize: function () {
            this._super();
        }
    });
}
);