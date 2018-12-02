$(window).on("load", function() {
    asyncRequest("#shorten", "/api/shorten", init, callback);
});

function init() {
    $("#error").removeClass("invis");
    $("#error").html("");
    $("#input").removeClass("invalid");
}

function error(text) {
    $("#error").html(text);
    $("#error").addClass("animate");
    $("#input").addClass("invalid");
    setTimeout(function() {
        $("#error").removeClass("animate");
    }, 300);
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
