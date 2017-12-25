$(function () {

//     js outline
    $('.name-video').click(function () {
        event.preventDefault();
        $('html,body').animate({scrollTop: 250}, 500);
        var pre = $(this).attr("id");
        var id = "#" + pre;
        $(id).parents(".o-view").addClass("active");
        $(id).parents(".o-view").children(".count").addClass("active");
        $(this).parents(".list-body").children(".div-x").children().addClass("md-check-2");

        var link = $(this).attr("link");
        var src = "https://www.youtube.com/embed/" + link;
        $('.embed-responsive-item').attr("src", src);
        $.ajax({
            url: ROOT_URL + 'index.php?module=default&controller=course&action=setCookieView',
            type: 'POST',
            data: {videoId: pre},
            success: function (data) {
                console.log(data);
            }
        })
    })
    $('.div-x').click(function () {
        var id = $(this).parents(".list-body").children().children(".name-video").attr("id");
        var checked = $(this).children().toggleClass("md-check-2");
        $(this).parents(".o-view").toggleClass("active");
        $(this).parents(".o-view").children(".count").toggleClass("active");
        console.log(checked[0].className);
        if (checked[0].className == "icon md-check-2") {
            $.ajax({
                url: ROOT_URL + 'index.php?module=default&controller=course&action=setCookieView',
                type: 'POST',
                data: {'videoId': id},
                success: function (data) {
                    console.log(data);
                }
            })
        } else {
            $.ajax({
                url: ROOT_URL + 'index.php?module=default&controller=course&action=setCookieView',
                type: 'POST',
                data: {deleteId: id},
                success: function (data) {
                    console.log(data);
                }
            })
        }

    })
    // end js outline
    $('.tabs-page .nav-tabs li a').click(function () {
        var text = $(this).attr("href");
        $.ajax({
            url: ROOT_URL + 'index.php?module=default&controller=course&action=activeMenu',
            type: 'POST',
            data: {nameMenu: text},
            success: function (data) {
                console.log(data);
            }
        });

    });

});
