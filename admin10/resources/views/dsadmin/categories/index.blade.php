@extends('layouts.admin')
@section('page_title', 'الأقسام')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0 fw-bold">الأقسام</h4>
        <small class="text-muted">إدارة أقسام المتجر</small>
    </div>
    <a href="{{ url('/dsadmin/categories/create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg ms-1"></i> إضافة قسم
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="row g-3">
            {{-- Cards ثابتة (UI فقط) --}}
            <div class="col-12 col-md-4">
                <div class="border rounded p-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="fw-bold">هواتف</div>
                            <small class="text-muted">12 منتج</small>
                        </div>
                        <span class="badge bg-primary">نشط</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="border rounded p-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="fw-bold">لابتوبات</div>
                            <small class="text-muted">7 منتجات</small>
                        </div>
                        <span class="badge bg-primary">نشط</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="border rounded p-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="fw-bold">إكسسوارات</div>
                            <small class="text-muted">22 منتج</small>
                        </div>
                        <span class="badge bg-secondary">مخفي</span>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>اسم القسم</th>
                        <th>الحالة</th>
                        <th class="text-end">إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>هواتف</td>
                        <td><span class="badge bg-success">نشط</span></td>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-outline-secondary">تعديل</a>
                            <a href="#" class="btn btn-sm btn-outline-danger">حذف</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>لابتوبات</td>
                        <td><span class="badge bg-success">نشط</span></td>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-outline-secondary">تعديل</a>
                            <a href="#" class="btn btn-sm btn-outline-danger">حذف</a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>إكسسوارات</td>
                        <td><span class="badge bg-secondary">مخفي</span></td>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-outline-secondary">تعديل</a>
                            <a href="#" class="btn btn-sm btn-outline-danger">حذف</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-3 text-muted small">واجهة فقط — لاحقًا نربطها بالقاعدة.</div>
    </div>
</div>
@endsection
