@extends('layouts.master')
@section('title', 'تعديل باقة VIP')

@section('content')
@component('components.breadcrumb')
    @slot('li_1') الإدارة @endslot
    @slot('title') تعديل باقة @endslot
@endcomponent

<form action="{{ route('vip-packages.update', $vipPackage->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">عنوان الباقة</label>
        <input type="text" name="title" value="{{ $vipPackage->title }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">السعر $</label>
        <input type="number" name="price" step="0.01" value="{{ $vipPackage->price }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">عدد الأيام</label>
        <input type="number" name="duration_days" value="{{ $vipPackage->duration_days }}" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">💾 تحديث</button>
    <a href="{{ route('vip-packages.index') }}" class="btn btn-secondary">إلغاء</a>
</form>
@endsection
