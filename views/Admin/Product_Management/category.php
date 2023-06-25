<?php
/**
 * @var $model \app\models\category
 */

use \app\core\Application;

?>
<div id="category" class="mt-1">
    <div class="grid">
        <div class="row sm-gutter">
            <div class="col l-4 m-4 c-12 ">
                <div class="category-add page-wrapper">
                    <?php $form = \app\core\form\Form::begin('form-category', 'form-category', '', 'post') ?>
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
                        <span class="form-message">
                                <?php echo $model->hasError('image') ? $model->getFirstError('image') : '' ?>
                            </span>
                    </div>
                    <?php echo $form->input($model, 'name', 'Category Name',) ?>
                    <?php echo $form->input($model, 'slug', 'Slug',) ?>
                    <?php echo $form->textarea($model, 'description', 'Description') ?>
                    <?php echo $form->button('submit', '', 'btn--primary', 'Add Category') ?>
                    <?php echo $form::end() ?>
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
    const fm_category = document.querySelector('form.form-category');
    const categoryName = fm_category.querySelector('input[name="name"]');
    const categorySlug = fm_category.querySelector('input[name="slug"]');


    categoryName.onkeyup = function () {
        categorySlug.value = generateSlug(this.value);
    }

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
    });
</script>
{{endpush(js)}}