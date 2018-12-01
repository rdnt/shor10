$(window).on("load", function() {
    asyncRequest("#shorten", "/api/shorten", init, callback);
});

function init() {
    $("#error").removeClass("invis");
    $("#error").html("");
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
            $("#error").html("URL can't be empty.");
            console.log(data);
            break;
        case "INVALID_URL":
            $("#error").html("URL entered is invalid.");
            console.log(data);
            break;
        case "LINK_CREATION_FAILED":
            $("#error").html("An internal error has occured.");
            console.log(data);
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
