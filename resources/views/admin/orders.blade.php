<x-admin.layout title="{{ __('Orders') }}">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>@lang('Orders')</h3>
                <x-breadcrumb :items="[['text' => 'Dashboard', 'route' => route('admin.index')], ['text' => 'Orders']]" />
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search">
                            <fieldset class="name">
                                <input
                                    type="text"
                                    placeholder="@lang('Search')..."
                                    class=""
                                    name="name"
                                    tabindex="2"
                                    value=""
                                    aria-required="true"
                                    required=""
                                >
                            </fieldset>
                            <div class="button-submit">
                                <button
                                    class=""
                                    type="submit"
                                ><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:70px">@lang('Order')</th>
                                    <th class="text-center">@lang('Name')</th>
                                    <th class="text-center">@lang('Phone')</th>
                                    <th class="text-center">@lang('Subtotal')</th>
                                    <th class="text-center">@lang('Tax')</th>
                                    <th class="text-center">@lang('Total')</th>

                                    <th class="text-center">@lang('Status')</th>
                                    <th class="text-center">@lang('Order Date')</th>
                                    <th class="text-center">@lang('Total Items')</th>
                                    <th class="text-center">@lang('Delivery Date')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="text-center">{{ $order->id }}</td>
                                        <td class="text-center">{{ $order->name }}</td>
                                        <td class="text-center">{{ $order->phone }}</td>
                                        <td class="text-center">${{ $order->subtotal }}</td>
                                        <td class="text-center">${{ $order->tax }}</td>
                                        <td class="text-center">${{ $order->total }}</td>

                                        <td class="text-center">
                                            @if ($order->status == 'delivered')
                                                <span class="badge bg-success">@lang('Delivered')</span>
                                            @elseif ($order->status == 'canceled')
                                                <span class="badge bg-danger">@lang('Cancelled')</span>
                                            @else
                                                <span class="badge bg-warning">@lang('Ordered')</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $order->created_at }}</td>
                                        <td class="text-center">{{ $order->orderItems->count() }}</td>
                                        <td class="text-center">{{ $order->delivered_date }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.order.details', ['order_id' => $order->id]) }}">
                                                <div class="list-icon-function view-icon">
                                                    <div class="item eye">
                                                        <i class="icon-eye"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{ $orders->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

</x-admin.layout>
