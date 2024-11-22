@extends('admin.layout')

@section('content')

@include('admin.nav')
<!-- thông báo add truyện -->
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="container">
    <div class="container">
        <h1>Cập Nhật Truyện: {{ $truyen->ten_truyen }}</h1>
        <form action="{{ route('truyen.update', $truyen->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- tên -->
            <div class="form-group">
                <label for="ten_truyen">Tên Truyện:</label>
                <input type="text" name="ten_truyen" id="ten_truyen" class="form-control"
                    value="{{ $truyen->ten_truyen }}" required>
            </div>

            <!-- tgia -->
            <div class="form-group">
                <label for="tac_gia">Tác Giả:</label>
                <input type="text" name="tac_gia" id="tac_gia" class="form-control" value="{{ $truyen->tac_gia }}"
                    required>
            </div>

            <!-- stt -->
            <div class="form-group">
                <label for="trang_thai">Trạng Thái:</label>
                <select name="trang_thai" id="trang_thai" class="form-control" required>
                    <option value="Đang cập nhật" {{ $truyen->trang_thai == 'Đang cập nhật' ? 'selected' : '' }}>
                        Đang cập nhật</option>
                    <option value="Hoàn thành" {{ $truyen->trang_thai == 'Hoàn thành' ? 'selected' : '' }}>Hoàn
                        thành</option>
                </select>
            </div>

            <!-- genre -->
            <div class="form-group">
                <label>Thể Loại:</label><br>
                @foreach ($categories as $category)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="the_loai[]" id="the_loai_{{ $category->id }}"
                        value="{{ $category->name }}" @if(in_array($category->name, json_decode($truyen->the_loai, true)
                    ?? [])) checked @endif>
                    <label class="form-check-label" for="the_loai_{{ $category->id }}">{{ $category->name }}</label>
                </div>
                @endforeach
            </div>

            <!-- mô tả -->
            <div class="form-group">
                <label for="mo_ta">Mô Tả:</label>
                <textarea name="mo_ta" id="mo_ta" rows="5" class="form-control" required>{{ $truyen->mo_ta }}</textarea>
            </div>

            <!-- thumbnail -->
            <div class="form-group">
                <label for="thumbnail">Ảnh Thumbnail (PNG, JPG):</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-control-file" accept=".png, .jpg, .jpeg">
                @if($truyen->thumbnail)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $truyen->thumbnail) }}" alt="Thumbnail" style="max-width: 100px;">
                </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật Truyện</button>
        </form>

    </div>
</div>
@endsection