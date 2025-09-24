@extends('layouts.app')

@section('title', 'Bookmarks / S App')

@section('content')
<div class="bookmarks-container">
    <!-- Bookmarks Header -->
    <div class="bookmarks-header">
        <div class="header-content">
            <h1>Bookmarks</h1>
            <div class="header-stats">
                <div class="stat-item">
                    <i class="fas fa-bookmark"></i>
                    <span>124 saved</span>
                </div>
                <div class="stat-item">
                    <i class="fas fa-folder"></i>
                    <span>8 collections</span>
                </div>
            </div>
        </div>
        <div class="header-actions">
            <button class="view-toggle" onclick="toggleView()" id="viewToggle">
                <i class="fas fa-th-large"></i>
            </button>
            <button class="sort-btn" onclick="toggleSortMenu()">
                <i class="fas fa-sort"></i>
                <span>Sort</span>
            </button>
            <button class="filter-btn" onclick="toggleFilterMenu()">
                <i class="fas fa-filter"></i>
                <span>Filter</span>
            </button>
        </div>
    </div>

    <!-- Sort & Filter Menus -->
    <div class="dropdown-menus">
        <div class="sort-menu" id="sortMenu" style="display: none;">
            <div class="menu-item active" onclick="sortBookmarks('recent')">
                <i class="fas fa-clock"></i>
                <span>Most Recent</span>
            </div>
            <div class="menu-item" onclick="sortBookmarks('popular')">
                <i class="fas fa-heart"></i>
                <span>Most Liked</span>
            </div>
            <div class="menu-item" onclick="sortBookmarks('oldest')">
                <i class="fas fa-history"></i>
                <span>Oldest First</span>
            </div>
            <div class="menu-item" onclick="sortBookmarks('alphabetical')">
                <i class="fas fa-sort-alpha-down"></i>
                <span>A-Z</span>
            </div>
        </div>

        <div class="filter-menu" id="filterMenu" style="display: none;">
            <div class="filter-section">
                <h4>Content Type</h4>
                <label class="filter-checkbox">
                    <input type="checkbox" checked onchange="filterBookmarks()">
                    <span>Posts</span>
                </label>
                <label class="filter-checkbox">
                    <input type="checkbox" checked onchange="filterBookmarks()">
                    <span>Images</span>
                </label>
                <label class="filter-checkbox">
                    <input type="checkbox" checked onchange="filterBookmarks()">
                    <span>Videos</span>
                </label>
                <label class="filter-checkbox">
                    <input type="checkbox" checked onchange="filterBookmarks()">
                    <span>Links</span>
                </label>
            </div>
            <div class="filter-section">
                <h4>Collections</h4>
                <label class="filter-checkbox">
                    <input type="checkbox" checked onchange="filterBookmarks()">
                    <span>Web Design</span>
                </label>
                <label class="filter-checkbox">
                    <input type="checkbox" checked onchange="filterBookmarks()">
                    <span>Laravel Tips</span>
                </label>
                <label class="filter-checkbox">
                    <input type="checkbox" checked onchange="filterBookmarks()">
                    <span>UI Inspiration</span>
                </label>
            </div>
        </div>
    </div>

    <!-- Collections Quick Access -->
    <div class="collections-bar">
        <div class="collections-scroll">
            <div class="collection-chip active" onclick="filterByCollection('all')">
                <i class="fas fa-globe"></i>
                <span>All Items</span>
                <div class="chip-count">124</div>
            </div>
            <div class="collection-chip" onclick="filterByCollection('web-design')">
                <i class="fas fa-palette"></i>
                <span>Web Design</span>
                <div class="chip-count">32</div>
            </div>
            <div class="collection-chip" onclick="filterByCollection('laravel')">
                <i class="fab fa-laravel"></i>
                <span>Laravel Tips</span>
                <div class="chip-count">28</div>
            </div>
            <div class="collection-chip" onclick="filterByCollection('ui-inspiration')">
                <i class="fas fa-lightbulb"></i>
                <span>UI Inspiration</span>
                <div class="chip-count">41</div>
            </div>
            <div class="collection-chip" onclick="filterByCollection('tutorials')">
                <i class="fas fa-graduation-cap"></i>
                <span>Tutorials</span>
                <div class="chip-count">18</div>
            </div>
            <div class="collection-chip" onclick="filterByCollection('tools')">
                <i class="fas fa-tools"></i>
                <span>Dev Tools</span>
                <div class="chip-count">15</div>
            </div>
            <div class="collection-chip new-collection" onclick="createNewCollection()">
                <i class="fas fa-plus"></i>
                <span>New Collection</span>
            </div>
        </div>
    </div>

    <!-- Bookmarks Content -->
    <div class="bookmarks-content" id="bookmarksContent">
        <div class="bookmarks-grid" id="bookmarksGrid">
            <!-- Bookmark Item - Post Type -->
            <div class="bookmark-item post-type" data-collection="ui-inspiration" data-type="post">
                <div class="bookmark-card">
                    <div class="bookmark-header">
                        <div class="bookmark-author">
                            <img src="https://via.placeholder.com/30/1d9bf0/ffffff?text=TG" alt="Tech Guru">
                            <span>Tech Guru</span>
                        </div>
                        <div class="bookmark-actions">
                            <button class="bookmark-menu-btn" onclick="showBookmarkMenu(1)">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </div>
                    </div>
                    <div class="bookmark-content">
                        <div class="bookmark-text">
                            "The key to great UI design is understanding that less is more. Every element should serve a purpose and contribute to the user's journey. 🎨✨"
                        </div>
                    </div>
                    <div class="bookmark-meta">
                        <div class="bookmark-stats">
                            <span><i class="fas fa-heart"></i> 234</span>
                            <span><i class="fas fa-retweet"></i> 67</span>
                            <span><i class="fas fa-comment"></i> 45</span>
                        </div>
                        <div class="bookmark-time">2 days ago</div>
                    </div>
                    <div class="bookmark-footer">
                        <div class="bookmark-tags">
                            <span class="tag">UI Design</span>
                            <span class="tag">Tips</span>
                        </div>
                        <div class="collection-badge ui-inspiration">UI Inspiration</div>
                    </div>
                </div>
            </div>

            <!-- Bookmark Item - Image Type -->
            <div class="bookmark-item image-type" data-collection="web-design" data-type="image">
                <div class="bookmark-card">
                    <div class="bookmark-image">
                        <img src="https://via.placeholder.com/400x250/e10600/ffffff?text=Superhero+Dashboard" alt="Superhero Dashboard Design">
                        <div class="image-overlay">
                            <button class="zoom-btn" onclick="openImageModal(this)">
                                <i class="fas fa-search-plus"></i>
                            </button>
                            <button class="download-btn" onclick="downloadImage(this)">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    </div>
                    <div class="bookmark-header">
                        <div class="bookmark-author">
                            <img src="https://via.placeholder.com/30/00ba7c/ffffff?text=DP" alt="Design Pro">
                            <span>Design Pro</span>
                        </div>
                        <div class="bookmark-actions">
                            <button class="bookmark-menu-btn" onclick="showBookmarkMenu(2)">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </div>
                    </div>
                    <div class="bookmark-content">
                        <div class="bookmark-title">Superhero Dashboard Concept</div>
                        <div class="bookmark-description">A dark-themed dashboard with red accents, perfect for admin panels and data visualization.</div>
                    </div>
                    <div class="bookmark-footer">
                        <div class="bookmark-tags">
                            <span class="tag">Dashboard</span>
                            <span class="tag">Dark Theme</span>
                            <span class="tag">Red</span>
                        </div>
                        <div class="collection-badge web-design">Web Design</div>
                    </div>
                </div>
            </div>

            <!-- Bookmark Item - Video Type -->
            <div class="bookmark-item video-type" data-collection="tutorials" data-type="video">
                <div class="bookmark-card">
                    <div class="bookmark-video">
                        <img src="https://via.placeholder.com/400x225/8b5cf6/ffffff?text=Laravel+Tutorial" alt="Laravel Tutorial">
                        <div class="video-overlay">
                            <button class="play-btn" onclick="playVideo(this)">
                                <i class="fas fa-play"></i>
                            </button>
                            <div class="video-duration">12:45</div>
                        </div>
                    </div>
                    <div class="bookmark-header">
                        <div class="bookmark-author">
                            <img src="https://via.placeholder.com/30/8b5cf6/ffffff?text=CM" alt="Code Master">
                            <span>Code Master</span>
                        </div>
                        <div class="bookmark-actions">
                            <button class="bookmark-menu-btn" onclick="showBookmarkMenu(3)">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </div>
                    </div>
                    <div class="bookmark-content">
                        <div class="bookmark-title">Laravel Authentication Deep Dive</div>
                        <div class="bookmark-description">Complete guide to implementing secure authentication in Laravel applications with best practices.</div>
                    </div>
                    <div class="bookmark-footer">
                        <div class="bookmark-tags">
                            <span class="tag">Laravel</span>
                            <span class="tag">Authentication</span>
                            <span class="tag">Security</span>
                        </div>
                        <div class="collection-badge tutorials">Tutorials</div>
                    </div>
                </div>
            </div>

            <!-- Bookmark Item - Link Type -->
            <div class="bookmark-item link-type" data-collection="tools" data-type="link">
                <div class="bookmark-card">
                    <div class="bookmark-link-preview">
                        <div class="link-icon">
                            <i class="fab fa-github"></i>
                        </div>
                        <div class="link-info">
                            <div class="link-domain">github.com</div>
                            <div class="link-title">Laravel S-App Boilerplate</div>
                        </div>
                        <div class="external-link-btn" onclick="openExternalLink(this)">
                            <i class="fas fa-external-link-alt"></i>
                        </div>
                    </div>
                    <div class="bookmark-content">
                        <div class="bookmark-description">
                            Complete Laravel boilerplate with superhero-themed UI components, authentication, and API ready setup.
                        </div>
                    </div>
                    <div class="bookmark-meta">
                        <div class="bookmark-stats">
                            <span><i class="fas fa-star"></i> 1.2k stars</span>
                            <span><i class="fas fa-code-branch"></i> 89 forks</span>
                        </div>
                        <div class="bookmark-time">5 days ago</div>
                    </div>
                    <div class="bookmark-footer">
                        <div class="bookmark-tags">
                            <span class="tag">Laravel</span>
                            <span class="tag">Boilerplate</span>
                            <span class="tag">GitHub</span>
                        </div>
                        <div class="collection-badge tools">Dev Tools</div>
                    </div>
                </div>
            </div>

            <!-- Bookmark Item - Article Type -->
            <div class="bookmark-item article-type" data-collection="laravel" data-type="post">
                <div class="bookmark-card">
                    <div class="bookmark-article-header">
                        <div class="article-source">
                            <img src="https://via.placeholder.com/40/ff6b6b/ffffff?text=LN" alt="Laravel News">
                            <div class="source-info">
                                <div class="source-name">Laravel News</div>
                                <div class="source-verified"><i class="fas fa-check-circle"></i></div>
                            </div>
                        </div>
                        <div class="article-time">3 hours ago</div>
                    </div>
                    <div class="bookmark-content">
                        <div class="bookmark-title">Laravel 11 New Features and Performance Improvements</div>
                        <div class="bookmark-description">
                            Discover the latest features in Laravel 11 including improved performance, new Artisan commands, and enhanced security measures.
                        </div>
                    </div>
                    <div class="bookmark-meta">
                        <div class="reading-time">
                            <i class="fas fa-clock"></i>
                            <span>5 min read</span>
                        </div>
                        <div class="bookmark-actions">
                            <button class="bookmark-menu-btn" onclick="showBookmarkMenu(5)">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </div>
                    </div>
                    <div class="bookmark-footer">
                        <div class="bookmark-tags">
                            <span class="tag">Laravel 11</span>
                            <span class="tag">Performance</span>
                            <span class="tag">Features</span>
                        </div>
                        <div class="collection-badge laravel">Laravel Tips</div>
                    </div>
                </div>
            </div>

            <!-- Bookmark Item - Code Snippet -->
            <div class="bookmark-item code-type" data-collection="laravel" data-type="post">
                <div class="bookmark-card">
                    <div class="bookmark-header">
                        <div class="bookmark-author">
                            <img src="https://via.placeholder.com/30/ffd400/000000?text=JS" alt="JavaScript Ninja">
                            <span>JavaScript Ninja</span>
                        </div>
                        <div class="bookmark-actions">
                            <button class="copy-code-btn" onclick="copyCode(this)" title="Copy code">
                                <i class="fas fa-copy"></i>
                            </button>
                            <button class="bookmark-menu-btn" onclick="showBookmarkMenu(6)">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </div>
                    </div>
                    <div class="bookmark-content">
                        <div class="bookmark-title">Laravel Route Model Binding Shortcut</div>
                        <div class="code-snippet">
                            <pre><code>// Instead of this
Route::get('/user/{id}', function ($id) {
    return User::findOrFail($id);
});

// Use this
Route::get('/user/{user}', function (User $user) {
    return $user;
});</code></pre>
                        </div>
                    </div>
                    <div class="bookmark-footer">
                        <div class="bookmark-tags">
                            <span class="tag">Laravel</span>
                            <span class="tag">Routing</span>
                            <span class="tag">Tips</span>
                        </div>
                        <div class="collection-badge laravel">Laravel Tips</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="image-modal" id="imageModal" style="display: none;">
    <div class="modal-backdrop" onclick="closeImageModal()"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h3>Image Preview</h3>
            <button class="close-modal-btn" onclick="closeImageModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-image">
            <img id="modalImage" src="" alt="">
        </div>
        <div class="modal-actions">
            <button class="modal-btn" onclick="downloadCurrentImage()">
                <i class="fas fa-download"></i>
                Download
            </button>
            <button class="modal-btn" onclick="shareCurrentImage()">
                <i class="fas fa-share"></i>
                Share
            </button>
        </div>
    </div>
</div>

<!-- Bookmark Menu -->
<div class="bookmark-context-menu" id="bookmarkMenu" style="display: none;">
    <div class="menu-item" onclick="editBookmark()">
        <i class="fas fa-edit"></i>
        <span>Edit</span>
    </div>
    <div class="menu-item" onclick="moveToCollection()">
        <i class="fas fa-folder"></i>
        <span>Move to Collection</span>
    </div>
    <div class="menu-item" onclick="copyBookmarkLink()">
        <i class="fas fa-link"></i>
        <span>Copy Link</span>
    </div>
    <div class="menu-item" onclick="shareBookmark()">
        <i class="fas fa-share"></i>
        <span>Share</span>
    </div>
    <div class="menu-item danger" onclick="removeBookmark()">
        <i class="fas fa-trash"></i>
        <span>Remove</span>
    </div>
</div>

@endsection
