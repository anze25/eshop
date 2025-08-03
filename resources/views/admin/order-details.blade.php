<x-admin.layout title="{{ __('Orders') }}">
    <style>
        .table-transaction>tbody>tr:nth-of-type(odd) {
            --bs-table-accent-bg: #fff !important;
        }
    </style>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>@lang('Order Details')</h3>
                <x-breadcrumb :items="[['text' => 'Dashboard', 'route' => route('admin.index')], ['text' => 'Order Details']]" />
            </div>
            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <h5>@lang('Order Details')</h5>
                    </div>
                    <a
                        class="tf-button style-1 w208"
                        href="{{ route('admin.orders') }}"
                    >@lang('Back')</a>
                </div>
                <div class="table-responsive">
                    @if (Session::has('status'))
                        <p class="alert alert-success">{{ Session::get('status') }}</p>
                    @endif
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>@lang('Order'): </th>
                                <td>{{ $order->id }}</td>
                                <th>@lang('Phone'): </th>
                                <td>{{ $order->phone_number }}</td>


                            </tr>
                            <tr>
                                <th>@lang('Order Date'): </th>
                                <td>{{ $order->created_at }}</td>
                                <th>@lang('Delivered Date'): </th>
                                <td>{{ $order->delivered_date }}</td>
                                <th>@lang('Cancelled Date'): </th>
                                <td>{{ $order->canceled_date }}</td>

                            </tr>
                            <tr>
                                <th>@lang('Order Status'): </th>
                                <td colspan="5">
                                    @if ($order->status == 'delivered')
                                        <span class="badge bg-success">@lang('Delivered')</span>
                                    @elseif ($order->status == 'canceled')
                                        <span class="badge bg-danger">@lang('Cancelled')</span>
                                    @else
                                        <span class="badge bg-warning">@lang('Ordered')</span>
                                    @endif
                                </td>
                            </tr>
                        </thead>

                    </table>
                </div>



            </div>
            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <h5>@lang('Ordered Items')</h5>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            < <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th class="text-center">@lang('Price')</th>
                                    <th class="text-center">@lang('Quantity')</th>
                                    <th class="text-center">@lang('SKU')</th>
                                    <th class="text-center">@lang('Category')</th>
                                    <th class="text-center">@lang('Brand')</th>


                                </tr>
                        </thead>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $item)
                                <tr>

                                    <td class="pname">
                                        <div class="image">
                                            <img
                                                src="{{ asset('uploads/products/thumbnails') }}/{{ $item->product->image }}"
                                                alt="{{ $item->product->name }}"
                                                class="image"
                                            >
                                        </div>
                                        <div class="name">
                                            <a
                                                href="{{ route('shop.product.details', ['product_slug' => $item->product->slug]) }}"
                                                target="_blank"
                                                class="body-title-2"
                                            >{{ $item->product->name }}</a>
                                        </div>
                                    </td>
                                    <td class="text-center">${{ $item->price }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-center">{{ $item->product->SKU }}</td>
                                    <td class="text-center">
                                        {{ $item->product->category->translations->where('locale', app()->getLocale())->first()->name ?? '' }}
                                    </td>
                                    <td class="text-center">{{ $item->product->brand->name }}</td>


                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{ $orderItems->links('pagination::bootstrap-5') }}
                </div>
            </div>

            <div class="wg-box mt-5">
                <h5>@lang('Shipping Address')</h5>
                <div class="my-account__address-item col-md-6">
                    <div class="my-account__address-item__detail">
                        <p>@lang('Address'): {{ $order->street_address }}, <br>

                            {{ $order->postal_code }} {{ $order->city }},
                            {{ $order->state_province_region ? $order->state_province_region : '' }},<br>

                            {{ $order->country ? $order->country : '' }}</p>



                        <p>@lang('Notes'): {{ $order->delivery_instructions }}</p>

                    </div>
                </div>
            </div>

            <div class="wg-box mt-5">
                <h5>@lang('Transactions')</h5>
                <table class="table table-striped table-bordered table-transaction">
                    <tbody>
                        <tr>
                            <th>@lang('Subtotal')</th>
                            <td>${{ $order->subtotal }}</td>
                            <th>@lang('Tax')</th>
                            <td>${{ $order->tax }}</td>
                            <th>@lang('Discount')</th>
                            <td>${{ $order->discount }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Total')</th>
                            <td>${{ $order->total }}</td>
                            <th>@lang('Payment Mode')</th>
                            <td>
                                @if ($transaction->mode == 'cod')
                                    @lang('Cash on delivery')
                                @elseif ($transaction->mode == 'paypal')
                                    @lang('Paypal')
                                @else
                                    @lang('Debit or Credit Card')
                                @endif
                            </td>
                            <th>@lang('Status')</th>
                            <td style="font-size: 16px; text-transform: uppercase;">
                                @if ($transaction->status == 'approved')
                                    <span class="badge bg-success">@lang('Approved')</span>
                                @elseif ($transaction->status == 'declined')
                                    <span class="badge bg-danger">@lang('Declined')</span>
                                @elseif ($transaction->status == 'refunded')
                                    <span class="badge bg-secondary">@lang('Refunded')</span>
                                @else
                                    <span class="badge bg-warning">@lang('Pending')</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="wg-box mt-5">
                <h5>@lang('Update Order Status')</h5>
                <form
                    action="{{ route('admin.order.status.update') }}"
                    method="POST"
                >
                    @csrf
                    @method('PUT')
                    <input
                        type="hidden"
                        name="order_id"
                        value="{{ $order->id }}"
                    />
                    <div class="row">
                        <div class="col-md-3">
                            <div class="select">
                                <select
                                    id="order_status"
                                    name="order_status"
                                >
                                    <option
                                        value="ordered"
                                        {{ $order->status == 'ordered' ? 'selected' : '' }}
                                    >@lang('Ordered')</option>
                                    <option
                                        value="delivered"
                                        {{ $order->status == 'delivered' ? 'selected' : '' }}
                                    >@lang('Delivered')</option>
                                    <option
                                        value="canceled"
                                        {{ $order->status == 'canceled' ? 'selected' : '' }}
                                    >@lang('Cancelled')</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button
                                type="submit"
                                class="btn btn-primary tf-button w200"
                            >@lang('Update Status')</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

</x-admin.layout>
