$(function () {

// check All
    $('input[name=checkall-toggle]').change(function () {
        var checkStatus = this.checked;
        $('#adminForm').find(':checkbox').each(function () {
            this.checked = checkStatus;
        });
    });

    // Active controller
    if (getUrlVar("controller"))
        $(".sidebar-menu li." + getUrlVar("controller")).addClass("active");
    if (getUrlVar("id"))
        $(".sidebar-menu li." + getUrlVar("id")).addClass("active");
})
;

//submit Form
function submitForm(url) {
    $('#adminForm').attr('action', url);
    $('#adminForm').submit();
}


//get URL
function getUrlVar(key) {
    var result = new RegExp(key + "=([^&]*)", "i").exec(window.location.href);
    return result && unescape(result[1]) || "";
}

// change Status
function ajaxStatus(url) {
    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        success: function (data, status) {
            var element = ".status i#status-" + data['id'];
            if (data['status'] == 0) {
                $(element).attr({
                    onclick: "javascript:ajaxStatus('" + data['link'] + "')"
                }).text('off');
            }
            else {
                $(element).attr({
                    onclick: "javascript:ajaxStatus('" + data['link'] + "')"
                }).text('on');
            }
        }
    });

}

// xem hình ảnh trước khi submit
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result)
        };
        reader.readAsDataURL(input.files[0]);
    }
}
// xem hình ảnh trước khi submit
function readURLThumbnail(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blahThumbnail').attr('src', e.target.result)
        };
        reader.readAsDataURL(input.files[0]);
    }
}

//ajax Show Video
function ajaxShowVideo(videoID, type) {
    if (type == 'video') {
        $("#youtube").attr('href', 'https://www.youtube.com/watch?v=' + videoID);
        iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' + videoID + ' " frameborder="0" allowfullscreen></iframe>';
        $('#modal-show-video .modal-body').html(iframe);
    } else {
        iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/videoseries?list=' + videoID + ' " frameborder="0" allowfullscreen></iframe>';
        $('#modal-show-video .modal-body').html(iframe);
    }
}


