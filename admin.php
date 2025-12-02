<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - KL Camera</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="./styles/admin.css">
</head>
<body>

    <div id="loadingOverlay">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <nav class="sidebar">
        <div class="sidebar-header">
            <i class="fa-solid fa-camera-retro me-2"></i> KL Camera Admin
        </div>
        <div class="d-flex flex-column py-3">
            <a class="nav-link active" onclick="loadSection('dashboard', this)">
                <i class="fa-solid fa-chart-line"></i> Dashboard
            </a>
            <a class="nav-link" onclick="loadSection('orders', this)">
                <i class="fa-solid fa-shopping-cart"></i> Đơn hàng
            </a>
            <a class="nav-link" onclick="loadSection('products', this)">
                <i class="fa-solid fa-box-open"></i> Sản phẩm
            </a>
            <a class="nav-link" onclick="loadSection('categories', this)">
                <i class="fa-solid fa-list"></i> Danh mục
            </a>
            <a class="nav-link" onclick="loadSection('brands', this)">
                <i class="fa-solid fa-copyright"></i> Thương hiệu
            </a>
            <a class="nav-link" onclick="loadSection('reviews', this)">
                <i class="fa-solid fa-star"></i> Đánh giá
            </a>
            <a class="nav-link" onclick="loadSection('blogs', this)">
                <i class="fa-solid fa-newspaper"></i> Tin tức (Blog)
            </a>
             <div class="mt-auto border-top pt-3">
                <a class="nav-link text-danger" onclick="logout()">
                    <i class="fa-solid fa-sign-out-alt"></i> Đăng xuất
                </a>
            </div>
        </div>
    </nav>

    <header class="top-header">
        <h5 class="m-0 text-secondary" id="pageTitle">Tổng quan</h5>
        <div class="d-flex align-items-center gap-3">
            <div class="notification-btn text-secondary" onclick="showNotifications()">
                <i class="fa-regular fa-bell fa-lg"></i>
                <span class="badge rounded-pill bg-danger badge-count" id="notifCount" style="display:none;">0</span>
            </div>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=random" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong id="adminName">Admin</strong>
                </a>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div id="dynamicContent">
            </div>
    </main>

    <div class="modal fade" id="notifModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cảnh báo tồn kho thấp</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="notifList">
                    </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Quản lý sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="productForm">
                        <input type="hidden" id="prodId">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="prodName" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mã SKU</label>
                                <input type="text" class="form-control" id="prodSku" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Giá bán</label>
                                <input type="number" class="form-control" id="prodPrice" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tồn kho</label>
                                <input type="number" class="form-control" id="prodStock" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Trạng thái</label>
                                <select class="form-select" id="prodStatus">
                                    <option value="active">Đang bán</option>
                                    <option value="inactive">Ngừng bán</option>
                                </select>
                            </div>
                        </div>
                         <div class="row">
                             <div class="col-md-6 mb-3">
                                <label class="form-label">Danh mục</label>
                                <select class="form-select" id="prodCategory"></select>
                            </div>
                             <div class="col-md-6 mb-3">
                                <label class="form-label">Thương hiệu</label>
                                <select class="form-select" id="prodBrand"></select>
                            </div>
                         </div>
                        <div class="mb-3">
                            <label class="form-label">Ảnh chính</label>
                            <input type="file" class="form-control" id="prodImage" accept="image/*">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" onclick="saveProduct()">Lưu sản phẩm</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="orderModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chi tiết đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="orderDetailContent">
                    </div>
                <div class="modal-footer">
                    <div class="input-group w-50">
                        <select class="form-select" id="orderStatusSelect">
                            <option value="pending">Chờ xử lý</option>
                            <option value="confirmed">Đã xác nhận</option>
                            <option value="processing">Đang đóng gói</option>
                            <option value="shipping">Đang giao</option>
                            <option value="delivered">Đã giao</option>
                            <option value="failed">Đã hủy</option>
                        </select>
                        <button class="btn btn-primary" id="btnUpdateStatus">Cập nhật trạng thái</button>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./js/admin.js"></script>
    
</body>
</html>