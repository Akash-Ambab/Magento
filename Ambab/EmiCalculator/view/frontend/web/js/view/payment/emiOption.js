define([
    'ko',
    'jquery',
    'uiComponent',
    'mage/url'
],
    function (ko, $, Component,url) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Ambab_EmiCalculator/checkout/emi-block'
            }
        });
    }
); 