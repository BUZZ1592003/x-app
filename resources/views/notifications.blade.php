@extends('layouts.app')

@section('title', 'Notifications / S App')

@section('content')
<div class="notifications-header">
    <div class="header-content">
        <h1>Notifications</h1>
        <div class="header-actions">
            <button class="filter-toggle" onclick="toggleNotificationFilters()">
                <i class="fas fa-filter"></i>
            </button>
            <button class="settings-btn" onclick="openNotificationSettings()">
                <i class="fas fa-cog"></i>
            </button>
        </div>
    </div>
    
    <div class="notification-filters" id="notificationFilters">
        <div class="filter-categories">
            <button class="filter-btn active" onclick="filterNotifications('all')" data-filter="all">
                <i class="fas fa-globe"></i>
                <span>All</span>
                <div class="notification-count">24</div>
            </button>
            <button class="filter-btn" onclick="filterNotifications('mentions')" data-filter="mentions">
                <i class="fas fa-at"></i>
                <span>Mentions</span>
                <div class="notification-count">8</div>
            </button>
            <button class="filter-btn" onclick="filterNotifications('likes')" data-filter="likes">
                <i class="fas fa-heart"></i>
                <span>Likes</span>
                <div class="notification-count">12</div>
            </button>
            <button class="filter-btn" onclick="filterNotifications('follows')" data-filter="follows">
                <i class="fas fa-user-plus"></i>
                <span>Follows</span>
                <div class="notification-count">4</div>
            </button>
            <button class="filter-btn" onclick="filterNotifications('reposts')" data-filter="reposts">
                <i class="fas fa-retweet"></i>
                <span>Reposts</span>
                <div class="notification-count">6</div>
            </button>
        </div>
    </div>
</div>

<div class="notifications-content">
    <!-- AI Summary Section -->
    <div class="ai-summary-card">
        <div class="ai-avatar">
            <i class="fas fa-robot"></i>
        </div>
        <div class="ai-content">
            <div class="ai-header">
                <h3>Your Daily Brief</h3>
                <span class="ai-badge">AI Assistant</span>
            </div>
            <div class="ai-insights">
                <div class="insight-item">
                    <i class="fas fa-trending-up"></i>
                    <span>Your post about Laravel got 45% more engagement than usual</span>
                </div>
                <div class="insight-item">
                    <i class="fas fa-users"></i>
                    <span>3 new followers from the web development community</span>
                </div>
                <div class="insight-item">
                    <i class="fas fa-clock"></i>
                    <span>Best time to post today: 2:00 PM - 4:00 PM</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Stories Section -->
    <div class="notification-stories">
        <h3 class="section-title">
            <i class="fas fa-fire"></i>
            Hot Activity
        </h3>
        <div class="stories-container">
            <div class="story-item" onclick="openNotificationStory('viral-post')">
                <div class="story-ring viral">
                    <img src="https://via.placeholder.com/60/e10600/ffffff?text=🔥" alt="Viral Post">
                </div>
                <span class="story-label">Viral Post</span>
                <div class="story-count">45</div>
            </div>
            
            <div class="story-item" onclick="openNotificationStory('new-followers')">
                <div class="story-ring followers">
                    <img src="https://via.placeholder.com/60/1d9bf0/ffffff?text=👥" alt="New Followers">
                </div>
                <span class="story-label">New Squad</span>
                <div class="story-count">8</div>
            </div>
            
            <div class="story-item" onclick="openNotificationStory('trending')">
                <div class="story-ring trending">
                    <img src="https://via.placeholder.com/60/00ba7c/ffffff?text=📈" alt="Trending">
                </div>
                <span class="story-label">Trending</span>
                <div class="story-count">12</div>
            </div>
            
            <div class="story-item" onclick="openNotificationStory('mentions')">
                <div class="story-ring mentions">
                    <img src="https://via.placeholder.com/60/f91880/ffffff?text=@" alt="Mentions">
                </div>
                <span class="story-label">Mentions</span>
                <div class="story-count">6</div>
            </div>
        </div>
    </div>

    <!-- Grouped Notifications -->
    <div class="notifications-feed">
        <!-- Recent Activity Group -->
        <div class="notification-group recent" data-category="all">
            <div class="group-header" onclick="toggleGroup('recent')">
                <div class="group-title">
                    <i class="fas fa-bolt"></i>
                    <span>Recent Activity</span>
                    <div class="group-count">8</div>
                </div>
                <div class="group-time">Last 2 hours</div>
                <i class="fas fa-chevron-down group-toggle"></i>
            </div>
            
            <div class="group-content expanded">
                <div class="notification-item likes unread" data-type="likes">
                    <div class="notification-avatar-stack">
                        <img src="https://via.placeholder.com/40/e10600/ffffff?text=JD" alt="User">
                        <img src="https://via.placeholder.com/40/1d9bf0/ffffff?text=SM" alt="User">
                        <img src="https://via.placeholder.com/40/00ba7c/ffffff?text=AK" alt="User">
                        <div class="avatar-more">+5</div>
                    </div>
                    <div class="notification-content">
                        <div class="notification-text">
                            <strong>John Doe</strong> and <strong>7 others</strong> liked your post about superhero UI design
                        </div>
                        <div class="notification-preview">
                            "The Marvel and DC inspired interface is absolutely stunning! 🦸‍♂️"
                        </div>
                        <div class="notification-meta">
                            <span class="notification-time">2 minutes ago</span>
                            <button class="quick-action" onclick="quickReply('likes-001')">
                                <i class="fas fa-reply"></i>
                            </button>
                        </div>
                    </div>
                    <div class="notification-status">
                        <div class="status-indicator pulse"></div>
                    </div>
                </div>

                <div class="notification-item mentions unread" data-type="mentions">
                    <div class="notification-avatar">
                        <img src="https://via.placeholder.com/40/f91880/ffffff?text=TP" alt="Tech Pro">
                        <div class="user-badge verified">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                    <div class="notification-content">
                        <div class="notification-text">
                            <strong>Tech Pro</strong> mentioned you in a comment: "Hey @johndoe, your S App clone is revolutionary! Can you share the source?"
                        </div>
                        <div class="notification-context">
                            <div class="context-post">
                                <i class="fas fa-comment"></i>
                                <span>Comment on "Building Twitter Clone with Laravel"</span>
                            </div>
                        </div>
                        <div class="notification-meta">
                            <span class="notification-time">15 minutes ago</span>
                            <div class="quick-actions">
                                <button class="quick-action" onclick="quickReply('mention-001')">
                                    <i class="fas fa-reply"></i>
                                </button>
                                <button class="quick-action" onclick="likeNotification('mention-001')">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="notification-status">
                        <div class="status-indicator pulse"></div>
                    </div>
                </div>

                <div class="notification-item follows" data-type="follows">
                    <div class="notification-avatar">
                        <img src="https://via.placeholder.com/40/8b5cf6/ffffff?text=DS" alt="Design Star">
                    </div>
                    <div class="notification-content">
                        <div class="notification-text">
                            <strong>Design Star</strong> started following you
                        </div>
                        <div class="notification-preview">
                            UI/UX Designer • Marvel & DC Fan • 45K followers
                        </div>
                        <div class="notification-meta">
                            <span class="notification-time">1 hour ago</span>
                            <button class="follow-back-btn" onclick="followBack('follow-001')">
                                Follow Back
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earlier Today Group -->
        <div class="notification-group earlier" data-category="all">
            <div class="group-header" onclick="toggleGroup('earlier')">
                <div class="group-title">
                    <i class="fas fa-sun"></i>
                    <span>Earlier Today</span>
                    <div class="group-count">6</div>
                </div>
                <div class="group-time">6-12 hours ago</div>
                <i class="fas fa-chevron-down group-toggle"></i>
            </div>
            
            <div class="group-content">
                <div class="notification-item reposts" data-type="reposts">
                    <div class="notification-avatar-stack">
                        <img src="https://via.placeholder.com/40/00ba7c/ffffff?text=CM" alt="Code Master">
                        <img src="https://via.placeholder.com/40/ffd400/ffffff?text=WG" alt="Web Guru">
                        <div class="avatar-more">+3</div>
                    </div>
                    <div class="notification-content">
                        <div class="notification-text">
                            <strong>Code Master</strong> and <strong>4 others</strong> reposted your tutorial
                        </div>
                        <div class="notification-preview">
                            "How to create a superhero-themed social media app"
                        </div>
                        <div class="notification-meta">
                            <span class="notification-time">8 hours ago</span>
                        </div>
                    </div>
                </div>

                <div class="notification-item achievement" data-type="achievements">
                    <div class="notification-avatar achievement-badge">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-text">
                            🎉 <strong>Achievement Unlocked!</strong> You've reached 1,000 followers!
                        </div>
                        <div class="notification-preview">
                            Your superhero journey is inspiring others. Keep building amazing things!
                        </div>
                        <div class="notification-meta">
                            <span class="notification-time">10 hours ago</span>
                            <button class="quick-action celebrate" onclick="celebrateAchievement()">
                                <i class="fas fa-star"></i>
                                Celebrate
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- This Week Group -->
        <div class="notification-group week" data-category="all">
            <div class="group-header" onclick="toggleGroup('week')">
                <div class="group-title">
                    <i class="fas fa-calendar-week"></i>
                    <span>This Week</span>
                    <div class="group-count">10</div>
                </div>
                <div class="group-time">1-7 days ago</div>
                <i class="fas fa-chevron-down group-toggle"></i>
            </div>
            
            <div class="group-content">
                <div class="notification-summary">
                    <div class="summary-stats">
                        <div class="stat-item">
                            <i class="fas fa-heart"></i>
                            <span>156 likes</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-retweet"></i>
                            <span>23 reposts</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-comment"></i>
                            <span>45 comments</span>
                        </div>
                    </div>
                    <button class="view-all-btn" onclick="expandWeeklyNotifications()">
                        View all weekly activity
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Notification Story Modal -->
<div id="notificationStoryModal" class="story-modal">
    <div class="story-content">
        <div class="story-header">
            <button class="close-story" onclick="closeNotificationStory()">&times;</button>
            <div class="story-progress">
                <div class="progress-bar" id="storyProgress"></div>
            </div>
        </div>
        <div class="story-body" id="storyBody">
            <!-- Dynamic story content will be loaded here -->
        </div>
    </div>
</div>

<!-- Quick Reply Modal -->
<div id="quickReplyModal" class="quick-modal">
    <div class="quick-modal-content">
        <div class="quick-modal-header">
            <h3>Quick Reply</h3>
            <button class="close-quick-modal" onclick="closeQuickReply()">&times;</button>
        </div>
        <div class="quick-reply-form">
            <textarea placeholder="Write your reply..." id="quickReplyText"></textarea>
            <div class="quick-reply-actions">
                <button class="cancel-btn" onclick="closeQuickReply()">Cancel</button>
                <button class="send-btn" onclick="sendQuickReply()">Send</button>
            </div>
        </div>
    </div>
</div>

@endsection
