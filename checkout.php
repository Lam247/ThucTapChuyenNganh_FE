<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Thanh Toán - KL Camera</title>
    
    <link rel="stylesheet" href="./styles/style.css" /> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <style>
        .checkout-section {
            margin-top: 180px;
            margin-bottom: 60px;
        }
        @media (max-width: 768px) {
            .checkout-section {
                margin-top: 110px;
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

        <div class="container checkout-section">
            <div class="row mb-4">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-dark">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="cart.php" class="text-decoration-none text-dark">Giỏ hàng</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
                        </ol>
                    </nav>
                    <h2 class="fw-bold">Thanh Toán Đơn Hàng</h2>
                </div>
            </div>

            <form id="checkoutForm" onsubmit="handlePlaceOrder(event)">
                <div class="row">
                    <div class="col-md-7 col-lg-8 order-md-1 mb-4">
                        <div class="card p-4 shadow-sm border-0">
                            <h4 class="mb-3 text-primary">Thông tin giao hàng</h4>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="customerName" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="customerName" placeholder="Nguyễn Văn A" required>
                                </div>

                                <div class="col-sm-6">
                                    <label for="customerEmail" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="customerEmail" placeholder="you@example.com" required>
                                </div>

                                <div class="col-sm-6">
                                    <label for="customerPhone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="customerPhone" placeholder="0909..." required>
                                </div>

                                <div class="col-12">
                                    <label for="shippingAddress" class="form-label">Địa chỉ nhận hàng <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="shippingAddress" placeholder="Số nhà, tên đường..." required>
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
                                    <textarea class="form-control" id="customerNote" rows="3" placeholder="Giao hàng giờ hành chính..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 col-lg-4 order-md-2 mb-4">
                        <div class="card p-4 shadow-sm border-0 bg-white">
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-primary">Đơn hàng</span>
                                <span class="badge bg-primary rounded-pill" id="cartBadgeCount">0</span>
                            </h4>
                            
                            <ul class="list-group mb-3 list-group-flush" id="orderSummaryList" style="max-height: 300px; overflow-y: auto;">
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
                                    <input id="cod" name="paymentMethod" type="radio" class="form-check-input" value="cod" checked>
                                    <label class="form-check-label" for="cod">COD (Tiền mặt)</label>
                                </div>
                                <div class="form-check">
                                    <input id="vnpay" name="paymentMethod" type="radio" class="form-check-input" value="vnpay">
                                    <label class="form-check-label" for="vnpay">Chuyển khoản / VNPAY</label>
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
        const API_URL = "http://127.0.0.1:8000/api";
        const formatMoney = (amount) => new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);

        document.addEventListener("DOMContentLoaded", () => {
            loadCheckoutCart();
            autoFillUser();
        });

        function loadCheckoutCart() {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            const listEl = document.getElementById("orderSummaryList");
            const countEl = document.getElementById("cartBadgeCount");
            
            if (cart.length === 0) {
                Swal.fire({
                    title: 'Giỏ hàng trống',
                    text: 'Vui lòng chọn sản phẩm trước khi thanh toán',
                    icon: 'warning',
                    confirmButtonColor: '#ff430a'
                }).then(() => window.location.href = 'index.php');
                return;
            }

            listEl.innerHTML = "";
            let total = 0;
            let itemCount = 0;

            cart.forEach(item => {
                const itemTotal = item.price * item.qty;
                total += itemTotal;
                itemCount += item.qty;

                listEl.innerHTML += `
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div class="d-flex align-items-center">
                            <img src="${item.img}" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px; border-radius: 5px;">
                            <div>
                                <h6 class="my-0 small text-truncate" style="max-width: 150px;">${item.name}</h6>
                                <small class="text-muted">SL: ${item.qty}</small>
                            </div>
                        </div>
                        <span class="text-muted">${formatMoney(itemTotal)}</span>
                    </li>
                `;
            });

            countEl.textContent = itemCount;
            document.getElementById("subTotalDisplay").textContent = formatMoney(total);

            let shipFee = (total < 500000) ? 30000 : 0;
            
            if (shipFee > 0) {
                document.getElementById("shippingFeeDisplay").textContent = formatMoney(shipFee);
                document.getElementById("shippingFeeDisplay").classList.remove('text-success');
            } else {
                document.getElementById("shippingFeeDisplay").textContent = "Miễn phí";
                document.getElementById("shippingFeeDisplay").classList.add('text-success');
            }

            document.getElementById("totalDisplay").textContent = formatMoney(total + shipFee);
        }

        function autoFillUser() {
            const userStr = localStorage.getItem("user_info");
            if (userStr) {
                const user = JSON.parse(userStr);
                document.getElementById("customerName").value = user.name || "";
                document.getElementById("customerEmail").value = user.email || "";
                document.getElementById("customerPhone").value = user.phone || "";
            }
        }

        async function handlePlaceOrder(event) {
            event.preventDefault();

            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            if (cart.length === 0) {
                alert("Giỏ hàng trống!"); return;
            }

            const payload = {
                customer_name: document.getElementById("customerName").value,
                customer_email: document.getElementById("customerEmail").value,
                customer_phone: document.getElementById("customerPhone").value,
                shipping_address: document.getElementById("shippingAddress").value,
                shipping_city: document.getElementById("shippingCity").value,
                shipping_district: document.getElementById("shippingDistrict").value,
                shipping_ward: document.getElementById("shippingWard").value,
                customer_note: document.getElementById("customerNote").value,
                payment_method: document.querySelector('input[name="paymentMethod"]:checked').value,
                coupon_code: "", 
                items: cart.map(item => ({
                    product_id: item.id,
                    quantity: item.qty
                }))
            };

            const token = localStorage.getItem("token");
            const headers = {
                "Content-Type": "application/json",
                "Accept": "application/json"
            };
            if (token) {
                headers["Authorization"] = `Bearer ${token}`;
            }

            try {
                Swal.fire({
                    title: 'Đang xử lý...',
                    text: 'Vui lòng chờ trong giây lát',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading() }
                });

                const response = await fetch(`${API_URL}/order`, {
                    method: "POST",
                    headers: headers,
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: `Mã đơn hàng của bạn: ${data.order.order_number}`,
                        confirmButtonText: 'Về trang chủ',
                        confirmButtonColor: '#ff430a'
                    }).then(() => {
                        localStorage.removeItem("cart"); 
                        window.location.href = "index.php"; 
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi đặt hàng',
                        text: data.message || 'Có lỗi xảy ra, vui lòng thử lại.',
                    });
                }

            } catch (error) {
                console.error("Lỗi:", error);
                Swal.fire("Lỗi", "Không thể kết nối đến máy chủ.", "error");
            }
        }
    </script>
</body>
</html>