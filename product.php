<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./styles/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/main.js" defer></script>
    <title>Cửa Hàng | KL Camera Shop</title>
  </head>
  <body>
    <div id="wrapper">
      <div id="top-bar">
        <div class="top-left">
          <form class="search-bar" action="product.php" method="get">
            <input type="text" placeholder="Tìm kiếm sản phẩm..." name="q" />
            <button type="submit">Tìm</button>
          </form>
        </div>
        <div class="top-right">
          <div class="promo-box">🔥 ƯU ĐÃI CỰC HOT 🔥</div>
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

      <div class="product-search-bar">
        <input type="text" placeholder="Tìm kiếm sản phẩm..." id="searchInput" />
      </div>

      <div id="main">
        <div id="dynamic-products-area">
             <p style="text-align:center; width:100%; margin-top: 50px;">Đang tải dữ liệu...</p>
        </div>
      </div>
      
      <footer class="footer">
        <div class="footer-main">
          <div class="footer-left">
            <img src="img/Logo.png" alt="KL Camera" class="footer-logo" />
            <p>KL Camera – Đồ án website bán máy ảnh, flycam...</p>
          </div>
          <div class="footer-info">
            <h4>Thông tin</h4>
            <p>Địa chỉ: 180 Cao Lỗ, Phường 4, Quận 8, TP Hồ Chí Minh</p>
            <p>Điện thoại: (028) 38 505 520</p>
          </div>
          <div class="footer-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.954342044612!2d106.67525717451676!3d10.738002459902354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f62a90e5dbd%3A0x674d5126513db295!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgU8OgaSBHw7Ju!5e0!3m2!1svi!2sus!4v1747419904719!5m2!1svi!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
        <div class="footer-bottom">
          <p>Họ và tên: Trần Kiêm Lâm | MSSV: DH52200971</p>
        </div>
      </footer>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            const keyword = urlParams.get('q');
            
            // Lấy URL từ biến global trong main.js hoặc fallback
            const baseUrl = typeof API_URL !== 'undefined' ? API_URL : "http://127.0.0.1:8000/api";
            let apiUrl = `${baseUrl}/products`;
            
            if (keyword) {
                apiUrl = `${baseUrl}/products/search?q=${encodeURIComponent(keyword)}`;
                document.querySelectorAll('input[name="q"]').forEach(i => i.value = keyword);
            }

            fetch(apiUrl)
            .then(res => res.json())
            .then(res => {
                let products = [];
                if (res.data && res.data.data) products = res.data.data;
                else if (Array.isArray(res.data)) products = res.data;
                else if (Array.isArray(res)) products = res;

                const mainContainer = document.getElementById('dynamic-products-area');
                mainContainer.innerHTML = ''; 

                if (products.length === 0) {
                    mainContainer.innerHTML = '<p class="text-center mt-5 text-muted">Không tìm thấy sản phẩm nào.</p>';
                    return;
                }

                if (keyword) {
                    renderProductSection(mainContainer, `Kết quả tìm kiếm: "${keyword}"`, products);
                } else {
                    groupAndRender(mainContainer, products);
                }
            })
            .catch(err => {
                document.getElementById('dynamic-products-area').innerHTML = `<p class="text-center text-danger mt-5">Lỗi kết nối: ${err.message}</p>`;
            });
        });

        function groupAndRender(container, products) {
            const grouped = {};
            const brandMap = { 1: "Canon", 2: "Nikon", 3: "Sony", 4: "Fujifilm", 9: "DJI" };

            products.forEach(p => {
                let brandName = p.brand ? p.brand.name : (brandMap[p.brand_id] || "Khác");
                if (!grouped[brandName]) grouped[brandName] = [];
                grouped[brandName].push(p);
            });

            const priority = ["Canon", "Sony", "Nikon", "Fujifilm", "DJI", "Khác"];
            priority.forEach(name => {
                if(grouped[name]) {
                    renderProductSection(container, name, grouped[name]);
                    delete grouped[name];
                }
            });
            for (const [name, list] of Object.entries(grouped)) {
                renderProductSection(container, name, list);
            }
        }

        function renderProductSection(container, title, list) {
            const section = document.createElement('div');
            section.className = 'mb-5';
            
            section.innerHTML = `
                <div class="headline-Product">
                    <span class="text-product">${title}</span>
                    <div class="line-product-last"></div>
                </div>
            `;

            const ul = document.createElement('ul');
            ul.className = 'product';
            
            list.forEach(p => {
                // QUAN TRỌNG: Hàm createProductHTML nằm trong main.js
                // Hãy chắc chắn main.js đã được cập nhật logic link href
                if(typeof createProductHTML === 'function') {
                    ul.innerHTML += createProductHTML(p);
                }
            });

            const wrap = document.createElement('div');
            wrap.id = 'products';
            wrap.appendChild(ul);
            
            section.appendChild(wrap);
            container.appendChild(section);
        }
    </script>
  </body>
</html>