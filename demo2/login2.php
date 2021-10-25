<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./demo/css/login.css"> -->
    <title>Document</title>
</head>
<body>
    <div class="login--page">
        <div class="form--login">
            <div class="container">
                <div class="heading--form">
                    <h2>LOGIN</h2>
                </div>
                <form action="xulylogin2.php" autocomplete="off" method="POST">
                    <div class="form--group">
                        <input type="text" id="uname" placeholder="Tài Khoản" name="uname"> <br/>
                    </div>
                    <div class="form--group">
                        <input type="password" id="paswd" placeholder="Mật Khẩu" name="passwd"> <br/>
                    </div>
                    <div class="form--group">
                        <button type="submit" class="btn--login">Đăng Nhập</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</body>
</html>