<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./styles/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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
      <div class="swiper mySwiper" id="mainBanner">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="img/banner/action-cam.jpg" alt="Action Cam">
            </div>
            <div class="swiper-slide">
                <img src="img/banner/t5-2024-flycam.png" alt="Flycam">
            </div>
            <div class="swiper-slide">
                <img src="img/banner/t5-2024-thu-cu-doi-moi.png" alt="Thu Cu Doi Moi">
            </div>
            <div class="swiper-slide">
                <img src="img/banner/banner-web-desktop-oa5pro.jpg" alt="Banner Web">
            </div>
        </div>
        
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        
        <div class="swiper-pagination"></div>
      </div>
      <div id="main">
        <div class="headline">
          <div class="line"></div>
          <span class="text">TOP Sản Phẩm Bán Chạy</span>
          <div class="line"></div>
        </div>

        <div id="products">
          <ul class="product">
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="product-detail.php?id=11" class="product-thumb">
                    <img src="./img/Flycam/DJI-Neo-8-247x296.jpg" alt="" />
                  </a>
                  <a href="product-detail.php?id=11" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="" class="product-name">DJI Neo</a>
                  <div class="product-discount-price">5,110,000đ</div>
                  <div class="product-price">4,810,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="product-detail.php?id=17" class="product-thumb">
                    <img
                      src="./img/Action-360 Camera/Insta360-X5-Essentials-Bundle-2-1-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="product-detail.php?id=17" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="product-detail.php?id=17" class="product-name"
                    >Insta360 X5 (Essentials Bundle)</a
                  >
                  <div class="product-price">16,800,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="product-detail.php?id=18" class="product-thumb">
                    <img
                      src="./img/Camera/Sony/Sony-ZV-E10-II-Lens-16-50mm-1-247x296.jpg"
                      alt="" 
                    />
                  </a>
                  <a href="product-detail.php?id=18" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="product-detail.php?id=18" class="product-name"
                    >Sony ZV-E10 + Lens 16-55mm F3.5-5.6</a
                  >
                  <div class="product-discount-price">18,990,000đ</div>
                  <div class="product-price">17,490,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="product-detail.php?id=19" class="product-thumb">
                    <img
                      src="./img/Camera/Sony/Sony-a6700-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="product-detail.php?id=19" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="product-detail.php?id=19" class="product-name"
                    >Sony a6700 Mirrorless Camera(Body Only)</a
                  >
                  <div class="product-discount-price">35,490,000đ</div>
                  <div class="product-price">34,490,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="product-detail.php?id=20" class="product-thumb">
                    <img
                      src="./img/Action-360 Camera/Insta360-X5-7-1-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="product-detail.php?id=20" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="product-detail.php?id=20" class="product-name">Insta360 X5</a>
                  <div class="product-price">10,590,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="product-detail.php?id=21" class="product-thumb">
                    <img
                      src="./img/accessory/DJI-Mini-3-Propellers-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="product-detail.php?id=21" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="product-detail.php?id=21" class="product-name">DJI Mini3 Propeller</a>
                  <div class="product-price">200,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="product-detail.php?id=22" class="product-thumb">
                    <img
                      src="./img/Gimbal/dji-rs-4-mini-5-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="product-detail.php?id=22" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="product-detail.php?id=22" class="product-name">DJI RSMini 5</a>
                  <div class="product-discount-price">7,499,000đ</div>
                  <div class="product-price">7,000,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="product-detail.php?id=23" class="product-thumb">
                    <img
                      src="./img/accessory/Hub-Sac-Pin-Hai-Chieu-DJI-Neo-1-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="product-detail.php?id=23" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="product-detail.php?id=23" class="product-name">Hub Sạc DJI Neo 1</a>
                  <div class="product-discount-price">1,250,000đ</div>
                  <div class="product-price">980,000đ</div>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="headline-Product">
          <span class="text-product">Camera</span>
          <div class="line-product-last"></div>
        </div>

        <div class="custom-banner">
          <img src="img/banner-mayanh.jpg" alt="Custom Banner" class="d-block w-100">
        </div>
        <div id="products">
          <ul class="product">
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="product-detail.php?id=5" class="product-thumb">
                    <img src="./img/Camera/Fujifilm/FUJIFILM-X-H2-1-247x296.jpg" alt="" />
                  </a>
                  <a href="product-detail.php?id=5" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="product-detail.php?id=5" class="product-name">Fujifilm XH2</a>
                  <div class="product-price">12,810,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="" class="product-thumb">
                    <img
                      src="./img/Camera/Nikon/Nikon-Z8-1-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="" class="product-name"
                    >Nikon Z8</a
                  >
                  <div class="product-price">32,990,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="" class="product-thumb">
                    <img
                      src="./img/Camera/Sony/Sony-ZV-E10-II-Lens-16-50mm-1-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="" class="product-name"
                    >Sony ZV-E10 + Lens 16-55mm F3.5-5.6</a
                  >
                  <div class="product-discount-price">18,990,000đ</div>
                  <div class="product-price">17,490,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="" class="product-thumb">
                    <img
                      src="./img/Camera/Sony/Sony-a6700-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="" class="product-name"
                    >Sony a6700 Mirrorless Camera(Body Only)</a
                  >
                  <div class="product-discount-price">35,490,000đ</div>
                  <div class="product-price">34,490,000đ</div>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="headline-Product">
          <span class="text-product">FlyCam</span>
          <div class="line-product-last"></div>
        </div>
        <div class="custom-banner">
          <img src="./img/banner/banner-tokyocamera-1.jpg" alt="Custom Banner" class="d-block w-100">
        </div>
        <div id="products">
          <ul class="product">
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="product-detail.php?id=11" class="product-thumb">
                    <img src="./img/Flycam/DJI-Neo-8-247x296.jpg" alt="" />
                  </a>
                  <a href="product-detail.php?id=11" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="product-detail.php?id=11" class="product-name">DJI Neo</a>
                  <div class="product-discount-price">5,110,000đ</div>
                  <div class="product-price">4,810,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="product-detail.php?id=14" class="product-thumb">
                    <img
                      src="./img/Flycam/FPV-Combo-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="product-detail.php?id=14" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="product-detail.php?id=14" class="product-name"
                    >FPV Combo</a
                  >
                  <div class="product-discount-price">12,200,000đ</div>
                  <div class="product-price">10,000,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="product-detail.php?id=16" class="product-thumb">
                    <img
                      src="./img/Flycam/mavic-3-cine-tokyocamera-1-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="product-detail.php?id=16" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="product-detail.php?id=16" class="product-name"
                    >Mavic 3</a
                  >
                  <div class="product-price">35,490,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="product-detail.php?id=9" class="product-thumb">
                    <img
                      src="./img/Flycam/DJI-Avata-2-Flying-Kit-Phien-ban-pin-don-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="product-detail.php?id=9" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="product-detail.php?id=9" class="product-name"
                    >DJI Avata2</a
                  >
                  <div class="product-discount-price">20,990,000đ</div>
                  <div class="product-price">17,490,000đ</div>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="headline-Product">
          <span class="text-product">Gimbal</span>
          <div class="line-product-last"></div>
        </div>

        <div class="custom-banner">
          <img src="./img/banner/banner-tokyocamera-6.jpg" alt="Custom Banner" class="d-block w-100">
        </div>
        <div id="products">
          <ul class="product">
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="" class="product-thumb">
                    <img src="./img/Gimbal/DJI-Osmo-Mobile-7-6-247x296.jpg" alt="" />
                  </a>
                  <a href="" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="" class="product-name">DJI Osmo Mobile 7</a>
                  <div class="product-discount-price">4,110,000đ</div>
                  <div class="product-price">4,000,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="" class="product-thumb">
                    <img
                      src="./img/Gimbal/DJI-RS-4-Pro-Tokyo-Camera-1-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="" class="product-name"
                    >RS4</a
                  >
                  <div class="product-price">5,000,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="" class="product-thumb">
                    <img
                      src="./img/Gimbal/insta360-flow-2-pro-creator-bundle-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="" class="product-name"
                    >Insta360 Flow 2 Pro</a
                  >
                  <div class="product-discount-price">9,990,000đ</div>
                  <div class="product-price">8,490,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="" class="product-thumb">
                    <img
                      src="./img/Gimbal/DJI-RS-3-Mini-6-Tokyo-Camera-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="" class="product-name"
                    >RS3</a
                  >
                  <div class="product-discount-price">2,200,000đ</div>
                  <div class="product-price">1,490,000đ</div>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="headline-Product">
          <span class="text-product">Action-360 Camera</span>
          <div class="line-product-last"></div>
        </div>

        <div class="custom-banner">
          <img src="./img/banner/banner-tokyocamera-4.jpg" alt="Custom Banner" class="d-block w-100">
        </div>
        <div id="products">
          <ul class="product">
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="" class="product-thumb">
                    <img src="./img/Action-360 Camera/GoPro-Hero-13-Black-1-247x296.jpg" alt="" />
                  </a>
                  <a href="" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="" class="product-name">Gopro Hero 3(Black)</a>
                  <div class="product-discount-price">15,110,000đ</div>
                  <div class="product-price">14,810,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="" class="product-thumb">
                    <img
                      src="./img/Action-360 Camera/insta360-connect-9-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="" class="product-name"
                    >Insta360 Conect 9</a
                  >
                  <div class="product-price">2,000,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="" class="product-thumb">
                    <img
                      src="./img/Action-360 Camera/Insta360-X5-flexicare-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="" class="product-name"
                    >Insta360 X5 Flexica</a
                  >
                  <div class="product-discount-price">20,590,000đ</div>
                  <div class="product-price">19,490,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="" class="product-thumb">
                    <img
                      src="./img/Action-360 Camera/GoPro-Hero-12-Black-1-1-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="" class="product-name"
                    >Gopro Hero 12</a
                  >
                  <div class="product-discount-price">10,490,000đ</div>
                  <div class="product-price">9,490,000đ</div>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="headline-Product">
          <span class="text-product">Phụ Kiện</span>
          <div class="line-product-last"></div>
        </div>

        <div class="custom-banner">
          <img src="./img/banner/1.jpg" alt="Custom Banner" class="d-block w-100">
        </div>
        <div id="products">
          <ul class="product">
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="" class="product-thumb">
                    <img src="./img/accessory/1-247x296.png" alt="" />
                  </a>
                  <a href="" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="" class="product-name">Insta360 X2 Lens</a>
                  <div class="product-price">590,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="" class="product-thumb">
                    <img
                      src="./img/accessory/dji-goggles-n3-10-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="" class="product-name"
                    >DJI Goggles</a
                  >
                  <div class="product-price">12,000,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="" class="product-thumb">
                    <img
                      src="./img/accessory/Hub-Sac-Pin-Hai-Chieu-DJI-Neo-1-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="" class="product-name"
                    >Hub Sạc DJI Neo 1</a
                  >
                  <div class="product-discount-price">1,250,000đ</div>
                  <div class="product-price">980,000đ</div>
                </div>
              </div>
            </li>
            <li>
              <div class="product-items">
                <div class="product-top">
                  <a href="" class="product-thumb">
                    <img
                      src="./img/accessory/Saramonic-Ultra-247x296.jpg"
                      alt=""
                    />
                  </a>
                  <a href="" class="buy-now">Mua Ngay</a>
                </div>
                <div class="product-info">
                  <a href="" class="product-name"
                    >Saramonic Ultra</a
                  >
                  <div class="product-price">1,000,000đ</div>
                </div>
              </div>
            </li>
          </ul>
        </div>
        </div>
      
      <section class="letter">
        <div class="letter-content">
          <div class="letter-text">
            <h2>Đăng Kí Nhận Bản Tin</h2>
            <p>Để nhận thông tin mới nhất từ KL Camera</p>
          </div>
          <form class="letter-form" action="#" method="POST">
            <input type="email" placeholder="Nhập địa chỉ email của bạn" required />
            <button type="submit">Đăng Kí</button>
          </form>
        </div>
      </section>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  </body>
    <footer class="footer">
        <div class="footer-main">
          <div class="footer-left">
            <img src="img/Logo.png" alt="KL Camera" class="footer-logo" />
            <p>KL Camera – Đồ án website bán máy ảnh, flycam, phụ kiện cuối kỳ môn học thực hành nhập môn web</p>
          </div>
          <div class="footer-info">
            <h4>Thông tin</h4>
            <p>Địa chỉ: 180 Cao Lỗ, Phường 4, Quận 8, TP Hồ Chí Minh</p>
            <p>Email: DH52200971@student.stu.edu.vn</p>
            <p>Điện thoại: (028) 38 505 520</p>
          </div>
          <div class="footer-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.954342044612!2d106.67525717451676!3d10.738002459902354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f62a90e5dbd%3A0x674d5126513db295!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgU8OgaSBHw7Ju!5e0!3m2!1svi!2sus!4v1747419904719!5m2!1svi!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>

        <div class="footer-bottom">
          <p>
            Họ và tên: Trần Kiêm Lâm | MSSV: DH52200971 | Lớp: D22_TH05 | Nhóm 12 Thứ 3 Ca 44
          </p>
        </div>
      </footer>
    </div>
</html>
