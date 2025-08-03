<x-admin.layout title="{{ __('Users') }}">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>@lang('Users')</h3>
                <x-breadcrumb :items="[['text' => 'Dashboard', 'route' => route('admin.index')], ['text' => 'Users']]" />

            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <x-admin.search-form />
                    </div>

                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <x-status-message />

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Email')</th>
                                    <th>@lang('Phone')</th>
                                    <th>@lang('Type')</th>
                                    <th>@lang('Orders')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td class="pname">

                                            <div class="name">
                                                <a
                                                    href="#"
                                                    class="body-title-2"
                                                >{{ $user->name }}</a>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->mobile }}</td>
                                        <td>{{ $user->utype }}</td>
                                        <td>{{ $user->orders->count() }}</td>
                                        <td>
                                            <div class="list-icon-function">
                                                <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}">
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                </a>
                                                <form
                                                    action="{{ route('admin.user.delete', ['id' => $user->id]) }}"
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
                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        {{-- Search brand --}}
        <script>
            $(function() {
                $('#search-input').on('keyup', function() {
                    var searchQuery = $(this).val();
                    var currentPage = window.location.pathname;
                    searchType = 'users';

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

                                    var url =
                                        "{{ route('admin.user.edit', ['id' => 'user_id']) }}";
                                    var link = url.replace('user_id', item.id);

                                    $('#box-content-search').append(`
                                    <li class="product-item gap14 mb-10">
                                      
                                            
                                        
                                        <div class="flex items-center justify-between gap20 flex-grow">
                                            <div class="name">
                                                <a href="${link}" class="body-text">${item.name}</a>
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
