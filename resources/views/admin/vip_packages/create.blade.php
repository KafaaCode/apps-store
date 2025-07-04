@extends('layouts.master')
@section('title', 'إضافة باقة VIP')

@section('content')
@component('components.breadcrumb')
    @slot('li_1') الإدارة @endslot
    @slot('title') إضافة باقة @endslot
@endcomponent

<form action="{{ route('ad.vip-packages.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">عنوان الباقة</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">السعر $</label>
        <input type="number" name="price" step="0.01" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">عدد الأيام</label>
        <input type="number" name="duration_days" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">💾 حفظ</button>
    <a href="{{ route('ad.vip-packages.index') }}" class="btn btn-secondary">إلغاء</a>
</form>
@endsection
