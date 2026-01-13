@extends('layouts.admin')

@section('page_title', 'لوحة التحكم')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1 fw-bold">لوحة التحكم</h3>
            <div class="text-muted">إحصائيات سريعة + آخر الطلبات</div>
        </div>
        <div class="text-muted small">
            آخر تحديث: {{ now()->format('Y-m-d H:i') }}
        </div>
    </div>

    {{-- Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted">المنتجات</div>
                            <div class="fs-2 fw-bold">{{ $productsCount }}</div>
                        </div>
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                            Products
                        </span>
                    </div>
                    <a href="{{ url('/dsadmin/products') }}" class="small text-decoration-none">إدارة المنتجات →</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted">الطلبات</div>
                            <div class="fs-2 fw-bold">{{ $ordersCount }}</div>
                        </div>
                        <span class="badge bg-success-subtle text-success border border-success-subtle">
                            Orders
                        </span>
                    </div>
                    <a href="{{ url('/dsadmin/orders') }}" class="small text-decoration-none">إدارة الطلبات →</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-muted">العملاء</div>
                            <div class="fs-2 fw-bold">{{ $customersCount }}</div>
                        </div>
                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle">
                            Customers
                        </span>
                    </div>
                    <a href="{{ url('/dsadmin/customers') }}" class="small text-decoration-none">عرض العملاء →</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Status Summary --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h6 class="fw-bold mb-3">حالات الطلبات</h6>

            @php
                $pending   = $ordersByStatus['pending']   ?? 0;
                $confirmed = $ordersByStatus['confirmed'] ?? 0;
                $completed = $ordersByStatus['completed'] ?? 0;
                $cancelled = $ordersByStatus['cancelled'] ?? 0;
            @endphp

            <div class="d-flex flex-wrap gap-2">
                <span class="badge bg-secondary px-3 py-2">pending: {{ $pending }}</span>
                <span class="badge bg-primary px-3 py-2">confirmed: {{ $confirmed }}</span>
                <span class="badge bg-success px-3 py-2">completed: {{ $completed }}</span>
                <span class="badge bg-danger px-3 py-2">cancelled: {{ $cancelled }}</span>
            </div>
        </div>
    </div>

    {{-- Latest Orders --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <span class="fw-bold">آخر الطلبات</span>
            <a href="{{ url('/dsadmin/orders') }}" class="small text-decoration-none">عرض الكل</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>العميل</th>
                            <th>الإجمالي</th>
                            <th>الحالة</th>
                            <th>تاريخ</th>
                            <th class="text-end">عرض</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestOrders as $o)
                            <tr>
                                <td>{{ $o->id }}</td>
                                <td>{{ $o->user->name ?? '-' }}</td>
                                <td>${{ number_format($o->total, 2) }}</td>
                                <td>
                                    <span class="badge
                                        @if($o->status=='pending') bg-secondary
                                        @elseif($o->status=='confirmed') bg-primary
                                        @elseif($o->status=='completed') bg-success
                                        @else bg-danger
                                        @endif
                                    ">
                                        {{ $o->status }}
                                    </span>
                                </td>
                                <td class="text-muted">{{ $o->created_at->format('Y-m-d') }}</td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-primary" href="{{ url('/dsadmin/orders/'.$o->id) }}">فتح</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    لا يوجد طلبات بعد
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
