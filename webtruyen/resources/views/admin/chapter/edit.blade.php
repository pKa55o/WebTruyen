@extends('admin.layout')

@section('content-for')

<!-- Thông báo thành công -->
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<!-- Form chỉnh sửa Chapter -->
<div class="container">
    <h1>Chỉnh Sửa Chapter: {{ $chapter->ten_chapter }} (Truyện: {{ $truyen->ten_truyen }})</h1>
    <form
        action="{{ route('chapter.chapter_update', ['truyen_id' => $truyen->id, 'chapter_id' => $chapter->id, 'chapter' => $chapter]) }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Số Chapter -->
        <div class="form-group">
            <label for="chapter_number">Chapter:</label>
            <input type="number" name="chapter_number" id="chapter_number" class="form-control"
                value="{{ $chapter->chapter_number }}" required>
        </div>

        <!-- Tên Chapter -->
        <div class="form-group">
            <label for="ten_chapter">Tên Chapter:</label>
            <input type="text" name="ten_chapter" id="ten_chapter" class="form-control"
                value="{{ $chapter->ten_chapter }}" required>
        </div>

        <!-- Nội dung -->
        <div class="form-group">
            <label for="content">Cập Nhật Nội Dung (Chỉ Chấp Nhận File ZIP):</label>
            <input type="file" name="content" id="content" class="form-control-file" accept=".zip">
            <small class="text-muted">Để trống nếu không muốn thay đổi file.</small>
        </div>
        <button type="submit" class="btn btn-primary">Cập Nhật Chapter</button>
    </form>

</div>

@endsection