
<div class="row justify-content-center">


    <div class="add-image-container">
        <img src='<?= asset("storage/uploads/avatars/")?><?= is_null(old('imageData')) ?  '/noavatar.jpg' : '/'.old('imageData') ?>' alt="" id="downloadImagePreview"
             class="img-thumbnail custom_thumbnail">

        <span id="imageDownloadOutput" class="alert alert-success d-none"></span>

        <div id="imageProgressContainer" class="progress invisible">
            <div id="imageDownloadProgress" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                 aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
        </div>

        <form enctype="multipart/form-data" id = "imageForm">

            {{ csrf_field() }}
            <input type="hidden" id="imageCustomType" name="imageCustomType" value="<?= @$imageCustomType ?>">

            <div class="form-group">

                <input type="file" name="file" id="file" class="<?= @$givenImage? "d-none": "" ?>">
            </div>

            <button type="button" id="downloadImageBtn" class="btn btn-info d-none ">Load</button>
            <button type="button" id="resetImageBtn" class="btn btn-danger <?= !@$givenImage? "d-none":'' ?>">Delete</button>

        </form>

    </div>


</div>
