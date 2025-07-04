@extends('layouts.master')

@section('title', 'إدارة باقات VIP')

@section('content')
@component('components.breadcrumb')
    @slot('li_1') الإدارة @endslot
    @slot('title') باقات VIP @endslot
@endcomponent

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('ad.vip-packages.create') }}" class="btn btn-primary">➕ إضافة باقة جديدة</a>
</div>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>السعر</th>
                    <th>عدد الأيام</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $package)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $package->title }}</td>
                    <td>{{ $package->price }} $</td>
                    <td>{{ $package->duration_days }} يوم</td>
                    <td>
                        <a href="{{ route('ad.vip-packages.edit', $package->id) }}" class="btn btn-warning btn-sm">✏️ تعديل</a>
                        <form action="{{ route('ad.vip-packages.destroy', $package->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">🗑 حذف</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($packages->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center">لا توجد باقات حالياً.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
