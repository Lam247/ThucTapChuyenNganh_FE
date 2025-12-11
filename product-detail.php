<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./styles/style.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    </style>
  </head>
  <body>
    <div id="wrapper">
      <!-- Top bar -->
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
            <div class="item cart-icon-wrap">
              <a href="cart.php" class="text-decoration-none">
                <img src="./img/icon/shopping-cart.png" alt="Giỏ hàng" />
                <span id="headerCartCount" class="cart-badge" style="display: none;">0</span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- Header -->
      <div id="header">
        <a href="index.php" class="logo">
          <img src="./img/Logo.png" alt="Logo" />
        </a>
        <div id="hamburger">&#9776;</div>
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
          &larr; Quay lại
        </button>
        <div class="row align-items-center">
          <div class="col-md-5 text-center">
            <img
              src="./img/Camera/Canon/DSLR/Canon-5D-Mark-IV-Body-247x296.jpg"
              alt="Canon 5D Mark 4"
              class="img-fluid rounded shadow product-detail-img"
              style="max-width: 350px"
            />
          </div>
          <div class="col-md-7">
            <h1
              class="mb-3 product-detail-title"
              style="font-size: 2rem; font-weight: 700"
            >
              Canon 5D Mark 4
            </h1>
            <div class="mb-2">
              <span
                class="text-muted text-decoration-line-through product-detail-price-old"
                style="font-size: 1.2rem"
                >25,110,000đ</span
              >
              <span
                class="ms-3 product-detail-price-new"
                style="color: #ff430a; font-size: 1.5rem; font-weight: 700"
                >24,810,000đ</span
              >
            </div>
            <p class="mb-4 product-detail-desc" style="font-size: 1.1rem">
              Canon 5D Mark IV là dòng máy ảnh DSLR chuyên nghiệp với cảm biến
              full-frame, khả năng quay phim 4K, lấy nét nhanh và chính xác, phù
              hợp cho cả nhiếp ảnh gia và quay phim chuyên nghiệp.
            </p>
            <button
              id="btnBuyNow"
              class="btn btn-primary btn-lg fw-bold shadow-sm"
              style="background: #ff430a; border: none; padding: 12px 30px;"
            >
              <i class="fa-solid fa-bolt"></i> Mua ngay
            </button>

            <button 
              id="btnAddToCart" 
              class="btn btn-outline-dark btn-lg ms-3 fw-bold shadow-sm"
              style="padding: 12px 30px;"
            >
              <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ
            </button>
          </div>
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
  </body>
</html>
