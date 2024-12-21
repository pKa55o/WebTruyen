@extends('layout')
@section('content')
<link rel="stylesheet" href="{{asset('css/giaodien.css')}}">
<div class="container2">
    <div class="left-content">
        <div class="duongdan">
            <a href="">Trang chủ</a><i class="fa-solid fa-angles-right" style="color: #808080;"></i><a href="">Thể
                loại</a><i class="fa-solid fa-angles-right" style="color: #808080;"></i><a href="">Mày Nói Gì Cơ?</a>
        </div>
        <div class="thongtintruyen">
            <div class="titlecuatruyen">
                <span id="name">Mày Nói Gì Cơ?</span>
                <span id="dayupate"><i>[Cập nhật lúc: 2024-11-21 14:55:46]</i></span>
            </div>
            <div class="noidung">
                <div class="anhtruyen">
                    <img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}" alt="ảnh">
                </div>
                <div class="big-thongtin">
                    <div class="thongtin">
                        <table>
                            <tr>
                                <td><span><i class="fa-solid fa-user"></i> Tác giả</span></td>
                                <td><span>Đang cập nhật</span></td>
                            </tr>
                            <tr>
                                <td><span><i class="fa fa-rss"> </i> Tình trạng</span></td>
                                <td><span>Đang tiến hành</span></td>
                            </tr>
                            <tr>
                                <td><span><i class="fa-solid fa-tags"></i> Thể loại</span></td>
                                <td><span><a href="">Hành động</a> - <a href="">Xuyên không</a></span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="buttonfunc">
                        <div class="line1">
                            <a href=""><i class="fa-solid fa-heart" style="color: #ffffff;"></i> Theo dõi</a>
                            <span>10 người theo dõi</span>
                        </div>
                        <div class="line2">
                            <a href="{{ route('giaodien3') }}">Đọc từ đầu</a><a href="">Đọc mới nhất</a><a href="">Đọc tiếp <i
                                    class="fa-solid fa-chevron-right" style="color: #ffffff;"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="noidungtruyen">
            <div class="titlenoidungtruyen">
                <span><i class="fa-regular fa-file-lines"></i> Nội dung truyện Mày Nói Cái Gì? trên TruyenTranh</span>
            </div>
            <div class="whitespace"></div>
            <div class="contenttruyen">
                <p>
                    Chào mừng bạn đến với TruyenTranh – không gian đọc truyện tranh online hoàn hảo dành cho tất cả các
                    fan truyện tranh!
                </p>
                <p>
                    <b>Trải nghiệm bộ truyện Mày Nói Cái Gì trên TruyenTranh – Hành trình đầy cảm xúc</b>
                </p>
                <p>
                    Bạn đang tìm kiếm một bộ truyện tranh vừa mang tính giải trí cao, vừa lôi cuốn với những tình tiết
                    sâu sắc? Hoặc đơn giản chỉ là một bộ truyện có tại TruyenTranh? Mày Nói Cái Gì là lựa chọn hoàn hảo
                    dành cho bạn. Được đăng tải và cập nhật liên tục trên TruyenTranh, đây là một trong những bộ truyện
                    nổi bật đang thu hút đông đảo người hâm mộ.
                </p>
            </div>
        </div>
        <div class="danhsachchuong">
            <div class="titledanhsach">
                <span><i class="fa-solid fa-bars"></i> Danh sách chương </span>
            </div>
            <div class="whitespace"></div>
            <div class="listchuong">
                <table>
                    <thead>
                        <th>Số chương <i class="fa-solid fa-caret-down"></i></th>
                        <th>Cập nhật</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td> Chapter 1 </td>
                            <td> 3 ngày trước </td>
                        </tr>
                        <tr>
                            <td> Chapter 2 </td>
                            <td>2 ngày trước </td>
                        </tr>
                        <tr>
                            <td> Chapter 3 </td>
                            <td> 1 ngày trước </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- <div class="commentlayout">
            <div class="titlecomment">
                <span>Bình luận</span>
            </div>
            <div class="commentcontent">
                <textarea name="" id="" rows="6" cols="4"></textarea>
                <a href="">Gửi</a>
            </div>
            <div class="morecomment">
                <a href="">Xem thêm bình luận</a>
            </div>
        </div> -->
        <div class="comments-section">
                <!-- Form thêm bình luận -->
                <div class="add-comment">
                  <h3>Thêm bình luận</h3>
                  <div class="textarea-container">
                    <textarea id="comment-input" placeholder="Nhập bình luận của bạn..."></textarea>
                    <div id="emoji-toolbar">
                      <!-- Các emoji phổ biến -->
                      <span class="emoji">😊</span> <span class="emoji">😂</span>
                      <span class="emoji">😍</span> <span class="emoji">😎</span>
                      <span class="emoji">😢</span> <span class="emoji">😡</span>
                      <span class="emoji">👍</span> <span class="emoji">🎉</span>
                    </div>
                  </div>
                  <button id="submit-comment">Gửi</button>
                </div>
              
                <!-- Khu vực hiển thị bình luận -->
                <div class="comments-list">
                  <h3>Bình luận</h3>
                  <ul id="comments-container">
                    <!-- Các bình luận sẽ được thêm vào đây -->
                  </ul>
                </div>
              </div>
    </div>
    <div class="right-content">
        <div class="themtruyen">
            <div class="titlethemtruyen">
                <span>Có thể quan tâm</span>
            </div>
            <div class="listtruyenthem">
                <div class="truyen">
                    <div class="anhtruyenthem">
                        <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}" alt=""></a>
                    </div>
                    <div class="thongtintruyenthem">
                        <a id="tentruyen" href="">Mày Nói Gì Cơ?</a>
                        <div class="small-thongtin">
                            <a href="">Chap 99</a>
                            <span>Views: 99</span>
                        </div>
                    </div>
                </div>
                <div class="truyen">
                    <div class="anhtruyenthem">
                        <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}" alt=""></a>
                    </div>
                    <div class="thongtintruyenthem">
                        <a id="tentruyen" href="">Mày Nói Gì Cơ?</a>
                        <div class="small-thongtin">
                            <a href="">Chap 99</a>
                            <span>Views: 99</span>
                        </div>
                    </div>
                </div>
                <div class="truyen">
                    <div class="anhtruyenthem">
                        <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}" alt=""></a>
                    </div>
                    <div class="thongtintruyenthem">
                        <a id="tentruyen" href="">Mày Nói Gì Cơ?</a>
                        <div class="small-thongtin">
                            <a href="">Chap 99</a>
                            <span>Views: 99</span>
                        </div>
                    </div>
                </div>
                <div class="truyen">
                    <div class="anhtruyenthem">
                        <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}" alt=""></a>
                    </div>
                    <div class="thongtintruyenthem">
                        <a id="tentruyen" href="">Mày Nói Gì Cơ?</a>
                        <div class="small-thongtin">
                            <a href="">Chap 99</a>
                            <span>Views: 99</span>
                        </div>
                    </div>
                </div>
                <div class="truyen">
                    <div class="anhtruyenthem">
                        <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}" alt=""></a>
                    </div>
                    <div class="thongtintruyenthem">
                        <a id="tentruyen" href="">Mày Nói Gì Cơ?</a>
                        <div class="small-thongtin">
                            <a href="">Chap 99</a>
                            <span>Views: 99</span>
                        </div>
                    </div>
                </div>
                <div class="truyen">
                    <div class="anhtruyenthem">
                        <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}" alt=""></a>
                    </div>
                    <div class="thongtintruyenthem">
                        <a id="tentruyen" href="">Mày Nói Gì Cơ?</a>
                        <div class="small-thongtin">
                            <a href="">Chap 99</a>
                            <span>Views: 99</span>
                        </div>
                    </div>
                </div>
                <div class="truyen">
                    <div class="anhtruyenthem">
                        <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}" alt=""></a>
                    </div>
                    <div class="thongtintruyenthem">
                        <a id="tentruyen" href="">Mày Nói Gì Cơ?</a>
                        <div class="small-thongtin">
                            <a href="">Chap 99</a>
                            <span>Views: 99</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/giaodien2.js')}}"></script>
@endsection