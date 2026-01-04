@extends('layouts.admin')

@section('page_title', 'لوحة التحكم')

@section('content')
<div class="container-fluid">

    {{-- Top Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
        <div>
            <h3 class="mb-1 fw-bold">لوحة التحكم</h3>
            <div class="text-muted">
                مرحبًا <span class="fw-semibold">{{ Auth::user()->name ?? 'بك' }}</span> 👋
                <span class="mx-1">•</span>
                نظرة سريعة على أداء المتجر اليوم
            </div>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ url('/dsadmin/products/create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg ms-1"></i> إضافة منتج
            </a>
            <a href="{{ url('/dsadmin/orders') }}" class="btn btn-outline-dark">
                <i class="bi bi-receipt ms-1"></i> عرض الطلبات
            </a>
        </div>
    </div>

    {{-- Status --}}
    @if (session('status'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <span class="me-2">✅</span>
            <div>{{ session('status') }}</div>
        </div>
    @endif

    {{-- KPIs --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small">مبيعات اليوم</div>
                            <div class="fs-4 fw-bold">$ 2,450</div>
                            <div class="small text-success mt-1">
                                <i class="bi bi-graph-up ms-1"></i> +12% عن أمس
                            </div>
                        </div>
                        <div class="rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center"
                             style="width:44px;height:44px;">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 pt-0">
                    <div class="progress" style="height:6px;">
                        <div class="progress-bar" role="progressbar" style="width:72%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small">طلبات اليوم</div>
                            <div class="fs-4 fw-bold">18</div>
                            <div class="small text-muted mt-1">
                                <span class="badge bg-warning text-dark">5 قيد المعالجة</span>
                            </div>
                        </div>
                        <div class="rounded-circle bg-warning-subtle text-warning d-flex align-items-center justify-content-center"
                             style="width:44px;height:44px;">
                            <i class="bi bi-receipt"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 pt-0">
                    <div class="progress" style="height:6px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width:45%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small">العملاء</div>
                            <div class="fs-4 fw-bold">1,204</div>
                            <div class="small text-primary mt-1">
                                <i class="bi bi-person-plus ms-1"></i> +8 عملاء هذا الأسبوع
                            </div>
                        </div>
                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center"
                             style="width:44px;height:44px;">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 pt-0">
                    <div class="progress" style="height:6px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width:64%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted small">المنتجات</div>
                            <div class="fs-4 fw-bold">86</div>
                            <div class="small text-danger mt-1">
                                <i class="bi bi-exclamation-triangle ms-1"></i> 6 قليلة المخزون
                            </div>
                        </div>
                        <div class="rounded-circle bg-danger-subtle text-danger d-flex align-items-center justify-content-center"
                             style="width:44px;height:44px;">
                            <i class="bi bi-box-seam"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 pt-0">
                    <div class="progress" style="height:6px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width:28%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Grid --}}
    <div class="row g-3">

        {{-- Latest Orders --}}
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <div class="fw-bold">آخر الطلبات</div>
                    <a href="{{ url('/dsadmin/orders') }}" class="small text-decoration-none">عرض الكل</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>رقم</th>
                                    <th>العميل</th>
                                    <th>المجموع</th>
                                    <th>الحالة</th>
                                    <th class="text-end">التاريخ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#1008</td>
                                    <td>أحمد</td>
                                    <td>$1500</td>
                                    <td><span class="badge bg-warning text-dark">قيد المعالجة</span></td>
                                    <td class="text-end text-muted">{{ now()->format('Y-m-d') }}</td>
                                </tr>
                                <tr>
                                    <td>#1007</td>
                                    <td>سارة</td>
                                    <td>$650</td>
                                    <td><span class="badge bg-success">مكتمل</span></td>
                                    <td class="text-end text-muted">{{ now()->subDay()->format('Y-m-d') }}</td>
                                </tr>
                                <tr>
                                    <td>#1006</td>
                                    <td>محمد</td>
                                    <td>$299</td>
                                    <td><span class="badge bg-danger">ملغي</span></td>
                                    <td class="text-end text-muted">{{ now()->subDays(2)->format('Y-m-d') }}</td>
                                </tr>
                                <tr>
                                    <td>#1005</td>
                                    <td>ريم</td>
                                    <td>$120</td>
                                    <td><span class="badge bg-primary">جديد</span></td>
                                    <td class="text-end text-muted">{{ now()->subDays(3)->format('Y-m-d') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3 d-flex gap-2">
                        <a href="{{ url('/dsadmin/orders') }}" class="btn btn-outline-dark btn-sm">
                            <i class="bi bi-receipt ms-1"></i> إدارة الطلبات
                        </a>
                        <a href="{{ url('/dsadmin/customers') }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-people ms-1"></i> العملاء
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Low Stock + Quick Actions --}}
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-white border-0 fw-bold">
                    منتجات قليلة المخزون
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <div class="fw-semibold">AirPods Pro</div>
                            <div class="text-muted small">المتبقي: 2</div>
                        </div>
                        <span class="badge bg-danger">خطر</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <div class="fw-semibold">USB-C Cable</div>
                            <div class="text-muted small">المتبقي: 5</div>
                        </div>
                        <span class="badge bg-warning text-dark">قليل</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-semibold">Gaming Mouse</div>
                            <div class="text-muted small">المتبقي: 3</div>
                        </div>
                        <span class="badge bg-warning text-dark">قليل</span>
                    </div>

                    <hr>
                    <a href="{{ url('/dsadmin/products') }}" class="btn btn-outline-danger w-100">
                        <i class="bi bi-box-seam ms-1"></i> إدارة المخزون
                    </a>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 fw-bold">
                    إجراءات سريعة
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ url('/dsadmin/products/create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg ms-1"></i> إضافة منتج
                        </a>
                        <a href="{{ url('/dsadmin/categories') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-tags ms-1"></i> الأقسام
                        </a>
                        <a href="{{ url('/dsadmin/orders') }}" class="btn btn-outline-dark">
                            <i class="bi bi-receipt ms-1"></i> الطلبات
                        </a>
                    </div>
                    <div class="text-muted small mt-3">
                        * هذه واجهة فقط — لاحقًا نربطها بالبيانات.
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
