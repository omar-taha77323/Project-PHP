@extends('layouts.admin')
@section('page_title', 'الطلبات')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0 fw-bold">الطلبات</h4>
        <small class="text-muted">متابعة طلبات العملاء</small>
    </div>
    <div class="d-flex gap-2">
        <input class="form-control" style="max-width:220px" placeholder="بحث برقم الطلب">
        <button class="btn btn-outline-primary">بحث</button>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>رقم</th>
                        <th>العميل</th>
                        <th>المجموع</th>
                        <th>الحالة</th>
                        <th>التاريخ</th>
                        <th class="text-end">تفاصيل</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#1001</td>
                        <td>أحمد</td>
                        <td>$1500</td>
                        <td><span class="badge bg-warning text-dark">قيد المعالجة</span></td>
                        <td>2025-12-30</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-primary" href="{{ url('/dsadmin/orders/1') }}">عرض</a>
                        </td>
                    </tr>
                    <tr>
                        <td>#1002</td>
                        <td>سارة</td>
                        <td>$650</td>
                        <td><span class="badge bg-success">مكتمل</span></td>
                        <td>2025-12-29</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-primary" href="{{ url('/dsadmin/orders/1') }}">عرض</a>
                        </td>
                    </tr>
                    <tr>
                        <td>#1003</td>
                        <td>محمد</td>
                        <td>$299</td>
                        <td><span class="badge bg-danger">ملغي</span></td>
                        <td>2025-12-28</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-primary" href="{{ url('/dsadmin/orders/1') }}">عرض</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-3 text-muted small">واجهة فقط — لاحقًا نربطها بالقاعدة.</div>
    </div>
</div>
@endsection
