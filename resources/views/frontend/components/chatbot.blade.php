<div id="mg-chat-widget" class="mg-chat-widget">
    <!-- Chat Toggle Button -->
    <button id="chat-toggle-btn" class="chat-toggle-btn shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 0 1-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8Z" />
        </svg>
    </button>

    <!-- Chat Window container -->
    <div id="chat-window" class="chat-window shadow-xl d-none">
        <!-- Header -->
        <div class="chat-header d-flex justify-content-between align-items-center bg-amber-600 text-white px-3 py-2.5 rounded-top-4">
            <div class="d-flex align-items-center">
                <span class="online-indicator me-2"></span>
                <span class="fw-bold">Makkah Gateway Support</span>
            </div>
            <button id="chat-close-btn" class="btn-close btn-close-white" aria-label="Close"></button>
        </div>

        <!-- Pre-Chat Form (Name/Email) -->
        <div id="pre-chat-form-container" class="chat-body p-3">
            <h6 class="fw-bold text-dark mb-2">Start a Live Chat</h6>
            <p class="text-muted small mb-3">Please fill out your details so our support staff can assist you immediately.</p>
            <form id="pre-chat-form">
                <div class="mb-2">
                    <label class="form-label small mb-1">Your Name</label>
                    <input type="text" id="chat-visitor-name" class="form-control form-control-sm" required placeholder="John Doe">
                </div>
                <div class="mb-3">
                    <label class="form-label small mb-1">Email (Optional)</label>
                    <input type="email" id="chat-visitor-email" class="form-control form-control-sm" placeholder="john@example.com">
                </div>
                <button type="submit" class="btn btn-warning btn-sm w-100 text-white fw-bold">Start Conversation</button>
            </form>
        </div>

        <!-- Chat messages view -->
        <div id="chat-conversation-container" class="chat-body p-3 d-none flex-column justify-content-between">
            <div id="chat-messages" class="chat-messages-log mb-2 flex-grow-1 overflow-y-auto pr-1">
                <!-- Dynamic messages go here -->
            </div>
            <div class="chat-input-area d-flex">
                <input type="text" id="chat-message-input" class="form-control form-control-sm me-2" placeholder="Type message...">
                <button id="chat-send-btn" class="btn btn-warning btn-sm text-white"><i class="bi bi-send-fill"></i></button>
            </div>
        </div>
    </div>
</div>

<style>
.mg-chat-widget {
    position: fixed;
    bottom: 25px;
    right: 25px;
    z-index: 10000;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.chat-toggle-btn {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    background-color: #d97706; /* amber-600 */
    color: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: transform 0.2s ease, background-color 0.2s ease;
}
.chat-toggle-btn:hover {
    transform: scale(1.08);
    background-color: #b45309;
}
.chat-window {
    width: 320px;
    height: 400px;
    border-radius: 12px;
    background: white;
    border: 1px solid rgba(0, 0, 0, 0.1);
    position: absolute;
    bottom: 70px;
    right: 0;
    display: flex;
    flex-direction: column;
}
.chat-header {
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}
.online-indicator {
    width: 8px;
    height: 8px;
    background-color: #10b981; /* emerald-500 */
    border-radius: 50%;
    display: inline-block;
    box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.4);
}
.chat-body {
    flex-grow: 1;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
}
.chat-messages-log {
    display: flex;
    flex-direction: column;
    gap: 8px;
    max-height: 270px;
    overflow-y: auto;
}
.chat-bubble {
    max-width: 80%;
    padding: 8px 12px;
    border-radius: 12px;
    font-size: 0.85rem;
    line-height: 1.4;
}
.chat-bubble.visitor {
    background-color: #f3f4f6;
    color: #1f2937;
    align-self: flex-start;
    border-bottom-left-radius: 2px;
}
.chat-bubble.staff {
    background-color: #d97706;
    color: white;
    align-self: flex-end;
    border-bottom-right-radius: 2px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatToggleBtn = document.getElementById('chat-toggle-btn');
    const chatCloseBtn = document.getElementById('chat-close-btn');
    const chatWindow = document.getElementById('chat-window');
    
    const preChatContainer = document.getElementById('pre-chat-form-container');
    const conversationContainer = document.getElementById('chat-conversation-container');
    const preChatForm = document.getElementById('pre-chat-form');
    const messagesLog = document.getElementById('chat-messages');
    const messageInput = document.getElementById('chat-message-input');
    const sendBtn = document.getElementById('chat-send-btn');

    let activeSessionId = localStorage.getItem('mg_chat_session_id');
    let pollInterval = null;

    // Toggle Chat visibility
    chatToggleBtn.addEventListener('click', function() {
        chatWindow.classList.toggle('d-none');
        if (!chatWindow.classList.contains('d-none')) {
            initializeChatInterface();
        } else {
            clearInterval(pollInterval);
        }
    });

    chatCloseBtn.addEventListener('click', function() {
        chatWindow.classList.add('d-none');
        clearInterval(pollInterval);
    });

    // Check if session already exists
    function initializeChatInterface() {
        if (activeSessionId) {
            preChatContainer.classList.add('d-none');
            conversationContainer.classList.remove('d-none');
            conversationContainer.style.display = 'flex';
            fetchMessages();
            // Start polling every 3 seconds
            pollInterval = setInterval(fetchMessages, 3000);
        } else {
            preChatContainer.classList.remove('d-none');
            conversationContainer.classList.add('d-none');
        }
    }

    // Submit Pre-Chat Form
    preChatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const name = document.getElementById('chat-visitor-name').value;
        const email = document.getElementById('chat-visitor-email').value;

        fetch('/api/chat/start', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ name, email })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                activeSessionId = data.session_id;
                localStorage.setItem('mg_chat_session_id', activeSessionId);
                initializeChatInterface();
            }
        });
    });

    // Send Message
    function sendMessage() {
        const message = messageInput.value.trim();
        if (!message) return;

        messageInput.value = '';
        appendMessage('visitor', message, 'Just now');

        fetch('/api/chat/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                chat_session_id: activeSessionId,
                message: message
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                fetchMessages();
            }
        });
    }

    sendBtn.addEventListener('click', sendMessage);
    messageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    // Fetch Messages
    function fetchMessages() {
        if (!activeSessionId) return;

        fetch(`/api/chat/messages/${activeSessionId}`)
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                messagesLog.innerHTML = '';
                data.messages.forEach(msg => {
                    appendMessage(msg.sender, msg.message, new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}));
                });
                
                // Auto scroll to bottom
                messagesLog.scrollTop = messagesLog.scrollHeight;

                // If chat closed on backend
                if (data.status === 'closed') {
                    localStorage.removeItem('mg_chat_session_id');
                    activeSessionId = null;
                    clearInterval(pollInterval);
                    initializeChatInterface();
                }
            }
        });
    }

    // Helper to append message bubble
    function appendMessage(sender, text, time) {
        const bubble = document.createElement('div');
        bubble.className = `chat-bubble ${sender}`;
        bubble.innerHTML = `<p class="mb-0">${text}</p><small class="d-block text-end mt-1 text-[10px] opacity-75" style="font-size: 0.65rem;">${time}</small>`;
        messagesLog.appendChild(bubble);
    }
});
</script>
