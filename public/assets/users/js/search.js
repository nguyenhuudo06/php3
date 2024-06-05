
$(document).ready(function () {
    $('#search').on('keyup', function () {
        var query = $(this).val();
        query = query.trim().replace(/\s+/g, '-');

        const queryParams = new URLSearchParams(window.location.search);
        queryParams.set('query', query);
        window.history.replaceState({}, '', `${window.location.pathname}?${queryParams}`);

        $.ajax({
            url: "/search",
            type: "GET",
            data: { 'query': query },
            success: function (data) {
                // console.log(data);
                // Cập nhật lại danh sách sản phẩm
                $('#product-list').html('');
                $.each(data, function (index, product) {
                    $('#product-list').append(

                        `<div class="col-md-6 col-lg-4 col-xl-3">` +
                        `<div class="rounded position-relative fruite-item">` +
                        `<div class="fruite-img">` +
                        `<img src="` + product.feature_image_path + `" class="img-fluid w-100 rounded-top" alt="">` +
                        `</div>` +
                        `<div class="p-4 border border-secondary border-top-0 rounded-bottom">` +
                        `<h4>` + product.name + `</h4>` +
                        `<p>` + product.price + `</p>` +
                        `<div class="d-flex justify-content-between flex-lg-wrap">` +
                        `<a href="` + product.url + `" class="btn border border-secondary rounded-pill px-3 text-primary">
                                            <i class="fa-solid fa-eye"></i> Views</a>` +
                        `<a href="#"
                                            class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                            cart</a>` +
                        `</div>` +
                        `</div>` +
                        `</div>` +
                        `</div>`
                    );
                });
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    })
})
