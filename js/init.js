function animateResult() {
    $("#result").addClass("animate");
    setTimeout(function() {
        $("#result").removeClass("animate");
    }, 500);
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
            console.log(data);
            break;
        case "INVALID_URL":
            console.log(data);
            break;
    }

}
function copyToClipboard(element) {
    var temp = $("<input>");
    $("body").append(temp);
    temp.val($(element).val()).select();
    document.execCommand("copy");
    temp.remove();
}
$(window).on("load", function() {
    asyncRequest("#shorten", "/api/shorten", null, callback);
});
$("#copy-btn").click(function() {
    copyToClipboard("#result");
    animateResult();
});
