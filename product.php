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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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
      <div class="product-search-bar">
        <input
          type="text"
          placeholder="Tìm kiếm sản phẩm..."
          id="searchInput"
        />
      </div>
      <div id="main">
    <div class="headline-Product">
        <span class="text-product">Tất cả sản phẩm</span>
        <div class="line-product-last"></div>
    </div>
    
    <div id="products">
        <ul class="product" id="danh-sach-san-pham">
             <p style="text-align:center; width:100%">Đang tải sản phẩm...</p>
        </ul>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Cấu hình đường dẫn API
        const apiUrl = 'http://127.0.0.1:8000/api/products'; 

        // Gọi API
        fetch(apiUrl, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Lỗi tải dữ liệu (Mã lỗi: ' + response.status + ')');
            return response.json();
        })
        .then(res => {
            const products = res.data.data ? res.data.data : res.data; 
            const listContainer = document.getElementById('danh-sach-san-pham');
            listContainer.innerHTML = ''; 

            if (!products || products.length === 0) {
                listContainer.innerHTML = '<p style="text-align:center; width:100%">Chưa có sản phẩm nào.</p>';
                return;
            }

            let htmlContent = '';
            
            // Hàm định dạng tiền tệ
            const formatMoney = (amount) => {
                return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
            };

            products.forEach(product => {
                // 1. Xử lý ảnh
                let imageUrl = './img/no-image.png'; 
                if (product.images && product.images.length > 0) {
                    let imgPath = product.images[0].image_url || product.images[0].url;
                    if (imgPath) {
                         imageUrl = imgPath.startsWith('http') ? imgPath : `./img/Camera/Canon/DSLR/Canon-5D-Mark-IV-Body-247x296.jpg`;//đang test đưa hình lên
                    }
                }

                // 2. Xử lý giá
                const currentPrice = formatMoney(product.price);
                
                // Logic hiển thị giá cũ (nếu có giảm giá thì hiện, không thì thôi - để giữ đúng cấu trúc gọn gàng)
                let oldPriceHtml = '';
                if (product.old_price && product.old_price > product.price) {
                     // Nếu bạn muốn hiện giá cũ thì bỏ comment dòng dưới
                     // oldPriceHtml = `<div class="product-discount-price">${formatMoney(product.old_price)}</div>`;
                }

                // 3. Render HTML chuẩn theo mẫu bạn gửi
                // Lưu ý: Đã bọc trong thẻ <li> vì container cha là <ul>
                htmlContent += `
                    <li>
                        <div class="product-items">
                            <div class="product-top">
                                <a href="product-detail.php?id=${product.id}" class="product-thumb">
                                    <img src="${imageUrl}" alt="${product.name}" onerror="this.src='./img/no-image.png'">
                                </a>
                                <a href="product-detail.php?id=${product.id}" class="buy-now">Mua Ngay</a>
                            </div>
                            <div class="product-info">
                                <a href="product-detail.php?id=${product.id}" class="product-name">${product.name}</a>
                                ${oldPriceHtml}
                                <div class="product-price">${currentPrice}</div>
                            </div>
                        </div>
                    </li>
                `;
            });

            listContainer.innerHTML = htmlContent;
        })
        .catch(error => {
            console.error('Lỗi:', error);
            document.getElementById('danh-sach-san-pham').innerHTML = `<p style="color:red; text-align:center">Lỗi kết nối: ${error.message}</p>`;
        });
    });
</script>
  </body>
  <footer class="footer">
    <div class="footer-main">
      <!-- Logo và mô tả -->
      <div class="footer-left">
        <img src="img/Logo.png" alt="KL Camera" class="footer-logo" />
        <p>
          KL Camera – Đồ án website bán máy ảnh, flycam, phụ kiện cuối kỳ môn
          học thực hành nhập môn web
        </p>
      </div>

      <!-- Thông tin -->
      <div class="footer-info">
        <h4>Thông tin</h4>
        <p>Địa chỉ: 180 Cao Lỗ, Phường 4, Quận 8, TP Hồ Chí Minh</p>
        <p>Email: DH52200971@student.stu.edu.vn</p>
        <p>Điện thoại: (028) 38 505 520</p>
      </div>

      <!-- Bản đồ nhỏ gọn -->
      <div class="footer-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.954342044612!2d106.67525717451676!3d10.738002459902354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f62a90e5dbd%3A0x674d5126513db295!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgU8OgaSBHw7Ju!5e0!3m2!1svi!2sus!4v1747419904719!5m2!1svi!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>

    <div class="footer-bottom">
      <p>
        Họ và tên: Trần Kiêm Lâm | MSSV: DH52200971 | Lớp: D22_TH05 | Nhóm 12
        Thứ 3 Ca 44
      </p>
    </div>
  </footer>
</html>
