@extends('layouts.master')

@section('title')
    @lang('translation.Dashboards')
@endsection
@section('css')

@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
@lang('site.home')
@endslot
@slot('title')
@lang('orders.orders')
@endslot
@endcomponent
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-body">
                <form method="GET" action="{{ route('ad.orders.index') }}" class="mb-3">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-4">
                            <label>@lang('translation.invoice_no')</label>
                            <input type="text" name="invoice_no" class="form-control"
                                value="{{ request('invoice_no') }}" placeholder="@lang('بحث')">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fa fa-search"></i> @lang('search')
                            </button>
                        </div>
                    </div>
                </form>

                @if (@isset($orders) && !@empty($orders) && count($orders) > 0)
                <div class="row">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>@lang('translation.invoice_no')</th>
                                    <!-- <th scope="col">@lang('orders.user')</th> -->
                                    <th>@lang('translation.playerid')</th>
                                    <th>@lang('translation.playername')</th>
                                    <th>@lang('translation.status')</th>
                                    <th>@lang('translation.name')</th>
                                    <th>@lang('translation.qyt')</th>
                                    <th>@lang('translation.base_total')</th>
                                    <!-- <th>@lang('translation.profit_percentage')</th>
                                    <th>@lang('translation.profit')</th> -->
                                    <th>@lang('translation.final_total')</th>
                                    <th>@lang('translation.note')</th>
                                    <th>@lang('translation.date_at')</th>
                                    <th>@lang('translation.action')</th>

                                </tr>
                            </thead>


                            <tbody>
                                @foreach($orders as $order)
                                @php($game = $order->game)
                                                <tr>
                                                    <td>#{{$order->invoice_no}}</td>
                                                    <!-- <th scope="row">{{ $order->user?->name }}</th> -->
                                                    <td>{{$order->player_id}}</td>
                                                    <td>{{$order->player_name}}</td>
                                                    <td>
                                                        <span class="alert_{{$order->status}}">
                                                            {{__('translation.' . $order->status)}}
                                                        </span>
                                                        @if($order->status == 'canceled')
                                                            <br>
                                                            <br>
                                                            <span class="w-100 text-center ">
                                                                {{ $order->reason}}
                                                            </span>
                                                        @endif

                                                    </td>
                                                    <td>{{$game?->title}}</td>
                                                    <td> @if($order->package){{$order->qty}} × {{$order->package->quantity}}
                                                    {{$game->name_currency}} @else {{$order->qty}} {{$game->name_currency}} @endif
                                                    </td>
                                                    <td>{{$order->base_total}}</td>
                                                    <!-- <td>{{$order->profit_percentage}}%</td>
                                                    <td>{{$order->profit}}</td> -->
                                                    <td>{{$order->final_total}}</td>
                                                    <td>{{$order->details}}</td>
                                                    <th scope="row">
                                                        @if ($order)
                                                            {{ $order->created_at->diffForHumans() }} <br>
                                                            {{ $order->created_at->format('Y-m-d') }}
                                                            ({{ $order->created_at->format('h:i') }})
                                                            {{ ($order->created_at->format('A') == 'AM' ? __('am') : __('pm')) }} <br>
                                                        @else
                                                            {{ __('no_update') }}
                                                        @endif
                                                    </th>
                                                    <td>
                                                        @include('admin.orders.action')
                                                    </td>
                                                </tr>

                                                @endforeach


                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="14">
                                                        <div class="float-right">
                                                        </div>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="d-flex justify-content-end mt-4">
                                            {!! $orders->appends(request()->all())->links() !!}
                                        </div>
                                    </div>
                                @else
                    <div class="alert alert-danger">
                        {{ __('data_no_found') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endsection