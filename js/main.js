// =============================================================
// 1. CẤU HÌNH & TIỆN ÍCH CHUNG
// =============================================================
const API_URL = "http://127.0.0.1:8000/api";
const IMAGE_BASE_URL = "http://127.0.0.1:8000/";

// Cấu hình Toast
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

const formatMoney = (amount) => {
  if (!amount) return "0đ";
  return new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
  }).format(amount);
};

const getProductImage = (product) => {
  if (product.images && product.images.length > 0) {
    let primaryImage =
      product.images.find((img) => img.is_primary == 1) || product.images[0];
    let url = primaryImage.image_url || primaryImage.url;
    if (url && !url.startsWith("http")) {
      if (url.startsWith("/")) url = url.substring(1);
      return IMAGE_BASE_URL + url;
    }
    return url;
  }
  return product.image || "./img/no-image.png";
};

// =============================================================
// 2. GIỎ HÀNG (CORE LOGIC)
// =============================================================

function updateCartCount() {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  const totalQty = cart.reduce((sum, item) => sum + item.qty, 0);

  const badge = document.getElementById("headerCartCount");
  if (badge) {
    badge.style.display = totalQty > 0 ? "flex" : "none";
    badge.innerText = totalQty > 99 ? "99+" : totalQty;
  }
  const checkoutBadge = document.getElementById("cartBadgeCount");
  if (checkoutBadge) checkoutBadge.innerText = totalQty;
}

// Hàm này được gọi từ trang Product Detail
function addToCart(productId, name, price, img, isBuyNow = false) {
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  const existing = cart.find((item) => item.id == productId);
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
    // Nếu là nút Mua Ngay ở trang chi tiết -> Chuyển sang thanh toán
    window.location.href = "checkout.php";
  } else {
    // Nếu là nút Thêm vào giỏ -> Ở lại và báo Toast
    if (Toast)
      Toast.fire({
        icon: "success",
        title: "Đã thêm vào giỏ hàng",
        text: name,
      });
    else alert(`Đã thêm ${name} vào giỏ hàng!`);
  }
}

// =============================================================
// 3. LOGIC TRANG CỬA HÀNG (SỬA ĐỔI QUAN TRỌNG Ở ĐÂY)
// =============================================================

// Tạo HTML cho 1 sản phẩm ở trang danh sách
const createProductHTML = (product) => {
  const imageUrl = getProductImage(product);
  const price = parseFloat(product.price);
  const comparePrice = product.compare_price
    ? parseFloat(product.compare_price)
    : 0;
  const hasDiscount = comparePrice > price;

  return `
        <li>
            <div class="product-items">
                <div class="product-top">
                    <a href="product-detail.php?id=${
                      product.id
                    }" class="product-thumb">
                        <img src="${imageUrl}" alt="${
    product.name
  }" onerror="this.src='./img/no-image.png'">
                    </a>
                    
                    <a href="product-detail.php?id=${
                      product.id
                    }" class="buy-now">
                        Xem chi tiết
                    </a>
                </div>
                <div class="product-info">
                    <a href="product-detail.php?id=${
                      product.id
                    }" class="product-name">${product.name}</a>
                    <div class="price-box">
                        ${
                          hasDiscount
                            ? `<span class="product-discount-price text-muted text-decoration-line-through me-2">${formatMoney(
                                comparePrice
                              )}</span>
                               <span class="product-price text-danger fw-bold">${formatMoney(
                                 price
                               )}</span>`
                            : `<span class="product-price text-danger fw-bold">${formatMoney(
                                price
                              )}</span>`
                        }
                    </div>
                </div>
            </div>
        </li>
    `;
};

// =============================================================
// 4. LOGIC TRANG CHI TIẾT (PRODUCT DETAIL)
// =============================================================

async function renderProductDetail() {
  if (!document.querySelector(".product-detail-img")) return;

  const params = new URLSearchParams(window.location.search);
  const id = params.get("id");
  if (!id) return; // Không có ID thì thôi

  try {
    const res = await fetch(`${API_URL}/products/${id}`);
    const json = await res.json();
    const product = json.data;

    if (!product) {
      document.getElementById("error-message").style.display = "block";
      document.getElementById("loading-spinner").style.display = "none";
      return;
    }

    const imageUrl = getProductImage(product);
    const price = parseFloat(product.price);
    const comparePrice = parseFloat(product.compare_price || 0);

    // Điền dữ liệu vào HTML
    document.querySelector(".product-detail-img").src = imageUrl;
    document.querySelector(".product-detail-title").textContent = product.name;
    document.querySelector(".product-detail-price-new").textContent =
      formatMoney(price);

    const oldPriceEl = document.querySelector(".product-detail-price-old");
    if (comparePrice > price && oldPriceEl) {
      oldPriceEl.textContent = formatMoney(comparePrice);
    }

    if (document.querySelector(".product-detail-desc"))
      document.querySelector(".product-detail-desc").innerHTML =
        product.description || "Đang cập nhật...";

    // --- SỬ LÝ 2 NÚT BẤM (ĐÚNG LOGIC BẠN CẦN) ---

    // Nút 1: Thêm vào giỏ (isBuyNow = false -> Ở lại trang)
    const btnAdd = document.getElementById("btnAddToCart");
    if (btnAdd) {
      // Clone để xóa event cũ nếu có
      const newBtn = btnAdd.cloneNode(true);
      btnAdd.parentNode.replaceChild(newBtn, btnAdd);

      // Gán sự kiện mới
      newBtn.addEventListener("click", function () {
        addToCart(product.id, product.name, price, imageUrl, false);
      });
    }

    // Nút 2: Mua ngay (isBuyNow = true -> Sang Checkout)
    const btnBuy = document.getElementById("btnBuyNow");
    if (btnBuy) {
      const newBtn = btnBuy.cloneNode(true);
      btnBuy.parentNode.replaceChild(newBtn, btnBuy);

      newBtn.addEventListener("click", function () {
        addToCart(product.id, product.name, price, imageUrl, true);
      });
    }

    // Hiển thị giao diện
    document.getElementById("loading-spinner").style.display = "none";
    document.getElementById("product-content").style.display = "flex";
  } catch (e) {
    console.error(e);
    document.getElementById("error-message").style.display = "block";
    document.getElementById("loading-spinner").style.display = "none";
  }
}

// =============================================================
// 5. LOGIC THANH TOÁN (CHECKOUT)
// =============================================================

function initCheckout() {
  const checkoutForm = document.getElementById("checkoutForm");
  if (!checkoutForm) return;

  loadCheckoutCart();
  autoFillUser();

  checkoutForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    handlePlaceOrder();
  });
}

function loadCheckoutCart() {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  const listEl = document.getElementById("orderSummaryList");

  if (cart.length === 0) {
    Swal.fire({
      title: "Giỏ hàng trống",
      text: "Vui lòng chọn sản phẩm",
      icon: "warning",
      confirmButtonColor: "#ff430a",
    }).then(() => (window.location.href = "product.php"));
    return;
  }

  if (listEl) {
    listEl.innerHTML = "";
    let total = 0;
    let itemCount = 0;

    cart.forEach((item) => {
      const itemTotal = item.price * item.qty;
      total += itemTotal;
      itemCount += item.qty;
      listEl.innerHTML += `
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div class="d-flex align-items-center">
                        <img src="${
                          item.img
                        }" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px; border-radius: 5px;">
                        <div><h6 class="my-0 small text-truncate" style="max-width: 150px;">${
                          item.name
                        }</h6><small class="text-muted">SL: ${
        item.qty
      }</small></div>
                    </div>
                    <span class="text-muted">${formatMoney(itemTotal)}</span>
                </li>`;
    });

    let shipFee = total < 5000000 ? 30000 : 0;
    document.getElementById("cartBadgeCount").innerText = itemCount;
    document.getElementById("subTotalDisplay").innerText = formatMoney(total);
    const shipEl = document.getElementById("shippingFeeDisplay");
    if (shipFee > 0) {
      shipEl.textContent = formatMoney(shipFee);
      shipEl.classList.remove("text-success");
    } else {
      shipEl.textContent = "Miễn phí";
      shipEl.classList.add("text-success");
    }
    document.getElementById("totalDisplay").textContent = formatMoney(
      total + shipFee
    );
  }
}

function autoFillUser() {
  const userStr = localStorage.getItem("user_info");
  if (userStr) {
    const user = JSON.parse(userStr);
    if (document.getElementById("customerName"))
      document.getElementById("customerName").value = user.name || "";
    if (document.getElementById("customerEmail"))
      document.getElementById("customerEmail").value = user.email || "";
    if (document.getElementById("customerPhone"))
      document.getElementById("customerPhone").value = user.phone || "";
  }
}

async function handlePlaceOrder() {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  const subTotal = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
  const shipFee = subTotal < 5000000 ? 30000 : 0;
  const totalAmount = subTotal + shipFee;

  const payload = {
    customer_name: document.getElementById("customerName").value,
    customer_email: document.getElementById("customerEmail").value,
    customer_phone: document.getElementById("customerPhone").value,
    shipping_address: document.getElementById("shippingAddress").value,
    full_address: `${document.getElementById("shippingAddress").value}, ${
      document.getElementById("shippingWard").value
    }, ${document.getElementById("shippingDistrict").value}, ${
      document.getElementById("shippingCity").value
    }`,
    note: document.getElementById("customerNote").value,
    payment_method: document.querySelector(
      'input[name="paymentMethod"]:checked'
    ).value,
    total_amount: totalAmount,
    order_details: cart.map((item) => ({
      product_id: item.id,
      quantity: item.qty,
      price: item.price,
    })),
  };

  const token = localStorage.getItem("token");
  const headers = {
    "Content-Type": "application/json",
    Accept: "application/json",
  };
  if (token) headers["Authorization"] = `Bearer ${token}`;

  try {
    Swal.fire({ title: "Đang xử lý...", didOpen: () => Swal.showLoading() });
    const response = await fetch(`${API_URL}/order`, {
      method: "POST",
      headers: headers,
      body: JSON.stringify(payload),
    });
    const data = await response.json();

    if (response.ok) {
      Swal.fire({
        icon: "success",
        title: "Thành công!",
        text: `Mã đơn hàng: ${data.order ? data.order.id : "Mới"}`,
        confirmButtonColor: "#ff430a",
      }).then(() => {
        localStorage.removeItem("cart");
        window.location.href = "index.php";
      });
    } else {
      throw new Error(data.message || "Lỗi đặt hàng");
    }
  } catch (error) {
    Swal.fire("Lỗi", error.message, "error");
  }
}

// =============================================================
// 6. LOGIN & INIT
// =============================================================

function checkLoginState() {
  const token = localStorage.getItem("token");
  const userStr = localStorage.getItem("user_info");
  const guestEl = document.getElementById("guestAction");
  const userEl = document.getElementById("userAction");
  if (!guestEl || !userEl) return;

  if (token && userStr) {
    const user = JSON.parse(userStr);
    guestEl.style.display = "none";
    userEl.style.display = "block";
    const avatarUrl = user.avatar || "./img/icon/user.png";
    const userName = user.name || "Khách hàng";

    if (document.getElementById("headerAvatar"))
      document.getElementById("headerAvatar").src = avatarUrl;

    if (document.getElementById("headerName"))
      document.getElementById("headerName").textContent = userName;

    if (document.getElementById("headerNameBold"))
      document.getElementById("headerNameBold").textContent = userName;
  } else {
    guestEl.style.display = "block";
    userEl.style.display = "none";
  }
}

async function handleLogout() {
  const result = await Swal.fire({
    title: "Bạn muốn đăng xuất?",
    text: "Giỏ hàng hiện tại sẽ được lưu lại.",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#ff430a",
    cancelButtonColor: "#6c757d",
    confirmButtonText: "Đăng xuất",
    cancelButtonText: "Ở lại",
  });

  if (result.isConfirmed) {
    localStorage.removeItem("token");
    localStorage.removeItem("user_info");
    // localStorage.removeItem("cart"); // Có thể giữ lại giỏ hàng nếu muốn
    Swal.fire({
      icon: "success",
      title: "Đã đăng xuất",
      showConfirmButton: false,
      timer: 1000,
    }).then(() => {
      window.location.href = "index.php";
    });
  }
}

function initLogin() {
  const form = document.getElementById("loginForm");
  if (!form) return;

  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    // 1. Bật loading indicator
    Swal.fire({
      title: "Đang xử lý...",
      didOpen: () => Swal.showLoading(),
      allowOutsideClick: false,
    });

    try {
      const res = await fetch(`${API_URL}/login`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
        body: JSON.stringify({ email, password }),
      });

      const data = await res.json();
      Swal.close();
      if (!res.ok) {
        let errorMsg =
          data.message ||
          "Đăng nhập thất bại. Vui lòng kiểm tra email và mật khẩu.";
        if (data.errors) {
          errorMsg = Object.values(data.errors).flat().join("\n");
        }
        throw new Error(errorMsg);
      }
      localStorage.setItem("token", data.token);
      localStorage.setItem("user_info", JSON.stringify(data.user));
      window.location.href =
        data.user.role === "admin" ? "admin.php" : "index.php";
    } catch (err) {
      Swal.close();
      Swal.fire(
        "Lỗi",
        err.message || "Không thể kết nối tới máy chủ API.",
        "error"
      );
    }
  });
}

function initUIHelpers() {
  if (document.getElementById("mainBanner") && typeof Swiper !== "undefined") {
    new Swiper("#mainBanner", {
      loop: true,
      autoplay: { delay: 3000 },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      pagination: { el: ".swiper-pagination", clickable: true },
    });
  }
  const hamburger = document.getElementById("hamburger");
  const menu = document.getElementById("menu");
  if (hamburger && menu) {
    hamburger.addEventListener("click", (e) => {
      e.stopPropagation();
      menu.classList.toggle("active");
    });
    document.addEventListener("click", () => menu.classList.remove("active"));
  }
}

function showWelcomeAlert() {
  const flagName = "welcome_shown_v1";
  if (localStorage.getItem(flagName)) {
    return;
  }
  Swal.fire({
    title: "Xin chào!",
    text: "Chào mừng bạn đến với KL Camera Shop",
    icon: "info",
    confirmButtonText: "Bắt đầu mua sắm",
    confirmButtonColor: "#ff430a",
    timer: 5000,
  }).then(() => {
    localStorage.setItem(flagName, "true");
  });
}

document.addEventListener("DOMContentLoaded", function () {
  updateCartCount();
  checkLoginState();
  initUIHelpers();
  initLogin();
  initCheckout();
  renderProductDetail();
  showWelcomeAlert();

  const btnTop = document.createElement("button");
  btnTop.innerHTML = "↑";
  btnTop.style.cssText =
    "position:fixed; bottom:20px; right:20px; display:none; z-index:999; padding:10px; border-radius:50%; background:#ff430a; color:white; border:none;";
  document.body.appendChild(btnTop);
  btnTop.onclick = () => window.scrollTo({ top: 0, behavior: "smooth" });
  window.onscroll = () =>
    (btnTop.style.display = window.scrollY > 200 ? "block" : "none");
});
