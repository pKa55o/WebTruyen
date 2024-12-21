@extends('layout')
@section('content')
<link rel="stylesheet" href="{{asset('css/giaodien.css')}}">
<div class="container2">
    <div class="left-content">
        <div class="duongdan">
            <a href="{{ route('home') }}">Trang chủ</a>
            <i class="fa-solid fa-angles-right" style="color: #808080;"></i>
            <a href="#">Thể loại</a>
            <i class="fa-solid fa-angles-right" style="color: #808080;"></i>
            <a href="#">{{ $truyen->ten_truyen }}</a>
        </div>

        <div class="thongtintruyen">
            <div class="titlecuatruyen">
                <span id="name">{{ $truyen->ten_truyen }}</span>
                <span id="dayupate">
                    <i>[Cập nhật lúc: {{ date('Y-m-d H:i:s', strtotime($truyen->updated_at)) }}]</i>
                </span>
            </div>

            <div class="noidung">
                <div class="anhtruyen">
                    <img src="{{ asset('storage/' . $truyen->thumbnail) }}" alt="ảnh">
                </div>
                <div class="big-thongtin">
                    <div class="thongtin">
                        <table>
                            <tr>
                                <td><span><i class="fa-solid fa-user"></i> Tác giả</span></td>
                                <td>
                                    <span>
                                        @if ($truyen->tac_gia)
                                        {{ $truyen->tac_gia }}
                                        @else
                                        Không rõ
                                        @endif
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><span><i class="fa fa-rss"></i> Tình trạng</span></td>
                                <td><span> {{$truyen->trang_thai}}</span></td>
                            </tr>
                            <tr>
                                <td><span><i class="fa-solid fa-tags"></i> Thể loại</span></td>
                                <td>
                                    @foreach ($truyen->categories as $category)
                                    <a href="#">
                                        {{ $category->name }}
                                    </a>
                                    @if (!$loop->last)-@endif
                                    @endforeach
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="buttonfunc">
                        <div class="line1">
                            <a href="#"><i class="fa-solid fa-heart" style="color: #ffffff;"></i> Theo dõi</a>
                            <span> 100 người theo dõi</span>
                        </div>
                        <div class="line2">
                            @if ($truyen->chapters->isNotEmpty())
                            <a
                                href="{{ route('chapter.show', ['chapter_id' => $truyen->chapters->first()->id, 'chapter' => $chapter]) }}">Chương
                                đầu</a>
                            <a
                                href="{{ route('chapter.show', ['chapter_id' => $truyen->chapters->last()->id, 'chapter' => $chapter]) }}">Chương
                                Cuối</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="noidungtruyen">
            <div class="titlenoidungtruyen">
                <span><i class="fa-regular fa-file-lines"></i> Nội dung truyện {{ $truyen->ten_truyen }} trên
                    TruyenTranh</span>
            </div>
            <div class="whitespace"></div>
            <div class="contenttruyen">
                <p>{{ $truyen->mo_ta }}</p>
            </div>
        </div>

        <div class="danhsachchuong">
            <div class="titledanhsach">
                <span><i class="fa-solid fa-bars"></i> Danh sách chương</span>
            </div>
            <div class="whitespace"></div>
            <div class="listchuong">
                <table class="chapter-table">
                    <thead>
                        <tr>
                            <th>Số chương</th>
                            <th>Cập nhật</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($truyen->chapters->isEmpty())
                        <tr>
                            <td colspan="2">Hiện chưa có chapter</td>
                        </tr>
                        @else
                        @foreach ($truyen->chapters->sortByDesc('updated_at') as $chapter)
                        <tr>
                            <td>
                                <a href="{{ route('chapter.show', ['chapter_id' => $chapter->id, 'chapter' => $chapter]) }}"
                                    class="chapter-link">
                                    Chapter {{ $chapter->chapter_number }}
                                </a>
                            </td>
                            <td>
                                @if ($chapter->updated_at)
                                {{ $chapter->updated_at->format('Y-m-d H:i:s') }}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endif
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