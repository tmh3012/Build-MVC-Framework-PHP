{{push(css)}}
<style>
    .header-nav {
        background: #fff;
        padding: 20px;
        font-size: 16px;
    }

    .header-nav .list-filter {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .header-nav .list-filter .filter-item {
        margin-right: 10px;
        border: 0.1rem solid rgba(0, 0, 0, 0.1);
        padding: 10px;
        border-radius: 10px;
        position: relative;
    }

    .popup {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #fff;
        border: 0.1rem solid rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
        width: 500px;
        height: 200px;
        z-index: 111;
    }

    .popup.show {
        display: flex;
        flex-direction: column
    }

    .popup-head {
        display: flex;
        justify-content: space-between;
        font-size: 16px;
        padding: 10px;
    }
</style>
{{endpush(css)}}
<div id="category page-wrapper" class="mt-1">
    <header>
        <div class="header-top p-1 d-none">Admin test</div>
        <nav class="header-nav">
            <ul class="list-filter">
                <li class="filter-item">Filter</li>
                <li class="filter-item">
                    <a class="filter-btn filter-app" href="javascript:void(0)">App</a>
                    <div class="popup ">
                        <div class="popup-head">
                            <span>App</span>
                            <a class="popup-close" href="javascript:void(0)">X</a>
                        </div>
                        <div class="popup-body">
                            <select style="width: 100%;" class="select2" name="app[]" id="app" multiple="multiple">
                                <option value="ap1">App 1</option>
                                <option value="ap2">App 2</option>
                                <option value="ap3">App 3</option>
                                <option value="ap4">App 4</option>
                                <option value="ap5">App 5</option>
                                <option value="ap6">App 6</option>
                            </select>
                        </div>
                        <div class="popup-footer">
                            <a class="btn btn--sm btn--primary" href="javascript:void(0)" apply-key="app">Apply</a>
                        </div>
                    </div>
                </li>
                <li class="filter-item">
                    <a class="filter-btn filter-app" href="javascript:void(0)">Country</a>
                    <div class="popup ">
                        <div class="popup-head">
                            <span>Country</span>
                            <a class="popup-close" href="javascript:void(0)">X</a>
                        </div>
                        <div class="popup-body">
                            <select style="width: 100%;" class="select2" name="country[]" id="country"
                                    multiple="multiple">
                                <option value="vn">Viet Nam</option>
                                <option value="laos">Lao</option>
                                <option value="cam">Campuchia</option>
                                <option value="thai">Thailand</option>
                                <option value="sin">Singapore</option>
                                <option value="indo">Indonesia</option>
                            </select>
                        </div>
                        <div class="popup-footer">
                            <a class="btn btn--sm btn--primary" href="javascript:void(0)" apply-key="country">Apply</a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
</div>

{{push(js)}}
<script>
    $(document).ready(function () {
        const filterList = $('.list-filter');
        $('#app').select2();
        $('#country').select2();
        let filter = {};

        filterList.find('.filter-item').each(function (el) {
            $(this).click(function (e) {
                console.log(123)
                e.stopPropagation();
                let popup = $(this).closest('.filter-item').find('.popup');
                if ($('.popup').hasClass('show')) {
                    $('.popup').removeClass('show');
                }
                popup.addClass('show');
            })
        });
        $('.popup-footer .btn').each(function (el) {
            $(this).click(function (e) {
                e.stopPropagation();
                let elParent = $(this).closest('.popup');
                const key = $(this).attr('apply-key');
                console.log(key, filter);
                if (!Object.hasOwnProperty(filter, 'dimension')) {
                    filter['dimension'] = {};
                }

                let selectValue = elParent.find('select').val();
                filter['dimension'][key] = selectValue;

                console.log('update filter', filter);
            });
        });

        $('.popup .popup-close').each(function () {
            $(this).click(function (e) {
                e.stopPropagation();
                console.log(true)
                $(this).closest('.popup').removeClass('show');
            })
        })

        $(document).click(function (e) {
            if ($(e.target).parents('.select2-container').length === 0) {
                $(".filter-item .popup.show").removeClass("show");
            }
        })
    })
</script>
{{endpush(js)}}