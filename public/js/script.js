
//-------------      OPEN DIALOG 		  

function OpenDialog(id, parameters) {

    if (!parameters.hasOwnProperty('resizable')) {
        parameters.resizable = false;
    }
    parameters.modal = true;
    // closeonescape only works when the focus is on the dialog
    // focus in only activated if there is at least on input in the dialog
    $('#' + id).dialog(parameters);
    if (parameters.hasOwnProperty("closeOnEscape")) {
        if ($("#" + id).find("input").length == 0) {
            $("#" + id + " a.button").focus();
        }
    }
}

$('.dialog_training_close').click(function (e) {
    e.preventDefault();
    $('#dialog_training_center_detail').dialog('close');
    $('.ui-widget-overlay').hide();
});

$('.info-slider').slick({
    arrows: false,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    centerMode: true,
    variableWidth: true,
    adaptiveHeight: true,
});
