$("form").each(function () {
    $(this).on("submit", function (e) {
        $(this)
            .find("input[data-mask]")
            .each(function () {
                $(this).unmask();
            });
        $(this)
            .find(".phone-mask")
            .each(function () {
                $(this).unmask();
            });
    });
});
