@extends('layouts.admin')
@section('page_title', 'العملاء')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0 fw-bold">العملاء</h4>
        <small class="text-muted">قائمة العملاء</small>
    </div>
    <input class="form-control" style="max-width:240px" placeholder="بحث باسم العميل">
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>الإيميل</th>
                        <th>عدد الطلبات</th>
                        <th class="text-end">إجراء</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>أحمد</td>
                        <td>ahmad@mail.com</td>
                        <td>5</td>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-outline-primary">عرض</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>سارة</td>
                        <td>sara@mail.com</td>
                        <td>2</td>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-outline-primary">عرض</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-3 text-muted small">واجهة فقط — لاحقًا نربطها بالقاعدة.</div>
    </div>
</div>
@endsection
