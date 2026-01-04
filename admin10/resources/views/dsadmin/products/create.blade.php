@extends('layouts.admin')

@section('page_title', 'Products')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0 fw-bold">إضافة منتج</h3>
            <small class="text-muted">أضف منتج جديد (واجهة فقط الآن)</small>
        </div>
        <a href="{{ url('/dsadmin/products') }}" class="btn btn-outline-secondary">رجوع</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            {{-- لاحقًا نحولها إلى form مرتبط بالباك اند --}}
            <form>
                <div class="mb-3">
                    <label class="form-label">اسم المنتج</label>
                    <input type="text" class="form-control" placeholder="مثال: iPhone 15 Pro">
                </div>

                <div class="mb-3">
                    <label class="form-label">الوصف</label>
                    <textarea class="form-control" rows="3" placeholder="وصف مختصر للمنتج"></textarea>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">السعر</label>
                        <input type="number" class="form-control" placeholder="1200">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">المخزون</label>
                        <input type="number" class="form-control" placeholder="15">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="button" class="btn btn-primary">حفظ (لاحقًا)</button>
                    <button type="reset" class="btn btn-outline-secondary">تفريغ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
