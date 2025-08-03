<x-admin.layout title="{{ __('Categories') }}">

    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>@lang('Categories')
                </h3>
                <x-breadcrumb :items="[
                    ['text' => 'Dashboard', 'route' => route('admin.index')],
                    ['text' => 'Categories', 'route' => route('admin.categories')],
                ]" />
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <x-admin.search-form />
                    </div>
                    <a
                        class="tf-button style-1 w208"
                        href="{{ route('admin.category.add') }}"
                    ><i class="icon-plus"></i>@lang('Add New')</a>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <x-status-message />

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Slug')</th>
                                    <th>@lang('Products')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td class="pname">
                                            <div class="image">
                                                <img
                                                    src="{{ asset('uploads/categories') }}/{{ $category->image }}"
                                                    alt="{{ $category->name }}"
                                                    class="image"
                                                >
                                            </div>
                                            <div class="name">
                                                <a
                                                    href="#"
                                                    class="body-title-2"
                                                >{{ $category->translations->where('locale', app()->getLocale())->first()->name ?? '' }}
                                                </a>
                                            </div>
                                        </td>
                                        <td>{{ $category->slug }}</td>
                                        <td><a
                                                href="#"
                                                target="_blank"
                                            >0</a></td>
                                        <td>
                                            <div class="list-icon-function">
                                                <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}">
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                </a>
                                                <form
                                                    action="{{ route('admin.category.delete', ['id' => $category->id]) }}"
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
                        {{ $categories->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        {{-- Search category --}}
        <script>
            $(function() {
                $('#search-input').on('keyup', function() {
                    var searchQuery = $(this).val();
                    var currentPage = window.location.pathname;
                    searchType = 'categories';
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
                                    var categoryName = item.translations.length > 0 ? item
                                        .translations[0].name : '';
                                    var url =
                                        "{{ route('admin.category.edit', ['id' => 'category_id']) }}";
                                    var link = url.replace('category_id', item.id);

                                    $('#box-content-search').append(`
                            <li class="product-item gap14 mb-10">
                                <div class="image no-bg">
                                    <a href="${link}">
                                    <img src="{{ asset('uploads/categories') }}/${item.image}" alt="${categoryName}"></a>
                                </div>
                                <div class="flex items-center justify-between gap20 flex-grow">
                                    <div class="name">
                                        <a href="${link}" class="body-text">${categoryName}</a>
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
