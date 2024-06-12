$(document).ready(function () {
    $("#example1").DataTable({
        order: [[0, 'desc']],
        columnDefs: [
            { orderable: false, targets: [8] }
        ]
    });


    $('.delete-product').click(function (e) {
        e.preventDefault();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var id = $(this).data('id');
        var url = $(this).data('url');
        Swal.fire({
            title: 'Bạn chắc chắn muốn xóa sản phẩm này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy bỏ'
        }).then((result) => {
            if (result.isConfirmed) {
                // Nếu người dùng xác nhận xóa, gửi yêu cầu xóa sản phẩm đến controller
                $.ajax({
                    type: "DELETE",
                    url: url,
                    data: {
                        _token: csrfToken, // Sử dụng token CSRF ở đây
                    },
                    success: function (response) {
                        // Xử lý khi xóa thành công
                        $('#product-' + id).remove();
                        Swal.fire('Xóa thành công!', '', 'success');
                    },
                    error: function (xhr, status, error) {
                        // Xử lý khi có lỗi xảy ra
                        Swal.fire('Đã xảy ra lỗi!', error, 'error');
                    }
                });
            }
        });
    });

});
