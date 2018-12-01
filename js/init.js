function callback(data) {
    console.log(data);
}
$(window).on("load", function() {
    asyncRequest("#shorten", "/api/shorten", null, callback);
});
