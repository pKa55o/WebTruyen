@extends('layout')
@section('content')
<?php 
$newestTruyens = collect($truyens)->sortByDesc('updated_at');
?>
<div class="main-content">
    <div class="de-cu">
        <div class="title-de-cu">
            <p>Dành cho bạn</p>
        </div>
        <div class="slider">
            <div class="list">
            </div>
            <div class="buttons">
                <button id="prev">&#60;</button>
                <button id="next">&#62;</button>
            </div>
        </div>
    </div>
    <div class="tiep-theo">
        <div class="list-truyen">
            <div class="title-de-cu">
                <p>Mới Cập Nhật</p>
            </div>
            <div class="danh-sach">
                @if ($truyens->isEmpty())
                <p>k lay dc truyen</p>
                @else
                @foreach ($truyens as $truyen)
                <div class="truyen">
                    <div class="img-truyen">
                        <a href="{{ route('infotruyen', ['truyen_id' => $truyen->id]) }}">
                            <img src="{{ asset('storage/' . $truyen->thumbnail) }}" alt="Thumbnail">
                        </a>
                    </div>
                    <div class="thong-tin-truyen">
                        <span>Views: {{ $truyen->views ?? 'N/A' }}</span>
                        <span>Likes: {{ $truyen->likes ?? 'N/A' }}</span>
                    </div>
                    <div class="ten-truyen">
                        <span><a
                                href="{{ route('infotruyen', ['truyen_id' => $truyen->id]) }}">{{ $truyen->ten_truyen }}</a></span>
                    </div>
                </div>
                @endforeach
                @endif
            </div>

            <div class="xephang">
                <div class="border-xephang">
                    <div class="title-xephang">
                        <span>Bảng Xếp Hạng</span>
                    </div>
                    <div class="type-xephang">
                        <button id="topday" onclick="showContent('topDay')" class="selected">Top ngày</button>
                        <button id="topweek" onclick="showContent('topWeek')">Top tuần</button>
                        <button id="topmonth" onclick="showContent('topMonth')">Top tháng</button>
                    </div>
                    <div class="list-xephang">
                        <div class="topContent" id="topDay">
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span style="color: red;">1</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span style="color: green;">2</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span style="color: rgb(255, 213, 0);">3</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span>4</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span>5</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span>6</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span>7</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span>8</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
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
                        <div class="topContent" id="topWeek">
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span style="color: red;">1</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ 2?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span style="color: green;">2</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ 2?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span style="color: rgb(255, 213, 0);">3</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ 2?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span>4</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ 2?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span>5</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ 2?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span>6</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ 2?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span>7</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ 2?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span>8</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ 2?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="topContent" id="topMonth">
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span style="color: red;">1</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ 3?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span style="color: green;">2</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ 3?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span style="color: rgb(255, 213, 0);">3</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ 3?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span>4</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ 3?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span>5</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ 3?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span>6</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ 3?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span>7</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ 3?</a>
                                    <div class="small-thongtin">
                                        <a href="">Chap 99</a>
                                        <span>Views: 99</span>
                                    </div>
                                </div>
                            </div>
                            <div class="truyen-ranking">
                                <div class="ranking">
                                    <span>8</span>
                                </div>
                                <div class="anhtruyenthem">
                                    <a href=""><img src="{{asset('imgs/ta-troi-sinh-da-la-nhan-vat-phan-dien.jpg')}}"
                                            alt=""></a>
                                </div>
                                <div class="thongtintruyenthem">
                                    <a id="tentruyen" href="">Mày Nói Gì Cơ 3?</a>
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
        </div>
    </div>

    @endsection