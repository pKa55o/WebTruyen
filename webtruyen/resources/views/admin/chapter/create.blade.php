@extends('admin.layout')

@section('content')

@include('admin.nav')

<div class="container">
    <h1>Thêm Chapter Mới cho Truyện: {{ $truyen->ten_truyen }}</h1>

    <!-- Form gửi dữ liệu -->
    <form action="{{ route('chapter.create_store', ['truyen_id' => $truyen->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <!-- Số Chapter -->
        <div class="form-group">
            <label for="chapter_number">Chapter :</label>
            <input type="number" name="chapter_number" id="chapter_number" class="form-control" required>
        </div>

        <!-- Tên Chapter -->
        <div class="form-group">
            <label for="ten_chapter">Tên Chapter:</label>
            <input type="text" name="ten_chapter" id="ten_chapter" class="form-control" required>
        </div>

        <!-- Nội dung -->
        <div class="form-group">
            <label for="content">Nội dung (File ZIP):</label>
            <input type="file" name="content" id="content" class="form-control-file" accept=".zip, .rar, .jpg, .png"
                required>
        </div>

        <button type="submit" class="btn btn-primary">Thêm Chapter</button>
    </form>
</div>

@endsection