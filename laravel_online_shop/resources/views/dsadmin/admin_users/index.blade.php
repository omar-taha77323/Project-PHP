@extends('dsadmin.layouts.app')

@section('content')
<div class="container">

    <h3 class="mb-3">{{ $title }}</h3>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a class="btn btn-primary mb-3"
        href="{{ $role == 1 ? url('/super-admins/create') : url('/sub-admins/create') }}">
        + إضافة
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>الإيميل</th>
                <th>تاريخ الإنشاء</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
            <tr>
                <td>{{ $u->id }}</td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->created_at ? $u->created_at->format('Y-m-d') : '' }}</td>
                <td>
                    <a class="btn btn-sm btn-warning"
                        href="{{ $role == 1 ? url('/super-admins/'.$u->id.'/edit') : url('/sub-admins/'.$u->id.'/edit') }}">
                        تعديل
                    </a>

                    <form method="POST"
                        action="{{ $role == 1 ? url('/super-admins/'.$u->id) : url('/sub-admins/'.$u->id) }}"
                        style="display:inline-block"
                        onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</div>
@endsection