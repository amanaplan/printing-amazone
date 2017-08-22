import axios from 'axios';

import APP_URL from './boot.js';

(function () {
    var output = document.getElementById('output');
    document.getElementById('upload').onchange = function () {

        //preview of the file
        readURL(this);

        var fileField = document.getElementById('upload');

        //disable the field
        fileField.setAttribute('disabled', 'disabled');
        //hide img remove btn
        $("button#rem-artwork").hide();

        var data = new FormData();
        data.append('file', fileField.files[0]);

        var config = {
            headers: { 'Content-Type': 'multipart/form-data' },
            onUploadProgress: function(progressEvent) {
            var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
            if(percentCompleted > 0)
            {
                document.getElementById("op-progress").style.display='block';
                output.setAttribute('aria-valuenow', percentCompleted);
                output.style.width = percentCompleted+'%';
                output.innerHTML = percentCompleted+'%';
            }
            },
        };

        axios.post(`${APP_URL}upload-artwork/process-upload`, data, config)
        .then(function (res) {
            resetAnimation();

            //the remove button
            $("button#rem-artwork").show();

            //proceed button active
            $("div.proceed-to-cart").html(`<div class="field"><button type="submit" class="btn btn-success">Proceed <i class="fa fa-angle-double-right" aria-hidden="true"></i></button></div>`);

            //skip button off
            $("p#skip-step").html('');

            swal("", "Artwork uploaded successfully", "success");
        })
        .catch(function (err) {
            resetAnimation();

            //proceed button off
            $(".proceed-to-cart").html('');

            //skip button on
            $("p#skip-step").html(`or, <button type="submit" class="skip-upload-button">skip this step &amp; email artwork later.</button>`);

            swal("Error!", err.message, "error");
        });
    };

})();

function resetAnimation()
{
    //active the file field
    var fileField = document.getElementById('upload');
    fileField.removeAttribute('disabled');

    document.getElementById("op-progress").style.display='none';
    output.setAttribute('aria-valuenow', '00');
    output.style.width = '0%';
    output.innerHTML = '0%';
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#artwork-prvw').show();

            $('#prvw-img').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

function getFileExtension(filename) {
    return filename.split('.').pop();
}
