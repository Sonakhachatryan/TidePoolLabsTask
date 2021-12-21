<div class="card col-12 m-2">
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <img class="card-img-top" width="300" height="300"
                     src="<?= FileManager\Services\File\FileService::getFileUrl($file) ?>" alt="Card image cap">
            </div>
            <div class="col-8">
                <form action="/file/customize" method="post" class="form-inline">
                    <input type="hidden" name="file" value="<?= $file ?>">
                    <div class="form-group w-25 d-inline-block">
                        <label>Size</label>
                        <div class="input-group mb-3">
                            <input name="width" type="number" class="form-control" placeholder="Width">
                            <div class="input-group-append">
                                <span class="input-group-text">px</span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input name="height" type="number" class="form-control" placeholder="Height">
                            <div class="input-group-append">
                                <span class="input-group-text">px</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group w-25 d-inline-block">
                        <label>Blur</label>
                        <input name="blur" type="number" class="form-control" placeholder="Blur">
                    </div>
                    <div class="form-group w-25 d-inline-block">
                        <label>Brightness</label>
                        <input name="brightness" type="number" class="form-control" placeholder="Brightness">
                    </div>
                    <div class="form-group w-25 d-inline-block">
                        <label>Grayscale</label>
                        <input name="grayscale" type="number" class="form-control" placeholder="Grayscale">
                    </div>
                    <button class="btn btn-primary my-3 d-block">Apply</button>
                </form>
                <a href="file/delete?file=<?= $file ?>" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>