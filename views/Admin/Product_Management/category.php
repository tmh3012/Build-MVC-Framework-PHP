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
                                        <span class="mry-1">Or</span>
                                        <button type="button" class="btn btn--primary btn-browser-file">Browse File
                                        </button>
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
                            <textarea id="description" name="description" rows="5" placeholder="Description"
                                      class="form-control"></textarea>
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn--primary btn-add">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col l-8 m-8 c-12 ">
                <div class="page-wrapper">
                    <table id="category-table" class="category-table class-hover " style="width: 100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>description</th>
                            <th>slug</th>
                            <th>action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>Tiger Nixon 11</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{push(js)}}
<script>
    $(document).ready(function () {
        $('#category-table').DataTable({
            dom: '<"top"i>rt<"bottom"lp><"clear">',
            "searching": false,
            info: false,
            "pagingType": "simple_numbers", // Sử dụng kiểu phân trang đầy đủ
            "language": {
                "lengthMenu": "Show _MENU_ rows",
                "paginate": {
                    "first": '<i class="fa fa-angle-double-left"></i>', // Biểu tượng cho nút "First"
                    "last": '<i class="fa fa-angle-double-right"></i>', // Biểu tượng cho nút "Last"
                    "previous": '<i class="fa fa-angle-left"></i>', // Biểu tượng cho nút "Previous"
                    "next": '<i class="fa fa-angle-right"></i>' // Biểu tượng cho nút "Next"
                },
            },
            columnDefs: [
                {targets: [0, 1], orderable: true},
                {targets: '_all', orderable: false}
            ]
        });
    })
    ;
</script>
{{endpush(js)}}