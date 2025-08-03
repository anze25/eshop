<fieldset>
    <div class="body-title">@lang('Upload images') <span class="tf-color-1">*</span>
    </div>
    <div class="upload-image flex-grow">
        <div
            id="imgpreview"
            class="item"
            style="display:none"
        >
            <img
                src="upload-1.html"
                class="effect8"
                alt=""
            >
        </div>
        <div
            id="upload-file"
            class="item up-load"
        >
            <label
                class="uploadfile"
                for="myFile"
            >
                <span class="icon">
                    <i class="icon-upload-cloud"></i>
                </span>
                <span class="body-text">@lang('Drop your images here or select') <span class="tf-color">@lang('click to browse')</span></span>
                <input
                    id="myFile"
                    type="file"
                    name="image"
                    accept="image/*"
                >
            </label>
        </div>
    </div>
</fieldset>
