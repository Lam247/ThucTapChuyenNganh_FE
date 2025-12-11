<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đang tải... - KL Camera</title>
    <link rel="stylesheet" href="./styles/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="./js/main.js"></script>
    <style>
        .product-detail-section { margin-top: 180px; margin-bottom: 60px; }
        @media (max-width: 768px) { .product-detail-section { margin-top: 110px; } }
        
        .main-image-container {
            border: 1px solid #eee;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
            /* Thêm chiều cao cố định để không bị nhảy layout */
            height: 400px; 
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .main-image { max-width: 100%; height: auto; max-height: 100%; object-fit: contain; }
        .thumbnail-container { display: flex; gap: 10px; overflow-x: auto; padding-bottom: 5px; }
        .thumbnail { width: 80px; height: 80px; object-fit: cover; border: 1px solid #ddd; cursor: pointer; border-radius: 4px; }
        .thumbnail.active { border-color: #ff430a; }
        
        .product-price { color: #ff430a; font-size: 2rem; font-weight: bold; }
        .btn-buy { background-color: #ff430a; color: white; border: none; padding: 12px 30px; font-weight: bold; }
        .btn-buy:hover { background-color: #e03a08; color: white; }
        
        /* Loading skeleton */
        .skeleton { background: #eee; height: 20px; margin-bottom: 10px; width: 100%; border-radius: 4px; animation: pulse 1.5s infinite; }
        @keyframes pulse { 0% { opacity: 0.6; } 50% { opacity: 1; } 100% { opacity: 0.6; } }
    </style>
</head>
<body>
    <div id="wrapper">
        <div id="top-bar">
            <div class="top-left"><form class="search-bar"><input type="text" placeholder="Tìm kiếm..."><button>Tìm</button></form></div>
            <div class="top-right">
                <div id="actions">
                    <div class="item" id="guestAction">
                        <a href="login.php">
                            <img src="./img/icon/user.png" alt="Đăng nhập" />
                        </a>
                    </div>

                    <div class="item user-dropdown" id="userAction" style="display: none;">
                        <div class="user-info">
                            <img src="./img/icon/user.png" id="headerAvatar" class="avatar-img">
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
             <a href="index.php" class="logo"><img src="./img/Logo.png" alt="Logo"></a>
        </div>

        <div class="container product-detail-section">
            <div id="loading" class="row">
                <div class="col-md-6"><div class="skeleton" style="height: 400px;"></div></div>
                <div class="col-md-6">
                    <div class="skeleton" style="height: 40px; width: 70%;"></div>
                    <div class="skeleton" style="height: 30px; width: 40%;"></div>
                    <div class="skeleton" style="height: 100px;"></div>
                </div>
            </div>

            <div id="product-content" class="row" style="display: none;">
                <div class="col-md-6 mb-4">
                    <div class="main-image-container">
                        <img id="mainImage" src="" alt="Product Image" class="main-image">
                    </div>
                    <div class="thumbnail-container" id="imageGallery">
                        </div>
                </div>

                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="#" id="categoryLink">Danh mục</a></li>
                            <li class="breadcrumb-item active" aria-current="page" id="breadcrumbName">Sản phẩm</li>
                        </ol>
                    </nav>

                    <h1 class="fw-bold mb-3" id="productName"></h1>
                    
                    <div class="mb-3">
                        <span class="badge bg-secondary me-2" id="brandName"></span>
                        <span class="text-muted">Mã SP: <span id="productSku"></span></span>
                    </div>

                    <div class="product-price mb-4" id="productPrice"></div>

                    <p class="text-muted mb-4" id="productShortDesc"></p>

                    <div class="d-flex align-items-center mb-4">
                        <div class="input-group me-3" style="width: 130px;">
                            <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity(-1)">-</button>
                            <input type="number" id="quantity" class="form-control text-center" value="1" min="1">
                            <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity(1)">+</button>
                        </div>
                        <button class="btn btn-buy rounded-pill" onclick="addToCart()">
                            <i class="fas fa-shopping-cart me-2"></i> THÊM VÀO GIỎ
                        </button>
                    </div>

                    <div class="alert alert-success d-none" id="addToCartSuccess">
                        Đã thêm sản phẩm vào giỏ hàng!
                    </div>
                </div>

                <div class="col-12 mt-5">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#description" type="button">Mô tả sản phẩm</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button">Đánh giá</button>
                        </li>
                    </ul>
                    <div class="tab-content p-4 border border-top-0 bg-white" id="myTabContent">
                        <div class="tab-pane fade show active" id="desc-content" role="tabpanel">
                             <div id="fullDescription"></div>
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <p>Chức năng đánh giá đang cập nhật...</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="error-view" class="text-center py-5" style="display: none;">
                 <h3 class="text-danger">Không tìm thấy sản phẩm!</h3>
                 <p class="text-muted">Đường dẫn không hợp lệ hoặc sản phẩm đã bị xóa.</p>
                 <a href="index.php" class="btn btn-outline-primary">Quay về trang chủ</a>
            </div>
        </div>

        <footer class="footer">
             <div class="footer-bottom"><p>Bản quyền © KL Camera Shop</p></div>
        </footer>
    </div>

    <script>
        let currentProductId = null;
        let currentProductName = "";
        let currentProductPrice = 0;
        let currentProductImage = "";

        document.addEventListener('DOMContentLoaded', () => {
            // Lấy tham số từ URL
            const urlParams = new URLSearchParams(window.location.search);
            const id = urlParams.get('id');       // Lấy ?id=...
            const slug = urlParams.get('slug');   // Lấy ?slug=...

            // Logic thông minh: Có ID thì dùng ID, không có ID mới xét Slug
            if (id) {
                fetchProductDetail(`${API_URL}/products/${id}`);
            } else if (slug) {
                fetchProductDetail(`${API_URL}/products/${slug}`);
            } else {
                showError();
            }
        });

        // Hàm gọi API
        async function fetchProductDetail(url) {
            try {
                const response = await fetch(url);
                const result = await response.json();
                if (!response.ok) {
                    throw new Error('Không thể tải dữ liệu');
                }
                if (result.data) {
                    renderProduct(result.data);
                } else {
                    throw new Error('Dữ liệu rỗng');
                }
            } catch (error) {
                console.error("Lỗi:", error);
                showError();
            }
        }

        function showError() {
            document.getElementById('loading').style.display = 'none';
            document.getElementById('product-content').style.display = 'none';
            document.getElementById('error-view').style.display = 'block';
        }

        function renderProduct(product) {
            currentProductId = product.id; 
            currentProductName   = product.name;
            currentProductPrice  = product.price;
            document.getElementById('loading').style.display = 'none';
            document.getElementById('product-content').style.display = 'flex';
            document.title = `${product.name} - KL Camera`;
            document.getElementById('productName').textContent = product.name;
            document.getElementById('breadcrumbName').textContent = product.name;
            document.getElementById('productSku').textContent = product.sku || 'N/A';
            const priceVND = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(product.price);
            document.getElementById('productPrice').textContent = priceVND;
            document.getElementById('productShortDesc').textContent = product.short_description || (product.description ? product.description.substring(0, 100) + '...' : '');
            const descContainer = document.getElementById('fullDescription');
            if(descContainer) descContainer.innerHTML = product.description || 'Đang cập nhật...';
            if (product.brand) {
                document.getElementById('brandName').textContent = product.brand.name;
            }
            if (product.category) {
                const catLink = document.getElementById('categoryLink');
                catLink.textContent = product.category.name;
                catLink.href = `categories.php?slug=${product.category.slug}`;
            }
            const images = (product.images && product.images.length > 0) 
               ? product.images 
               : [{ image_url: './img/no-image.png', is_primary: 1 }];

            const mainImgObj = images.find(img => img.is_primary == 1) || images[0];
            const mainImgEl = document.getElementById('mainImage');
            mainImgEl.src = mainImgObj.image_url;
            currentProductImage = mainImgObj.image_url;
            const galleryDiv = document.getElementById('imageGallery');
            galleryDiv.innerHTML = '';
            images.forEach(img => {
                const thumb = document.createElement('img');
                thumb.src = img.image_url;
                thumb.className = 'thumbnail';
                if (img.image_url === mainImgObj.image_url) {
                    thumb.classList.add('active');
                }
                thumb.onclick = function() {
                    mainImgEl.src = this.src;
                    document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                };
                galleryDiv.appendChild(thumb);
            });
        }

        function updateQuantity(change) {
            const input = document.getElementById('quantity');
            let newVal = parseInt(input.value) + change;
            if (newVal < 1) newVal = 1;
            input.value = newVal;
        }

        // Hàm Thêm vào giỏ hàng
        async function addToCart() {
        // DÙNG ĐÚNG KEY 'token' (giống main.js/login)
        const token = localStorage.getItem('token');

        if (!token) {
            Swal.fire({
                title: 'Yêu cầu đăng nhập',
                text: 'Bạn cần đăng nhập để thêm vào giỏ hàng.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Đăng nhập',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) window.location.href = 'login.php';
            });
            return;
        }

        const quantity = parseInt(document.getElementById('quantity').value) || 1;

        try {
            // 1. GỌI API LARAVEL
            const response = await fetch(`${API_URL}/cart/add`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: currentProductId,
                    quantity: quantity
                })
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Lỗi thêm giỏ hàng');
            }

            // 2. CẬP NHẬT GIỎ LOCAL (để cart.php & badge dùng)
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            const existing = cart.find(item => item.id == currentProductId);

            if (existing) {
                existing.qty += quantity;
            } else {
                cart.push({
                    id:   currentProductId,
                    name: currentProductName,
                    price: currentProductPrice,
                    img:  currentProductImage,
                    qty:  quantity
                });
            }

            localStorage.setItem('cart', JSON.stringify(cart));

            // 3. GỌI HÀM CẬP NHẬT SỐ LƯỢNG TRÊN HEADER (từ main.js)
            if (typeof updateCartCount === 'function') {
                updateCartCount();
            }

            // 4. THÔNG BÁO THÀNH CÔNG
            Swal.fire('Thành công!', 'Sản phẩm đã được thêm vào giỏ hàng.', 'success');
        } catch (error) {
            Swal.fire('Lỗi', error.message, 'error');
        }
    }
    </script>
</body>
</html>