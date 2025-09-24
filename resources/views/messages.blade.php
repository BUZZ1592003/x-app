@extends('layouts.app')

@section('title', 'Messages / S App')

@section('content')
<div class="messages-workspace">
    <!-- Floating Chat Bubbles -->
    <div class="chat-bubbles-container" id="chatBubblesContainer">
        <!-- AI Assistant Bubble -->
        <div class="chat-bubble ai-bubble" data-chat-id="ai-assistant" onclick="burstBubble(this, 'AI Assistant', 'ai')">
            <div class="bubble-avatar">
                <div class="ai-avatar">
                    <i class="fas fa-robot"></i>
                </div>
            </div>
            <div class="bubble-content">
                <div class="bubble-name">AI Assistant</div>
                <div class="bubble-preview">Ready to help! 🚀</div>
            </div>
            <div class="bubble-effects">
                <div class="pulse-ring"></div>
            </div>
        </div>

        <!-- Tech Guru Bubble -->
        <div class="chat-bubble unread-bubble" data-chat-id="tech-guru" onclick="burstBubble(this, 'Tech Guru', 'user')">
            <div class="bubble-avatar">
                <img src="https://via.placeholder.com/60/1d9bf0/ffffff?text=TG" alt="Tech Guru">
                <div class="online-indicator"></div>
            </div>
            <div class="bubble-content">
                <div class="bubble-name">Tech Guru</div>
                <div class="bubble-preview">Amazing design! 🦸‍♂️</div>
            </div>
            <div class="unread-badge">2</div>
            <div class="bubble-effects">
                <div class="pulse-ring unread"></div>
            </div>
        </div>

        <!-- Laravel Team Bubble -->
        <div class="chat-bubble group-bubble unread-bubble" data-chat-id="laravel-team" onclick="burstBubble(this, 'Laravel Team', 'group')">
            <div class="bubble-avatar">
                <img src="https://via.placeholder.com/60/e10600/ffffff?text=LT" alt="Laravel Team">
                <div class="member-count">5</div>
            </div>
            <div class="bubble-content">
                <div class="bubble-name">Laravel Team</div>
                <div class="bubble-preview">Sarah: New feature! 🔥</div>
            </div>
            <div class="unread-badge">3</div>
            <div class="bubble-effects">
                <div class="pulse-ring unread"></div>
            </div>
        </div>

        <!-- Design Pro Bubble -->
        <div class="chat-bubble" data-chat-id="design-pro" onclick="burstBubble(this, 'Design Pro', 'user')">
            <div class="bubble-avatar">
                <img src="https://via.placeholder.com/60/00ba7c/ffffff?text=DP" alt="Design Pro">
                <div class="away-indicator"></div>
            </div>
            <div class="bubble-content">
                <div class="bubble-name">Design Pro</div>
                <div class="bubble-preview">📷 Photo</div>
            </div>
            <div class="bubble-effects">
                <div class="pulse-ring away"></div>
            </div>
        </div>

        <!-- Code Master Bubble -->
        <div class="chat-bubble" data-chat-id="code-master" onclick="burstBubble(this, 'Code Master', 'user')">
            <div class="bubble-avatar">
                <img src="https://via.placeholder.com/60/8b5cf6/ffffff?text=CM" alt="Code Master">
                <div class="offline-indicator"></div>
            </div>
            <div class="bubble-content">
                <div class="bubble-name">Code Master</div>
                <div class="bubble-preview">Thanks for tips! 👨‍💻</div>
            </div>
        </div>

        <!-- JS Study Group Bubble -->
        <div class="chat-bubble group-bubble" data-chat-id="js-study" onclick="burstBubble(this, 'JS Study Group', 'group')">
            <div class="bubble-avatar">
                <img src="https://via.placeholder.com/60/ffd400/000000?text=JS" alt="JS Study Group">
                <div class="member-count">8</div>
            </div>
            <div class="bubble-content">
                <div class="bubble-name">JS Study Group</div>
                <div class="bubble-preview">Alex: Challenge! 🥷</div>
            </div>
        </div>
    </div>

    <!-- Floating Chat Windows Container -->
    <div class="floating-windows-container" id="floatingWindows"></div>

    <!-- New Chat Bubble (Always visible) -->
    <div class="new-chat-bubble" onclick="showNewChatOptions()">
        <i class="fas fa-plus"></i>
    </div>
</div>

<!-- New Chat Options Popup -->
<div class="new-chat-popup" id="newChatPopup" style="display: none;">
    <div class="popup-header">
        <h3>Start New Chat</h3>
        <button onclick="hideNewChatOptions()">×</button>
    </div>
    <div class="quick-contacts">
        <div class="contact-item" onclick="createNewBubble('sarah-dev', 'Sarah Dev', 'SD')">
            <img src="https://via.placeholder.com/40/ff6b6b/ffffff?text=SD" alt="Sarah Dev">
            <span>Sarah Dev</span>
        </div>
        <div class="contact-item" onclick="createNewBubble('mike-code', 'Mike Code', 'MC')">
            <img src="https://via.placeholder.com/40/00d4ff/ffffff?text=MC" alt="Mike Code">
            <span>Mike Code</span>
        </div>
    </div>
</div>

@endsection
