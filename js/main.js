// ===============================
// 1. CẤU HÌNH & TIỆN ÍCH CHUNG
// ===============================
const API_URL = "http://127.0.0.1:8000/api";

// Cấu hình Toast (Thông báo nhỏ góc phải)
const Toast =
  typeof Swal !== "undefined"
    ? Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener("mouseenter", Swal.stopTimer);
          toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
      })
    : null;

// Banner Swiper
document.addEventListener("DOMContentLoaded", function () {
  if (document.getElementById("mainBanner") && typeof Swiper !== "undefined") {
    new Swiper("#mainBanner", {
      effect: "slide",
      speed: 800,
      loop: true,
      autoplay: { delay: 3000, disableOnInteraction: false },
      grabCursor: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      pagination: { el: ".swiper-pagination", clickable: true },
      lazy: true,
    });
  }
});

// Thông báo chào mừng
function showWelcomeAlert() {
  if (!localStorage.getItem("klcamera_welcome")) {
    setTimeout(function () {
      if (typeof Swal !== "undefined") {
        Swal.fire({
          title: "Chào mừng!",
          text: "Chào mừng bạn đến với KL Camera Shop!",
          imageUrl: "./img/Logo.png",
          imageWidth: 150,
          imageHeight: 50,
          imageAlt: "Logo",
          confirmButtonColor: "#ff430a",
          timer: 3000,
        });
      }
    }, 1000);
    localStorage.setItem("klcamera_welcome", "1");
  }
}

// Menu Mobile
function handleHamburgerMenu() {
  const hamburger = document.getElementById("hamburger");
  const menu = document.getElementById("menu");
  if (!hamburger || !menu) return;

  hamburger.addEventListener("click", (e) => {
    e.stopPropagation();
    menu.classList.toggle("active");
  });
  document.addEventListener("click", (e) => {
    if (!menu.contains(e.target) && !hamburger.contains(e.target)) {
      menu.classList.remove("active");
    }
  });
}

// Scroll Top Btn
function initScrollToTopBtn() {
  const scrollBtn = document.createElement("button");
  scrollBtn.id = "scrollToTopBtn";
  scrollBtn.innerHTML = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M12 19V5M5 12l7-7 7 7"/></svg>`;
  scrollBtn.style.cssText =
    "position:fixed; bottom:30px; right:30px; display:none; z-index:9999; background:#ff430a; border:none; padding:10px; border-radius:50%; cursor:pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.3)";

  document.body.appendChild(scrollBtn);
  window.addEventListener("scroll", () => {
    scrollBtn.style.display = window.scrollY > 200 ? "block" : "none";
  });
  scrollBtn.addEventListener("click", () =>
    window.scrollTo({ top: 0, behavior: "smooth" })
  );
}

// ===============================
// 2. GIỎ HÀNG (CORE LOGIC)
// ===============================

// Cập nhật số trên icon
function updateCartCount() {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  const totalQty = cart.reduce((sum, item) => sum + item.qty, 0);
  const badge = document.getElementById("headerCartCount");

  if (badge) {
    if (totalQty > 0) {
      badge.style.display = "flex";
      badge.innerText = totalQty > 99 ? "99+" : totalQty;
    } else {
      badge.style.display = "none";
    }
  }
}

// Thêm vào giỏ (Logic đa năng)
function addToCart(productId, name, price, img, isBuyNow = false) {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  const existing = cart.find((item) => item.id === productId);
  let rawPrice =
    typeof price === "string" ? parseInt(price.replace(/[^0-9]/g, "")) : price;

  if (existing) {
    existing.qty += 1;
  } else {
    cart.push({ id: productId, name: name, price: rawPrice, img: img, qty: 1 });
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  updateCartCount();

  if (isBuyNow) {
    // Chuyển trang ngay lập tức
    window.location.href = "checkout.php";
  } else {
    // Hiện thông báo nhẹ nhàng (Toast)
    if (Toast) {
      Toast.fire({
        icon: "success",
        title: "Đã thêm vào giỏ hàng",
        text: name,
      });
    } else {
      alert(`Đã thêm ${name} vào giỏ hàng!`);
    }
  }
}

// ===============================
// 3. CHI TIẾT SẢN PHẨM (DỮ LIỆU)
// ===============================

// Dữ liệu sản phẩm (Copy từ file cũ của bạn)
const products = [
  {
    id: "1",
    name: "Canon 5D Mark 4",
    price: "24,810,000đ",
    oldPrice: "25,110,000đ",
    img: "./img/Camera/Canon/DSLR/Canon-5D-Mark-IV-Body-247x296.jpg",
    desc: "Canon 5D Mark IV là dòng máy ảnh DSLR chuyên nghiệp...",
  },
  {
    id: "2",
    name: "Canon 77D + 18-55mm",
    price: "10,000,000đ",
    oldPrice: "",
    img: "./img/Camera/Canon/DSLR/Canon-77D-18-55mm-STM-247x296.jpg",
    desc: "Máy ảnh Canon 77D kèm ống kính 18-55mm...",
  },
  {
    id: "3",
    name: "Canon EOS R1",
    price: "10,200,000đ",
    oldPrice: "10,990,000đ",
    img: "./img/Camera/Canon/Microless/Canon-EOS-R1-1-247x296.jpg",
    desc: "Canon EOS R1...",
  },
  {
    id: "4",
    name: "Canon M200",
    price: "7,000,000đ",
    oldPrice: "7,490,000đ",
    img: "./img/Camera/Canon/Microless/Canon-EOS-M200-8-247x296.jpg",
    desc: "Canon M200...",
  },
  {
    id: "5",
    name: "FujiFilm XH2",
    price: "25,000,000đ",
    oldPrice: "29,000,000đ",
    img: "./img/Camera/Fujifilm/FUJIFILM-X-H2-1-247x296.jpg",
    desc: "Fujifilm XH2...",
  },
  {
    id: "6",
    name: "Nikon Z5 II",
    price: "20,000,000đ",
    oldPrice: "25,000,000đ",
    img: "./img/Camera/Nikon/Nikon-Z5-II-5-247x296.jpg",
    desc: "Nikon Z5 II...",
  },
  {
    id: "7",
    name: "Sony A7C II",
    price: "9,000,000đ",
    oldPrice: "10,000,000đ",
    img: "./img/Camera/Sony/Sony-A7C-II-9-1-247x296.jpg",
    desc: "Sony A7C II...",
  },
  {
    id: "8",
    name: "Sony A9III",
    price: "99,000,000đ",
    oldPrice: "100,000,000đ",
    img: "./img/Camera/Sony/Sony-A9-III-247x296.jpg",
    desc: "Sony A9III...",
  },
  {
    id: "9",
    name: "DJI Avata2",
    price: "9,800,000đ",
    oldPrice: "10,000,000đ",
    img: "./img/Flycam/DJI-Avata-2-Flying-Kit-Phien-ban-pin-don-247x296.jpg",
    desc: "DJI Avata2...",
  },
  {
    id: "10",
    name: "DJI Mini 4",
    price: "15,000,000đ",
    oldPrice: "",
    img: "./img/Flycam/dji-mini-4-pro-fly-more-combo-plus-247x296.jpg",
    desc: "DJI Mini 4...",
  },
  {
    id: "11",
    name: "DJI Neo 8",
    price: "20,000,000đ",
    oldPrice: "",
    img: "./img/Flycam/DJI-Neo-8-247x296.jpg",
    desc: "DJI Neo 8...",
  },
  {
    id: "12",
    name: "DJI Neo Fly Combo",
    price: "25,000,000đ",
    oldPrice: "",
    img: "./img/Flycam/DJI-Neo-Fly-More-Combo-3-247x296.jpg",
    desc: "DJI Neo Fly Combo...",
  },
  {
    id: "13",
    name: "DJI Bag",
    price: "1,000,000đ",
    oldPrice: "",
    img: "./img/Flycam/dji-shoulder-bag-cho-mini-3-1-247x296.jpg",
    desc: "DJI Bag...",
  },
  {
    id: "14",
    name: "FPV Combo",
    price: "20,000,000đ",
    oldPrice: "25,000,000đ",
    img: "./img/Flycam/FPV-Combo-247x296.jpg",
    desc: "FPV Combo...",
  },
  {
    id: "15",
    name: "Tay Cầm DJI",
    price: "15,000,000đ",
    oldPrice: "",
    img: "./img/Flycam/Insta360-Titan-Chinh-hang-247x296.jpg",
    desc: "Tay Cầm DJI...",
  },
  {
    id: "16",
    name: "Mavic 3",
    price: "100,000,000đ",
    oldPrice: "",
    img: "./img/Flycam/mavic-3-cine-tokyocamera-1-247x296.jpg",
    desc: "Mavic 3...",
  },
  {
    id: "17",
    name: "Insta360 X5 (Bundle)",
    price: "16,800,000đ",
    oldPrice: "",
    img: "./img/Action-360 Camera/Insta360-X5-Essentials-Bundle-2-1-247x296.jpg",
    desc: "Insta360 X5...",
  },
  {
    id: "18",
    name: "Sony ZV-E10",
    price: "17,490,000đ",
    oldPrice: "18,990,000đ",
    img: "./img/Camera/Sony/Sony-ZV-E10-II-Lens-16-50mm-1-247x296.jpg",
    desc: "Sony ZV-E10...",
  },
  {
    id: "19",
    name: "Sony a6700",
    price: "34,490,000đ",
    oldPrice: "35,490,000đ",
    img: "./img/Camera/Sony/Sony-a6700-247x296.jpg",
    desc: "Sony a6700...",
  },
  {
    id: "20",
    name: "Insta360 X5",
    price: "10,590,000đ",
    oldPrice: "",
    img: "./img/Action-360 Camera/Insta360-X5-7-1-247x296.jpg",
    desc: "Insta360 X5...",
  },
  {
    id: "21",
    name: "DJI Mini3 Prop",
    price: "200,000đ",
    oldPrice: "",
    img: "./img/accessory/DJI-Mini-3-Propellers-247x296.jpg",
    desc: "DJI Mini3 Prop...",
  },
  {
    id: "22",
    name: "DJI RSMini 5",
    price: "7,000,000đ",
    oldPrice: "7,499,000đ",
    img: "./img/Gimbal/dji-rs-4-mini-5-247x296.jpg",
    desc: "DJI RSMini 5...",
  },
  {
    id: "23",
    name: "Hub Sạc DJI Neo",
    price: "980,000đ",
    oldPrice: "1,250,000đ",
    img: "./img/accessory/Hub-Sac-Pin-Hai-Chieu-DJI-Neo-1-247x296.jpg",
    desc: "Hub Sạc...",
  },
];

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

  const oldPriceEl = document.querySelector(".product-detail-price-old");
  if (oldPriceEl) oldPriceEl.textContent = product.oldPrice || "";

  if (document.querySelector(".product-detail-desc"))
    document.querySelector(".product-detail-desc").textContent = product.desc;

  // Gán sự kiện
  const btnAdd = document.getElementById("btnAddToCart");
  if (btnAdd) {
    btnAdd.onclick = () =>
      addToCart(product.id, product.name, product.price, product.img, false);
  }

  const btnBuy = document.getElementById("btnBuyNow");
  if (btnBuy) {
    btnBuy.onclick = () =>
      addToCart(product.id, product.name, product.price, product.img, true);
  }
}

// ===============================
// 4. XỬ LÝ ĐĂNG NHẬP & USER UI
// ===============================

// Kiểm tra trạng thái đăng nhập để đổi giao diện Header
function checkLoginState() {
  const token = localStorage.getItem("token");
  const userStr = localStorage.getItem("user_info");
  const guestAction = document.getElementById("guestAction");
  const userAction = document.getElementById("userAction");

  if (token && userStr) {
    const user = JSON.parse(userStr);
    if (guestAction) guestAction.style.display = "none";
    if (userAction) {
      userAction.style.display = "block";
      const nameEl = document.getElementById("userName");
      if (nameEl) nameEl.textContent = user.name;

      const emailEl = document.getElementById("userEmail");
      if (emailEl) emailEl.textContent = user.email;

      const avatarEl = document.getElementById("userAvatar");
      if (avatarEl) {
        avatarEl.src = user.avatar
          ? user.avatar
          : `https://ui-avatars.com/api/?name=${encodeURIComponent(
              user.name
            )}&background=random`;
      }
    }
  } else {
    if (guestAction) guestAction.style.display = "block";
    if (userAction) userAction.style.display = "none";
  }
}

// Hàm Đăng Xuất
async function handleLogout() {
  // Hỏi trước khi thoát
  const result = await Swal.fire({
    title: "Đăng xuất?",
    text: "Bạn có chắc muốn đăng xuất?",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Đăng xuất",
    cancelButtonText: "Hủy",
  });

  if (result.isConfirmed) {
    const token = localStorage.getItem("token");
    try {
      await fetch(`${API_URL}/logout`, {
        method: "POST",
        headers: {
          Authorization: `Bearer ${token}`,
          Accept: "application/json",
        },
      });
    } catch (e) {
      console.log(e);
    }

    localStorage.removeItem("token");
    localStorage.removeItem("user_info");

    Swal.fire({
      icon: "success",
      title: "Đã đăng xuất",
      timer: 1000,
      showConfirmButton: false,
    }).then(() => {
      window.location.href = "index.php";
    });
  }
}

// Xử lý Login Form
function initLogin() {
  const form = document.getElementById("loginForm");
  if (!form) return;

  form.addEventListener("submit", async (event) => {
    event.preventDefault();
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    try {
      Swal.fire({ title: "Đang xử lý...", didOpen: () => Swal.showLoading() });

      const response = await fetch(`${API_URL}/login`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
        body: JSON.stringify({ email, password }),
      });

      const data = await response.json();

      if (!response.ok) {
        Swal.fire({
          icon: "error",
          title: "Thất bại",
          text: data.message || "Sai email/mật khẩu",
        });
        return;
      }

      localStorage.setItem("token", data.token);
      localStorage.setItem("user_info", JSON.stringify(data.user));

      Swal.fire({
        icon: "success",
        title: "Thành công",
        text: "Đăng nhập thành công!",
        timer: 1500,
        showConfirmButton: false,
      }).then(() => {
        if (data.user && data.user.role === "admin") {
          window.location.href = "admin.php";
        } else {
          window.location.href = "index.php";
        }
      });
    } catch (error) {
      console.error(error);
      Swal.fire({ icon: "error", title: "Lỗi", text: "Lỗi kết nối Server!" });
    }
  });
}

// ===============================
// 5. KHỞI TẠO (INIT)
// ===============================
document.addEventListener("DOMContentLoaded", function () {
  updateCartCount();
  checkLoginState(); // Check login ngay khi load
  renderProductDetail();
  showWelcomeAlert();
  handleHamburgerMenu();
  initScrollToTopBtn();
  initLogin();
});
