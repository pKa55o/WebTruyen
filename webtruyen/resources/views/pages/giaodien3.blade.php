@extends('layout')
@section('content')
<link rel="stylesheet" href="/css/giaodien3.css">
<div class="container2">
        <div class="maincontent">
            <div class="thongtinchinh">
                <div class="duongdan">
                    <a href="">Trang chủ</a><i class="fa-solid fa-angles-right" style="color: #808080;"></i><a href="">Thể loại</a><i class="fa-solid fa-angles-right" style="color: #808080;"></i><a href="">Mày Nói Gì Cơ?</a><i class="fa-solid fa-angles-right" style="color: #808080;"></i><a href="">Chapter 0</a>
                </div>
                <div class="tentruyen">
                    <a href="">Mày Nói Gì Cơ?</a><span id="sochapter"> - Chapter 0</span><span><i> [Cập nhật lúc: 2024-01-23 16:26:53]</i></span>
                </div>
                <div class="huongdan">
                    <span><i class="fa fa-info-circle"></i><i>Sử dụng mũi tên trái (←) hoặc phải (→) để chuyển chapter</i></span>
                </div>
                <div class="chucnang">
                    <a href=""><i class="fa-solid fa-house"></i></a>
                    <a href=""><i class="fa-solid fa-bars"></i></a>
                    <a href="" id="buttonrollback"><i class="fa-solid fa-chevron-left" style="color: #ffffff;"></i></a>
                    <select name="" id="">
                        <option value="">Chapter 0</option>
                        <option value="">Chapter 1</option>
                        <option value="">Chapter 2</option>
                        <option value="">Chapter 3</option>
                        <option value="">Chapter 4</option>
                        <option value="">Chapter 5</option>
                    </select>
                    <a href="" id="buttonturnup"><i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i></a>
                    <a href="" id="theodoi"><i class="fa fa-heart"></i><span> Theo dõi</span></a>
                </div>
            </div>
            <div class="truyentranh">
                <div class="page-chapter">
                    <img src="imgs/0.jpg" alt="">
                </div>
                <div class="page-chapter">
                    <img src="/imgs/4.jpg" alt="">
                </div>
                <div class="page-chapter">
                    <img src="/imgs/0.jpg" alt="">
                </div>
                <div class="page-chapter">
                    <imgs src="/imgs/4.jpg" alt="">
                </div>
                <div class="page-chapter">
                    <img src="/imgs/0.jpg" alt="">
                </div>
                <div class="page-chapter">
                    <img src="/imgs/4.jpg" alt="">
                </div>
                <div class="page-chapter">
                    <img src="/imgs/0.jpg" alt="">
                </div>
                <div class="page-chapter">
                    <img src="/imgs/4.jpg" alt="">
                </div>
                <div class="page-chapter">
                    <img src="/imgs/0.jpg" alt="">
                </div>
                <div class="page-chapter">
                    <img src="/imgs/4.jpg" alt="">
                </div>
                <div class="page-chapter">
                    <img src="/imgs/0.jpg" alt="">
                </div>
                <div class="page-chapter">
                    <img src="/imgs/4.jpg" alt="">
                </div>
                
            </div>
        </div>
    </div>
    <div id="progress">
        <span id="progress-value">&#x1F815;</span>
    </div>
    <div id="menuchapter">
        <div id="menuchucnang">
            <a href=""><i class="fa-solid fa-house"></i></a>
            <a href=""><i class="fa-solid fa-bars"></i></a>
            <a href="" id="buttonrollback"><i class="fa-solid fa-chevron-left" style="color: #ffffff;"></i></a>
            <select name="" id="">
                <option value="">Chapter 0</option>
                <option value="">Chapter 1</option>
                <option value="">Chapter 2</option>
                <option value="">Chapter 3</option>
                <option value="">Chapter 4</option>
                <option value="">Chapter 5</option>
            </select>
            <a href="" id="buttonturnup"><i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i></a>
            <a href="" id="menutheodoi"><i class="fa fa-heart"></i><span> Theo dõi</span></a>
        </div>
    </div>
    <script src="/js/giaodien3.js"></script>
@endsection