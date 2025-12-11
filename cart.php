<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Giỏ Hàng - KL Camera Shop</title>
    
    <link rel="stylesheet" href="./styles/style.css" /> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <script src="./js/main.js" defer></script> <style>
        /* Canh lề để không bị Header che khuất */
        .cart-section {
            margin-top: 180px;
            min-height: 60vh; /* Chiều cao tối thiểu để footer không bị đẩy lên */
            margin-bottom: 60px;
        }
        @media (max-width: 768px) {
            .cart-section {
                margin-top: 130px;
            }
        }
        
        /* Tinh chỉnh bảng */
        .table img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }
        .quantity-input {
            width: 60px;
            text-align: center;
            border: 1px solid #dee2e6;
            margin: 0 5px;
        }
        .btn-qty {
            border: 1px solid #dee2e6;
            background: #fff;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .btn-qty:hover {
            background: #f8f9fa;
        }
        .btn-checkout {
            background-color: #ff430a;
            border-color: #ff430a;
            color: white;
            font-weight: bold;
            padding: 12px;
            text-transform: uppercase;
        }
        .btn-checkout:hover {
            background-color: #e03a00;
            color: white;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        
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
                    <div class="item">
                        <a href="login.php">
                            <img src="./img/icon/user.png" alt="Đăng nhập" />
                        </a>
                    </div>
                    <div class="item">
                        <a href="cart.php">
                            <img src="./img/icon/shopping-cart.png" alt="Giỏ hàng" />
                            </a>
                    </div>
                </div>
            </div>
        </div>

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

        <div class="container cart-section">
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="fw-bold mb-4" style="border-left: 5px solid #ff430a; padding-left: 15px;">Giỏ Hàng Của Bạn</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4 py-3">Sản phẩm</th>
                                            <th class="py-3">Đơn giá</th>
                                            <th class="py-3">Số lượng</th>
                                            <th class="py-3 text-end pe-4">Thành tiền</th>
                                            <th class="py-3"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="cartTableBody">
                                        </tbody>
                                </table>
                            </div>

                            <div id="emptyCartMessage" class="text-center py-5" style="display: none;">
                                <img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png" alt="Empty" style="width: 80px; opacity: 0.5;">
                                <p class="text-muted mt-3 fs-5">Giỏ hàng chưa có sản phẩm nào</p>
                                <a href="index.php" class="btn btn-outline-dark mt-2">
                                    ← Quay lại mua sắm
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold">Cộng giỏ hàng</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Tạm tính:</span>
                                <strong id="cartSubtotal">0đ</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Phí vận chuyển:</span>
                                <span class="text-success">Tính lúc thanh toán</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fs-5 fw-bold">Tổng cộng:</span>
                                <span class="fs-4 fw-bold" style="color: #ff430a;" id="cartTotal">0đ</span>
                            </div>
                            
                            <a href="checkout.php" id="btnCheckout" class="btn btn-checkout w-100 mb-2">
                                Tiến hành thanh toán
                            </a>
                            <a href="index.php" class="btn btn-outline-secondary w-100 border-0">
                                Tiếp tục xem sản phẩm
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.954342044612!2d106.67525717451676!3d10.738002459902354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f62a90e5dbd%3A0x674d5126513db295!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgU8OgaSBHw7Ju!5e0!3m2!1svi!2sus!4v1747419904719!5m2!1svi!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="footer-bottom">
                <p>Họ và tên: Trần Kiêm Lâm | MSSV: DH52200971 | Lớp: D22_TH05 | Nhóm 12 Thứ 3 Ca 44</p>
            </div>
        </footer>
    </div>

    <script>
        // Format tiền tệ
        const formatMoney = (amount) => new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);

        // 1. Render giỏ hàng
        function renderCartPage() {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            const tbody = document.getElementById("cartTableBody");
            const emptyMsg = document.getElementById("emptyCartMessage");
            const subtotalEl = document.getElementById("cartSubtotal");
            const totalEl = document.getElementById("cartTotal");
            const btnCheckout = document.getElementById("btnCheckout");

            tbody.innerHTML = "";
            let total = 0;

            if (cart.length === 0) {
                emptyMsg.style.display = "block";
                btnCheckout.classList.add("disabled");
                subtotalEl.innerText = "0đ";
                totalEl.innerText = "0đ";
                return;
            } else {
                emptyMsg.style.display = "none";
                btnCheckout.classList.remove("disabled");
            }

            cart.forEach((item, index) => {
                const lineTotal = item.price * item.qty;
                total += lineTotal;

                const row = `
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <img src="${item.img}" alt="img" class="shadow-sm border">
                                <div class="ms-3">
                                    <h6 class="mb-1 fw-bold text-dark">${item.name}</h6>
                                    <small class="text-muted">Mã: ${item.id}</small>
                                </div>
                            </div>
                        </td>
                        <td class="fw-bold text-secondary">${formatMoney(item.price)}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <button class="btn-qty rounded-start" onclick="updateQty(${index}, -1)">-</button>
                                <input type="text" class="quantity-input" value="${item.qty}" readonly>
                                <button class="btn-qty rounded-end" onclick="updateQty(${index}, 1)">+</button>
                            </div>
                        </td>
                        <td class="text-end pe-4 fw-bold" style="color: #ff430a;">${formatMoney(lineTotal)}</td>
                        <td>
                            <button class="btn btn-link text-danger p-0" onclick="removeItem(${index})">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });

            subtotalEl.innerText = formatMoney(total);
            totalEl.innerText = formatMoney(total);
        }

        // 2. Cập nhật số lượng
        function updateQty(index, change) {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            let newQty = cart[index].qty + change;

            if (newQty < 1) {
                removeItem(index);
                return;
            }

            cart[index].qty = newQty;
            localStorage.setItem("cart", JSON.stringify(cart));
            renderCartPage();
            // Cập nhật số trên header (nếu main.js có hỗ trợ)
            if(typeof updateCartCount === 'function') updateCartCount();
        }

        // 3. Xóa sản phẩm
        function removeItem(index) {
            Swal.fire({
                title: 'Xóa sản phẩm?',
                text: "Bạn có chắc muốn xóa khỏi giỏ hàng?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ff430a',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    let cart = JSON.parse(localStorage.getItem("cart")) || [];
                    cart.splice(index, 1);
                    localStorage.setItem("cart", JSON.stringify(cart));
                    renderCartPage();
                    if(typeof updateCartCount === 'function') updateCartCount();
                    
                    // Swal.fire('Đã xóa!', '', 'success');
                }
            })
        }

        document.addEventListener("DOMContentLoaded", renderCartPage);
    </script>
</body>
</html>