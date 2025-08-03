<x-admin.layout title="Message from {{ $contact->name }}">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="wg-box p-4 shadow-sm rounded bg-white">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">

                    <h4 class="mb-0">@lang('Subject'): {{ $contact->subject }}</h4>
                    <p class="text-muted fst-italic">{{ $contact->created_at->diffForHumans() }}</p>

                </div>

                <div class="pt-3">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-2">
                            <p class="mb-1"><strong>@lang('Name')</strong> {{ $contact->name }}</p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <p class="mb-1"><strong>@lang('Email')</strong> <a
                                    href="mailto:{{ $contact->email }}"
                                    class="text-decoration-none"
                                >{{ $contact->email }}</a></p>
                        </div>
                        <div class="col-md-6 mt-md-2">
                            <p class="mb-0"><strong>@lang('Phone')</strong> {{ $contact->phone ?? 'N/A' }}</p>

                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <h6 class="mb-2 text-secondary">@lang('Message Details')</h6>
                        <div
                            class="p-4 bg-light border rounded message-box"
                            style="min-height: 150px; overflow-y: auto; font-size:16px; "
                        >
                            <p class="text-muted fst-italic">{!! nl2br(e($contact->comment)) !!}</p>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-3">
                        <a
                            href="{{ route('admin.contacts') }}"
                            class="btn btn-outline-secondary btn-lg d-inline-flex align-items-center"
                        >
                            <i class="fas fa-arrow-left me-2"></i> @lang('Back to All')
                        </a>


                        <form
                            action="{{ route('admin.contact.delete', ['id' => $contact->id]) }}"
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="btn btn-danger btn-lg d-inline-flex align-items-center delete"
                            >
                                <i class="fas fa-trash-alt  me-2"></i> @lang('Delete Message')
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>

<style>
    /* Custom styles for minor adjustments */
    .message-box {
        white-space: pre-wrap;
        /* Preserves whitespace and wraps text */
    }
</style>
