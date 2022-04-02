<div class="modal fade" id="cropperModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crop Images</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div style="max-height: 350px">
                    <img id="image-crop" style="width:100%">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="cropImage()">Crop</button>
            </div>
        </div>
    </div>
</div>

<script>
    var cropperModal = new bootstrap.Modal(document.getElementById('cropperModal'));
    var canvas = document.getElementById('image-crop');
    var preview = document.getElementById('image-preview');
    var input = document.getElementById('image_bas64');

    var elModal = document.getElementById('cropperModal');
    elModal.addEventListener('shown.bs.modal', function(event) {
        var files = document.getElementById('images').files;

        if (files[0].type.match(/^image\//)) {
            var reader = new FileReader();
            reader.onload = function(evt) {
                canvas.src = evt.target.result;
                var cropper = new Cropper(canvas, {
                    aspectRatio: 16 / 9
                });
            };
            reader.readAsDataURL(files[0]);
        } else {
            alert("Invalid file type! Please select an image file.");
            canvas.cropper.destroy();
            canvas.src = '';
            preview.src = '';
            input.value = '';
        }
    });

    elModal.addEventListener('hide.bs.modal', function(event) {
        canvas.cropper.destroy();
        canvas.src = '';
    });


    function openImageCropper() {
        cropperModal.show();
    }

    function cropImage() {
        var croppedImageDataURL = canvas.cropper.getCroppedCanvas().toDataURL("image/png");

        preview.src = croppedImageDataURL;
        input.value = croppedImageDataURL;
        cropperModal.hide();
    }
</script>
