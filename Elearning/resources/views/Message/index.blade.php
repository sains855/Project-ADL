<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Interface</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 1200px;
            height: 80vh;
            display: flex;
            overflow: hidden;
        }

        .sidebar {
            width: 350px;
            background: #f8f9fa;
            border-right: 1px solid #e9ecef;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 20px;
            background: #6c757d;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar-header h2 {
            font-size: 1.3rem;
        }

        .unread-badge {
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .search-section {
            padding: 15px 20px;
            border-bottom: 1px solid #e9ecef;
        }

        .search-input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 25px;
            outline: none;
            font-size: 0.9rem;
        }

        .conversations-list {
            flex: 1;
            overflow-y: auto;
        }

        .conversation-item {
            padding: 15px 20px;
            border-bottom: 1px solid #f1f3f4;
            cursor: pointer;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .conversation-item:hover {
            background: #e9ecef;
        }

        .conversation-item.active {
            background: #007bff;
            color: white;
        }

        .avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(45deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .conversation-info {
            flex: 1;
        }

        .conversation-name {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .conversation-preview {
            font-size: 0.85rem;
            opacity: 0.7;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-area {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .chat-header {
            padding: 20px 25px;
            background: white;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .chat-header h3 {
            color: #333;
            font-size: 1.2rem;
        }

        .messages-container {
            flex: 1;
            padding: 20px 25px;
            overflow-y: auto;
            background: #f8f9fa;
        }

        .message {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-end;
            gap: 10px;
        }

        .message.sent {
            flex-direction: row-reverse;
        }

        .message-bubble {
            max-width: 70%;
            padding: 12px 16px;
            border-radius: 18px;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .message.received .message-bubble {
            background: white;
            border-bottom-left-radius: 4px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .message.sent .message-bubble {
            background: #007bff;
            color: white;
            border-bottom-right-radius: 4px;
        }

        .message-time {
            font-size: 0.7rem;
            opacity: 0.6;
            margin-top: 4px;
        }

        .message-input-area {
            padding: 20px 25px;
            background: white;
            border-top: 1px solid #e9ecef;
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .message-input {
            flex: 1;
            padding: 12px 18px;
            border: 1px solid #ddd;
            border-radius: 25px;
            outline: none;
            font-size: 0.9rem;
            resize: none;
            max-height: 100px;
        }

        .send-btn {
            background: #007bff;
            color: white;
            border: none;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s;
        }

        .send-btn:hover {
            background: #0056b3;
        }

        .send-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .new-conversation-btn {
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .new-conversation-btn:hover {
            background: #218838;
        }

        .users-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            padding: 25px;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #999;
        }

        .users-list {
            max-height: 300px;
            overflow-y: auto;
        }

        .user-item {
            padding: 12px 0;
            border-bottom: 1px solid #f1f3f4;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-item:hover {
            background: #f8f9fa;
            margin: 0 -10px;
            padding-left: 10px;
            padding-right: 10px;
            border-radius: 8px;
        }

        .empty-state {
            text-align: center;
            color: #6c757d;
            padding: 50px 20px;
        }

        .empty-state h3 {
            margin-bottom: 10px;
            color: #495057;
        }

        .loading {
            text-align: center;
            padding: 20px;
            color: #6c757d;
        }

        @media (max-width: 768px) {
            .container {
                height: 95vh;
                border-radius: 0;
            }

            .sidebar {
                width: 100%;
                display: none;
            }

            .sidebar.active {
                display: flex;
            }

            .chat-area.sidebar-active {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2>Pesan</h2>
                <div class="header-actions">
                    <span class="unread-badge" id="unreadBadge" style="display: none;">0</span>
                    <button class="new-conversation-btn" onclick="openUsersModal()">+ Baru</button>
                </div>
            </div>

            <div class="search-section">
                <input type="text" class="search-input" placeholder="Cari percakapan..." id="searchConversations">
            </div>

            <div class="conversations-list" id="conversationsList">
                <div class="loading">Memuat percakapan...</div>
            </div>
        </div>

        <!-- Chat Area -->
        <div class="chat-area" id="chatArea">
            <div class="chat-header" id="chatHeader" style="display: none;">
                <div class="avatar" id="chatAvatar">U</div>
                <h3 id="chatUserName">Pilih percakapan</h3>
            </div>

            <div class="messages-container" id="messagesContainer">
                <div class="empty-state">
                    <h3>Selamat datang di Pesan</h3>
                    <p>Pilih percakapan dari sidebar atau mulai percakapan baru</p>
                </div>
            </div>

            <div class="message-input-area" id="messageInputArea" style="display: none;">
                <textarea class="message-input" id="messageInput" placeholder="Ketik pesan..." rows="1"></textarea>
                <button class="send-btn" id="sendBtn" onclick="sendMessage()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M2,21L23,12L2,3V10L17,12L2,14V21Z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Users Modal -->
    <div class="users-modal" id="usersModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Pilih Pengguna</h3>
                <button class="close-btn" onclick="closeUsersModal()">&times;</button>
            </div>

            <div class="search-section">
                <input type="text" class="search-input" placeholder="Cari pengguna..." id="searchUsers" oninput="searchUsers()">
            </div>

            <div class="users-list" id="usersList">
                <div class="loading">Memuat pengguna...</div>
            </div>
        </div>
    </div>

    <script>
        // Global variables
        let currentConversation = null;
        let conversations = [];
        let users = [];

        // API Base URL - sesuaikan dengan URL Laravel Anda
        const API_BASE = '/api';

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            loadConversations();
            loadUnreadCount();
            setupEventListeners();

            // Refresh data every 30 seconds
            setInterval(() => {
                if (currentConversation) {
                    loadMessages(currentConversation.userId);
                }
                loadUnreadCount();
            }, 30000);
        });

        function setupEventListeners() {
            // Message input auto-resize
            const messageInput = document.getElementById('messageInput');
            messageInput.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 100) + 'px';
            });

            // Send message on Enter
            messageInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });

            // Search conversations
            document.getElementById('searchConversations').addEventListener('input', function(e) {
                filterConversations(e.target.value);
            });
        }

        // Load conversations
        async function loadConversations() {
            try {
                const response = await fetch(`${API_BASE}/messages`, {
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken(),
                        'Accept': 'application/json',
                    }
                });

                const data = await response.json();

                if (data.success) {
                    conversations = data.data;
                    renderConversations(conversations);
                } else {
                    showError('Gagal memuat percakapan');
                }
            } catch (error) {
                console.error('Error loading conversations:', error);
                showError('Terjadi kesalahan saat memuat percakapan');
            }
        }

        // Render conversations list
        function renderConversations(conversationData) {
            const container = document.getElementById('conversationsList');

            if (conversationData.length === 0) {
                container.innerHTML = '<div class="empty-state"><p>Belum ada percakapan</p></div>';
                return;
            }

            container.innerHTML = conversationData.map(conv => {
                const otherUser = conv.sender_id === getCurrentUserId() ? conv.receiver : conv.sender;
                const initials = otherUser.name.split(' ').map(n => n[0]).join('').toUpperCase();

                return `
                    <div class="conversation-item" onclick="openConversation(${otherUser.id}, '${otherUser.name}')">
                        <div class="avatar">${initials}</div>
                        <div class="conversation-info">
                            <div class="conversation-name">${otherUser.name}</div>
                            <div class="conversation-preview">${conv.message}</div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        // Filter conversations
        function filterConversations(query) {
            if (!query) {
                renderConversations(conversations);
                return;
            }

            const filtered = conversations.filter(conv => {
                const otherUser = conv.sender_id === getCurrentUserId() ? conv.receiver : conv.sender;
                return otherUser.name.toLowerCase().includes(query.toLowerCase()) ||
                       conv.message.toLowerCase().includes(query.toLowerCase());
            });

            renderConversations(filtered);
        }

        // Open conversation
        async function openConversation(userId, userName) {
            currentConversation = { userId, userName };

            // Update UI
            document.getElementById('chatHeader').style.display = 'flex';
            document.getElementById('messageInputArea').style.display = 'flex';
            document.getElementById('chatUserName').textContent = userName;
            document.getElementById('chatAvatar').textContent = userName.split(' ').map(n => n[0]).join('').toUpperCase();

            // Mark conversation as active
            document.querySelectorAll('.conversation-item').forEach(item => {
                item.classList.remove('active');
            });

            // Find and mark the clicked conversation as active
            const conversationItems = document.querySelectorAll('.conversation-item');
            conversationItems.forEach(item => {
                if (item.onclick && item.onclick.toString().includes(`openConversation(${userId},`)) {
                    item.classList.add('active');
                }
            });

            // Load messages
            await loadMessages(userId);

            // Mark as read
            markAsRead(userId);
        }

        // Load messages for conversation
        async function loadMessages(userId) {
            try {
                const response = await fetch(`${API_BASE}/messages/${userId}`, {
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken(),
                        'Accept': 'application/json',
                    }
                });

                const data = await response.json();

                if (data.success) {
                    renderMessages(data.data);
                } else {
                    showError('Gagal memuat pesan');
                }
            } catch (error) {
                console.error('Error loading messages:', error);
                showError('Terjadi kesalahan saat memuat pesan');
            }
        }

        // Render messages
        function renderMessages(messages) {
            const container = document.getElementById('messagesContainer');
            const currentUserId = getCurrentUserId();

            if (messages.length === 0) {
                container.innerHTML = '<div class="empty-state"><p>Belum ada pesan. Mulai percakapan!</p></div>';
                return;
            }

            container.innerHTML = messages.map(msg => {
                const isSent = msg.sender_id === currentUserId;
                const time = new Date(msg.sent_at).toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit'
                });

                return `
                    <div class="message ${isSent ? 'sent' : 'received'}">
                        <div class="message-bubble">
                            ${msg.message}
                            <div class="message-time">${time}</div>
                        </div>
                    </div>
                `;
            }).join('');

            // Scroll to bottom
            container.scrollTop = container.scrollHeight;
        }

        // Send message
        async function sendMessage() {
            const input = document.getElementById('messageInput');
            const message = input.value.trim();

            if (!message || !currentConversation) return;

            const sendBtn = document.getElementById('sendBtn');
            sendBtn.disabled = true;

            try {
                const response = await fetch(`${API_BASE}/messages`, {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken(),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        receiver_id: currentConversation.userId,
                        message: message
                    })
                });

                const data = await response.json();

                if (data.success) {
                    input.value = '';
                    input.style.height = 'auto';
                    loadMessages(currentConversation.userId);
                    loadConversations(); // Refresh conversations list
                } else {
                    showError(data.message || 'Gagal mengirim pesan');
                }
            } catch (error) {
                console.error('Error sending message:', error);
                showError('Terjadi kesalahan saat mengirim pesan');
            } finally {
                sendBtn.disabled = false;
            }
        }

        // Load unread count
        async function loadUnreadCount() {
            try {
                const response = await fetch(`${API_BASE}/messages/unread-count`, {
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken(),
                        'Accept': 'application/json',
                    }
                });

                const data = await response.json();

                if (data.success) {
                    const badge = document.getElementById('unreadBadge');
                    if (data.unread_count > 0) {
                        badge.textContent = data.unread_count;
                        badge.style.display = 'flex';
                    } else {
                        badge.style.display = 'none';
                    }
                }
            } catch (error) {
                console.error('Error loading unread count:', error);
            }
        }

        // Mark messages as read
        async function markAsRead(userId) {
            try {
                await fetch(`${API_BASE}/messages/${userId}/mark-read`, {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken(),
                        'Accept': 'application/json',
                    }
                });

                loadUnreadCount();
            } catch (error) {
                console.error('Error marking as read:', error);
            }
        }

        // Users modal functions
        async function openUsersModal() {
            document.getElementById('usersModal').style.display = 'flex';
            await loadUsers();
        }

        function closeUsersModal() {
            document.getElementById('usersModal').style.display = 'none';
            document.getElementById('searchUsers').value = '';
        }

        // Fixed loadUsers function
        async function loadUsers(search = '') {
            try {
                const url = search ? `${API_BASE}/messages/users?search=${encodeURIComponent(search)}` : `${API_BASE}/messages/users`;
                const response = await fetch(url, {
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken(),
                        'Accept': 'application/json',
                    }
                });

                const data = await response.json();

                if (data.success) {
                    users = data.data;
                    renderUsers(users);
                } else {
                    console.error('Error loading users:', data.message);
                    showError('Gagal memuat daftar pengguna');
                }
            } catch (error) {
                console.error('Error loading users:', error);
                showError('Terjadi kesalahan saat memuat daftar pengguna');
            }
        }

        function renderUsers(userData) {
            const container = document.getElementById('usersList');

            if (userData.length === 0) {
                container.innerHTML = '<div class="empty-state"><p>Tidak ada pengguna ditemukan</p></div>';
                return;
            }

            container.innerHTML = userData.map(user => {
                const initials = user.name.split(' ').map(n => n[0]).join('').toUpperCase();
                return `
                    <div class="user-item" onclick="startConversation(${user.id}, '${user.name.replace(/'/g, "\\'")}')">
                        <div class="avatar">${initials}</div>
                        <div>
                            <div style="font-weight: 600;">${user.name}</div>
                            <div style="font-size: 0.85rem; opacity: 0.7;">${user.email}</div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function searchUsers() {
            const query = document.getElementById('searchUsers').value;
            loadUsers(query);
        }

        function startConversation(userId, userName) {
            closeUsersModal();
            openConversation(userId, userName);
        }

        // Utility functions
        function getAuthToken() {
            // Ganti dengan cara Anda menyimpan token
            return localStorage.getItem('auth_token') || 'your-auth-token';
        }

        function getCurrentUserId() {
            // Ganti dengan cara Anda mendapatkan ID user saat ini
            return parseInt(localStorage.getItem('user_id')) || 1;
        }

        function showError(message) {
            alert(message); // Ganti dengan notification system yang lebih baik
        }
    </script>
</body>
</html>
