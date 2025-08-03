<x-admin.layout title="{{ __('Welcome') }}">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>@lang('All Products')</h3>
                <x-breadcrumb :items="[['text' => 'Dashboard', 'route' => route('admin.index')], ['text' => 'Products']]" />
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <x-admin.search-form />
                    </div>
                    <a
                        class="tf-button style-1 w208"
                        href="{{ route('admin.product.add') }}"
                    ><i class="icon-plus"></i>@lang('Add New')</a>
                </div>
                <div class="table-responsive">
                    @if (Session::has('status'))
                        <p class="alert alert-success">{{ Session::get('status') }}</p>
                    @endif
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Price')</th>
                                <th>@lang('Sale Price')</th>
                                <th>@lang('SKU')</th>
                                <th>@lang('Category')</th>
                                <th>@lang('Brand')</th>
                                <th>@lang('Featured')</th>
                                <th>@lang('Quantity')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td class="pname">
                                        <div class="image">
                                            <img
                                                src="{{ asset('uploads/products/thumbnails') }}/{{ $product->image }}"
                                                alt="{{ $product->translations->where('locale', app()->getLocale())->first()->name ?? '' }}"
                                                class="image"
                                            >
                                        </div>
                                        <div class="name">
                                            <a
                                                href="#"
                                                class="body-title-2"
                                            >{{ $product->translations->where('locale', app()->getLocale())->first()->name ?? '' }}</a>
                                            <div class="text-tiny mt-3">{{ $product->slug }}</div>
                                        </div>
                                    </td>
                                    <td>${{ $product->regular_price }}</td>
                                    <td>${{ $product->sale_price }}</td>
                                    <td>{{ $product->SKU }}</td>
                                    <td>{{ $product->category->translations->where('locale', app()->getLocale())->first()->name ?? '' }}
                                    </td>
                                    <td>{{ $product->brand->name }}</td>
                                    <td>{{ $product->featured === 0 ? 'No' : 'Yes' }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                        <div class="list-icon-function">

                                            <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}">
                                                <div class="item edit">
                                                    <i class="icon-edit-3"></i>
                                                </div>
                                            </a>
                                            <form
                                                action="{{ route('admin.product.delete', ['id' => $product->id]) }}"
                                                method="POST"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <div class="item text-danger delete">
                                                    <i class="icon-trash-2"></i>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{ $products->links('pagination::bootstrap-5') }}

                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        {{-- Search products --}}
        <script>
            $(function() {
                $('#search-input').on('keyup', function() {
                    var searchQuery = $(this).val();
                    var currentPage = window.location.pathname;
                    searchType = 'products';
                    $('#search-input').attr('data-search-type', searchType);


                    if (searchQuery.length > 2) {
                        $.ajax({
                            type: 'GET',
                            url: "{{ route('admin.search') }}",
                            data: {
                                query: searchQuery,
                                type: searchType // Send search type
                            },
                            dataType: 'json',
                            success: function(data) {
                                $('#box-content-search').html('');
                                $.each(data, function(index, item) {
                                    var productName = item.translations.length > 0 ? item
                                        .translations[0].name : '';
                                    var url =
                                        "{{ route('admin.product.edit', ['id' => 'product_id']) }}";
                                    var link = url.replace('product_id', item.id);

                                    $('#box-content-search').append(`
                        <li class="product-item gap14 mb-10">
                            <div class="image no-bg">
                                <a href="${link}">
                                <img src="{{ asset('uploads/products/thumbnails') }}/${item.image}" alt="${item.name}"></a>
                            </div>
                            <div class="flex items-center justify-between gap20 flex-grow">
                                <div class="name">
                                    <a href="${link}" class="body-text">${productName}</a>
                                </div>
                            </div>
                        </li>
                        <li class="mb-10">
                            <div class="divider"></div>
                        </li>
                    `);
                                });
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
</x-admin.layout>
