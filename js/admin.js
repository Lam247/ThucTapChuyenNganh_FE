// --- CẤU HÌNH ---
const API_BASE = "http://127.0.0.1:8000/api";
const API_ADMIN = API_BASE + "/admin";

// --- HELPER FUNCTIONS ---

function getToken() {
  return localStorage.getItem("token");
}

async function fetchAPI(url, options = {}) {
  const token = getToken();
  if (!token) {
    // Chưa đăng nhập thì về trang chủ hoặc trang login
    window.location.href = "index.php";
    return;
  }

  const headers = {
    Accept: "application/json",
    Authorization: `Bearer ${token}`,
    ...options.headers,
  };

  if (!(options.body instanceof FormData)) {
    headers["Content-Type"] = "application/json";
  } else {
    delete headers["Content-Type"];
  }

  document.getElementById("loadingOverlay").style.display = "flex";

  try {
    const response = await fetch(url, { ...options, headers });
    document.getElementById("loadingOverlay").style.display = "none";

    if (response.status === 401) {
      alert("Phiên đăng nhập hết hạn");
      logout();
      return null;
    }

    if (!response.ok) {
      const err = await response.json();
      throw new Error(err.message || "Có lỗi xảy ra");
    }

    return await response.json();
  } catch (error) {
    document.getElementById("loadingOverlay").style.display = "none";
    Swal.fire("Lỗi", error.message, "error");
    return null;
  }
}

function logout() {
  localStorage.removeItem("token");
  localStorage.removeItem("user_info");
  window.location.href = "index.php";
}

function getStatusBadge(status) {
  const map = {
    pending: '<span class="badge bg-warning text-dark">Chờ xử lý</span>',
    confirmed: '<span class="badge bg-info text-dark">Đã xác nhận</span>',
    shipping: '<span class="badge bg-primary">Đang giao</span>',
    delivered: '<span class="badge bg-success">Đã giao</span>',
    failed: '<span class="badge bg-danger">Đã hủy</span>',
    active: '<span class="badge bg-success-soft">Hoạt động</span>',
    inactive: '<span class="badge bg-secondary">Ẩn</span>',
    draft: '<span class="badge bg-warning text-dark">Nháp</span>',
    published: '<span class="badge bg-success">Đã đăng</span>',
  };
  return map[status] || `<span class="badge bg-secondary">${status}</span>`;
}

function formatCurrency(amount) {
  return new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
  }).format(amount);
}

// --- NAVIGATION LOGIC ---

function loadSection(section, el) {
  document
    .querySelectorAll(".nav-link")
    .forEach((link) => link.classList.remove("active"));
  if (el) el.classList.add("active");

  const titleEl = document.getElementById("pageTitle");

  switch (section) {
    case "dashboard":
      titleEl.textContent = "Dashboard";
      loadDashboard();
      break;
    case "products":
      titleEl.textContent = "Quản lý Sản phẩm";
      loadProducts();
      break;
    case "orders":
      titleEl.textContent = "Quản lý Đơn hàng";
      loadOrders();
      break;
    case "categories":
      titleEl.textContent = "Quản lý Danh mục";
      loadCategories();
      break;
    case "brands":
      titleEl.textContent = "Quản lý Thương hiệu";
      loadBrands();
      break;
    case "reviews":
      titleEl.textContent = "Quản lý Đánh giá";
      loadReviews();
      break;
    case "blogs":
      titleEl.textContent = "Quản lý Tin tức";
      loadBlogs();
      break;
  }
}

// --- MODULES ---

async function loadDashboard() {
  document.getElementById("dynamicContent").innerHTML = `
        <div class="row">
            <div class="col-md-3">
                <div class="card card-custom p-3 bg-primary text-white">
                    <h3>Sản phẩm</h3>
                    <p>Quản lý kho hàng</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-custom p-3 bg-success text-white">
                    <h3>Đơn hàng</h3>
                    <p>Theo dõi vận chuyển</p>
                </div>
            </div>
                <div class="col-md-3">
                <div class="card card-custom p-3 bg-warning text-dark">
                    <h3>Tồn kho thấp</h3>
                    <p>Cần nhập hàng ngay</p>
                </div>
            </div>
        </div>
        <div class="card card-custom p-4 mt-3">
            <h4>Chào mừng trở lại trang quản trị!</h4>
            <p>Chọn một mục từ thanh bên trái để bắt đầu làm việc.</p>
        </div>
    `;
  checkLowStock();
}

async function checkLowStock() {
  const data = await fetchAPI(`${API_ADMIN}/lowstock/unread`);
  if (data && data.success) {
    const count = data.data.count;
    const badge = document.getElementById("notifCount");
    if (count > 0) {
      badge.style.display = "inline-block";
      badge.textContent = count;
    } else {
      badge.style.display = "none";
    }
  }
}

async function showNotifications() {
  const data = await fetchAPI(`${API_ADMIN}/lowstock?is_read=0`);
  const listEl = document.getElementById("notifList");
  listEl.innerHTML = "";

  if (data && data.data.data.length > 0) {
    data.data.data.forEach((notif) => {
      listEl.innerHTML += `
                <div class="alert alert-warning d-flex justify-content-between align-items-center">
                    <span>${notif.message}</span>
                    <button class="btn btn-sm btn-outline-dark" onclick="markRead(${notif.id})">Đã xem</button>
                </div>
            `;
    });
  } else {
    listEl.innerHTML = '<p class="text-center">Không có thông báo mới.</p>';
  }
  new bootstrap.Modal(document.getElementById("notifModal")).show();
}

async function markRead(id) {
  await fetchAPI(`${API_ADMIN}/lowstock/${id}/read`, { method: "PUT" });
  showNotifications();
  checkLowStock();
}

// Sản phẩm
async function loadProducts() {
  const res = await fetchAPI(`${API_ADMIN}/products?per_page=100`);
  if (!res) return;

  let html = `
        <div class="card card-custom p-4">
            <div class="d-flex justify-content-between mb-3">
                <input type="text" class="form-control w-25" placeholder="Tìm kiếm sản phẩm...">
                <button class="btn btn-primary" onclick="openProductModal()"><i class="fa-solid fa-plus"></i> Thêm mới</button>
            </div>
            <table class="table table-custom table-hover">
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>SKU</th>
                        <th>Giá</th>
                        <th>Kho</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
    `;

  res.data.data.forEach((p) => {
    const mainImg =
      p.images && p.images.find((img) => img.is_primary)
        ? p.images.find((img) => img.is_primary).image_url
        : "https://placehold.co/50";

    html += `
            <tr>
                <td><img src="${mainImg}" alt="img"></td>
                <td>${p.name}</td>
                <td>${p.sku}</td>
                <td>${formatCurrency(p.price)}</td>
                <td>${p.stock_quantity}</td>
                <td>${getStatusBadge(p.status)}</td>
                <td>
                    <button class="btn btn-sm btn-outline-danger" onclick="deleteItem('products', ${
                      p.id
                    })"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>
        `;
  });

  html += `</tbody></table></div>`;
  document.getElementById("dynamicContent").innerHTML = html;
}

// Modal Sản phẩm
async function openProductModal() {
  document.getElementById("productForm").reset();
  document.getElementById("prodId").value = "";

  // Load options
  const cats = await fetchAPI(`${API_BASE}/categories`);
  const brands = await fetchAPI(`${API_BASE}/brands`);

  const catSelect = document.getElementById("prodCategory");
  const brandSelect = document.getElementById("prodBrand");

  catSelect.innerHTML = cats
    .map((c) => `<option value="${c.id}">${c.name}</option>`)
    .join("");
  brandSelect.innerHTML = brands
    .map((b) => `<option value="${b.id}">${b.name}</option>`)
    .join("");

  new bootstrap.Modal(document.getElementById("productModal")).show();
}

async function saveProduct() {
  const id = document.getElementById("prodId").value;
  const formData = new FormData();

  formData.append("name", document.getElementById("prodName").value);
  formData.append("sku", document.getElementById("prodSku").value);
  formData.append("price", document.getElementById("prodPrice").value);
  formData.append("stock_quantity", document.getElementById("prodStock").value);
  formData.append("status", document.getElementById("prodStatus").value);
  formData.append("category_id", document.getElementById("prodCategory").value);
  formData.append("brand_id", document.getElementById("prodBrand").value);
  formData.append("product_condition", "new");

  const fileInput = document.getElementById("prodImage");
  if (fileInput.files[0]) {
    formData.append("primary_image", fileInput.files[0]);
  }

  let url = `${API_ADMIN}/products`;
  if (id) {
    url = `${API_ADMIN}/products/${id}`;
    formData.append("_method", "PUT");
  }

  const res = await fetchAPI(url, {
    method: "POST",
    body: formData,
  });

  if (res) {
    Swal.fire("Thành công", "Đã lưu sản phẩm!", "success");
    bootstrap.Modal.getInstance(document.getElementById("productModal")).hide();
    loadProducts();
  }
}

// Đơn hàng
async function loadOrders() {
  const res = await fetchAPI(`${API_ADMIN}/order`);
  if (!res) return;

  let html = `
        <div class="card card-custom p-4">
            <table class="table table-custom table-hover">
                <thead>
                    <tr>
                        <th>Mã Đơn</th>
                        <th>Khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
    `;

  res.data.forEach((o) => {
    html += `
            <tr>
                <td>#${o.id}</td>
                <td>${o.user ? o.user.name : "Khách vãng lai"}</td>
                <td>${new Date(o.created_at).toLocaleDateString("vi-VN")}</td>
                <td>${formatCurrency(o.total || 0)}</td>
                <td>${getStatusBadge(o.status)}</td>
                <td>
                    <button class="btn btn-sm btn-outline-info" onclick="viewOrder(${
                      o.id
                    })">Chi tiết</button>
                </td>
            </tr>
        `;
  });

  html += `</tbody></table></div>`;
  document.getElementById("dynamicContent").innerHTML = html;
}

async function viewOrder(id) {
  const res = await fetchAPI(`${API_ADMIN}/order/${id}/status`);
  if (!res) return;
  const order = res.order;

  let itemsHtml = "";
  order.items.forEach((item) => {
    itemsHtml += `
            <tr>
                <td>${item.product_name || "Sản phẩm"}</td>
                <td>${item.quantity}</td>
                <td>${formatCurrency(item.price)}</td>
                <td>${formatCurrency(item.price * item.quantity)}</td>
            </tr>
        `;
  });

  document.getElementById("orderDetailContent").innerHTML = `
        <p><strong>Khách hàng:</strong> ${order.customer_name || "N/A"}</p>
        <p><strong>Địa chỉ:</strong> ${order.shipping_address || "N/A"}</p>
        <table class="table table-bordered mt-3">
            <thead><tr><th>Sản phẩm</th><th>SL</th><th>Đơn giá</th><th>Thành tiền</th></tr></thead>
            <tbody>${itemsHtml}</tbody>
        </table>
        <h5 class="text-end text-danger">Tổng: ${formatCurrency(
          order.total
        )}</h5>
    `;

  const btnUpdate = document.getElementById("btnUpdateStatus");
  btnUpdate.onclick = () => updateOrderStatus(order.id);
  document.getElementById("orderStatusSelect").value = order.status;

  new bootstrap.Modal(document.getElementById("orderModal")).show();
}

async function updateOrderStatus(id) {
  const newStatus = document.getElementById("orderStatusSelect").value;
  const res = await fetchAPI(`${API_ADMIN}/order/${id}/status`, {
    method: "PUT",
    body: JSON.stringify({ new_status: newStatus }),
  });

  if (res) {
    Swal.fire("Thành công", "Cập nhật trạng thái thành công!", "success");
    bootstrap.Modal.getInstance(document.getElementById("orderModal")).hide();
    loadOrders();
  }
}

// Các mục khác
async function loadCategories() {
  const res = await fetchAPI(`${API_BASE}/categories`);
  let html = `<div class="card card-custom p-4"><h4>Danh mục</h4><ul class="list-group">`;
  res.forEach((c) => {
    html += `<li class="list-group-item d-flex justify-content-between">
                    ${c.name} 
                    <button class="btn btn-sm btn-danger" onclick="deleteItem('categories', ${c.id})">Xóa</button>
                 </li>`;
  });
  html += `</ul></div>`;
  document.getElementById("dynamicContent").innerHTML = html;
}

async function loadBrands() {
  const res = await fetchAPI(`${API_BASE}/brands`);
  let html = `<div class="card card-custom p-4"><h4>Thương hiệu</h4><ul class="list-group">`;
  res.forEach((b) => {
    html += `<li class="list-group-item d-flex justify-content-between">
                    ${b.name}
                     <button class="btn btn-sm btn-danger" onclick="deleteItem('brands', ${b.id})">Xóa</button>
                 </li>`;
  });
  html += `</ul></div>`;
  document.getElementById("dynamicContent").innerHTML = html;
}

async function loadReviews() {
  const res = await fetchAPI(`${API_ADMIN}/reviews`);
  let html = `<div class="card card-custom p-4"><h4>Đánh giá sản phẩm</h4><ul class="list-group">`;
  res.data.forEach((r) => {
    html += `<li class="list-group-item">
                    <strong>${
                      r.user ? r.user.name : "Ẩn danh"
                    }</strong> đánh giá 
                    <span class="text-warning">${r.rating} sao</span> cho 
                    <strong>${r.product ? r.product.name : "SP cũ"}</strong>: 
                    <br> "${r.content}"
                    <div class="mt-2"><button class="btn btn-sm btn-outline-danger" onclick="deleteItem('reviews', ${
                      r.id
                    })">Xóa review này</button></div>
                 </li>`;
  });
  html += `</ul></div>`;
  document.getElementById("dynamicContent").innerHTML = html;
}

async function loadBlogs() {
  const res = await fetchAPI(`${API_ADMIN}/blogs`);
  let html = `
        <div class="card card-custom p-4">
            <h4>Quản lý Tin tức</h4>
            <table class="table table-custom">
                <thead><tr><th>Tiêu đề</th><th>Tác giả</th><th>Trạng thái</th><th>Hành động</th></tr></thead>
                <tbody>
    `;
  res.data.forEach((b) => {
    html += `<tr>
                    <td>${b.title}</td>
                    <td>${b.author ? b.author.name : "N/A"}</td>
                    <td>${getStatusBadge(b.status)}</td>
                    <td>
                        <button class="btn btn-sm btn-danger" onclick="deleteItem('blogs', ${
                          b.id
                        })">Xóa</button>
                        ${
                          b.status === "draft"
                            ? `<button class="btn btn-sm btn-success" onclick="publishBlog(${b.id})">Đăng ngay</button>`
                            : ""
                        }
                    </td>
                </tr>`;
  });
  html += `</tbody></table></div>`;
  document.getElementById("dynamicContent").innerHTML = html;
}

async function publishBlog(id) {
  await fetchAPI(`${API_ADMIN}/blogs/${id}/publish`, { method: "PUT" });
  loadBlogs();
}

async function deleteItem(type, id) {
  if (!confirm("Xóa mục này?")) return;
  let url = "";
  if (type === "reviews") url = `${API_ADMIN}/reviews/${id}`;
  else if (type === "categories") url = `${API_ADMIN}/categories/${id}`;
  else if (type === "brands") url = `${API_ADMIN}/brands/${id}`;
  else if (type === "products") url = `${API_ADMIN}/products/${id}`;
  else if (type === "blogs") url = `${API_ADMIN}/blogs/${id}`;

  const res = await fetchAPI(url, { method: "DELETE" });
  if (res) {
    alert("Đã xóa!");
    if (type === "reviews") loadReviews();
    if (type === "categories") loadCategories();
    if (type === "brands") loadBrands();
    if (type === "products") loadProducts();
    if (type === "blogs") loadBlogs();
  }
}

let revenueChartInstance = null;

async function loadDashboard() {
  document.getElementById("dynamicContent").innerHTML = `
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card card-custom p-3 bg-primary text-white">
                    <h3>Sản phẩm</h3>
                    <p>Quản lý kho hàng</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-custom p-3 bg-success text-white">
                    <h3>Đơn hàng</h3>
                    <p>Theo dõi vận chuyển</p>
                </div>
            </div>
             <div class="col-md-3">
                <div class="card card-custom p-3 bg-warning text-dark">
                    <h3>Tồn kho thấp</h3>
                    <p id="lowStockText">Đang kiểm tra...</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-custom p-3 bg-info text-white">
                    <h3>Tổng Doanh Thu</h3>
                    <h4 id="totalRevenueDisplay" class="fw-bold">0 đ</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-custom p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold text-secondary">Biểu đồ doanh thu</h5>
                        
                        <div class="d-flex gap-2">
                            <select class="form-select form-select-sm" onchange="renderRevenueChart(this.value)" style="width: 150px;">
                                <option value="week">7 ngày qua</option>
                                <option value="month" selected>30 ngày qua</option>
                                <option value="quarter">3 tháng qua (1 Quý)</option>
                                <option value="year">1 năm qua</option>
                            </select>
                            <button class="btn btn-sm btn-outline-primary" onclick="renderRevenueChart(document.querySelector('.form-select').value)">
                                <i class="fa-solid fa-sync"></i>
                            </button>
                        </div>
                    </div>
                    <div style="height: 400px;">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    `;

  checkLowStock();
  renderRevenueChart("month"); // Mặc định load 1 tháng
}

// Hàm vẽ biểu đồ (Có tham số range)
async function renderRevenueChart(range = "month") {
  const ctx = document.getElementById("revenueChart");
  if (!ctx) return;

  // 1. Gọi API kèm tham số range
  const res = await fetchAPI(`${API_ADMIN}/stats/revenue?range=${range}`);

  if (res) {
    // Cập nhật tổng tiền hiển thị
    document.getElementById("totalRevenueDisplay").textContent = formatCurrency(
      res.total_revenue
    );

    // 2. QUAN TRỌNG: Hủy biểu đồ cũ nếu đã tồn tại (để tránh lỗi vẽ chồng)
    if (revenueChartInstance) {
      revenueChartInstance.destroy();
    }

    // 3. Vẽ biểu đồ mới
    revenueChartInstance = new Chart(ctx, {
      type: "line",
      data: {
        labels: res.labels,
        datasets: [
          {
            label: `Doanh thu (${
              range === "year" ? "1 năm" : range === "week" ? "7 ngày" : "Tháng"
            })`,
            data: res.data,
            borderColor: "#4f46e5",
            backgroundColor: "rgba(79, 70, 229, 0.1)",
            borderWidth: 2,
            pointBackgroundColor: "#ffffff",
            pointBorderColor: "#4f46e5",
            pointRadius: 4,
            fill: true,
            tension: 0.3,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { position: "top" },
          tooltip: {
            callbacks: {
              label: function (context) {
                let label = context.dataset.label || "";
                if (label) label += ": ";
                if (context.parsed.y !== null) {
                  label += new Intl.NumberFormat("vi-VN", {
                    style: "currency",
                    currency: "VND",
                  }).format(context.parsed.y);
                }
                return label;
              },
            },
          },
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: function (value) {
                // Format trục Y gọn gàng
                if (value >= 1000000000) return value / 1000000000 + " tỷ";
                if (value >= 1000000) return value / 1000000 + " tr";
                return value / 1000 + " k";
              },
            },
          },
        },
      },
    });
  }
}

// --- INIT ---
document.addEventListener("DOMContentLoaded", () => {
  // Hiển thị tên Admin
  const userInfo = JSON.parse(localStorage.getItem("user_info"));
  if (userInfo) {
    document.getElementById("adminName").textContent = userInfo.name;
  }

  if (!getToken()) {
    Swal.fire({
      title: "Yêu cầu đăng nhập",
      text: "Vui lòng đăng nhập Admin.",
      icon: "warning",
    }).then(() => {
      window.location.href = "index.php";
    });
  } else {
    loadSection("dashboard", document.querySelector(".nav-link.active"));
    checkLowStock();
    setInterval(checkLowStock, 30000);
  }
});
