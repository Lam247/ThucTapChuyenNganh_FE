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
    <script src="./js/main.js" defer></script>
    <title>KL Camera Shop</title>
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
            <div class="item cart-icon-wrap">
              <a href="cart.php" class="text-decoration-none">
                <img src="./img/icon/shopping-cart.png" alt="Giỏ hàng" />
                <span id="headerCartCount" class="cart-badge" style="display: none;">0</span>
              </a>
            </div>
          </div>
        </div>
      </div>
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
      <section class="contact-section">
        <h2 class="contact-title">LIÊN HỆ</h2>
        <form class="contact-form">
          <div class="form-row">
            <div class="form-group">
              <label for="name">Tên:</label>
              <input type="text" id="name" placeholder="Tên của bạn" required />
            </div>
            <div class="form-group">
              <label for="phone">Số điện thoại:</label>
              <input type="tel" id="phone" placeholder="Số điện thoại" />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="email">Email:</label>
              <input
                type="email"
                id="email"
                placeholder="Email của bạn"
                required
              />
            </div>
            <div class="form-group">
              <label for="subject">Tiêu đề:</label>
              <input type="text" id="subject" placeholder="Tiêu đề" />
            </div>
          </div>

          <div class="form-group">
            <label for="message">Lời nhắn:</label>
            <textarea
              id="message"
              rows="6"
              placeholder="Nội dung lời nhắn..."
            ></textarea>
          </div>

          <div class="form-submit">
            <button type="submit">Gửi lời nhắn</button>
          </div>
        </form>
      </section>
    </div>
  </body>
  <footer class="footer">
    <div class="footer-main">
      <div class="footer-left">
        <img src="img/Logo.png" alt="KL Camera" class="footer-logo" />
        <p>
          KL Camera – Đồ án website bán máy ảnh, flycam, phụ kiện cuối kỳ môn
          học thực hành nhập môn web
        </p>
      </div>

      <div class="footer-info">
        <h4>Thông tin</h4>
        <p>Địa chỉ: 180 Cao Lỗ, Phường 4, Quận 8, TP Hồ Chí Minh</p>
        <p>Email: DH52200971@student.stu.edu.vn</p>
        <p>Điện thoại: 0395352082</p>
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
        Họ và tên: Trần Kiêm Lâm | MSSV: DH52200971 | Lớp: D222-TH05 | Nhóm 12 -
        Thứ 3 ca 4
      </p>
    </div>
  </footer>
</html>
