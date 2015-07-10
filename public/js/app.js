'use strict'

;(function($){
    $(document).ready(function(){
        var $fileupload     = $('#fileupload'),
            $upload_success = $('#upload-success'),
            $progress_bar = $('#progress .progress-bar');

        $fileupload.fileupload({
            url: '/upload',
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            maxFileSize: 999000,
            formData: {
                _token: $fileupload.data('token'),
                userId: $fileupload.data('userId')
            },
            done: function (e, data) {
                $upload_success.removeClass('hide').hide().slideDown('fast');
                setTimeout(function(){
                    location.reload();
                }, 2000);
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            }
        });
    });
})(window.jQuery);