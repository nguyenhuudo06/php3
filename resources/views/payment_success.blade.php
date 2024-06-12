<!DOCTYPE html>
<html>
<head>
    <title>Payment Success</title>
</head>
<body>
    <h1>Thanh toán thành công!</h1>
    <p>Mã giao dịch: {{ $order['vnp_TxnRef'] }}</p>
    <p>Số tiền: {{ $order['vnp_Amount'] / 100 }} VND</p>
    <p>Nội dung: {{ $order['vnp_OrderInfo'] }}</p>
</body>
</html>
