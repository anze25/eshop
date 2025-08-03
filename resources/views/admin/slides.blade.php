<x-admin.layout title="{{ __('Slides') }}">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>@lang('Slider')</h3>
                <x-breadcrumb :items="[['text' => 'Dashboard', 'route' => route('admin.index')], ['text' => 'Slides']]" />
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        {{-- <x-admin.search-form /> --}}
                    </div>
                    <a
                        class="tf-button style-1 w208"
                        href="{{ route('admin.slide.add') }}"
                    ><i class="icon-plus"></i>@lang('Add New')</a>
                </div>
                <div class="wg-table table-all-user">

                    <table class="table table-striped table-bordered">
                        <x-status-message />

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('Image')</th>
                                <th>@lang('Tagline')</th>
                                <th>@lang('Title')</th>
                                <th>@lang('Subtitle')</th>
                                <th>@lang('Link')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($slides as $slide)
                                <tr>
                                    <td>{{ $slide->id }}</td>
                                    <td class="pname">
                                        <div class="image">
                                            <img
                                                src="{{ asset('uploads/slides') }}/{{ $slide->image }}"
                                                alt="{{ $slide->translations->where('locale', app()->getLocale())->first()->title ?? '' }}"
                                                class="image"
                                            >
                                        </div>
                                    </td>
                                    <td>{{ $slide->translations->where('locale', app()->getLocale())->first()->tagline ?? '' }}
                                    </td>
                                    <td>{{ $slide->translations->where('locale', app()->getLocale())->first()->title ?? '' }}
                                    </td>
                                    <td>{{ $slide->translations->where('locale', app()->getLocale())->first()->subtitle ?? '' }}
                                    </td>
                                    <td>{{ $slide->link }}</td>
                                    <td>
                                        <div class="list-icon-function">
                                            <a href="{{ route('admin.slide.edit', ['id' => $slide->id]) }}">
                                                <div class="item edit">
                                                    <i class="icon-edit-3"></i>
                                                </div>
                                            </a>
                                            <form
                                                action="{{ route('admin.slide.delete', ['id' => $slide->id]) }}"
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
                    {{ $slides->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        {{-- Search slide --}}
        <script>
            $(function() {
                $('#search-input').on('keyup', function() {
                    var searchQuery = $(this).val();
                    var currentPage = window.location.pathname;
                    searchType = 'slides';
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
                                    var slideTitle = item.translations.length > 0 ? item
                                        .translations[0].title : '';
                                    var url =
                                        "{{ route('admin.slide.edit', ['id' => 'slide_id']) }}";
                                    var link = url.replace('slide_id', item.id);

                                    $('#box-content-search').append(`
                        <li class="product-item gap14 mb-10">
                            <div class="image no-bg">
                                <a href="${link}">
                                <img src="{{ asset('uploads/slides') }}/${item.image}" alt="${slideTitle}"></a>
                            </div>
                            <div class="flex items-center justify-between gap20 flex-grow">
                                <div class="name">
                                    <a href="${link}" class="body-text">${slideTitle}</a>
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
