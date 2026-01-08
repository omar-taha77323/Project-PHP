@extends('layouts.admin')

@section('page_title', 'المنتجات')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0 fw-bold">المنتجات</h3>
            <small class="text-muted">إدارة منتجات متجر الإلكترونيات</small>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            + إضافة منتج
        </a>
    </div>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>اسم المنتج</th>
                            <th>القسم</th>
                            <th>السعر</th>
                            <th>المخزون</th>
                            <th>الحالة</th>
                            <th class="text-end">إجراءات</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>

                                <td class="fw-semibold">
                                    {{ $product->name }}
                                    @if(!empty($product->sku))
                                        <div class="text-muted small">SKU: {{ $product->sku }}</div>
                                    @endif
                                </td>
                                <td>
                                    {{ $product->category ? $product->category->name : 'بدون قسم' }}
                                </td>
                                <td>${{ number_format($product->price, 2) }}</td>

                                <td>
                                    @if($product->stock == 0)
                                        <span class="badge bg-danger">نفذ</span>
                                    @elseif($product->stock < 5)
                                        <span class="badge bg-warning text-dark">قليل</span>
                                    @else
                                        <span class="badge bg-success">متوفر</span>
                                    @endif
                                    <span class="text-muted">({{ $product->stock }})</span>
                                </td>

                                <td>
                                    @if($product->is_active)
                                        <span class="badge bg-success">نشط</span>
                                    @else
                                        <span class="badge bg-secondary">غير نشط</span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-secondary">تعديل</a>

                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('هل أنت متأكد من حذف المنتج؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    لا يوجد منتجات بعد
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $products->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
