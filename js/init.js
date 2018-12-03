$(window).on("load", function() {
    asyncRequest("#shorten", "/api/shorten", init, callback);
});
//var error_occured = false;

function init() {
    //
    //error_occured = false;
    $("#error").addClass("invis");
    $("#error").html("");
    $("#input").removeClass("invalid");
}

function error(text) {
    //error_occured = true;
    $("#error").html(text);
    $("#error").addClass("animate");
    $("#error").removeClass("invis");
    $("#input").addClass("animate");
    $("#input").addClass("invalid");
    $("#input").focus();


    setTimeout(function() {

        $("#error").removeClass("animate");
        $("#input").removeClass("animate");
        setTimeout(function() {
            $("#input").addClass("no-animate");
        }, 100)
    }, 1000);
}

function callback(data) {
    switch (data['response']) {
        case "SUCCESS":
            // Hide the input and button for submission
            $("#input").addClass("invis");
            $("#submit-btn").addClass("invis");
            // Show the copy input and button
            $("#result").removeClass("invis");
            $("#copy-btn").removeClass("invis");
            // Put result in the result input
            var short_url = data['data'];
            $("#result").val(short_url);
            animateResult();
            break;
        case "EMPTY_URL":
            error("URL can't be empty.");
            break;
        case "INVALID_URL":
            error("URL entered is invalid.");
            break;
        case "LINK_CREATION_FAILED":
            error("An internal error has occured.");
            break;
    }
}

$("#copy-btn").click(function() {
    copyToClipboard("#result");
    animateResult();
});

$('#input').keypress(function(e) {
    //if (error_occured) {
    //    error_occured = false;
    $("#input").removeClass("invalid");
    //    setTimeout(function() {

    //    }, 1000);
    //}
    // {
    //
    //}

    if (e.keyCode == 13) {
        $('#submit-btn').focus();
    }
});

$('#input').focus(function() {
    //$("#error").addClass("invis");
    //$("#input").removeClass("invalid");
});

$('#input').focusout(function() {
    $("#input").removeClass("no-animate");
    //$("#error").addClass("invis");
    //$("#input").removeClass("invalid");
});

// $('#submit-btn').focus(function() {
//     $('#input').removeClass("focus");
// });
//
// $('html').mousedown(function() {
//     $('#input').removeClass("focus");
// });
//
// $('#input').mousedown(function(event) {
//     event.stopPropagation();
//     $('#input').addClass("focus");
// });

// $('#input').focus(function() {
//     $('#input').addClass("focus");
// });
//
//
// $('#input').focusout(function() {
//     $('#input').removeClass("focus");
// });





//
// $(".base").click(function() {
//     console.log("click");
// });
//
// $(window).mouseup(function(e) {
//     $('#input').removeClass("focus");
// });
//
// $('#input').mousedown(function(e) {
//     $('#input').addClass("focus");
// });

function animateResult() {
    $("#result").addClass("animate");
    setTimeout(function() {
        $("#result").removeClass("animate");
    }, 500);
}

function copyToClipboard(element) {
    var temp = $("<input>");
    $("body").append(temp);
    temp.val($(element).val()).select();
    document.execCommand("copy");
    temp.remove();
}
