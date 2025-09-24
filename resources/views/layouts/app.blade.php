<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'S App')</title>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/sapp.css') }}">
</head>
<body>
    <div class="app-container">
        <!-- Sidebar Navigation -->
        <nav class="sidebar">
            <div class="logo-section">
                <div class="logo">S</div>
                <span class="app-name">S App</span>
            </div>
            
            <div class="nav-menu">
                <a href="#" class="nav-item active">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
                <a onclick="window.location.href='{{url('/explore')}}'" class="nav-item">
                    <i class="fas fa-search" ></i>
                    <span>Explore</span>
                </a>
                <a onclick="window.location.href='{{url('/notifications')}}'" class="nav-item">
                    <i class="fas fa-bell"></i>
                    <span>Notifications</span>
                </a>
                <a onclick="window.location.href='{{url('/messages')}}'" class="nav-item">
                    <i class="fas fa-envelope"></i>
                    <span>Messages</span>
                </a>
                <a onclick="window.location.href='{{url('/bookmarks')}}'" class="nav-item">
                    <i class="fas fa-bookmark"></i>
                    <span>Bookmarks</span>
                </a>
                <a onclick="window.location.href='{{url('/profile')}}'" class="nav-item">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
                <a onclick="window.location.href='{{url('/settings')}}'" class="nav-item">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </div>
            
            <button class="compose-btn" onclick="openComposeModal()">
                <i class="fas fa-plus"></i>
                <span>Compose</span>
            </button>
            
            <div class="user-profile" onclick="toggleUserMenu()">
                <img src="https://via.placeholder.com/40" alt="Profile">
                <div class="user-info">
                    <div class="username">John Doe</div>
                    <div class="handle">@johndoe</div>
                </div>
                <i class="fas fa-ellipsis-h"></i>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            @yield('content')
        </main>

        <!-- Right Sidebar -->
        <aside class="right-sidebar">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search S App" id="searchInput">
            </div>
            
            <div class="trending-widget">
                <h3>What's happening</h3>
                <div class="trending-item">
                    <div class="trend-category">Trending in Tech</div>
                    <div class="trend-title">#Laravel</div>
                    <div class="trend-posts">15.2K posts</div>
                </div>
                <div class="trending-item">
                    <div class="trend-category">Trending</div>
                    <div class="trend-title">#WebDevelopment</div>
                    <div class="trend-posts">8,547 posts</div>
                </div>
                <div class="trending-item">
                    <div class="trend-category">Technology · Trending</div>
                    <div class="trend-title">PHP</div>
                    <div class="trend-posts">12.1K posts</div>
                </div>
                <div class="trending-item">
                    <div class="trend-category">Social Media</div>
                    <div class="trend-title">#SApp</div>
                    <div class="trend-posts">3,247 posts</div>
                </div>
            </div>
            
            <div class="suggestions-widget">
                <h3>Who to follow</h3>
                <div class="suggestion-item">
                    <img src="https://via.placeholder.com/40" alt="User">
                    <div class="suggestion-info">
                        <div class="suggestion-name">Sarah Developer</div>
                        <div class="suggestion-handle">@sarahdev</div>
                    </div>
                    <button class="follow-btn" onclick="toggleFollow(this)">Follow</button>
                </div>
                <div class="suggestion-item">
                    <img src="https://via.placeholder.com/40" alt="User">
                    <div class="suggestion-info">
                        <div class="suggestion-name">Mike Code</div>
                        <div class="suggestion-handle">@mikecode</div>
                    </div>
                    <button class="follow-btn" onclick="toggleFollow(this)">Follow</button>
                </div>
                <div class="suggestion-item">
                    <img src="https://via.placeholder.com/40" alt="User">
                    <div class="suggestion-info">
                        <div class="suggestion-name">Alex Tech</div>
                        <div class="suggestion-handle">@alextech</div>
                    </div>
                    <button class="follow-btn" onclick="toggleFollow(this)">Follow</button>
                </div>
            </div>
        </aside>
    </div>

    <!-- Compose Modal -->
    <div id="composeModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close-btn" onclick="closeComposeModal()">&times;</button>
                <h2>Compose new post</h2>
            </div>
            <div class="compose-form">
                <div class="compose-user">
                    <img src="https://via.placeholder.com/48" alt="Profile">
                </div>
                <div class="compose-content">
                    <textarea placeholder="What's happening?" maxlength="280" id="composeText" oninput="updateCharCount()"></textarea>
                    <div class="compose-actions">
                        <div class="compose-options">
                            <button class="option-btn" onclick="attachMedia('image')"><i class="fas fa-image"></i></button>
                            <button class="option-btn" onclick="attachMedia('video')"><i class="fas fa-video"></i></button>
                            <button class="option-btn" onclick="createPoll()"><i class="fas fa-poll"></i></button>
                            <button class="option-btn" onclick="addEmoji()"><i class="fas fa-smile"></i></button>
                        </div>
                        <div class="compose-submit">
                            <span class="char-count">280</span>
                            <button class="post-btn" onclick="submitPost()" id="modalPostBtn" disabled>Post</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/interactive.js') }}"></script>
</body>
</html>
