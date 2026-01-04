@extends('layouts.admin')
@section('page_title', 'تفاصيل الطلب')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0 fw-bold">طلب #1001</h4>
        <small class="text-muted">تفاصيل الطلب و العناصر</small>
    </div>
    <a href="{{ url('/dsadmin/orders') }}" class="btn btn-outline-secondary">رجوع</a>
</div>

<div class="row g-3">
    <div class="col-12 col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="fw-bold mb-2">معلومات العميل</div>
                <div class="small text-muted">الاسم</div>
                <div class="mb-2">أحمد</div>

                <div class="small text-muted">الهاتف</div>
                <div class="mb-2">0500000000</div>

                <div class="small text-muted">العنوان</div>
                <div>الرياض - حي النرجس</div>

                <hr>
                <div class="fw-bold mb-2">حالة الطلب</div>
                <span class="badge bg-warning text-dark">قيد المعالجة</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="fw-bold mb-3">العناصر</div>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>المنتج</th>
                                <th>السعر</th>
                                <th>الكمية</th>
                                <th class="text-end">الإجمالي</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>iPhone 15 Pro</td>
                                <td>$1200</td>
                                <td>1</td>
                                <td class="text-end">$1200</td>
                            </tr>
                            <tr>
                                <td>AirPods</td>
                                <td>$300</td>
                                <td>1</td>
                                <td class="text-end">$300</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end">
                    <div style="min-width: 260px;">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">المجموع</span>
                            <strong>$1500</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">الشحن</span>
                            <strong>$0</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fs-5">
                            <span class="fw-bold">الإجمالي</span>
                            <span class="fw-bold">$1500</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
