@extends('dsadmin.layouts.app')

@section('content')

<div class="container py-4">
<div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0 fw-bold">Discount</h3>
            <small class="text-muted">Discount Management</small>
        </div>
      {{-- added button --}}
        <a href="#" class="btn btn-primary">
            + Add Discount
        </a>    
    </div>
</div>

@endsection