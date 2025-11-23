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
      <section id="news" class="news-section">
        <div class="container">
          <h2 class="section-title">Tin Tức Mới Nhất</h2>
          <div class="news-list">
            <div class="news-item">
              <img
                src="./img/Flycam/banner-dji-mavic-4-pro-1.jpg"
                alt="Ra mắt sản phẩm mới"
              />
              <div class="news-content">
                <h3>Ra Mắt Flycam Mới Nhất 2025</h3>
                <p>
                  KL Camera chính thức ra mắt mẫu Flycam siêu nhỏ gọn, chất
                  lượng quay 4K siêu nét...
                </p>
                <a href="#" class="read-more">Đọc thêm →</a>
              </div>
            </div>

            <div class="news-item">
              <img
                src="./img/Camera/Canon/Microless/Canon-EOS-R8-247x296.jpg"
                alt="Khuyến mãi"
              />
              <div class="news-content">
                <h3>Khuyến Mãi Lớn Tháng 5</h3>
                <p>
                  Giảm giá lên tới 40% cho các dòng máy ảnh Canon và Sony từ
                  ngày 10 - 30/5/2025...
                </p>
                <a href="#" class="read-more">Đọc thêm →</a>
              </div>
            </div>

            <div class="news-item">
              <img
                src="./img/banner/Ra-Mat-Atomos-Shinobi-Go-bia.jpg"
                alt="Workshop nhiếp ảnh"
              />
              <div class="news-content">
                <h3>Workshop Nhiếp Ảnh Chuyên Nghiệp</h3>
                <p>
                  Đăng ký tham gia buổi workshop nhiếp ảnh cùng chuyên gia nổi
                  tiếng từ KL Camera...
                </p>
                <a href="#" class="read-more">Đọc thêm →</a>
              </div>
            </div>
          </div>
        </div>
      </section>
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
            Họ và tên: Trần Kiêm Lâm | MSSV: DH52200971 | Lớp: D222-TH05 | Nhóm
            12 - Thứ 3 ca 4
          </p>
        </div>
      </footer>
    </div>
  </body>
</html>
