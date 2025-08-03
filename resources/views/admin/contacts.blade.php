<x-admin.layout title="{{ __('Messages') }}">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>@lang('All Messages')</h3>
                <x-breadcrumb :items="[['text' => 'Dashboard', 'route' => route('admin.index')], ['text' => 'Messages']]" />
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
                    <a
                        class="tf-button style-1 w208"
                        href="{{ route('admin.coupon.add') }}"
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
                                    <th>@lang('Phone')</th>
                                    <th>@lang('Email')</th>
                                    <th>@lang('Subject')</th>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->subject }}</td>
                                        <td>{{ $contact->created_at }}</td>

                                        <td>
                                            <div class="list-icon-function">
                                                <a href="{{ route('admin.contact.show', ['id' => $contact->id]) }}">
                                                    <div class="item eye">
                                                        <i class="icon-eye"></i>
                                                    </div>
                                                </a>

                                                <form
                                                    action="{{ route('admin.contact.delete', ['id' => $contact->id]) }}"
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
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{ $contacts->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

</x-admin.layout>
