@extends('layouts.admin')

@section('page_title', 'إضافة منتج')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0 fw-bold">إضافة منتج</h3>
            <small class="text-muted">أضف منتج جديد للمتجر</small>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">رجوع</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            @if ($errors->any())
            <div class="alert alert-danger">
                <div class="fw-semibold mb-2">يوجد أخطاء:</div>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">القسم</label>
                    <select name="category_id" class="form-select">
                        <option value="">بدون قسم</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">اسم المنتج</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">الوصف</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">SKU (اختياري)</label>
                    <input type="text" name="sku" class="form-control" value="{{ old('sku') }}" placeholder="مثال: IP15PRO-256">
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">السعر</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">المخزون</label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock', 0) }}" required>
                    </div>
                </div>

                {{-- ✅ الصور --}}
                <div class="mb-3 mt-3">
                    <label class="form-label">صور المنتج (يمكن اختيار أكثر من صورة)</label>
                    <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                    <small class="text-muted">الحد الأقصى 2MB لكل صورة (jpg/png/webp)</small>
                </div>

                <input type="hidden" name="is_active" value="0">
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                    <label class="form-check-label" for="is_active">نشط</label>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <button type="reset" class="btn btn-outline-secondary">تفريغ</button>
                </div>
            </form>

        </div>
    </div>

</div>
@endsection