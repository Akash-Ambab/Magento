require(
    [
        'jquery',
        'Magento_Ui/js/modal/modal'
    ],
    function(
        $,
        modal
    ) {
        var options = {
            type: 'popup',
            responsive: true,
            innerScroll: true,
            title: 'EMI Options',
            buttons: [{
                text: $.mage.__('Close'),
                class: '',
                click: function () {
                    this.closeModal();
                }
            }]
        };

        modal(options, $('#popup-modal'));
        $("#emiBlock").on('click',function() {
            $("#popup-modal").modal("openModal");
        });
    }
);

require([
    'jquery',
    'accordion'], function ($) {
    $("#element").accordion();
});