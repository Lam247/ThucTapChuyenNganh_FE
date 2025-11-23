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

//Danh sách sản phẩm
const products = [
  {
    id: "1",
    name: "Canon 5D Mark 4",
    price: "24,810,000đ",
    oldPrice: "25,110,000đ",
    img: "./img/Camera/Canon/DSLR/Canon-5D-Mark-IV-Body-247x296.jpg",
    desc: "Canon 5D Mark IV là dòng máy ảnh DSLR chuyên nghiệp với cảm biến full-frame...",
  },
  {
    id: "2",
    name: "Canon 77D + 18-55mm",
    price: "10,000,000đ",
    oldPrice: "",
    img: "./img/Camera/Canon/DSLR/Canon-77D-18-55mm-STM-247x296.jpg",
    desc: "Máy ảnh Canon 77D kèm ống kính 18-55mm, nhỏ gọn, dễ sử dụng.",
  },
  {
    id: "3",
    name: "Canon EOS R1",
    price: "10,200,000đ",
    oldPrice: "10,990,000đ",
    img: "./img/Camera/Canon/Microless/Canon-EOS-R1-1-247x296.jpg",
    desc: "Canon EOS R1, máy ảnh mirrorless cao cấp, quay phim sắc nét.",
  },
  {
    id: "4",
    name: "Canon M200",
    price: "7,000,000đ",
    oldPrice: "7,490,000đ",
    img: "./img/Camera/Canon/Microless/Canon-EOS-M200-8-247x296.jpg",
    desc: "Canon M200, máy ảnh nhỏ gọn, phù hợp du lịch và chụp ảnh hàng ngày.",
  },
  {
    id: "5",
    name: "FujiFilm XH2",
    price: "25,000,000đ",
    oldPrice: "29,000,000đ",
    img: "./img/Camera/Fujifilm/FUJIFILM-X-H2-1-247x296.jpg",
    desc: "Fujifilm XH2, cảm biến lớn, chất lượng ảnh vượt trội.",
  },
  {
    id: "6",
    name: "Nikon Z5 II",
    price: "20,000,000đ",
    oldPrice: "25,000,000đ",
    img: "./img/Camera/Nikon/Nikon-Z5-II-5-247x296.jpg",
    desc: "Nikon Z5 II, máy ảnh mirrorless, hiệu năng ổn định, giá tốt.",
  },
  {
    id: "7",
    name: "Sony A7C II",
    price: "9,000,000đ",
    oldPrice: "10,000,000đ",
    img: "./img/Camera/Sony/Sony-A7C-II-9-1-247x296.jpg",
    desc: "Sony A7C II, nhỏ gọn, quay phim 4K, lấy nét nhanh.",
  },
  {
    id: "8",
    name: "Sony A9III",
    price: "99,000,000đ",
    oldPrice: "100,000,000đ",
    img: "./img/Camera/Sony/Sony-A9-III-247x296.jpg",
    desc: "Sony A9III, flagship tốc độ cao, dành cho nhiếp ảnh chuyên nghiệp.",
  },
  {
    id: "9",
    name: "DJI Avata2",
    price: "9,800,000đ",
    oldPrice: "10,000,000đ",
    img: "./img/Flycam/DJI-Avata-2-Flying-Kit-Phien-ban-pin-don-247x296.jpg",
    desc: "Flycam DJI Avata2 nhỏ gọn, quay video mượt mà, dễ điều khiển.",
  },
  {
    id: "10",
    name: "DJI Mini 4",
    price: "15,000,000đ",
    oldPrice: "",
    img: "./img/Flycam/dji-mini-4-pro-fly-more-combo-plus-247x296.jpg",
    desc: "Flycam DJI Mini 4, siêu nhẹ, quay phim 4K, pin lâu.",
  },
  {
    id: "11",
    name: "DJI Neo 8",
    price: "20,000,000đ",
    oldPrice: "",
    img: "./img/Flycam/DJI-Neo-8-247x296.jpg",
    desc: "DJI Neo 8, flycam mạnh mẽ, ổn định, phù hợp quay ngoài trời.",
  },
  {
    id: "12",
    name: "DJI Neo Fly Combo",
    price: "25,000,000đ",
    oldPrice: "",
    img: "./img/Flycam/DJI-Neo-Fly-More-Combo-3-247x296.jpg",
    desc: "Combo flycam DJI Neo, đầy đủ phụ kiện, bay lâu hơn.",
  },
  {
    id: "13",
    name: "DJI Bag",
    price: "1,000,000đ",
    oldPrice: "",
    img: "./img/Flycam/dji-shoulder-bag-cho-mini-3-1-247x296.jpg",
    desc: "Túi đựng DJI chính hãng, bảo vệ flycam an toàn.",
  },
  {
    id: "14",
    name: "FPV Combo",
    price: "20,000,000đ",
    oldPrice: "25,000,000đ",
    img: "./img/Flycam/FPV-Combo-247x296.jpg",
    desc: "Bộ FPV Combo, trải nghiệm bay tốc độ cao, hình ảnh sắc nét.",
  },
  {
    id: "15",
    name: "Tay Cầm DJI",
    price: "15,000,000đ",
    oldPrice: "",
    img: "./img/Flycam/Insta360-Titan-Chinh-hang-247x296.jpg",
    desc: "Tay cầm DJI, điều khiển dễ dàng, chắc chắn.",
  },
  {
    id: "16",
    name: "Mavic 3",
    price: "100,000,000đ",
    oldPrice: "",
    img: "./img/Flycam/mavic-3-cine-tokyocamera-1-247x296.jpg",
    desc: "Flycam Mavic 3, quay phim chuyên nghiệp, pin cực lâu.",
  },
  {
    id: "17",
    name: "Insta360 X5 (Essentials Bundle)",
    price: "16,800,000đ",
    oldPrice: "",
    img: "./img/Action-360 Camera/Insta360-X5-Essentials-Bundle-2-1-247x296.jpg",
    desc: "Bộ camera Insta360 X5 Essentials Bundle, quay 360 độ, nhỏ gọn, tiện dụng.",
  },
  {
    id: "18",
    name: "Sony ZV-E10 + Lens 16-55mm F3.5-5.6",
    price: "17,490,000đ",
    oldPrice: "18,990,000đ",
    img: "./img/Camera/Sony/Sony-ZV-E10-II-Lens-16-50mm-1-247x296.jpg",
    desc: "Sony ZV-E10 kèm lens 16-55mm, quay vlog, chụp ảnh chất lượng cao.",
  },
  {
    id: "19",
    name: "Sony a6700 Mirrorless Camera (Body Only)",
    price: "34,490,000đ",
    oldPrice: "35,490,000đ",
    img: "./img/Camera/Sony/Sony-a6700-247x296.jpg",
    desc: "Sony a6700, máy ảnh mirrorless, cảm biến APS-C, quay phim 4K.",
  },
  {
    id: "20",
    name: "Insta360 X5",
    price: "10,590,000đ",
    oldPrice: "",
    img: "./img/Action-360 Camera/Insta360-X5-7-1-247x296.jpg",
    desc: "Insta360 X5, camera hành trình 360 độ, nhỏ gọn, dễ sử dụng.",
  },
  {
    id: "21",
    name: "DJI Mini3 Propeller",
    price: "200,000đ",
    oldPrice: "",
    img: "./img/accessory/DJI-Mini-3-Propellers-247x296.jpg",
    desc: "Cánh quạt thay thế cho DJI Mini3, bền, nhẹ, dễ lắp đặt.",
  },
  {
    id: "22",
    name: "DJI RSMini 5",
    price: "7,000,000đ",
    oldPrice: "7,499,000đ",
    img: "./img/Gimbal/dji-rs-4-mini-5-247x296.jpg",
    desc: "Gimbal DJI RS Mini 5, chống rung mượt mà, nhỏ gọn.",
  },
  {
    id: "23",
    name: "Hub Sạc DJI Neo 1",
    price: "980,000đ",
    oldPrice: "1,250,000đ",
    img: "./img/accessory/Hub-Sac-Pin-Hai-Chieu-DJI-Neo-1-247x296.jpg",
    desc: "Hub sạc pin hai chiều cho DJI Neo 1, sạc nhanh, an toàn.",
  },
];

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

//Hàm load các func vừa tạo ở trên
document.addEventListener("DOMContentLoaded", function () {
  renderProductDetail();
  initCarousel();
  showWelcomeAlert();
  handleHamburgerMenu();
  initScrollToTopBtn();
  focusSearchInput();
});
