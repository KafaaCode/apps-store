@extends('layouts.master')
@section('title', 'اشتراكات VIP')

@section('content')
    @component('components.breadcrumb')
    @slot('li_1') الإدارة @endslot
    @slot('title') اشتراكات VIP @endslot
    @endcomponent

    <div class="card">
        <div class="card-body table-responsive">
            <h4 class="mb-3">قائمة الاشتراكات</h4>
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>اسم المستخدم</th>
                        <th>البريد الإلكتروني</th>
                        <th>مدة الاشتراك</th>
                        <th>السعر</th>
                        <th>تاريخ البدء</th>
                        <th>تاريخ الانتهاء</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vips as $vip)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $vip->user?->name ?? '-' }}</td>
                            <td>{{ $vip->user?->email ?? '-' }}</td>
                            <td>{{ $vip->duration_days }} يوم</td>
                            <td>{{ number_format($vip->price, 2) }} $</td>
                            <td>{{ \Carbon\Carbon::parse($vip->start_at)->format('Y-m-d') }}</td>
                            <td>{{ \Carbon\Carbon::parse($vip->end_at)->format('Y-m-d') }}</td>
                            <td>
                                @if($vip->is_active)
                                    <span class="badge bg-success">نشط</span>
                                @else
                                    <span class="badge bg-secondary">منتهي</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">لا يوجد اشتراكات حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $vips->links() }}
            </div>
        </div>
    </div>
@endsection