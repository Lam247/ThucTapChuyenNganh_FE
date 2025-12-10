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
            <div class="item"><a href="login.php"><img src="./img/icon/user.png" alt="Đăng nhập" /></a></div>
            <div class="item"><img src="./img/icon/shopping-cart.png" alt="Giỏ hàng" /></div>
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
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            
            // 1. Cấu hình API và Tìm kiếm
            const urlParams = new URLSearchParams(window.location.search);
            const keyword = urlParams.get('q');
            
            let apiUrl = '';
            if (keyword) {
                // Nếu có tìm kiếm thì gọi API Search
                apiUrl = `http://127.0.0.1:8000/api/products/search?q=${encodeURIComponent(keyword)}`;
                const searchInputs = document.querySelectorAll('input[name="q"], #searchInput');
                searchInputs.forEach(input => input.value = keyword);
            } else {
                // Nếu không thì lấy tất cả
                apiUrl = 'http://127.0.0.1:8000/api/products';
            }

            console.log("Đang gọi API:", apiUrl);

            // 2. Fetch dữ liệu
            fetch(apiUrl)
            .then(response => {
                if (!response.ok) throw new Error(`Lỗi tải dữ liệu (${response.status})`);
                return response.json();
            })
            .then(res => {
                // Xử lý dữ liệu trả về (Laravel paginate hay array thường)
                let products = [];
                if (res.data && res.data.data) {
                    products = res.data.data; 
                } else if (Array.isArray(res.data)) {
                    products = res.data; 
                }

                const mainContainer = document.getElementById('dynamic-products-area');
                mainContainer.innerHTML = ''; 

                if (!products || products.length === 0) {
                    mainContainer.innerHTML = '<p style="text-align:center; margin-top:50px;">Không tìm thấy sản phẩm nào.</p>';
                    return;
                }

                // === LOGIC GOM NHÓM THEO HÃNG ===
                
                // Nếu đang tìm kiếm, ta hiện dạng danh sách chung (như cũ)
                if (keyword) {
                     renderProductSection(mainContainer, `Kết quả tìm kiếm: "${keyword}"`, products);
                } 
                else {
                    // Nếu ở trang cửa hàng, ta chia theo hãng
                    const groupedProducts = {};

                    // Danh sách tên hãng dựa trên ID (Phòng hờ trường hợp chưa join bảng brands)
                    const brandMap = {
                        1: "Canon",
                        2: "Nikon",
                        3: "Sony",
                        4: "Panasonic",
                        5: "Sigma",
                        6: "Tamron",
                        7: "Pentax",
                        8: "Phụ Kiện"
                    };

                    products.forEach(product => {
                        // Ưu tiên lấy tên từ quan hệ 'brand', nếu không có thì tra từ ID
                        let brandName = 'Thương hiệu khác';
                        
                        if (product.brand && product.brand.name) {
                            brandName = product.brand.name; 
                        } else if (product.brand_id && brandMap[product.brand_id]) {
                            brandName = brandMap[product.brand_id];
                        }

                        // Tạo mảng cho nhóm nếu chưa có
                        if (!groupedProducts[brandName]) {
                            groupedProducts[brandName] = [];
                        }
                        groupedProducts[brandName].push(product);
                    });

                    // Vẽ giao diện từng nhóm
                    // Sắp xếp thứ tự ưu tiên hiển thị (Canon -> Sony -> Nikon...)
                    const priorityOrder = ["Canon", "Sony", "Nikon", "Fujifilm", "Panasonic"];
                    
                    // Vẽ các hãng ưu tiên trước
                    priorityOrder.forEach(name => {
                        if(groupedProducts[name]) {
                            renderProductSection(mainContainer, name, groupedProducts[name]);
                            delete groupedProducts[name]; // Xóa để không vẽ lại
                        }
                    });

                    // Vẽ các hãng còn lại
                    for (const [brandName, listProducts] of Object.entries(groupedProducts)) {
                        renderProductSection(mainContainer, brandName, listProducts);
                    }
                }
            })
            .catch(error => {
                console.error('Lỗi:', error);
                document.getElementById('dynamic-products-area').innerHTML = `<p style="color:red; text-align:center; margin-top:50px;">Lỗi kết nối Server: ${error.message}</p>`;
            });
        });

        // === HÀM VẼ GIAO DIỆN ===
        function renderProductSection(container, title, productList) {
            // 1. Tạo Tiêu đề (Headline) giống mẫu ảnh bạn gửi
            const headlineDiv = document.createElement('div');
            headlineDiv.className = 'headline-Product';
            headlineDiv.innerHTML = `
                <span class="text-product" style="font-weight:bold; font-size: 1.5rem; text-transform: uppercase;">${title}</span>
                <div class="line-product-last"></div>
            `;
            container.appendChild(headlineDiv);

            // 2. Tạo khung lưới sản phẩm
            const productsDiv = document.createElement('div');
            productsDiv.id = 'products'; // ID để nhận CSS layout
            
            const ul = document.createElement('ul');
            ul.className = 'product'; // Class để nhận CSS grid/flex
            
            let htmlContent = '';
            const formatMoney = (amount) => new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);

            productList.forEach(product => {
                // Xử lý ảnh
                let imageUrl = './img/no-image.png'; 
                if (product.images && product.images.length > 0) {
                    let imgObj = product.images.find(img => img.is_primary == 1) || product.images[0];
                    let p = imgObj.image_url || imgObj.url;
                    if(p) imageUrl = p.startsWith('http') ? p : p;
                } else if (product.image) {
                    imageUrl = product.image;
                }

                // Xử lý giá cũ/mới
                let oldPriceHtml = '';
                if (product.compare_price && parseFloat(product.compare_price) > parseFloat(product.price)) {
                     oldPriceHtml = `<span class="product-discount-price" style="text-decoration: line-through; color: #888; font-size: 0.9em; margin-right: 5px;">${formatMoney(product.compare_price)}</span>`;
                }

                // HTML từng ô sản phẩm
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
                                <div class="price-box">
                                    ${oldPriceHtml}
                                    <span class="product-price" style="color: #ff430a; font-weight: bold;">${formatMoney(product.price)}</span>
                                </div>
                            </div>
                        </div>
                    </li>
                `;
            });

            ul.innerHTML = htmlContent;
            productsDiv.appendChild(ul);
            container.appendChild(productsDiv);
            
            // Khoảng cách giữa các hãng
            const spacer = document.createElement('div');
            spacer.style.height = "50px"; 
            container.appendChild(spacer);
        }
    </script>
    
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

  </body>
</html>