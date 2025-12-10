<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./styles/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/main.js" defer></script>
    <title>Chi tiết sản phẩm | KL Camera Shop</title>
    
    <style>
      .product-detail-section {
        margin-top: 180px;
      }
      @media (max-width: 768px) {
        .product-detail-section {
          margin-top: 110px;
        }
      }
      /* Thêm style cho mô tả để hiển thị HTML từ DB đẹp hơn */
      .product-detail-desc {
        line-height: 1.6;
        color: #333;
      }
      .product-detail-desc img {
        max-width: 100%;
        height: auto;
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
              <img src="./img/icon/shopping-cart.png" alt="Giỏ hàng" />
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

      <div class="container my-5 product-detail-section">
        <button
          onclick="window.history.back()"
          class="btn btn-outline-dark mb-3"
        >
          ← Quay lại
        </button>
        
        <div id="loading-spinner" class="text-center my-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p>Đang tải thông tin sản phẩm...</p>
        </div>

        <div class="row align-items-start" id="product-content" style="display: none;">
          <div class="col-md-5 text-center">
            <img
              src="" 
              alt=""
              class="img-fluid rounded shadow product-detail-img"
              style="max-width: 100%; object-fit: contain;"
            />
          </div>
          <div class="col-md-7">
            <h1
              class="mb-3 product-detail-title"
              style="font-size: 2rem; font-weight: 700"
            >
              </h1>
            <div class="mb-2">
              <span
                class="text-muted text-decoration-line-through product-detail-price-old"
                style="font-size: 1.2rem"
                ></span>
              <span
                class="ms-3 product-detail-price-new"
                style="color: #ff430a; font-size: 1.5rem; font-weight: 700"
                ></span>
            </div>
            
            <div class="mb-4">
                <h5>Mô tả chi tiết:</h5>
                <div class="product-detail-desc" style="font-size: 1.1rem">
                  </div>
            </div>

            <button
              class="btn btn-primary btn-lg btn-buy-now"
              style="background: #ff430a; border: none"
            >
              Mua ngay
            </button>
            <button class="btn btn-outline-secondary btn-lg ms-2 btn-add-cart">
              Thêm vào giỏ
            </button>
          </div>
        </div>
        
        <div id="error-message" class="alert alert-danger text-center my-5" style="display: none;">
            Không tìm thấy sản phẩm hoặc có lỗi xảy ra.
        </div>
      </div>

      <footer class="footer">
        <div class="footer-main">
          <div class="footer-left">
            <img src="img/Logo.png" alt="KL Camera" class="footer-logo" />
            <p>
              KL Camera – Đồ án website bán máy ảnh, flycam, phụ kiện cuối kỳ
              môn học thực hành nhập môn web
            </p>
          </div>
          <div class="footer-info">
            <h4>Thông tin</h4>
            <p>Địa chỉ: 180 Cao Lỗ, Phường 4, Quận 8, TP Hồ Chí Minh</p>
            <p>Email: DH52200971@student.stu.edu.vn</p>
            <p>Điện thoại: (028) 38 505 520</p>
          </div>
          <div class="footer-map">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.954342044612!2d106.67525717451676!3d10.738002459902354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f62a90e5dbd%3A0x674d5126513db295!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgU8OgaSBHw7Ju!5e0!3m2!1svi!2sus!4v1747419904719!5m2!1svi!2sus"
              width="600"
              height="450"
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
          </div>
        </div>
        <div class="footer-bottom">
          <p>
            Họ và tên: Trần Kiêm Lâm | MSSV: DH52200971 | Lớp: D22_TH05 | Nhóm
            12 Thứ 3 Ca 44
          </p>
        </div>
      </footer>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const params = new URLSearchParams(window.location.search);
        const productId = params.get("id");
        
        const loadingSpinner = document.getElementById('loading-spinner');
        const productContent = document.getElementById('product-content');
        const errorMsg = document.getElementById('error-message');

        if (!productId) {
            showError("Thiếu ID sản phẩm trên URL.");
            return;
        }

        // URL API: Đảm bảo route trong Laravel là /products/{id}
        const API_URL = `http://127.0.0.1:8000/api/products/${productId}`;

        fetch(API_URL)
          .then(response => {
            if (!response.ok) throw new Error(`Lỗi server: ${response.status}`);
            return response.json();
          })
          .then(jsonResponse => {
            // Dựa vào cấu trúc return response()->json(['data' => $product]) của Laravel
            const product = jsonResponse.data; 

            if (!product) {
                showError("Không tìm thấy dữ liệu sản phẩm.");
                return;
            }

            // 1. Tên
            document.querySelector(".product-detail-title").textContent = product.name;

            // 2. Giá
            const price = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(product.price);
            document.querySelector(".product-detail-price-new").textContent = price;

            // 3. Giá cũ (Nếu có)
            if (product.compare_price > product.price) {
                const oldPrice = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(product.compare_price);
                document.querySelector(".product-detail-price-old").textContent = oldPrice;
            }

            // 4. Mô tả
            const desc = product.description || product.short_description || "Đang cập nhật mô tả...";
            document.querySelector(".product-detail-desc").innerHTML = desc;

            // 5. Ảnh
            const imgEl = document.querySelector(".product-detail-img");
            let finalImg = './img/no-image.png';
            
            if (product.images && product.images.length > 0) {
                // Ưu tiên ảnh primary hoặc ảnh đầu tiên
                let imgObj = product.images.find(img => img.is_primary == 1) || product.images[0];
                let path = imgObj.image_url || imgObj.url;
                if(path) finalImg = path.startsWith('http') ? path : path;
            } else if (product.image) {
                finalImg = product.image;
            }
            
            imgEl.src = finalImg;
            imgEl.onerror = function() { this.src = 'https://placehold.co/400?text=No+Image'; };

            // Hiện nội dung
            loadingSpinner.style.display = 'none';
            productContent.style.display = 'flex';
          })
          .catch(err => {
            console.error(err);
            showError("Lỗi kết nối: " + err.message);
          });

        function showError(msg) {
            loadingSpinner.style.display = 'none';
            productContent.style.display = 'none';
            errorMsg.style.display = 'block';
            errorMsg.textContent = msg;
        }
      });
    </script>
  </body>
</html>