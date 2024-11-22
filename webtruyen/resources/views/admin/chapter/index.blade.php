@extends('admin.layout')

@section('content')

@include('admin.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Thông Tin Truyện: ') }} {{ $truyen->ten_truyen }}</div>

                <div class="card-body">
                    <!-- in4 truyện -->
                    <p><strong>Tác giả:</strong> {{ $truyen->tac_gia ?? 'Không rõ' }}</p>
                    <p><strong>Trạng thái:</strong> {{ $truyen->trang_thai }}</p>
                    <p><strong>ID:</strong> {{ $truyen->id  }}</p>
                    <p><strong>Mô tả:</strong> {{ $truyen->mo_ta }}</p>
                    <p><strong>Thumbnail:</strong></p>
                    <img src="{{ asset('storage/' . $truyen->thumbnail) }}" alt="Thumbnail" style="max-width: 100px;">
                    <hr>

                    <!-- list chap -->
                    <h5>Danh Sách Chương</h5>
                    @if($chapters->isEmpty())
                    <p>Hiện chưa có chương truyện nào</p>
                    @else
                    <ul class="list-group">
                        @foreach($chapters as $chapter)
                        <li class="list-group-item">
                            <p><strong>Chapter:</strong> {{ $chapter->chapter_number }} - {{ $chapter->ten_chapter }}
                            </p>
                            <p><strong>Ảnh Nội Dung:</strong> <img src="{{ asset('storage/' . $chapter->thumbnail) }}"
                                    alt="Thumbnail" style="max-width: 100px;"></p>
                            <p><strong>Mô tả:</strong> {{ $chapter->mo_ta }}</p>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                    <!-- tạo chap cho truyện -->
                    <!-- <a href="{{ route(RouteName::Chapter_create->value,['truyen_id' => $truyen->id]) }}"
                        class="btn btn-primary">Thêm
                        Chapter Mới</a>
                    <a href="{{ route(RouteName::Chapter_create->value, ['truyen_id' => $truyen->id]) }}"
                        class="btn btn-primary mt-3">Xem
                        Chapters</a </div> -->
                    <a href="{{ route('chapter.create_chapter', ['truyen_id' => $truyen->id]) }}"
                        class="btn btn-primary">Thêm
                        Chapter Mới</a>
                </div>
            </div>
        </div>
    </div>

    @endsection