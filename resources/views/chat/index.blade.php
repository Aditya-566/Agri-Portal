<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Toast Alerts -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600 dark:text-emerald-400 text-xs font-semibold border border-emerald-100 dark:border-emerald-900/50 flex items-center gap-2 animate-fade-in">
                <i data-lucide="check-circle" class="w-4.5 h-4.5 shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-rose-50 dark:bg-rose-950/20 text-rose-600 dark:text-rose-455 text-xs font-semibold border border-rose-100 dark:border-rose-900/50 flex items-center gap-2 animate-fade-in">
                <i data-lucide="alert-triangle" class="w-4.5 h-4.5 shrink-0"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm overflow-hidden min-h-[600px] flex flex-col md:flex-row">
            <!-- Left Pane: Conversations List -->
            <div class="w-full md:w-80 border-r border-slate-100 dark:border-slate-750 flex flex-col shrink-0 bg-slate-50/30 dark:bg-slate-900/10">
                <div class="p-5 border-b border-slate-100 dark:border-slate-750 shrink-0">
                    <h2 class="font-heading font-extrabold text-lg text-slate-900 dark:text-white flex items-center gap-2">
                        <span class="p-1 bg-emerald-100 text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-400 rounded-lg">
                            <i data-lucide="message-square" class="w-4 h-4"></i>
                        </span>
                        Inbox Messages
                    </h2>
                    <p class="text-[10px] text-slate-400 mt-1 font-medium">Direct communication between farmers and buyers.</p>
                </div>

                <!-- Chat items -->
                <div class="flex-grow overflow-y-auto max-h-[500px]">
                    @forelse($chats as $chat)
                        @php
                            $chatUser = $chat->otherParticipant(auth()->id());
                            $isActive = $activeChat && $activeChat->id === $chat->id;
                            $lastMsg = collect($chat->messages)->last();
                        @endphp
                        @if($chatUser)
                            <a href="{{ route('chats.index', ['chat_id' => $chat->id]) }}" 
                               class="block p-4 border-b border-slate-100/50 dark:border-slate-750/50 transition-all hover:bg-slate-50 dark:hover:bg-slate-900/40 {{ $isActive ? 'bg-emerald-50/50 dark:bg-emerald-950/15 border-l-4 border-l-emerald-500' : '' }}">
                                <div class="flex items-center gap-3">
                                    <!-- User Avatar Mock -->
                                    <div class="w-9 h-9 rounded-full bg-emerald-100 dark:bg-emerald-950/30 text-emerald-700 dark:text-emerald-400 flex items-center justify-center font-bold text-xs shrink-0">
                                        {{ substr($chatUser->name, 0, 1) }}
                                    </div>
                                    <div class="min-w-0 flex-grow">
                                        <div class="flex items-center justify-between gap-1">
                                            <span class="block text-xs font-bold text-slate-900 dark:text-white truncate flex items-center gap-1">
                                                {{ $chatUser->name }}
                                                @if($chatUser->isFarmer() && $chatUser->is_verified)
                                                    <i data-lucide="badge-check" class="w-3.5 h-3.5 text-emerald-555 fill-emerald-500/10" title="Verified Farmer"></i>
                                                @endif
                                            </span>
                                            <span class="text-[9px] text-slate-400 shrink-0 font-medium">
                                                {{ $chat->last_message_at ? $chat->last_message_at->diffForHumans(null, true) : '' }}
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-between gap-2 mt-1">
                                            <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate max-w-[150px] font-medium">
                                                {{ $lastMsg ? $lastMsg['message'] : 'No messages yet' }}
                                            </p>
                                            <span class="inline-flex items-center text-[8px] font-bold uppercase tracking-wider px-1.5 py-0.5 rounded-full {{ $chatUser->isFarmer() ? 'bg-emerald-50 text-emerald-600 dark:bg-emerald-950/20 dark:text-emerald-400' : 'bg-blue-50 text-blue-600 dark:bg-blue-950/20 dark:text-blue-400' }}">
                                                {{ $chatUser->role }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @empty
                        <div class="text-center py-16 text-slate-400 dark:text-slate-655 p-6">
                            <i data-lucide="message-square-off" class="w-10 h-10 mx-auto text-slate-350 dark:text-slate-700 mb-3"></i>
                            <span class="block text-xs font-bold text-slate-700 dark:text-slate-400">No active discussions</span>
                            <p class="text-[10px] text-slate-450 mt-1 max-w-[180px] mx-auto leading-normal">Browse active crop offers and contact a farmer to initiate a trade dialogue.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Right Pane: Message Area -->
            <div class="flex-grow flex flex-col bg-white dark:bg-slate-800">
                @if($activeChat && $otherUser)
                    <!-- Active Chat Header -->
                    <div class="p-4 border-b border-slate-100 dark:border-slate-750 flex items-center justify-between shrink-0 bg-slate-50/20 dark:bg-slate-900/5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-950/30 text-emerald-700 dark:text-emerald-400 flex items-center justify-center font-bold text-sm shrink-0">
                                {{ substr($otherUser->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="font-heading font-extrabold text-sm text-slate-900 dark:text-white flex items-center gap-1">
                                    {{ $otherUser->name }}
                                    @if($otherUser->isFarmer() && $otherUser->is_verified)
                                        <span class="inline-flex items-center gap-0.5 text-[9px] bg-emerald-50 text-emerald-600 dark:bg-emerald-950/20 dark:text-emerald-400 font-extrabold px-1.5 py-0.5 rounded-full">
                                            <i data-lucide="badge-check" class="w-3.5 h-3.5 fill-emerald-500/10"></i> Verified
                                        </span>
                                    @endif
                                </h3>
                                <p class="text-[10px] text-slate-400 font-semibold mt-0.5 flex items-center gap-1.5">
                                    <span class="inline-block w-1.5 w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                    Active Trade Contact ({{ ucfirst($otherUser->role) }})
                                    @if($otherUser->phone)
                                        <span class="text-slate-350 dark:text-slate-600">|</span>
                                        <i data-lucide="phone" class="w-3 h-3 inline"></i> {{ $otherUser->phone }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Profile Info Link or Action -->
                        <div class="flex gap-2">
                            @if($otherUser->isFarmer())
                                <a href="{{ route('products.index', ['farmer_id' => $otherUser->id]) }}" class="px-3 py-1.5 border border-slate-200 dark:border-slate-700 hover:border-emerald-500 hover:text-emerald-600 rounded-xl text-[10px] font-bold text-slate-600 dark:text-slate-300 transition-colors flex items-center gap-1">
                                    <i data-lucide="sprout" class="w-3.5 h-3.5"></i> View Catalog
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Message History -->
                    <div class="flex-grow p-6 overflow-y-auto space-y-4 max-h-[400px] bg-slate-50/20 dark:bg-slate-900/10" id="messages-container">
                        @forelse($activeChat->messages as $msg)
                            @php
                                $isMe = $msg['sender_id'] === auth()->id();
                                $sentTime = isset($msg['created_at']) ? \Carbon\Carbon::parse($msg['created_at'])->format('h:i A') : '';
                            @endphp
                            <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }}">
                                <div class="flex flex-col max-w-[70%] space-y-1">
                                    <div class="px-4 py-2.5 rounded-2xl text-xs leading-relaxed {{ $isMe ? 'bg-emerald-600 text-white rounded-br-none shadow-sm shadow-emerald-600/10' : 'bg-white dark:bg-slate-700 text-slate-800 dark:text-white border border-slate-100 dark:border-slate-655 rounded-bl-none shadow-sm' }}">
                                        {{ $msg['message'] }}
                                    </div>
                                    <span class="text-[9px] text-slate-400 font-semibold {{ $isMe ? 'text-right' : 'text-left' }} px-1">
                                        {{ $sentTime }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-16 text-slate-400 dark:text-slate-600">
                                <i data-lucide="message-square" class="w-8 h-8 mx-auto mb-2 opacity-50"></i>
                                <p class="text-xs font-bold">No messages yet.</p>
                                <p class="text-[10px] opacity-80 mt-0.5">Send a message below to start trading discussions.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Message Input Form -->
                    <div class="p-4 border-t border-slate-100 dark:border-slate-750 shrink-0 bg-slate-50/10">
                        <form method="POST" action="{{ route('chats.send') }}" class="flex gap-3">
                            @csrf
                            <input type="hidden" name="chat_id" value="{{ $activeChat->id }}">
                            <div class="flex-grow">
                                <input type="text" name="message" id="message-input" required autocomplete="off" placeholder="Write a message to {{ $otherUser->name }}..."
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 text-slate-850 dark:text-white border border-slate-205 dark:border-slate-700 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 font-medium">
                            </div>
                            <button type="submit" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-sm hover:shadow transition-all flex items-center gap-1.5 shrink-0">
                                Send <i data-lucide="send" class="w-3.5 h-3.5"></i>
                            </button>
                        </form>
                    </div>
                @else
                    <!-- Empty message pane -->
                    <div class="flex-grow flex flex-col items-center justify-center p-8 text-center text-slate-400 dark:text-slate-655">
                        <div class="w-16 h-16 rounded-full bg-slate-50 dark:bg-slate-900 flex items-center justify-center text-slate-350 dark:text-slate-700 border border-slate-100 dark:border-slate-800/80 mb-4 animate-bounce">
                            <i data-lucide="message-square" class="w-8 h-8"></i>
                        </div>
                        <h3 class="font-heading font-extrabold text-slate-800 dark:text-white text-base">Trade Advisory Messaging</h3>
                        <p class="text-xs text-slate-450 mt-1 max-w-sm mx-auto leading-relaxed">
                            Click on a contact from the left list to view active messages. You can also view a crop detail page and click "Chat with Farmer" to start a direct trade negotiation.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if($activeChat)
        <!-- Automatically scroll chat history to bottom -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const container = document.getElementById('messages-container');
                if (container) {
                    container.scrollTop = container.scrollHeight;
                }
            });
        </script>
    @endif
</x-app-layout>
