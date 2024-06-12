<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email thông báo đặt hàng thành công</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Đơn hàng của bạn đã được đặt thành công!</h1>
                <p>Cảm ơn bạn đã mua hàng tại cửa hàng của chúng tôi!</p>

                <div class="card">
                    <div class="card-body">
                        <h2>Thông tin đơn hàng</h2>
                        <ul>
                            <li>Tên khách hàng: {{ $data['name'] }}</li>
                        </ul>
                    </div>
                </div>

                <p>Để theo dõi tình trạng đơn hàng, vui lòng truy cập [link trang theo dõi đơn hàng].</p>

                <p>Cảm ơn bạn một lần nữa! Hy vọng bạn sẽ hài lòng với sản phẩm của chúng tôi.</p>

                <p>Trân trọng,</p>

                <p>Cửa hàng [Tên cửa hàng]</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
