@extends('layouts.admin')

@section('page_title', 'Products')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0 fw-bold">المنتجات</h3>
            <small class="text-muted">إدارة منتجات متجر الإلكترونيات</small>
        </div>
        <a href="{{ url('/dsadmin/products/create') }}" class="btn btn-primary">
            + إضافة منتج
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>اسم المنتج</th>
                            <th>السعر</th>
                            <th>المخزون</th>
                            <th class="text-end">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- بيانات تجريبية (Static) --}}
                        <tr>
                            <td>1</td>
                            <td>iPhone 15 Pro</td>
                            <td>$1200</td>
                            <td><span class="badge bg-success">متوفر</span></td>
                            <td class="text-end">
                                <a href="#" class="btn btn-sm btn-outline-secondary">تعديل</a>
                                <a href="#" class="btn btn-sm btn-outline-danger">حذف</a>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Samsung S24 Ultra</td>
                            <td>$1100</td>
                            <td><span class="badge bg-warning text-dark">قليل</span></td>
                            <td class="text-end">
                                <a href="#" class="btn btn-sm btn-outline-secondary">تعديل</a>
                                <a href="#" class="btn btn-sm btn-outline-danger">حذف</a>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>Lenovo Legion Laptop</td>
                            <td>$1500</td>
                            <td><span class="badge bg-danger">نفذ</span></td>
                            <td class="text-end">
                                <a href="#" class="btn btn-sm btn-outline-secondary">تعديل</a>
                                <a href="#" class="btn btn-sm btn-outline-danger">حذف</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <hr>
            <small class="text-muted">هذه بيانات تجريبية. لاحقًا سنربطها بالقاعدة.</small>
        </div>
    </div>
</div>
@endsection
