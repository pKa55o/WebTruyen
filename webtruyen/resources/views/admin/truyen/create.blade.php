@extends('admin.layout')

@section('content')

@include('admin.nav')
<!-- thông báo thêm truyện thành công -->
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="container">
    <div class="container">
        <h1>Thêm Truyện Mới</h1>
        <form action="{{ route('truyen.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Tên truyện -->
            <div class="form-group">
                <label for="ten_truyen">Tên Truyện:</label>
                <input type="text" name="ten_truyen" id="ten_truyen" class="form-control" required>
            </div>

            <!-- Tác giả -->
            <div class="form-group">
                <label for="tac_gia">Tác Giả:</label>
                <input type="text" name="tac_gia" id="tac_gia" class="form-control" required>
            </div>

            <!-- Trạng thái -->
            <div class="form-group">
                <label for="trang_thai">Trạng Thái:</label>
                <select name="trang_thai" id="trang_thai" class="form-control" required>
                    <option value="Đang cập nhật">Đang cập nhật</option>
                    <option value="Hoàn thành">Hoàn thành</option>
                </select>
            </div>

            <!-- Thể loại -->
            <div class="form-group">
                <label>Thể Loại:</label><br>
                @php
                $categories = [
                "Action", "Adventure", "Anime", "Chuyển Sinh", "Comedy", "Comic", "Cooking", "Cổ Đại",
                "Doujinshi", "Drama", "Đam Mỹ", "Fantasy", "Gender Bender", "Historical", "Horror",
                "Live Action", "Manga", "Manhua", "Manhwa", "Martial Arts", "Mecha", "Mystery",
                "Ngôn Tình", "Psychological", "Romance", "School Life", "Sci-fi", "Shoujo",
                "Shoujo Ai", "Shounen", "Shounen Ai", "Slice of Life", "Sports", "Supernatural",
                "Thiếu Nhi", "Tragedy", "Trinh Thám", "Truyện scan", "Truyện Màu", "Webtoon",
                "Xuyên Không", "Tu Tiên"
                ];
                @endphp
                @foreach ($categories as $category)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="the_loai[]" id="the_loai_{{ $loop->index }}"
                        value="{{ $category }}">
                    <label class="form-check-label" for="the_loai_{{ $loop->index }}">{{ $category }}</label>
                </div>
                @endforeach
            </div>

            <!-- Mô tả -->
            <div class="form-group">
                <label for="mo_ta">Mô Tả:</label>
                <textarea name="mo_ta" id="mo_ta" rows="5" class="form-control" required></textarea>
            </div>

            <!-- Thumbnail -->
            <div class="form-group">
                <label for="thumbnail">Ảnh Thumbnail (PNG, JPG):</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-control-file" accept=".png, .jpg, .jpeg"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">Thêm Truyện</button>
        </form>

    </div>
    @endsection