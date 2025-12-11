<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thanh Toán - KL Camera</title>
    
    <link rel="stylesheet" href="./styles/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .checkout-section {
            margin-top: 180px;
            margin-bottom: 60px;
        }
        @media (max-width: 768px) {
            .checkout-section {
                margin-top: 130px;
            }
        }
        .form-control, .form-select {
            border: 1px solid #ced4da;
            padding: .375rem .75rem;
            font-size: 1rem;
        }
        .btn-primary {
            background-color: #ff430a;
            border-color: #ff430a;
        }
        .btn-primary:hover {
            background-color: #e03a00;
            border-color: #e03a00;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <!-- TOP BAR giống các trang khác để main.js dùng chung -->
    <div id="top-bar">
        <div class="top-left">
            <form class="search-bar" action="#" method="get">
                <input type="text" placeholder="Tìm kiếm sản phẩm..." name="q" />
                <button type="submit">Tìm</button>
            </form>
        </div>
        <div class="top-right">
            <div class="promo-box">🔥 ƯU ĐÃI CỰC HOT 🔥</div>
            <div id="actions">
                <!-- Khi chưa login -->
                <div class="item" id="guestAction">
                    <a href="login.php">
                        <img src="./img/icon/user.png" alt="Đăng nhập" />
                    </a>
                </div>

                <!-- Khi đã login -->
                <div class="item user-dropdown" id="userAction" style="display:none;">
                    <div class="user-info">
                        <img src="./img/icon/user.png" id="headerAvatar" class="avatar-img" alt="User" />
                        <span id="headerName" class="user-name">User</span>
                    </div>

                    <div class="dropdown-menu-custom">
                        <div class="menu-item disabled">
                            Xin chào, <b id="headerNameBold">User</b>
                        </div>
                        <a href="profile.php" class="menu-item">Tài khoản của tôi</a>
                        <a href="#" onclick="handleLogout()" class="menu-item logout-btn">Đăng xuất</a>
                    </div>
                </div>

                <!-- Icon giỏ hàng (vẫn dẫn tới cart.php đúng flow của bạn) -->
                <div class="item cart-icon-wrap">
                    <a href="cart.php">
                        <img src="./img/icon/shopping-cart.png" alt="Giỏ hàng" />
                        <span id="headerCartCount" class="cart-badge">0</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- HEADER LOGO + MENU -->
    <div id="header">
        <a href="index.php" class="logo">
            <img src="./img/Logo.png" alt="Logo" />
        </a>
        <div id="hamburger">☰</div>
        <div id="menu">
            <div class="item">
                <ul>
                    <li><a href="index.php">Trang Chủ</a></li>
                    <li><a href="product.php">Cửa Hàng</a></li>
                    <li><a href="contact.php">Liên Hệ</a></li>
                    <li><a href="blog.php">Tin Tức</a></li>
                    <li><a href="about.php">Giới Thiệu</a></li>
                    <li><a href="lab_th.php">Lab Thực Hành</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- KHU THANH TOÁN -->
    <div class="container checkout-section">
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.php" class="text-decoration-none text-dark">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="cart.php" class="text-decoration-none text-dark">Giỏ hàng</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
                    </ol>
                </nav>
                <h2 class="fw-bold">Thanh Toán Đơn Hàng</h2>
            </div>
        </div>

        <!-- ❗ form chỉ cần id="checkoutForm", không cần onsubmit (đã xử lý trong main.js) -->
        <form id="checkoutForm">
            <div class="row">
                <!-- THÔNG TIN GIAO HÀNG -->
                <div class="col-md-7 col-lg-8 order-md-1 mb-4">
                    <div class="card p-4 shadow-sm border-0">
                        <h4 class="mb-3 text-primary">Thông tin giao hàng</h4>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="customerName" class="form-label">
                                    Họ và tên <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="customerName"
                                       placeholder="Nguyễn Văn A" required>
                            </div>

                            <div class="col-sm-6">
                                <label for="customerEmail" class="form-label">
                                    Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control" id="customerEmail"
                                       placeholder="you@example.com" required>
                            </div>

                            <div class="col-sm-6">
                                <label for="customerPhone" class="form-label">
                                    Số điện thoại <span class="text-danger">*</span>
                                </label>
                                <input type="tel" class="form-control" id="customerPhone"
                                       placeholder="0909..." required>
                            </div>

                            <div class="col-12">
                                <label for="shippingAddress" class="form-label">
                                    Địa chỉ nhận hàng <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="shippingAddress"
                                       placeholder="Số nhà, tên đường..." required>
                            </div>

                            <div class="col-md-4">
                                <label for="shippingCity" class="form-label">Tỉnh / Thành phố</label>
                                <input type="text" class="form-control" id="shippingCity" required>
                            </div>
                            <div class="col-md-4">
                                <label for="shippingDistrict" class="form-label">Quận / Huyện</label>
                                <input type="text" class="form-control" id="shippingDistrict" required>
                            </div>
                            <div class="col-md-4">
                                <label for="shippingWard" class="form-label">Phường / Xã</label>
                                <input type="text" class="form-control" id="shippingWard" required>
                            </div>

                            <div class="col-12">
                                <label for="customerNote" class="form-label">Ghi chú (Tùy chọn)</label>
                                <textarea class="form-control" id="customerNote" rows="3"
                                          placeholder="Giao hàng giờ hành chính..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ĐƠN HÀNG -->
                <div class="col-md-5 col-lg-4 order-md-2 mb-4">
                    <div class="card p-4 shadow-sm border-0 bg-white">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-primary">Đơn hàng</span>
                            <!-- ❗ ID này main.js dùng để hiển thị tổng số item -->
                            <span class="badge bg-primary rounded-pill" id="cartBadgeCount">0</span>
                        </h4>

                        <!-- ❗ ID này main.js (loadCheckoutCart) sẽ render danh sách sản phẩm -->
                        <ul class="list-group mb-3 list-group-flush"
                            id="orderSummaryList"
                            style="max-height: 300px; overflow-y: auto;">
                            <!-- JS sẽ fill -->
                        </ul>

                        <hr class="my-2">

                        <div class="d-flex justify-content-between mb-2">
                            <span>Tạm tính:</span>
                            <strong id="subTotalDisplay">0đ</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Phí vận chuyển:</span>
                            <span class="text-success" id="shippingFeeDisplay">Miễn phí</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4 border-top pt-2">
                            <span class="fs-5 fw-bold">Tổng cộng:</span>
                            <strong class="fs-5 text-danger" id="totalDisplay">0đ</strong>
                        </div>

                        <h5 class="mb-3">Thanh toán</h5>
                        <div class="my-3">
                            <div class="form-check mb-2">
                                <input id="cod" name="paymentMethod" type="radio"
                                       class="form-check-input" value="cod" checked>
                                <label class="form-check-label" for="cod">COD (Tiền mặt)</label>
                            </div>
                            <div class="form-check">
                                <input id="vnpay" name="paymentMethod" type="radio"
                                       class="form-check-input" value="vnpay">
                                <label class="form-check-label" for="vnpay">
                                    Chuyển khoản / VNPAY
                                </label>
                            </div>
                        </div>

                        <button class="w-100 btn btn-primary btn-lg" type="submit">
                            ĐẶT HÀNG
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- FOOTER giữ nguyên -->
    <footer class="footer">
        <div class="footer-main">
            <div class="footer-left">
                <img src="img/Logo.png" alt="KL Camera" class="footer-logo" />
                <p>KL Camera – Đồ án website bán máy ảnh, flycam, phụ kiện cuối kỳ môn học thực hành nhập môn web</p>
            </div>
            <div class="footer-info">
                <h4>Thông tin</h4>
                <p>Địa chỉ: 180 Cao Lỗ, Phường 4, Quận 8, TP Hồ Chí Minh</p>
                <p>Email: DH52200971@student.stu.edu.vn</p>
                <p>Điện thoại: (028) 38 505 520</p>
            </div>
            <div class="footer-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.954342044612!2d106.67525717451676!3d10.738002459902354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f62a90e5dbd%3A0x674d5126513db295!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgU8OgaSBHw7Ju!5e0!3m2!1svi!2sus!4v1747419904719!5m2!1svi!2sus"
                        width="600" height="450" style="border:0;" allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Họ và tên: Trần Kiêm Lâm | MSSV: DH52200971 | Lớp: D22_TH05 | Nhóm 12 Thứ 3 Ca 44</p>
        </div>
    </footer>
</div>
<script src="./js/main.js"></script>
</body>
</html>
