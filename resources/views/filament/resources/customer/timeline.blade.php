<div class="p-6 bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm">
    <div class="flow-root">
        <ul role="list" class="-mb-8">
            @forelse($records as $index => $event)
                <li>
                    <div class="relative pb-8">
                        @if($index < count($records) - 1)
                            <span class="absolute left-5 top-5 -ml-px h-full w-0.5 bg-gray-200 dark:bg-gray-700" aria-hidden="true"></span>
                        @endif
                        <div class="relative flex items-start space-x-4">
                            <div class="relative">
                                @php
                                    $bgColor = match($event->event_type) {
                                        'Status Changed' => 'bg-blue-500',
                                        'Document Uploaded' => 'bg-purple-500',
                                        'Visa Approved' => 'bg-emerald-500',
                                        'Payment Received' => 'bg-teal-500',
                                        'Inquiry Converted' => 'bg-amber-500',
                                        default => 'bg-gray-500',
                                    };
                                @endphp
                                <div class="flex h-10 w-10 items-center justify-center rounded-full {{ $bgColor }} text-white shadow-md ring-8 ring-white dark:ring-gray-900">
                                    @if($event->event_type === 'Status Changed')
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                        </svg>
                                    @elseif($event->event_type === 'Document Uploaded')
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                    @elseif($event->event_type === 'Visa Approved')
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                        </svg>
                                    @elseif($event->event_type === 'Payment Received')
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    @else
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            <div class="min-w-0 flex-1 py-1.5">
                                <div class="flex justify-between items-center space-x-4">
                                    <div>
                                        <span class="inline-flex items-center rounded-md bg-amber-50 dark:bg-amber-900/30 px-2 py-1 text-xs font-medium text-amber-800 dark:text-amber-400 ring-1 ring-inset ring-amber-600/20">
                                            {{ $event->event_type }}
                                        </span>
                                        <p class="text-sm text-gray-700 dark:text-gray-300 mt-1 font-semibold">
                                            {{ $event->description }}
                                        </p>
                                    </div>
                                    <div class="whitespace-nowrap text-right text-xs text-gray-400">
                                        <span class="font-medium text-gray-700 dark:text-gray-300">{{ $event->user?->name ?? 'System' }}</span>
                                        <time class="block mt-1 text-gray-400">{{ $event->created_at->diffForHumans() }}</time>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @empty
                <div class="text-center py-6 text-gray-500 dark:text-gray-400">
                    No timeline events recorded yet.
                </div>
            @endforelse
        </ul>
    </div>
</div>
