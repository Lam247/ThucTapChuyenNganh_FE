<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đang xử lý đăng nhập...</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="spinner-border text-primary mb-3" role="status"></div>
    <h4 class="text-secondary">Đang đăng nhập bằng Google...</h4>
    <p>Vui lòng chờ trong giây lát.</p>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const params = new URLSearchParams(window.location.search);
            const token = params.get('token');
            const userStr = params.get('user');
            const error = params.get('error');
            if (error) {
                alert("Lỗi đăng nhập: " + decodeURIComponent(error));
                window.location.href = "login.php";
                return;
            }
            if (token && userStr) {
                try {
                    const decodedUser = decodeURIComponent(userStr);
                    const user = JSON.parse(decodedUser);
                    localStorage.setItem('token', token);
                    localStorage.setItem('user_info', decodedUser);
                    if (user.role === 'admin') {
                        window.location.href = 'admin.php';
                    } else {
                        window.location.href = 'index.php';
                    }
                } catch (e) {
                    console.error(e);
                    alert("Dữ liệu đăng nhập không hợp lệ.");
                    window.location.href = "login.php";
                }
            } else {
                window.location.href = "login.php";
            }
        });
    </script>
</body>
</html>