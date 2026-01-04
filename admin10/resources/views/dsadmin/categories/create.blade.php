@extends('layouts.admin')
@section('page_title', 'إضافة قسم')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0 fw-bold">إضافة قسم</h4>
        <small class="text-muted">إنشاء قسم جديد (واجهة فقط)</small>
    </div>
    <a href="{{ url('/dsadmin/categories') }}" class="btn btn-outline-secondary">رجوع</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form>
            <div class="mb-3">
                <label class="form-label">اسم القسم</label>
                <input type="text" class="form-control" placeholder="مثال: هواتف">
            </div>

            <div class="mb-3">
                <label class="form-label">الحالة</label>
                <select class="form-select">
                    <option>نشط</option>
                    <option>مخفي</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary">حفظ (لاحقًا)</button>
                <button type="reset" class="btn btn-outline-secondary">تفريغ</button>
            </div>
        </form>
    </div>
</div>
@endsection
