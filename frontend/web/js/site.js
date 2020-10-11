var recipe = (function () {
    var commonAjax = function (form, l) {
        $.ajax({
            beforeSend: function () {
                l.start();
            },
            url: $(this).attr('action'),
            data: form,
            processData: false,
            contentType: false,
            type: 'post',
            success: function (response) {
                if (response.flag) {
                    setTimeout(function () {
                        l.stop();
                        swal.fire({text: response.message, type: 'success',timerProgressBar: true}).then(function () {
                            if (response.url) {
                                window.location.href = response.url;
                            }
                        });
                    }, 1000);
                } else {
                  //  grecaptcha.reset();
                    element = '';
                    if (response.type === 'error') {
                        l.stop();
                            $.each(response.message, function (i, v) {
                                $(".field-" + response.formName + "-" + i).children('p').text(v).addClass('text-danger');
                            });

                        if(response.formName == null) {
                            $.each(response.message, function (i, v) {
                                element += '<h3>' + v + '</h3>';
                            });
                            swal.fire({
                                type: 'info',
                                html: element,
                            });
                            element = '';
                        }
                    } else {
                        setTimeout(function () {
                            l.stop();
                            swal.fire({text: response.message, type: 'warning'});
                        }, 1000);
                    }
                }
            }, error: function () {
                grecaptcha.reset();
                l.stop();
                swal.fire({text: 'Please refresh the page and try again '});
            }
        });
        return false;
    };
    var markFavJob = function (id, url, type) {
        $.get(url, {id: id, type: type}, function (response) {
            if (response.flag) {
                $('#' + id).children().addClass('active');
            } else {
                if (response.message == 'duplicate') {
                    $('#' + id).children().removeClass('active');
                }
            }
        });
        return false;
    };
    var markFav = function (id, url) {
        $.get(url, {id: id}, function (response) {
            if (response.flag) {
                $('#' + id).children().addClass('active');
            } else {
                if (response.message == 'duplicate') {
                    $('#' + id).children().removeClass('active');
                }
            }
        });
        return false;
    };

    return {
        commonAjax: commonAjax,
        markFavJob: markFavJob,
        markFav: markFav,
    };
})();