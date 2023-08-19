<!-- pace js -->
<script src="{{ asset('admin_assets/libs/pace-js/pace.min.js') }}"></script>
<script>
    /** 
     * This method for submiting a form. First Include the file in push(js) from blade. then call the function with params.
     * @param   formId              main form element ID
     * @param   submitButtonId      submit button element ID
     * @param   postUrl             submit URL(post type) 
     * @param   redirectUrl         after success redirect to the url (get type)
     **/



    function formPost(formId, submitButtonId, postUrl, redirectUrl, message_show_time = 5000) {
        $(".custom-error-p").remove();
        $(".is-invalid").removeClass("is-invalid");
        formId = "#" + formId;
        // submitButtonId = "#" + submitButtonId;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        var form = $(formId);
        var form_method = $(formId).attr('method');
        var submitButtonHtml = $(submitButtonId).html();
        Pace.restart();
        Pace.track(function() {
            $.ajax({
                url: postUrl,
                type: form_method,
                data: new FormData(form[0]),
                contentType: false,
                processData: false,
                dataType: "json",
                beforeSend: function() {
                    $(submitButtonId).html('<i class="fa fa-spinner fa-spin"></i>');
                    $(submitButtonId).attr('disabled', true);
                },
                success: function(data) {
                    $(submitButtonId).html(submitButtonHtml);
                    if (data.code == 200) {
                        $.toast({
                            heading: 'Success',
                            text: data.message,
                            position: 'top-right',
                            stack: false,
                            showHideTransition: 'fade',
                            icon: 'success',
                            hideAfter: message_show_time
                        });
                        window.setTimeout(function() {
                            redirectUrl = redirectUrl.replace(/&amp;/g, '&');
                            window.location.href = redirectUrl;
                        }, 1000);
                    } else if (data.code == 422) {
                        $.toast({
                            heading: data.message,
                            text: getErrorHtml(data.errors),
                            position: 'top-right',
                            stack: false,
                            showHideTransition: 'fade',
                            icon: 'error',
                            hideAfter: 10000,
                        });


                        if (data.errors) {

                            let keys = Object.keys(data.errors);

                            keys.forEach(key => {
                                var inputElement = $(`${formId} input[name="${key}"]`);
                                inputElement.addClass('is-invalid');

                                var classElement = $(`.${key}`);
                                classElement.addClass('is-invalid');

                                let errors = data.errors[key];

                                let errorString = errors.join(" ");

                                inputElement.after(
                                    `<label class="custom-error-p error invalid-feedback">${errorString}</label>`
                                );
                                classElement.append(
                                    `<strong class="custom-error-p  text-danger">${errorString}</strong>`
                                );
                            });
                        }


                    } else {
                        $.toast({
                            heading: 'Error',
                            text: data.message,
                            position: 'top-right',
                            stack: false,
                            showHideTransition: 'fade',
                            icon: 'error',
                            hideAfter: message_show_time
                        });
                    }
                },
                complete: function(data) {
                    $(submitButtonId).removeAttr('disabled');
                }

            });

        });



    }

    $('.ajaxFormSubmit').on('submit', function(e) {
        e.preventDefault();
        var formId = $(this).attr('id');
        var submitButtonId = $(this).find('button[type=submit]');
        if (!submitButtonId) {
            submitButtonId = $(this).find('input[type=submit]');
        }
        var postUrl = $(this).attr('action');
        var redirectUrl = $(this).attr('data-redirect');
        formPost(formId, submitButtonId, postUrl, redirectUrl);
    });

    function getErrorHtml($errors) {
        var errorsHtml = '';
        $.each($errors, function(key, value) {

            if (value.constructor === Array) {
                $.each(value, function(i, v) {

                    $("#id_" + key).show().html(v);
                    errorsHtml += '<li>' + v + '</li>';
                });
            } else {
                errorsHtml += '<li>' + value[0] + '</li>';
            }
        });
        return errorsHtml
    }
</script>
