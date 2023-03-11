


<div class="grid" style="margin-top: 60px; background-color: #281E5D; padding: 10px 25px;">
        <div class="grid wide">
            <div class="row no-gutters">
                <div class="col l-3">
                    <div class="media">
                        <i class="fa-brands fa-2x fa-facebook"></i>
                        <i class="fa-brands fa-2x fa-instagram"></i>
                        <i class="fa-brands fa-2x fa-youtube"></i>
                        <i class="fa-brands fa-2x fa-tiktok"></i>
                    </div>
                </div>
                <?php
                    if(isset($user['username'])){
                ?>
                <div class="col l-3 l-o-1 special-discount">
                    <i class="fa-solid fa-envelope"></i>
                    <p>Khuyến mãi đặc biệt</p>
                </div>
                <?php        
                    }else{
                ?>
                <div class="col l-3 l-o-1 special-discount">
                    <i class="fa-solid fa-envelope"></i>
                    <p>Khuyến mãi đặc biệt ? Đăng kí ngay</p>
                </div>
                <?php
                }
                ?>
                <div class="col l-4 l-o-1">
                    <form action="" class="form-get-input-email">
                        <input type="text" placeholder="Nhập email nhận ngay ưu đãi..." name="text">
                        <button type="button">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="grid wide container">
        <div class="row" style="align-items: flex-start;">
            <div class="col l-4 location">
                <div class="logo">
                    <h2>
                        <span style="color: #281E5D;">DVN</span>
                        <span style="color: #B90E0A;">CellphoneS</span>
                    </h2>
                </div>
                <p>Công ty TNHH Thương Mại Công Nghệ DVN</p>
                <div style="margin-top: 12px;">
                    <div class="location-footer">
                        <i class="fa-solid fa-location-dot"></i>
                        <p style="font-weight: bold; font-size: 15px;">Địa chỉ: </p>
                        <p> 18 Trần Hưng Đạo, phường 5, quận 10, TP</p>
                        <p style="margin-top: 5px; margin-left: 25px;">Hồ Chí Minh</p>
                    </div>
                    <div class="phone-number-footer">
                        <i class="fa-solid fa-mobile-screen-button"></i>
                        <p style="font-weight: bold; font-size: 15px;">Số điện thoại:</p>
                        <p>1800.2366</p>
                    </div>
                    <div class="email-footer">
                        <i class="fa-solid fa-envelope"></i>
                        <p style="font-weight: bold; font-size: 15px;">Email:</p>
                        <p>dvncellphones@gmail.com.co</p>
                    </div>
                </div>
            </div>
            <div class="col l-2">
                <div class="info-footer">
                    <h3>Thông tin</h3>
                    <div>
                        <p>Hướng dẫn mua hàng online</p>
                        <p>Hướng dẫn mua hàng trả góp</p>
                        <p>Tìm hiểu thêm DVN CellphoneS</p>
                        <p>Tích điểm đổi quà</p>
                    </div>
                </div>
            </div>
            <div class="col l-2">
                <div class="policy-footer">
                    <h3>Chính sách</h3>
                    <div>
                        <p>Chính sách bảo hành</p>
                        <p>Quy định và hình thức thanh toán</p>
                        <p>Chính sách vận chuyển, giao nhận</p>
                        <p>Chính sách đổi trả hàng</p>
                        <p>Chính sách bảo mật</p>
                    </div>
                </div>
            </div>
            <div class="col l-4">
                <div class="row">
                    <div class="col l-12 online-order-footer">
                        <h3>Đặt hàng online giao hàng tận nơi</h3>
                        <div>
                            <p>HOTLINE:</p>
                            <p style="font-weight: bold; color: #0082F0; font-size: 16px;">1800.2366</p>
                            <p>(8h - 21h)</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col l-12 payment-method">
                        <h3>Phương thức thanh toán</h3>
                        <div>
                            <img src="images/visa-logo.png" alt="">
                            <img src="images/mastercard_logo.png" alt="">
                            <img src="images/MoMo_Logo.png" alt="">
                            <img src="images/vnpay_logo.jpg" alt="">
                        </div>
                        <img src="images/dathongbaobct.png" alt="" width=50%>
                    </div>
                </div>
            </div>
        </div>
    </div>
