$(".accordian-body").on("show.bs.collapse", function ($) {
    console.log("aqui");
    $(this)
        .closest("table")
        .find(".collapse.show")
        .not(this)
        .collapse("toggle");
});