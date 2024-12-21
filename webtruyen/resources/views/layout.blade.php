<!-- header -->
<!DOCTYPE html>
<html lang="en">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- script -->
<script src="{{asset('js/trangchu.js')}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<?php 
use App\Models\Truyen;
$truyens = Truyen::all();
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WebTruyen</title>
    <link rel="stylesheet" href="{{asset('css/trangchu.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container1">
        <div class="title">
            <span><a href="{{route('homepage')}}">TruyenTranh</a> </span>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Tìm Kiếm" />
            <button type="submit" title="Search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
        <div id="auth-container">
            @guest
            <!-- Hiển thị nút Login nếu chưa đăng nhập -->
            <a href="{{ route('login') }}" class="auth-link">
                Đăng nhập
            </a>
            @if (Route::has('register'))
            <!-- Hiển thị nút Register nếu chưa đăng nhập -->
            <a href="{{ route('register') }}" class="auth-link">
                Đăng ký
            </a>
            @endif
            @else
            <!-- Hiển thị dropdown nếu đã đăng nhập -->
            <div class="dropdown">
                <a class="auth-link dropdown-toggle" href="#" role="button" onclick="toggleDropdown(event)">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu">
                    @if (Auth::user()->role === 'admin')
                    <!-- Hiển thị Management nếu role là admin -->
                    <a class="dropdown-item" href="{{ route('admin.home') }}">Management</a>
                    @endif
                    <!-- Hiển thị Logout cho mọi người dùng -->
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
            @endguest
        </div>
    </div>
    <nav class="menu-bar">
        <div class="big-navbar">
            <div class="title-menu">
                <a href="{{route('homepage')}}"><i class="fa-solid fa-house"></i></a>
            </div>
        </div>
        <div class="big-navbar">
            <div class="title-menu">
                <a href="">HOT</a>
            </div>
        </div>
        <div class="big-navbar">
            <div class="title-menu">
                <a href="">THEO DÕI</a>
            </div>
        </div>
        <div class="big-navbar">
            <div class="title-menu">
                <a href="">LỊCH SỬ</a>
            </div>
        </div>
        <div class="big-navbar">
            <div class="title-menu">
                <a href="">THỂ LOẠI</a>
            </div>
            <div class="content" id="content4">
                <table>
                    <tr>
                        <td><a href="">ngôn tình</a></td>
                        <td><a href="">đam mĩ</a></td>
                        <td><a href="">xuyên không</a></td>
                        <td><a href="">trinh thám</a></td>
                    </tr>
                    <tr>
                        <td><a href="">manga</a></td>
                        <td><a href="">manwha</a></td>
                        <td><a href="">manhua</a></td>
                        <td><a href="">anime</a></td>
                    </tr>
                    <tr>
                        <td><a href="">phiêu lưu</a></td>
                        <td><a href="">kinh dị</a></td>
                        <td><a href="">lãng mạn</a></td>
                        <td><a href="">thiếu nhi</a></td>
                    </tr>
                    <tr>
                        <td><a href="">horror</a></td>
                        <td><a href="">cooking</a></td>
                        <td><a href="">comedy</a></td>
                        <td><a href="">cổ đại</a></td>
                    </tr>
                    <tr>
                        <td><a href="">drama</a></td>
                        <td><a href="">webtoon</a></td>
                        <td><a href="">harem</a></td>
                        <td><a href="">thể thao</a></td>
                    </tr>
                    <tr>
                        <td><a href="">học đường</a></td>
                        <td><a href="">hành động</a></td>
                        <td><a href="">live action</a></td>
                        <td><a href="">khoa học viễn tưởng</a></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="big-navbar">
            <div class="title-menu">
                <a href="">XẾP HẠNG</a>
            </div>
            <div class="content2">
                <table>
                    <tr>
                        <td><a href="">Top All</a></td>
                        <td><a href="">Top Tháng</a></td>
                    </tr>
                    <tr>
                        <td><a href="">Top Tuần</a></td>
                        <td><a href="">Top Ngày</a></td>
                    </tr>
                    <tr>
                        <td><a href="">Top Follow</a></td>
                        <td><a href="">Truyện Full</a></td>
                    </tr>
                    <tr>
                        <td><a href="">Yêu Thích</a></td>
                        <td><a href="">Mới Cập Nhật</a></td>
                    </tr>
                    <tr>
                        <td><a href="">Truyện Mới</a></td>
                        <td><a href="">Số Chapter</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row fullwith-slider"></div>
        @yield('content')
    </div>

    <!-- footer -->
    <footer>
        <div class="copyright">
            <span>Bản quyền thuộc về © 2024 TruyenTranh</span>
            <span>Quý độc giả vui lòng không sao chép dưới mọi hình thức</span>
        </div>
        <div class="contact">
            <span><b>Mọi thông tin vui lòng liên hệ</b></span>
            <span>Email: truyentranh@gmail.com</span>
            <span>Zalo: 0999.999.xxx</span>
            <span>Facebook: facebook.com/truyentranh</span>
        </div>
    </footer>
</body>

</html>