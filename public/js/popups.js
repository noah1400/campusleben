jQuery(function () {
    $("#newPostButton").on("click", function () {
        $("#overlay").css("visibility", "visible");
        $("#newPostForm").css("visibility", "visible");
    })

    // $("#createPostForm").on("submit", function (e) {
    //     e.preventDefault();
    //     this.submit();
    //     $("#overlay").css("visibility", "hidden");
    //     $("#newPostForm").css("visibility", "hidden");
    //     location.reload();
    // })

    $("#chancelNewPost").on("click", function () {
        $("#overlay").css("visibility", "hidden");
        $("#newPostForm").css("visibility", "hidden");
    })
})