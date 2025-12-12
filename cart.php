<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Giỏ Hàng - KL Camera Shop</title>
    
    <link rel="stylesheet" href="./styles/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        .cart-section { margin-top: 180px; min-height: 60vh; margin-bottom: 60px; }
        @media (max-width: 768px) { .cart-section { margin-top: 130px; } }
        .table img { width: 80px; height: 80px; object-fit: cover; border-radius: 8px; }
        .quantity-input { width: 60px; text-align: center; border: 1px solid #dee2e6; margin: 0 5px; }
        .btn-qty { border: 1px solid #dee2e6; background: #fff; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; cursor: pointer; }
        .btn-qty:hover { background: #f8f9fa; }
        .btn-checkout { background-color: #ff430a; border-color: #ff430a; color: white; font-weight: bold; padding: 12px; text-transform: uppercase; }
    </style>
</head>

<body>
<div id="wrapper">
    <div id="top-bar">
        <div class="top-left">
            <form class="search-bar" action="#" method="get"><input type="text" placeholder="Tìm kiếm..." name="q" /><button type="submit">Tìm</button></form>
        </div>
        <div class="top-right">
            <div class="promo-box">🔥 ƯU ĐÃI CỰC HOT 🔥</div>
            <div id="actions">
                <div class="item" id="guestAction">
                    <a href="login.php"><img src="./img/icon/user.png" alt="Đăng nhập" /></a>
                </div>
                <div class="item user-dropdown" id="userAction" style="display: none;">
                    <div class="user-info">
                        <img src="./img/icon/user.png" id="headerAvatar" alt="Avatar" class="avatar-img">
                        <span id="headerName" class="user-name">User</span>
                    </div>
                    <div class="dropdown-menu-custom">
                        <div class="menu-item disabled">Xin chào, <b id="headerNameBold">User</b></div>
                        <a href="profile.php" class="menu-item">Tài khoản của tôi</a>
                        <a href="#" onclick="handleLogout()" class="menu-item logout-btn">Đăng xuất</a>
                    </div>
                </div>
                <div class="item cart-icon-wrap">
                    <a href="cart.php">
                        <img src="./img/icon/shopping-cart.png" alt="Giỏ hàng" />
                        <span id="headerCartCount" class="cart-badge">0</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div id="header">
        <a href="index.php" class="logo"><img src="./img/Logo.png" alt="Logo" /></a>
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
        <h2 class="fw-bold mb-4" style="border-left: 5px solid #ff430a; padding-left: 15px;">Giỏ Hàng Của Bạn</h2>
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
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="cartTableBody"></tbody>
                            </table>
                        </div>
                        <div id="emptyCartMessage" class="text-center py-5" style="display:none;">
                            <img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png" alt="Empty" style="width:80px; opacity:0.5;">
                            <p class="text-muted mt-3 fs-5">Giỏ hàng chưa có sản phẩm nào</p>
                            <a href="index.php" class="btn btn-outline-dark mt-2">← Quay lại mua sắm</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3"><h5 class="mb-0 fw-bold">Cộng giỏ hàng</h5></div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3"><span class="text-muted">Tạm tính:</span><strong id="cartSubtotal">0đ</strong></div>
                        <div class="d-flex justify-content-between mb-3"><span class="text-muted">Phí vận chuyển:</span><span class="text-success">Tính lúc thanh toán</span></div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4"><span class="fs-5 fw-bold">Tổng cộng:</span><span class="fs-4 fw-bold" id="cartTotal" style="color:#ff430a;">0đ</span></div>
                        <a href="checkout.php" class="btn btn-checkout w-100 mb-2">Tiến hành thanh toán</a>
                        <a href="product.php" class="btn btn-outline-secondary w-100 border-0">Tiếp tục mua sắm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./js/main.js"></script>

<script>
    // Định nghĩa hàm format riêng để chạy ngay lập tức (Không chờ main.js)
    const safeFormatMoney = (amount) => new Intl.NumberFormat("vi-VN", { style: "currency", currency: "VND" }).format(amount);

    function renderCartPage() {
        let cart = [];
        try { cart = JSON.parse(localStorage.getItem("cart")) || []; } catch(e) { cart=[]; }
        
        const tbody = document.getElementById("cartTableBody");
        const emptyMsg = document.getElementById("emptyCartMessage");
        const subtotalEl = document.getElementById("cartSubtotal");
        const totalEl = document.getElementById("cartTotal");

        if (!tbody) return;

        tbody.innerHTML = "";
        let total = 0;

        if (cart.length === 0) {
            if(emptyMsg) emptyMsg.style.display = "block";
            if(subtotalEl) subtotalEl.innerText = "0đ";
            if(totalEl) totalEl.innerText = "0đ";
            return;
        } else {
            if(emptyMsg) emptyMsg.style.display = "none";
        }

        cart.forEach((item, index) => {
            const lineTotal = item.price * item.qty;
            total += lineTotal;
            let imgUrl = item.img || './img/no-image.png';

            tbody.innerHTML += `
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center">
                            <img src="${imgUrl}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;" onerror="this.src='./img/no-image.png'">
                            <div class="ms-3"><h6 class="mb-1 fw-bold">${item.name}</h6></div>
                        </div>
                    </td>
                    <td>${safeFormatMoney(item.price)}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <button class="btn-qty" onclick="updateQty(${index}, -1)">-</button>
                            <input class="quantity-input" value="${item.qty}" readonly>
                            <button class="btn-qty" onclick="updateQty(${index}, 1)">+</button>
                        </div>
                    </td>
                    <td class="text-end pe-4 fw-bold">${safeFormatMoney(lineTotal)}</td>
                    <td>
                        <button class="btn btn-link text-danger" onclick="removeItem(${index})"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            `;
        });

        if(subtotalEl) subtotalEl.innerText = safeFormatMoney(total);
        if(totalEl) totalEl.innerText = safeFormatMoney(total);
    }

    function updateQty(index, change) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        let newQty = cart[index].qty + change;
        if (newQty < 1) return removeItem(index);
        cart[index].qty = newQty;
        localStorage.setItem("cart", JSON.stringify(cart));
        renderCartPage(); 
        
        // Gọi hàm update Header từ main.js
        if (typeof updateCartCount === "function") updateCartCount();
    }

    function removeItem(index) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        cart.splice(index, 1);
        localStorage.setItem("cart", JSON.stringify(cart));
        renderCartPage();
        
        // Gọi hàm update Header từ main.js
        if (typeof updateCartCount === "function") updateCartCount();
    }

    // --- CHẠY NGAY LẬP TỨC (Main.js đã load ở trên rồi) ---
    console.log("Cart Page Init...");
    renderCartPage();

    // Cập nhật Header User & Số lượng (Hàm từ main.js)
    if (typeof checkLoginState === "function") checkLoginState();
    if (typeof updateCartCount === "function") updateCartCount();

</script>
</body>
</html>