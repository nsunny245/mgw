<div class="p-6 bg-white dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col space-y-4" style="max-height: 500px; overflow-y: auto;">
    @forelse($records as $msg)
        @php
            $isVisitor = $msg->sender === 'visitor';
        @endphp
        <div class="flex {{ $isVisitor ? 'justify-start' : 'justify-end' }}">
            <div class="max-w-md rounded-2xl px-4 py-2.5 shadow-sm {{ $isVisitor ? 'bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-bl-none' : 'bg-amber-500 text-white rounded-br-none' }}">
                <div class="flex items-center justify-between space-x-4 mb-1 text-[10px] opacity-75">
                    <span class="font-semibold">{{ $isVisitor ? ($msg->session->visitor_name ?? 'Visitor') : ($msg->user?->name ?? 'Staff Support') }}</span>
                    <span>{{ $msg->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-sm leading-relaxed">{{ $msg->message }}</p>
            </div>
        </div>
    @empty
        <div class="text-center py-6 text-gray-400 dark:text-gray-600">
            No messages in this chat session yet.
        </div>
    @endforelse
</div>
