<x-app title="{{ __('My Account') }}">
    <style>
        .text-success {
            color: #31b904 !important;
        }

        .list-icon-function {
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            align-items: center;
            justify-content: start;
            gap: 20px;
        }

        .list-icon-function .item {
            font-size: 20px;
            cursor: pointer;
        }

        .list-icon-function .item.eye {
            color: #2377FC;
        }

        .list-icon-function .item.edit {
            color: #22C55E;
        }

        .list-icon-function .item.trash {
            color: #FF5200;
        }

        .my-account__address-item__title a {
            border: none
        }
    </style>
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">@lang('Addresses')</h2>
            <div class="row">
                <div class="col-lg-3">
                    @include('user.account-nav')
                </div>
                <div class="col-lg-9">
                    <div class="page-content my-account__address">
                        <div class="row">
                            <div class="col-6">

                            </div>
                            <div class="col-6 text-right">
                                <a
                                    href="{{ route('user.address.add') }}"
                                    class="btn btn-sm btn-info"
                                >@lang('Add New')</a>
                            </div>
                        </div>

                        <div class="my-account__address-list row">
                            <h5>@lang('Shipping Address'):</h5>
                            @if ($addresses->count() > 0)
                                @foreach ($addresses as $address)
                                    <div class="my-account__address-item col-md-6">
                                        <div
                                            class="my-account__address-item__title d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">
                                                {{ $address->first_name }} {{ $address->last_name }}
                                                @if ($address->isdefault == 1)
                                                    <i
                                                        class="fa fa-check-circle text-success ms-2"
                                                        title="{{ __('Default Address') }}"
                                                    ></i>
                                                @endif
                                            </h5>
                                            <div class="list-icon-function">
                                                <a href="{{ route('user.address.edit', ['id' => $address->id]) }}">
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                </a>
                                                <form
                                                    action="{{ route('user.address.delete', ['id' => $address->id]) }}"
                                                    method="POST"
                                                > @csrf
                                                    @method('DELETE')
                                                    <div class="item text-danger delete">
                                                        <i class="icon-trash-2"></i>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="my-account__address-item__detail mt-3">
                                            @if ($address->company_name)
                                                <p><strong>@lang('Company'): </strong> {{ $address->company_name }}</p>
                                            @endif

                                            <p><strong>@lang('Address'): </strong>
                                                {{ $address->street_address }}{{ $address->address_line_2 ? ', ' . $address->address_line_2 : '' }}<br>
                                                {{ $address->postal_code }}
                                                {{ $address->city }}{{ $address->state_province_region ? ', ' . $address->state_province_region : '' }}<br>
                                                {{ $address->country }}
                                            </p>
                                            @if ($address->phone_number)
                                                <p><strong>@lang('Mobile'): </strong> {{ $address->phone_number }}
                                                </p>
                                            @endif

                                            @if ($address->delivery_instructions)
                                                <p><strong>@lang('Delivery Instructions'):
                                                    </strong><em>{{ $address->delivery_instructions }}</em>
                                                </p>
                                            @endif


                                        </div>
                                    </div>
                                @endforeach


                            @endif

                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @push('scripts')
        <script>
            $(function() {
                $('.delete').on('click', function(e) {
                    e.preventDefault();
                    var form = $(this).closest('form');
                    swal({
                        title: "@lang('Are you sure?')",
                        text: "@lang('You won/t be able to revert this!')",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "@lang('Yes, delete it!')",
                        cancelButtonText: "@lang('No, cancel it!')",
                    }).then((result) => {
                        if (result) {
                            form.submit();
                        }
                    });
                })
            })
        </script>
    @endpush
</x-app>
