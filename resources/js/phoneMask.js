$(() => {
    var options = {
        onKeyPress: function (phone, e, field, options) {
            var masks = ['(00) 0000-00009', '(00) 00000-0000'];
            var mask = (phone.length > 14) ? masks[1] : masks[0];
            $('#phone').mask(mask, options);
        }
    };

    $(".phone-mask").each(function () {
        if ($(this).val().length > 10) {
            $('#phone').mask('(00) 00000-0000', options);
        } else {
            $('#phone').mask('(00) 0000-00009', options);
        };
    });
});