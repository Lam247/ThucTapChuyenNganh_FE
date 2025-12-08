let products = []; // GLOBAL LIST

//Banner tự động chạy
function initCarousel() {
  const carouselElement = document.querySelector("#carouselExampleAutoplay");
  if (carouselElement) {
    new bootstrap.Carousel(carouselElement, {
      interval: 3000,
      ride: "carousel",
    });
  }
}

// Hiện thông báo chào mừng lần đầu truy cập
function showWelcomeAlert() {
  if (!localStorage.getItem("klcamera_welcome")) {
    setTimeout(function () {
      alert("Chào mừng bạn đến với KL Camera!");
    }, 300);
    localStorage.setItem("klcamera_welcome", "1");
  }
}

//Xử lí dấu 3 gạch hamburger menu
function handleHamburgerMenu() {
  const hamburger = document.getElementById("hamburger");
  const menu = document.getElementById("menu");
  if (!hamburger || !menu) return;

  hamburger.addEventListener("click", (e) => {
    e.stopPropagation();
    menu.classList.toggle("active");
  });

  menu.addEventListener("click", (e) => {
    e.stopPropagation();
  });

  document.addEventListener("click", () => {
    if (menu.classList.contains("active")) {
      menu.classList.remove("active");
    }
  });
}

//Tạo nút cuộn lên đầu trang
function initScrollToTopBtn() {
  const scrollBtn = document.createElement("button");
  scrollBtn.id = "scrollToTopBtn";
  scrollBtn.innerHTML = `
    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
      <circle cx="12" cy="12" r="12" fill="#ff430a"/>
      <path d="M12 8L12 16" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
      <path d="M8 12L12 8L16 12" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
  `;
  scrollBtn.style.position = "fixed";
  scrollBtn.style.bottom = "30px";
  scrollBtn.style.right = "30px";
  scrollBtn.style.display = "none";
  scrollBtn.style.zIndex = "9999";
  scrollBtn.style.background = "transparent";
  scrollBtn.style.border = "none";
  scrollBtn.style.padding = "0";
  scrollBtn.style.cursor = "pointer";
  scrollBtn.style.boxShadow = "0 2px 8px rgba(0,0,0,0.15)";
  scrollBtn.style.borderRadius = "50%";
  document.body.appendChild(scrollBtn);

  window.addEventListener("scroll", function () {
    scrollBtn.style.display = window.scrollY > 200 ? "block" : "none";
  });

  scrollBtn.addEventListener("click", function () {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
}

//Tự động focus vào ô tìm kiếm
function focusSearchInput() {
  const searchInput = document.querySelector(
    '.search-bar input[type="text"], .search-bar input[type="search"], .search-bar input[type="email"]'
  );
  if (searchInput) {
    searchInput.focus();
  }
}


//Thêm sản phẩm vào giỏ hàng
function addToCart(productId) {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  const product = products.find((p) => p.id === productId);
  if (!product) return;
  const existing = cart.find((item) => item.id === productId);
  if (existing) {
    existing.qty += 1;
  } else {
    cart.push({ id: productId, qty: 1 });
  }
  localStorage.setItem("cart", JSON.stringify(cart));
  updateCartCount();
  alert("Đã thêm vào giỏ hàng!");
}

// Hiển thị chi tiết sản phẩm
function renderProductDetail() {
  if (!document.querySelector(".product-detail-img")) return;
  const params = new URLSearchParams(window.location.search);
  const id = params.get("id");
  const product = products.find((p) => p.id === id);
  if (!product) return;

  document.querySelector(".product-detail-img").src = product.img;
  document.querySelector(".product-detail-title").textContent = product.name;
  document.querySelector(".product-detail-price-new").textContent =
    product.price;
  document.querySelector(".product-detail-price-old").textContent =
    product.oldPrice || "";
  document.querySelector(".product-detail-desc").textContent = product.desc;
  const buyBtn = document.querySelector(".btn-primary");
  if (buyBtn) {
    buyBtn.onclick = function () {
      addToCart(id);
    };
  }
}

// ===============================
// API CONFIG & LOGIC HIỂN THỊ (FIXED CHO PRODUCT CONTROLLER)
// ===============================
const IMAGE_BASE_URL = "http://127.0.0.1:8000/"; 

// 1. Hàm format tiền tệ
const formatCurrency = (amount) => {
    if (!amount) return '0đ';
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
};

// 2. Hàm lấy ảnh đại diện chính xác từ quan hệ 'images'
const getProductImage = (product) => {
    // Controller trả về quan hệ tên là 'images' (trong hàm show: with('images'))
    if (product.images && product.images.length > 0) {
        // Tìm ảnh có is_primary = 1
        let primaryImage = product.images.find(img => img.is_primary == 1);
        
        // Nếu không có ảnh chính, lấy ảnh đầu tiên
        if (!primaryImage) primaryImage = product.images[0];
        
        let url = primaryImage.image_url;
        
        // Xử lý đường dẫn
        if (url && !url.startsWith('http')) {
            if (url.startsWith('/')) url = url.substring(1);
            return IMAGE_BASE_URL + url;
        }
        return url;
    }
    return './img/no-image.jpg';
};

// 3. Hàm tạo HTML
const createProductHTML = (product) => {
    const imageUrl = getProductImage(product);
    
    // Logic giá: Database có 'price' và 'compare_price'
    const price = parseFloat(product.price);
    const comparePrice = product.compare_price ? parseFloat(product.compare_price) : 0;
    const hasDiscount = comparePrice > price;

    return `
        <li>
            <div class="product-items">
                <div class="product-top">
                    <a href="product-detail.php?id=${product.id}" class="product-thumb">
                        <img src="${imageUrl}" alt="${product.name}" onerror="this.src='./img/no-image.jpg'">
                    </a>
                    <a href="javascript:void(0)" onclick="addToCart(${product.id})" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                    <a href="product-detail.php?id=${product.id}" class="product-name">${product.name}</a>
                    ${
                        hasDiscount
                        ? `<div class="product-discount-price">${formatCurrency(comparePrice)}</div>
                           <div class="product-price">${formatCurrency(price)}</div>`
                        : `<div class="product-price">${formatCurrency(price)}</div>`
                    }
                </div>
            </div>
        </li>
    `;
};

// 4. Hàm gọi API (Đã sửa để đọc cấu trúc Phân Trang)
async function fetchAndRenderProducts() {
    if (!document.getElementById('list-canon')) return;

    try {
        const response = await fetch(`${API_URL}/products`);
        if (!response.ok) throw new Error(`Lỗi API: ${response.status}`);
        
        const jsonData = await response.json();
        
        // --- QUAN TRỌNG: XỬ LÝ DỮ LIỆU PHÂN TRANG ---
        // Controller trả về: { message: "...", data: { data: [sản phẩm...], current_page: 1... } }
        // Nên danh sách sản phẩm nằm ở: jsonData.data.data
        
        
        if (jsonData.data && jsonData.data.data && Array.isArray(jsonData.data.data)) {
          products = jsonData.data.data; // lưu vào biến global
             // Lấy mảng sản phẩm từ bên trong object phân trang
        } else if (jsonData.data && Array.isArray(jsonData.data)) {
            products = jsonData.data; // Trường hợp dự phòng nếu sau này bỏ phân trang
        } else {
            console.warn("Cấu trúc dữ liệu lạ:", jsonData);
        }

        // Ẩn loading
        document.querySelectorAll('.loading-text').forEach(el => el.style.display = 'none');

        const listCanon = document.getElementById('list-canon');
        const listFlycam = document.getElementById('list-flycam');
        const listGimbal = document.getElementById('list-gimbal');
        const listAction = document.getElementById('list-action');
        const listAccessory = document.getElementById('list-accessory');

        products.forEach(product => {
            const html = createProductHTML(product);
            
            // Logic phân loại
            const brandName = product.brand ? product.brand.name.toLowerCase() : '';
            const categoryName = product.category ? product.category.name.toLowerCase() : '';
            const productName = product.name.toLowerCase();

            if (brandName.includes('canon') || brandName.includes('sony') || brandName.includes('nikon') || categoryName.includes('máy ảnh')) {
                if(listCanon) listCanon.innerHTML += html;
            }
            else if (productName.includes('dji') || productName.includes('flycam') || productName.includes('mavic')) {
                if(listFlycam) listFlycam.innerHTML += html;
            }
            else if (productName.includes('gimbal') || productName.includes('rs')) {
                if(listGimbal) listGimbal.innerHTML += html;
            }
            else if (productName.includes('gopro') || productName.includes('insta360') || productName.includes('action')) {
                if(listAction) listAction.innerHTML += html;
            }
            else {
                if(listAccessory) listAccessory.innerHTML += html;
            }
        });

    } catch (error) {
        console.error('Lỗi JS:', error);
        const listCanon = document.getElementById('list-canon');
        if(listCanon) listCanon.innerHTML = `<p style="color:red; text-align:center">Lỗi: ${error.message}. Kiểm tra Server (php artisan serve) hoặc F12 xem lỗi CORS.</p>`;
    }
}

//Hàm load các func vừa tạo ở trên
document.addEventListener("DOMContentLoaded", function () {
  renderProductDetail();
  initCarousel();
  showWelcomeAlert();
  handleHamburgerMenu();
  initScrollToTopBtn();
  focusSearchInput();
  initLogin();

  fetchAndRenderProducts();
});
