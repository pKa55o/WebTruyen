@extends('admin.layout')

@section('content-for')
<!-- Thông báo thành công -->
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Thông Tin Truyện: ') }} {{ $truyen->ten_truyen }}</div>

                <div class="card-body">
                    <!-- Thông tin truyện -->
                    <p><strong>Tác giả:</strong> {{ $truyen->tac_gia ?? 'Không rõ' }}</p>
                    <p><strong>Trạng thái:</strong> {{ $truyen->trang_thai }}</p>
                    <p><strong>Mô tả:</strong> {{ $truyen->mo_ta }}</p>
                    <p><strong>Thumbnail:</strong></p>
                    <img src="{{ asset('storage/' . $truyen->thumbnail) }}" alt="Thumbnail" style="max-width: 100px;">
                    <hr>
                    <!-- Danh sách chương -->
                    <h5>Danh Sách Chương</h5>
                    @if($chapters->isEmpty())
                    <p>lỗi mảng</p>
                    @else
                    <ul class="list-group">
                        @foreach($chapters as $chapter)
                        <li class="list-group-item">
                            <p><strong>Chapter:</strong> {{ $chapter->chapter_number }}</p>
                            <p><strong>Tên Chapter:</strong> {{ $chapter->ten_chapter }}</p>
                            <!-- Nút Xem Chapter -->
                            <a href="{{ route('chapter.show', ['truyen_id' => $truyen->id, 'chapter_id' => $chapter->id, 'chapter' => $chapter]) }}"
                                class="btn btn-primary mt-3">Xem Chapter</a>
                            <!-- Nút Cập Nhật -->
                            <a href="{{ route('chapter.edit', ['truyen_id' => $truyen->id, 'chapter_id' => $chapter->id, 'chapter' => $chapter]) }}"
                                class="btn btn-warning mt-3">Cập nhật</a>
                            <!-- Form Xóa Chapter -->
                            <form action="{{ route('chapter.destroy', $chapter->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mt-3"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa chapter này?')">Xóa</button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                    @endif

                    <!-- Nút Thêm Chapter -->
                    <a href="{{ route('chapter.create_chapter', ['truyen_id' => $truyen->id]) }}"
                        class="btn btn-primary mt-3">Thêm Chapter Mới</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection