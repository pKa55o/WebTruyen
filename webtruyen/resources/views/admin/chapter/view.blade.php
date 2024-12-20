@extends('layout')

@section('content')

<link rel="stylesheet" href="/css/giaodien3.css">
<div class="truyentranh">
    @if(!empty($images))
    @foreach($images as $image)
    <div class="page-chapter">
        <img src="{{ $image }}" alt="Chapter Image" style="width: 100%; max-height: 100%;">
    </div>
    @endforeach
    @else
    <p class="notification">{{ $status }}</p>
    @endif
</div>

<div class="container2">
    <div class="maincontent">
        <div class="thongtinchinh">
            <div class="duongdan">
                <a href="{{ route('home') }}">Trang chủ</a>
                <i class="fa-solid fa-angles-right" style="color: #808080;"></i>
                <a href="{{ route('truyen.show', $truyen->id) }}">{{ $truyen->ten_truyen }}</a>
                <i class="fa-solid fa-angles-right" style="color: #808080;"></i>
                <a href="#">Chapter {{ $chapter->chapter_number }}</a>
            </div>
            <div class="tentruyen">
                <a href="{{ route('truyen.show', $truyen->id) }}">{{ $truyen->ten_truyen }}</a>
                <span id="sochapter"> - Chapter {{ $chapter->chapter_number }}</span>
                <span><i> [Cập nhật lúc: {{ $chapter->updated_at }}]</i></span>
            </div>
            <div class="huongdan">
                <span><i class="fa fa-info-circle"></i> <i>Sử dụng mũi tên trái (←) hoặc phải (→) để chuyển
                        chapter</i></span>
            </div>
            <div class="chucnang">
                <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
                <a href="{{ route('truyen.show', $truyen->id) }}"><i class="fa-solid fa-bars"></i></a>
                <a href="{{ route('chapter.show', ['chapter_id' => $chapter->id - 1, 'chapter' => $chapter]) }}"
                    id="buttonrollback"><i class="fa-solid fa-chevron-left" style="color: #ffffff;"></i></a>
                <select name="" id="" onchange="window.location.href=this.value">
                    @foreach($truyen->chapters as $chap)
                    <option value="{{ route('chapter.show', ['chapter_id' => $chap->id, 'chapter' => $chapter]) }}"
                        {{ $chap->id == $chapter->id ? 'selected' : '' }}>
                        Chapter {{ $chap->chapter_number }}
                    </option>
                    @endforeach
                </select>
                <a href="{{ route('chapter.show', ['chapter_id' => $chapter->id + 1, 'chapter' => $chapter]) }}"
                    id="buttonturnup"><i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i></a>
                <a href="#" id="theodoi"><i class="fa fa-heart"></i><span> Theo dõi</span></a>
            </div>
        </div>
        <div class="truyentranh">
            @if(!empty($images))
            @foreach($images as $image)
            <div class="page-chapter">
                <img src="{{ $image }}" alt="Chapter Image" style="width: 100%; max-height: 100%;">
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>

<div id="progress">
    <span id="progress-value">&#x1F815;</span>
</div>

<script src="/js/giaodien3.js"></script>
@endsection