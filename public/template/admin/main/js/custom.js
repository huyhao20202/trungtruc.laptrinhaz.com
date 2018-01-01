$(function () {
    urlGlobal = '';
    //Click Button Add
    $("#content .btn-app").click(function () {
        param = this.id.split('-');
        urlGlobal = ROOT_URL + 'admin/' + param[0] + "/" + param[1];
        if (param[1] == "add") {
            $("#modal-add .modal-title").html(jsUcfirst(param[1]) + " " + jsUcfirst(param[0]));
            $.get(urlGlobal, function (data) {
                $('#modal-add .modal-body').html(data);
            });
        } else if (param[0] == "video" && param[1] == "delete") {
            urlGlobal += "&id=" + $("#content input[name='idItem']").val();
            $('#adminForm').attr('action', urlGlobal);
            $('#adminForm').submit();
        } else {
            urlGlobal += "&type=" + param[2];
            console.log(param);
            $('#adminForm').attr('action', urlGlobal);
            $('#adminForm').submit();
        }
    })

    //Click a Edit
    $("#content .btn-edit").click(function () {
        param = this.id.split('-');
        urlGlobal = ROOT_URL + 'admin/' + param[0] + "/" + param[1] + "&id=" + param[2];
        $("#modal-edit .modal-title").html(jsUcfirst(param[1]) + " " + jsUcfirst(param[0]));
        $.get(urlGlobal, function (data) {
            $('#modal-edit .modal-body').html(data);
        });
    })

    //Submit Form Add
    $('#modal-add .submit-form').click(function (event) {
        event.preventDefault();
        id = this.id;
        console.log(urlGlobal);
        var form_data = new FormData();
        switch (urlGlobal.split('/')[4]) {
            case "author":
                name = $('#modal-add input[name="name"]')[0].value.trim();
                console.log(name);
                info = $('#modal-add input[name="info"]')[0].value.trim();
                email = $('#modal-add input[name="email"]')[0].value.trim();
                facebook = $('#modal-add input[name="facebook"]')[0].value.trim();
                phone = $('#modal-add input[name="phone"]')[0].value.trim();
                avatar = $('#modal-add input[name="avatar"]').prop('files')[0];
                form_data.append('form[name]', name);
                form_data.append('form[info]', info);
                form_data.append('form[email]', email);
                form_data.append('form[facebook]', facebook);
                form_data.append('form[phone]', phone);
                form_data.append('avatar', avatar);
                break;
            case "course":
                name = $('#modal-add input[name="name"]').val();
                link = $('#modal-add input[name="link"]').val();
                category_id = $('#modal-add select[name="category_id"]').val();
                image = $('#modal-add input[name="image"]').prop('files')[0];
                var form_data = new FormData();
                form_data.append('form[name]', name);
                form_data.append('form[link]', link);
                form_data.append('form[category_id]', category_id);
                form_data.append('image', image);
                break;
            case "video":
                title = $('#modal-add input[name="title"]').val();
                link = $('#modal-add input[name="link"]').val();
                course_id = $('#modal-add select[name="course_id"]').val();
                form_data.append('form[title]', title);
                form_data.append('form[link]', link);
                form_data.append('form[course_id]', course_id);
                break;
            case "category":
                name = $('#modal-add input[name="name"]').val();
                status = $('#form-add #status')[0].checked;
                form_data.append('form[name]', name);
                form_data.append('form[status]', (status == 'true') ? 1 : 0);
                break;
        }
        $.ajax({
            url: urlGlobal,
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            beforeSend: function () {
                $('#modal-add .alert-course').hide();
                $("#modal-add #loader").show();
                $("#modal-add #xoay").addClass('xoay');

            },
            success: function (data, status) {
                $("#modal-add #loader").hide();
                $("#modal-add #xoay").removeClass('xoay');
                $('#modal-add .modal-body').html(data);
            },
            complete: function () {
                if (id == "save-close") {
                    if ($("#modal-add .alert-success").length) {
                        location.reload();
                    }
                }
            }
        });
    });

    //Submit Form Edit
    $('#modal-edit .submit-form').click(function (event) {
        event.preventDefault();
        id = this.id;
        var form_data = new FormData();
        switch (urlGlobal.split('/')[4]) {
            case "author":
                name = $('#modal-edit input[name="name"]')[0].value.trim();
                console.log(name);
                info = $('#modal-edit input[name="info"]')[0].value.trim();
                email = $('#modal-edit input[name="email"]')[0].value.trim();
                facebook = $('#modal-edit input[name="facebook"]')[0].value.trim();
                phone = $('#modal-edit input[name="phone"]')[0].value.trim();
                avatar = $('#modal-edit input[name="avatar"]').prop('files')[0];
                form_data.append('form[name]', name);
                form_data.append('form[info]', info);
                form_data.append('form[email]', email);
                form_data.append('form[facebook]', facebook);
                form_data.append('form[phone]', phone);
                form_data.append('avatar', avatar);
                break;
            case "course":
                name = $('#modal-edit input[name="name"]').val();
                id = $('#modal-edit input[type="hidden"]').val();
                link = $('#modal-edit input[name="link"]').val();
                category_id = $('#modal-edit select[name="category_id"]').val();
                image = $('#modal-edit input[name="image"]').prop('files')[0];
                var form_data = new FormData();
                form_data.append('form[name]', name);
                form_data.append('form[link]', link);
                form_data.append('form[category_id]', category_id);
                form_data.append('image', image);
                form_data.append('id', id);
                break;
            case "video":
                title = $('#modal-edit input[name="title"]').val();
                link = $('#modal-edit input[name="link"]').val();
                course_id = $('#modal-edit select[name="course_id"]').val();
                form_data.append('form[title]', title);
                form_data.append('form[link]', link);
                form_data.append('form[course_id]', course_id);
                break;
            case "category":
                name = $('#modal-edit input[name="name"]').val();
                status = $('#form-edit #status')[0].checked;
                form_data.append('form[name]', name);
                form_data.append('form[status]', (status == 'true') ? 1 : 0);
                break;
        }
        $.ajax({
            url: urlGlobal,
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            beforeSend: function () {
                $('#modal-edit .alert-course').hide();
                $("#modal-edit #loader").show();
                $("#modal-edit #xoay").addClass('xoay');

            },
            success: function (data, status) {
                $("#modal-edit #loader").hide();
                $("#modal-edit #xoay").removeClass('xoay');
                $('#modal-edit .modal-body').html(data);
            }
        });
    });

    // check All
    $('input[name=checkall-toggle]').change(function () {
        var checkStatus = this.checked;
        $('#adminForm').find(':checkbox').each(function () {
            this.checked = checkStatus;
        });
    })

    //close form
    $("button.close span").click(function () {
        location.reload();
    })
})

// change Status Onclick
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

//Viet hoa chu cai dau tien
function jsUcfirst(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

// xem hình ảnh trước khi submit
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result)
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

