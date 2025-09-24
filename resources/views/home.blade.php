@extends('layouts.app')

@section('title', 'Home / S App')

@section('content')
<div class="timeline-header">
    <h1>Home</h1>
    <button class="timeline-options" onclick="refreshFeed()">
        <i class="fas fa-sparkles"></i>
    </button>
</div>

<div class="timeline-tabs">
    <div class="tab active" onclick="switchTab(this, 'foryou')">For you</div>
    <div class="tab" onclick="switchTab(this, 'following')">Following</div>
</div>

<div class="compose-box">
    <div class="compose-avatar">
        <img src="https://via.placeholder.com/48" alt="Profile">
    </div>
    <div class="compose-input">
        <textarea placeholder="What's happening?" id="mainComposeText" oninput="updateMainCompose()"></textarea>
        <div class="compose-toolbar">
            <div class="compose-options">
                <button onclick="attachMedia('image')"><i class="fas fa-image"></i></button>
                <button onclick="attachMedia('video')"><i class="fas fa-video"></i></button>
                <button onclick="createPoll()"><i class="fas fa-poll"></i></button>
                <button onclick="addEmoji()"><i class="fas fa-smile"></i></button>
                <button onclick="schedulePost()"><i class="fas fa-calendar"></i></button>
                <button onclick="addLocation()"><i class="fas fa-map-marker-alt"></i></button>
            </div>
            <button class="post-btn disabled" onclick="postFromMain()" id="mainPostBtn">Post</button>
        </div>
    </div>
</div>

<div class="timeline-feed" id="timelineFeed">
    <!-- Static Posts -->
    <article class="post" data-post-id="1">
        <div class="post-avatar">
            <img src="https://via.placeholder.com/40" alt="TechGuru">
        </div>
        <div class="post-content">
            <div class="post-header">
                <div class="post-user-info">
                    <span class="post-name">Tech Guru</span>
                    <span class="post-handle">@techguru</span>
                    <span class="post-verified"><i class="fas fa-check-circle"></i></span>
                    <span class="post-time">2h</span>
                </div>
                <div class="post-menu">
                    <button class="menu-btn" onclick="showPostMenu(1)">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                </div>
            </div>
            
            <div class="post-text">
                Just launched my new Laravel project using the S App interface! The red and black theme with comic-style fonts gives it such a unique feel. 🔥 #Laravel #WebDev #SApp
            </div>
            
            <div class="post-actions">
                <button class="action-btn reply-btn" onclick="replyToPost(1)">
                    <i class="fas fa-comment"></i>
                    <span>42</span>
                </button>
                <button class="action-btn repost-btn" onclick="repostPost(1)">
                    <i class="fas fa-retweet"></i>
                    <span>18</span>
                </button>
                <button class="action-btn like-btn" onclick="toggleLike(1)">
                    <i class="fas fa-heart"></i>
                    <span>156</span>
                </button>
                <button class="action-btn bookmark-btn" onclick="bookmarkPost(1)">
                    <i class="fas fa-bookmark"></i>
                </button>
                <button class="action-btn share-btn" onclick="sharePost(1)">
                    <i class="fas fa-share"></i>
                </button>
            </div>
        </div>
    </article>

    <article class="post" data-post-id="2">
        <div class="post-avatar">
            <img src="https://via.placeholder.com/40" alt="DesignPro">
        </div>
        <div class="post-content">
            <div class="post-header">
                <div class="post-user-info">
                    <span class="post-name">Design Pro</span>
                    <span class="post-handle">@designpro</span>
                    <span class="post-time">4h</span>
                </div>
                <div class="post-menu">
                    <button class="menu-btn" onclick="showPostMenu(2)">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                </div>
            </div>
            
            <div class="post-text">
                The Marvel and DC universe inspired UI trends are taking over! Love how @johndoe implemented the comic book aesthetic in S App. The typography choices are *chef's kiss* 👌
            </div>
            
            <div class="post-media">
                <img src="https://via.placeholder.com/500x300/1a1a1a/e10600?text=Comic+UI+Design" alt="Comic UI Design">
            </div>
            
            <div class="post-actions">
                <button class="action-btn reply-btn" onclick="replyToPost(2)">
                    <i class="fas fa-comment"></i>
                    <span>23</span>
                </button>
                <button class="action-btn repost-btn" onclick="repostPost(2)">
                    <i class="fas fa-retweet"></i>
                    <span>67</span>
                </button>
                <button class="action-btn like-btn liked" onclick="toggleLike(2)">
                    <i class="fas fa-heart"></i>
                    <span>284</span>
                </button>
                <button class="action-btn bookmark-btn bookmarked" onclick="bookmarkPost(2)">
                    <i class="fas fa-bookmark"></i>
                </button>
                <button class="action-btn share-btn" onclick="sharePost(2)">
                    <i class="fas fa-share"></i>
                </button>
            </div>
        </div>
    </article>

    <article class="post" data-post-id="3">
        <div class="post-avatar">
            <img src="https://via.placeholder.com/40" alt="CodeMaster">
        </div>
        <div class="post-content">
            <div class="post-header">
                <div class="post-user-info">
                    <span class="post-name">Code Master</span>
                    <span class="post-handle">@codemaster</span>
                    <span class="post-time">6h</span>
                </div>
                <div class="post-menu">
                    <button class="menu-btn" onclick="showPostMenu(3)">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                </div>
            </div>
            
            <div class="post-text">
                Working on a new social media clone project. The challenge is making it stand out from the crowd. S App's approach with the retro-comic theme is brilliant! 🦸‍♂️⚡
                
                Key features I'm implementing:
                • Real-time notifications
                • AI-powered feed
                • Interactive animations
                • Mobile-first design
                
                #FullStack #JavaScript #Laravel
            </div>
            
            <div class="post-actions">
                <button class="action-btn reply-btn" onclick="replyToPost(3)">
                    <i class="fas fa-comment"></i>
                    <span>89</span>
                </button>
                <button class="action-btn repost-btn reposted" onclick="repostPost(3)">
                    <i class="fas fa-retweet"></i>
                    <span>34</span>
                </button>
                <button class="action-btn like-btn" onclick="toggleLike(3)">
                    <i class="fas fa-heart"></i>
                    <span>201</span>
                </button>
                <button class="action-btn bookmark-btn" onclick="bookmarkPost(3)">
                    <i class="fas fa-bookmark"></i>
                </button>
                <button class="action-btn share-btn" onclick="sharePost(3)">
                    <i class="fas fa-share"></i>
                </button>
            </div>
        </div>
    </article>

    <article class="post" data-post-id="4">
        <div class="post-avatar">
            <img src="https://via.placeholder.com/40" alt="UIDesigner">
        </div>
        <div class="post-content">
            <div class="post-header">
                <div class="post-user-info">
                    <span class="post-name">UI Designer</span>
                    <span class="post-handle">@uidesigner</span>
                    <span class="post-verified"><i class="fas fa-check-circle"></i></span>
                    <span class="post-time">8h</span>
                </div>
                <div class="post-menu">
                    <button class="menu-btn" onclick="showPostMenu(4)">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                </div>
            </div>
            
            <div class="post-text">
                🎨 Color theory in action! The red (#e10600) and black combo in S App creates such a powerful visual hierarchy. Perfect contrast ratios for accessibility too! 
                
                Who else is loving the superhero aesthetic trend in web design? 🦸‍♀️
            </div>
            
            <div class="post-actions">
                <button class="action-btn reply-btn" onclick="replyToPost(4)">
                    <i class="fas fa-comment"></i>
                    <span>76</span>
                </button>
                <button class="action-btn repost-btn" onclick="repostPost(4)">
                    <i class="fas fa-retweet"></i>
                    <span>92</span>
                </button>
                <button class="action-btn like-btn" onclick="toggleLike(4)">
                    <i class="fas fa-heart"></i>
                    <span>345</span>
                </button>
                <button class="action-btn bookmark-btn" onclick="bookmarkPost(4)">
                    <i class="fas fa-bookmark"></i>
                </button>
                <button class="action-btn share-btn" onclick="sharePost(4)">
                    <i class="fas fa-share"></i>
                </button>
            </div>
        </div>
    </article>
</div>

<div class="loading-indicator" id="loadingIndicator" style="display: none;">
    <div class="spinner"></div>
    <span>Loading more posts...</span>
</div>
@endsection
