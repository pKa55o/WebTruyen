@extends('admin.layout')

@section('content')

@include('admin.nav')
@if(session('success'))
<div class="alert alert-success mt-3">
    {{ session('success') }}
</div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Danh Sách Truyện') }}</div>
                <div class="card-body">
                    @if ($truyens->isEmpty())
                    <p>Không có truyện nào trong danh sách.</p>
                    @else
                    <ul class="list-group">
                        @foreach ($truyens as $truyen)
                        <li class="list-group-item">
                            <h5>{{ $truyen->ten_truyen }}</h5>
                            <p><strong>Tác giả:</strong> {{ $truyen->tac_gia ?? 'Không rõ' }}</p>
                            <p><strong>Trạng thái:</strong> {{ $truyen->trang_thai }}</p>
                            <p><strong>Thể loại:</strong>
                                @foreach ($truyen->categories as $category)
                                <span class="badge bg-secondary">{{ $category->name }}</span>
                                @endforeach
                            </p>
                            <p><strong>Mô tả:</strong> {{ $truyen->mo_ta }}</p>
                            <p><strong>Thumbnail:</strong></p>
                            <img src="{{ asset('storage/' . $truyen->thumbnail) }}" alt="Thumbnail"
                                style="max-width: 100px;">
                            <br>
                            <a href="{{ route('chapter.list', ['truyen_id' => $truyen->id]) }}"
                                class="btn btn-primary mt-3">Xem Chapters</a>
                            <a href="{{ route('truyen.edit', $truyen->id) }}" class="btn btn-warning mt-3">Cập nhật</a>
                            <form action="{{ route('truyen.destroy', $truyen->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mt-3"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa truyện này?')">Xóa</button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection