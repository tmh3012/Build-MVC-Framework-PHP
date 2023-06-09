<div id="category" class="mt-1">
    <div class="grid">
        <div class="row sm-gutter">
            <div class="col l-4 m-4 c-12 ">
                <div class="category-add page-wrapper">
                    <form class="form-category">
                        <div id="dropzone">
                            <div class="form-group">
                                <div class="dropzone main">
                                    <div class="dd-area">
                                        <span class="icon d-block"><i class="fas fa-cloud-upload-alt"></i></span>
                                        <h4 class="mry-0 dz-message">Drop files here to upload.</h4>
                                        <span class="my-2">Or</span>
                                        <button type="button" class="btn btn--primary mt-1 btn-browser-file">Browse
                                            File</button>
                                        <input type="file" hidden="" name="image" id="input-file" accept="image/*">
                                    </div>
                                    <div class="dd-preview"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="form-label">Category Name</label>
                            <input id="name" name="name" type="text" placeholder="Category Name" class="form-control">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="slug" class="form-label">Slug</label>
                            <input id="slug" name="slug" type="text" placeholder="/category" class="form-control">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" rows="5" placeholder="Description" class="form-control"></textarea>
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn--primary btn-add">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col l-8 m-8 c-12 "></div>
        </div>
    </div>
</div>