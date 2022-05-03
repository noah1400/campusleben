jQuery(function () {
    $("#newPostButton").on("click", function () {
        $("#overlay").css("visibility", "visible");
        $("#newPostForm").css("visibility", "visible");
    })

    $("#chancelNewPost").on("click", function () {
        $("#overlay").css("visibility", "hidden");
        $("#newPostForm").css("visibility", "hidden");
    })
})