
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng thành công</title>
</head>
<body>
    <h1>Cảm ơn bạn đã đặt hàng!</h1>
    <p>Đơn hàng của bạn đã được tiếp nhận và đang được xử lý.</p>
    <div class="header-media-group"><button class="header-user"><img src="{{ asset('img/user.png') }}"
        alt="user"></button><a href="{{ route('index') }}"><img src={{ asset('img/logo.png') }}
        alt="logo"></a><button class="header-src"><i class="fas fa-search"></i></button></div><a
href="{{ route('index') }}" class="header-logo"><img src="img/logo.png" alt="logo"></a>
</body>
</html>

