// Global variables
let posts = [];
let currentPostId = 5; // Next ID for new posts

// Modal functionality
function openComposeModal() {
    document.getElementById('composeModal').style.display = 'block';
    document.getElementById('composeText').focus();
}

function closeComposeModal() {
    document.getElementById('composeModal').style.display = 'none';
    document.getElementById('composeText').value = '';
    updateCharCount();
}

// Character counter
function updateCharCount() {
    const textarea = document.getElementById('composeText');
    const counter = document.querySelector('.char-count');
    const postBtn = document.getElementById('modalPostBtn');
    const remaining = 280 - textarea.value.length;
    
    counter.textContent = remaining;
    
    // Update button state
    if (textarea.value.trim().length > 0 && remaining >= 0) {
        postBtn.disabled = false;
        postBtn.classList.remove('disabled');
    } else {
        postBtn.disabled = true;
        postBtn.classList.add('disabled');
    }
    
    // Update counter color
    if (remaining < 0) {
        counter.className = 'char-count danger';
    } else if (remaining < 20) {
        counter.className = 'char-count warning';
    } else {
        counter.className = 'char-count';
    }
}

// Main compose box functionality
function updateMainCompose() {
    const textarea = document.getElementById('mainComposeText');
    const postBtn = document.getElementById('mainPostBtn');
    
    if (textarea.value.trim().length > 0 && textarea.value.length <= 280) {
        postBtn.classList.remove('disabled');
        postBtn.disabled = false;
    } else {
        postBtn.classList.add('disabled');
        postBtn.disabled = true;
    }
    
    // Auto-resize textarea
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';
}

// Post functionality
function submitPost() {
    const content = document.getElementById('composeText').value.trim();
    if (!content || content.length > 280) return;
    
    addNewPost(content);
    closeComposeModal();
}

function postFromMain() {
    const content = document.getElementById('mainComposeText').value.trim();
    if (!content || content.length > 280) return;
    
    addNewPost(content);
    document.getElementById('mainComposeText').value = '';
    updateMainCompose();
}

function addNewPost(content) {
    const newPost = {
        id: currentPostId++,
        content: content,
        user: {
            name: 'John Doe',
            username: 'johndoe',
            avatar: 'https://via.placeholder.com/40'
        },
        time: 'now',
        replies: 0,
        reposts: 0,
        likes: 0,
        isLiked: false,
        isBookmarked: false,
        isReposted: false
    };
    
    const postHTML = `
        <article class="post" data-post-id="${newPost.id}">
            <div class="post-avatar">
                <img src="${newPost.user.avatar}" alt="${newPost.user.name}">
            </div>
            <div class="post-content">
                <div class="post-header">
                    <div class="post-user-info">
                        <span class="post-name">${newPost.user.name}</span>
                        <span class="post-handle">@${newPost.user.username}</span>
                        <span class="post-time">${newPost.time}</span>
                    </div>
                    <div class="post-menu">
                        <button class="menu-btn" onclick="showPostMenu(${newPost.id})">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </div>
                </div>
                <div class="post-text">${newPost.content}</div>
                <div class="post-actions">
                    <button class="action-btn reply-btn" onclick="replyToPost(${newPost.id})">
                        <i class="fas fa-comment"></i>
                        <span>${newPost.replies}</span>
                    </button>
                    <button class="action-btn repost-btn" onclick="repostPost(${newPost.id})">
                        <i class="fas fa-retweet"></i>
                        <span>${newPost.reposts}</span>
                    </button>
                    <button class="action-btn like-btn" onclick="toggleLike(${newPost.id})">
                        <i class="fas fa-heart"></i>
                        <span>${newPost.likes}</span>
                    </button>
                    <button class="action-btn bookmark-btn" onclick="bookmarkPost(${newPost.id})">
                        <i class="fas fa-bookmark"></i>
                    </button>
                    <button class="action-btn share-btn" onclick="sharePost(${newPost.id})">
                        <i class="fas fa-share"></i>
                    </button>
                </div>
            </div>
        </article>
    `;
    
    const feed = document.getElementById('timelineFeed');
    feed.insertAdjacentHTML('afterbegin', postHTML);
    
    // Animate the new post
    const newPostElement = feed.firstElementChild;
    newPostElement.style.transform = 'translateY(-20px)';
    newPostElement.style.opacity = '0';
    setTimeout(() => {
        newPostElement.style.transition = 'all 0.3s ease';
        newPostElement.style.transform = 'translateY(0)';
        newPostElement.style.opacity = '1';
    }, 10);
}

// Post interaction functions
function toggleLike(postId) {
    const btn = document.querySelector(`[data-post-id="${postId}"] .like-btn`);
    const countSpan = btn.querySelector('span');
    const currentCount = parseInt(countSpan.textContent);
    
    if (btn.classList.contains('liked')) {
        btn.classList.remove('liked');
        countSpan.textContent = currentCount - 1;
    } else {
        btn.classList.add('liked');
        countSpan.textContent = currentCount + 1;
        
        // Add heart animation
        const heart = btn.querySelector('i');
        heart.style.animation = 'heartPulse 0.3s ease';
        setTimeout(() => {
            heart.style.animation = '';
        }, 300);
    }
}

function repostPost(postId) {
    const btn = document.querySelector(`[data-post-id="${postId}"] .repost-btn`);
    const countSpan = btn.querySelector('span');
    const currentCount = parseInt(countSpan.textContent);
    
    if (btn.classList.contains('reposted')) {
        btn.classList.remove('reposted');
        countSpan.textContent = currentCount - 1;
    } else {
        btn.classList.add('reposted');
        countSpan.textContent = currentCount + 1;
    }
}

function bookmarkPost(postId) {
    const btn = document.querySelector(`[data-post-id="${postId}"] .bookmark-btn`);
    
    if (btn.classList.contains('bookmarked')) {
        btn.classList.remove('bookmarked');
    } else {
        btn.classList.add('bookmarked');
    }
}

function replyToPost(postId) {
    alert(`Reply to post ${postId} - This would open reply modal in full app`);
}

function sharePost(postId) {
    if (navigator.share) {
        navigator.share({
            title: 'S App Post',
            text: 'Check out this post on S App!',
            url: window.location.href
        });
    } else {
        navigator.clipboard.writeText(window.location.href);
        alert('Link copied to clipboard!');
    }
}

function showPostMenu(postId) {
    alert(`Post menu for ${postId} - Edit, Delete, etc.`);
}

// Tab switching
function switchTab(tabElement, tabType) {
    document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
    tabElement.classList.add('active');
    
    // In a real app, this would load different content
    console.log(`Switched to ${tabType} tab`);
}

// Follow functionality
function toggleFollow(btn) {
    if (btn.classList.contains('following')) {
        btn.textContent = 'Follow';
        btn.classList.remove('following');
    } else {
        btn.textContent = 'Following';
        btn.classList.add('following');
    }
}

// Media attachment functions
function attachMedia(type) {
    alert(`${type} attachment - File picker would open in full app`);
}

function createPoll() {
    alert('Poll creation - Poll interface would open in full app');
}

function addEmoji() {
    alert('Emoji picker - Emoji selector would open in full app');
}

function schedulePost() {
    alert('Schedule post - Date/time picker would open in full app');
}

function addLocation() {
    alert('Add location - Location picker would open in full app');
}

// Other functions
function refreshFeed() {
    const indicator = document.getElementById('loadingIndicator');
    indicator.style.display = 'flex';
    
    setTimeout(() => {
        indicator.style.display = 'none';
        alert('Feed refreshed!');
    }, 1000);
}

function toggleUserMenu() {
    alert('User menu - Profile options would appear in full app');
}

// Search functionality
function setupSearch() {
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function() {
        const query = this.value;
        if (query.length > 2) {
            console.log(`Searching for: ${query}`);
            // In a real app, this would trigger search API
        }
    });
}

// Infinite scroll simulation
let isLoadingMore = false;

function simulateInfiniteScroll() {
    window.addEventListener('scroll', function() {
        if (isLoadingMore) return;
        
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 1000) {
            loadMorePosts();
        }
    });
}

function loadMorePosts() {
    isLoadingMore = true;
    const indicator = document.getElementById('loadingIndicator');
    indicator.style.display = 'flex';
    
    setTimeout(() => {
        // Add some sample posts
        const samplePosts = [
            'Just discovered an amazing new CSS trick! 🔥',
            'Working late on my Laravel project. The grind never stops! 💪',
            'Anyone else excited about the new JavaScript features? 🚀',
            'Coffee + Code = Perfect Monday morning ☕️',
            'The S App interface is looking incredible! 🎨'
        ];
        
        const randomPost = samplePosts[Math.floor(Math.random() * samplePosts.length)];
        addNewPost(randomPost);
        
        indicator.style.display = 'none';
        isLoadingMore = false;
    }, 1500);
}

// Add CSS keyframes for animations
const style = document.createElement('style');
style.textContent = `
    @keyframes heartPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }
`;
document.head.appendChild(style);

// Initialize when DOM loads
document.addEventListener('DOMContentLoaded', function() {
    setupSearch();
    simulateInfiniteScroll();
    
    // Character counter for compose modal
    const composeText = document.getElementById('composeText');
    if (composeText) {
        composeText.addEventListener('input', updateCharCount);
    }
    
    // Main compose box setup
    const mainComposeText = document.getElementById('mainComposeText');
    if (mainComposeText) {
        mainComposeText.addEventListener('input', updateMainCompose);
    }
    
    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('composeModal');
        if (event.target === modal) {
            closeComposeModal();
        }
    });
    
    // Keyboard shortcuts
    document.addEventListener('keydown', function(event) {
        // Ctrl/Cmd + Enter to post
        if ((event.ctrlKey || event.metaKey) && event.key === 'Enter') {
            const modalText = document.getElementById('composeText');
            const mainText = document.getElementById('mainComposeText');
            
            if (modalText && modalText === document.activeElement) {
                submitPost();
            } else if (mainText && mainText === document.activeElement) {
                postFromMain();
            }
        }
        
        // Escape to close modal
        if (event.key === 'Escape') {
            closeComposeModal();
        }
    });
});

//explore tab

// Explore Tab Functionality
function switchExploreTab(tabElement, tabType) {
    // Remove active class from all tabs
    document.querySelectorAll('.explore-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    
    // Add active class to clicked tab
    tabElement.classList.add('active');
    
    // Hide all sections
    document.querySelectorAll('.explore-section').forEach(section => {
        section.classList.add('hidden');
    });
    
    // Show selected section
    const sectionId = `${tabType}-section`;
    const targetSection = document.getElementById(sectionId);
    if (targetSection) {
        targetSection.classList.remove('hidden');
    }
    
    console.log(`Switched to ${tabType} explore tab`);
}

// Media Filter Functionality
function filterMedia(type) {
    // Update filter buttons
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
    
    // Filter media items
    const mediaItems = document.querySelectorAll('.media-item');
    mediaItems.forEach(item => {
        if (type === 'all' || item.classList.contains(type.slice(0, -1))) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
    
    console.log(`Filtered media by: ${type}`);
}

// Follow Topic Functionality
function followTopic(topicId) {
    const btn = event.target;
    
    if (btn.textContent === 'Follow') {
        btn.textContent = 'Following';
        btn.style.backgroundColor = '#e10600';
        btn.style.color = 'white';
        btn.style.borderColor = '#e10600';
        
        // Add animation
        btn.style.transform = 'scale(1.1)';
        setTimeout(() => {
            btn.style.transform = 'scale(1)';
        }, 200);
    } else {
        btn.textContent = 'Follow';
        btn.style.backgroundColor = 'transparent';
        btn.style.color = '#e10600';
        btn.style.borderColor = '#e10600';
    }
    
    console.log(`Toggled follow for topic: ${topicId}`);
}

// Follow Person Functionality
function followPerson(personId) {
    const btn = event.target;
    
    if (btn.textContent === 'Follow') {
        btn.textContent = 'Following';
        btn.style.backgroundColor = 'transparent';
        btn.style.color = '#e10600';
        btn.style.border = '2px solid #e10600';
        
        // Add animation
        btn.style.transform = 'scale(1.1)';
        setTimeout(() => {
            btn.style.transform = 'scale(1)';
        }, 200);
    } else {
        btn.textContent = 'Follow';
        btn.style.backgroundColor = '#e10600';
        btn.style.color = 'white';
        btn.style.border = 'none';
    }
    
    console.log(`Toggled follow for person: ${personId}`);
}

// Explore Search Functionality
function setupExploreSearch() {
    const searchInput = document.getElementById('exploreSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            
            if (query.length > 2) {
                // Simulate search results
                console.log(`Searching explore for: ${query}`);
                
                // In a real app, this would trigger API calls
                // and update the content sections with search results
                
                // Show loading indicator
                const loading = document.getElementById('exploreLoading');
                if (loading) {
                    loading.style.display = 'flex';
                    
                    setTimeout(() => {
                        loading.style.display = 'none';
                        console.log(`Search completed for: ${query}`);
                    }, 1500);
                }
            }
        });
    }
}

// Infinite Scroll for Explore
function setupExploreInfiniteScroll() {
    let isLoading = false;
    
    window.addEventListener('scroll', function() {
        if (isLoading) return;
        
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 1000) {
            loadMoreExploreContent();
        }
    });
    
    function loadMoreExploreContent() {
        isLoading = true;
        const loading = document.getElementById('exploreLoading');
        
        if (loading) {
            loading.style.display = 'flex';
            
            setTimeout(() => {
                // Add more content based on active tab
                const activeTab = document.querySelector('.explore-tab.active');
                const tabType = activeTab ? activeTab.textContent.trim().toLowerCase() : 'trending';
                
                console.log(`Loading more ${tabType} content...`);
                
                // In a real app, this would load more content from API
                
                loading.style.display = 'none';
                isLoading = false;
            }, 2000);
        }
    }
}

// Initialize Explore functionality
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('exploreSearch')) {
        setupExploreSearch();
        setupExploreInfiniteScroll();
    }
});

//notification tabb

// Notification functionality
let currentStoryIndex = 0;
let storyTimer;

function toggleNotificationFilters() {
    const filters = document.getElementById('notificationFilters');
    const toggle = document.querySelector('.filter-toggle');
    
    filters.classList.toggle('active');
    toggle.classList.toggle('active');
    
    // Update aria attributes for accessibility
    const isActive = filters.classList.contains('active');
    toggle.setAttribute('aria-expanded', isActive);
    
    // Change icon based on state
    const icon = toggle.querySelector('i');
    if (isActive) {
        icon.className = 'fas fa-times';
    } else {
        icon.className = 'fas fa-filter';
    }
}


function filterNotifications(category) {
    // Update filter buttons
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    document.querySelector(`[data-filter="${category}"]`).classList.add('active');
    
    // Filter notifications
    const notifications = document.querySelectorAll('.notification-item');
    const groups = document.querySelectorAll('.notification-group');
    
    if (category === 'all') {
        notifications.forEach(item => item.classList.remove('hidden'));
        groups.forEach(group => group.classList.remove('hidden'));
    } else {
        notifications.forEach(item => {
            if (item.dataset.type === category) {
                item.classList.remove('hidden');
            } else {
                item.classList.add('hidden');
            }
        });
        
        // Hide groups that have no visible notifications
        groups.forEach(group => {
            const visibleNotifications = group.querySelectorAll('.notification-item:not(.hidden)');
            if (visibleNotifications.length === 0) {
                group.classList.add('hidden');
            } else {
                group.classList.remove('hidden');
            }
        });
    }
    
    console.log(`Filtered notifications by: ${category}`);
}

function toggleGroup(groupId) {
    const group = document.querySelector(`.notification-group.${groupId}`);
    const content = group.querySelector('.group-content');
    content.classList.toggle('expanded');
}

function openNotificationStory(storyType) {
    const modal = document.getElementById('notificationStoryModal');
    const storyBody = document.getElementById('storyBody');
    
    modal.style.display = 'block';
    
    // Different story content based on type
    const storyContent = {
        'viral-post': generateViralPostStory(),
        'new-followers': generateFollowersStory(),
        'trending': generateTrendingStory(),
        'mentions': generateMentionsStory()
    };
    
    storyBody.innerHTML = storyContent[storyType] || '<p>Story not found</p>';
    
    // Start progress animation
    startStoryProgress();
}

function generateViralPostStory() {
    return `
        <div class="story-slide">
            <h2 style="color: #e10600; margin-bottom: 20px;">🔥 Your Post Went Viral!</h2>
            <div style="background: #1a1a1a; padding: 20px; border-radius: 16px; max-width: 500px;">
                <p style="color: #e1e8ed; font-size: 1.1rem; margin-bottom: 16px;">
                    "The Marvel and DC inspired interface is absolutely stunning! 🦸‍♂️"
                </p>
                <div style="display: flex; gap: 20px; color: #8b98a5;">
                    <span><i class="fas fa-heart" style="color: #f91880;"></i> 2,345 likes</span>
                    <span><i class="fas fa-retweet" style="color: #00ba7c;"></i> 567 reposts</span>
                    <span><i class="fas fa-comment" style="color: #1d9bf0;"></i> 234 replies</span>
                </div>
            </div>
            <p style="color: #d1d9df; margin-top: 20px;">
                Your superhero-themed UI post reached 45,000+ people!
            </p>
        </div>
    `;
}

function generateFollowersStory() {
    return `
        <div class="story-slide">
            <h2 style="color: #1d9bf0; margin-bottom: 20px;">👥 New Squad Members</h2>
            <div style="display: flex; flex-direction: column; gap: 16px; max-width: 400px;">
                <div style="display: flex; align-items: center; gap: 12px; background: #1a1a1a; padding: 16px; border-radius: 12px;">
                    <img src="https://via.placeholder.com/50/e10600/ffffff?text=TG" style="border-radius: 50%;">
                    <div>
                        <div style="color: #e1e8ed; font-weight: bold;">Tech Guru</div>
                        <div style="color: #8b98a5; font-size: 0.9rem;">@techguru • 125K followers</div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 12px; background: #1a1a1a; padding: 16px; border-radius: 12px;">
                    <img src="https://via.placeholder.com/50/1d9bf0/ffffff?text=DP" style="border-radius: 50%;">
                    <div>
                        <div style="color: #e1e8ed; font-weight: bold;">Design Pro</div>
                        <div style="color: #8b98a5; font-size: 0.9rem;">@designpro • 89K followers</div>
                    </div>
                </div>
            </div>
            <p style="color: #d1d9df; margin-top: 20px;">
                8 new developers joined your superhero community today!
            </p>
        </div>
    `;
}

function generateTrendingStory() {
    return `
        <div class="story-slide">
            <h2 style="color: #00ba7c; margin-bottom: 20px;">📈 You're Trending</h2>
            <div style="background: #1a1a1a; padding: 20px; border-radius: 16px; max-width: 500px;">
                <div style="color: #e1e8ed; margin-bottom: 16px;">
                    <strong>#LaravelSuperhero</strong> is trending because of your tutorial
                </div>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; color: #8b98a5; font-size: 0.9rem;">
                    <div><i class="fas fa-eye" style="color: #00ba7c;"></i> 12.5K views</div>
                    <div><i class="fas fa-share" style="color: #1d9bf0;"></i> 892 shares</div>
                    <div><i class="fas fa-bookmark" style="color: #ffd400;"></i> 445 saves</div>
                    <div><i class="fas fa-comments" style="color: #f91880;"></i> 234 discussions</div>
                </div>
            </div>
            <p style="color: #d1d9df; margin-top: 20px;">
                Your content is inspiring the developer community!
            </p>
        </div>
    `;
}

function generateMentionsStory() {
    return `
        <div class="story-slide">
            <h2 style="color: #f91880; margin-bottom: 20px;">@ Mentions</h2>
            <div style="display: flex; flex-direction: column; gap: 16px; max-width: 500px;">
                <div style="background: #1a1a1a; padding: 16px; border-radius: 12px;">
                    <div style="color: #e1e8ed; margin-bottom: 8px;">
                        <strong>@techpro:</strong> "Hey @johndoe, your S App clone is revolutionary!"
                    </div>
                    <div style="color: #8b98a5; font-size: 0.9rem;">5 minutes ago</div>
                </div>
                <div style="background: #1a1a1a; padding: 16px; border-radius: 12px;">
                    <div style="color: #e1e8ed; margin-bottom: 8px;">
                        <strong>@webwizard:</strong> "Can @johndoe share the superhero theme source?"
                    </div>
                    <div style="color: #8b98a5; font-size: 0.9rem;">12 minutes ago</div>
                </div>
            </div>
            <p style="color: #d1d9df; margin-top: 20px;">
                6 people mentioned you in their posts today
            </p>
        </div>
    `;
}

function startStoryProgress() {
    const progressBar = document.getElementById('storyProgress');
    let width = 0;
    
    storyTimer = setInterval(() => {
        width += 2;
        progressBar.style.width = width + '%';
        
        if (width >= 100) {
            closeNotificationStory();
        }
    }, 100);
}

function closeNotificationStory() {
    const modal = document.getElementById('notificationStoryModal');
    modal.style.display = 'none';
    
    if (storyTimer) {
        clearInterval(storyTimer);
    }
    
    const progressBar = document.getElementById('storyProgress');
    progressBar.style.width = '0%';
}

function quickReply(notificationId) {
    const modal = document.getElementById('quickReplyModal');
    modal.style.display = 'block';
    modal.dataset.notificationId = notificationId;
    document.getElementById('quickReplyText').focus();
}

function closeQuickReply() {
    const modal = document.getElementById('quickReplyModal');
    modal.style.display = 'none';
    document.getElementById('quickReplyText').value = '';
}

function sendQuickReply() {
    const modal = document.getElementById('quickReplyModal');
    const text = document.getElementById('quickReplyText').value.trim();
    const notificationId = modal.dataset.notificationId;
    
    if (text) {
        console.log(`Sending reply to ${notificationId}: ${text}`);
        
        // Animate success
        const sendBtn = document.querySelector('.send-btn');
        sendBtn.textContent = 'Sent!';
        sendBtn.style.backgroundColor = '#00ba7c';
        
        setTimeout(() => {
            closeQuickReply();
            sendBtn.textContent = 'Send';
            sendBtn.style.backgroundColor = '#e10600';
        }, 1000);
    }
}

function likeNotification(notificationId) {
    console.log(`Liked notification: ${notificationId}`);
    
    const btn = event.target.closest('.quick-action');
    const heart = btn.querySelector('i');
    
    heart.style.color = '#f91880';
    heart.style.animation = 'heartPulse 0.3s ease';
    
    setTimeout(() => {
        heart.style.animation = '';
    }, 300);
}

function followBack(userId) {
    console.log(`Following back: ${userId}`);
    
    const btn = event.target;
    btn.textContent = 'Following';
    btn.style.backgroundColor = 'transparent';
    btn.style.border = '2px solid #e10600';
    btn.style.color = '#e10600';
}

function celebrateAchievement() {
    console.log('Celebrating achievement!');
    
    const btn = event.target.closest('.quick-action');
    btn.innerHTML = '<i class="fas fa-check"></i> Celebrated!';
    btn.style.backgroundColor = '#00ba7c';
    
    // Create celebration effect
    createCelebrationEffect(btn);
}

function createCelebrationEffect(element) {
    const rect = element.getBoundingClientRect();
    const colors = ['#ffd400', '#ff6b00', '#e10600', '#f91880', '#8b5cf6'];
    
    for (let i = 0; i < 10; i++) {
        const particle = document.createElement('div');
        particle.style.position = 'fixed';
        particle.style.left = rect.left + rect.width / 2 + 'px';
        particle.style.top = rect.top + rect.height / 2 + 'px';
        particle.style.width = '6px';
        particle.style.height = '6px';
        particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        particle.style.borderRadius = '50%';
        particle.style.pointerEvents = 'none';
        particle.style.zIndex = '9999';
        
        document.body.appendChild(particle);
        
        const angle = (Math.PI * 2 * i) / 10;
        const velocity = 100 + Math.random() * 100;
        const gravity = 500;
        
        let x = 0, y = 0, vx = Math.cos(angle) * velocity, vy = Math.sin(angle) * velocity;
        
        function animate() {
            x += vx * 0.02;
            y += vy * 0.02;
            vy += gravity * 0.02;
            
            particle.style.transform = `translate(${x}px, ${y}px)`;
            particle.style.opacity = Math.max(0, 1 - Math.sqrt(x*x + y*y) / 200);
            
            if (particle.style.opacity > 0) {
                requestAnimationFrame(animate);
            } else {
                document.body.removeChild(particle);
            }
        }
        
        requestAnimationFrame(animate);
    }
}

function expandWeeklyNotifications() {
    console.log('Expanding weekly notifications...');
    alert('This would load all weekly notifications in a real app');
}

function openNotificationSettings() {
    console.log('Opening notification settings...');
    alert('Notification settings would open here');
}

// Auto-mark notifications as read when scrolled into view
function setupReadTracking() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const notification = entry.target;
                if (notification.classList.contains('unread')) {
                    setTimeout(() => {
                        notification.classList.remove('unread');
                        updateNotificationCount();
                    }, 2000);
                }
            }
        });
    });
    
    document.querySelectorAll('.notification-item.unread').forEach(item => {
        observer.observe(item);
    });
}

function updateNotificationCount() {
    const unreadCount = document.querySelectorAll('.notification-item.unread').length;
    // Update counts in filter buttons
    document.querySelectorAll('.notification-count').forEach(counter => {
        // In a real app, this would update based on filtered counts
    });
}

// Initialize notifications functionality
document.addEventListener('DOMContentLoaded', function() {
    if (window.location.pathname.includes('/notifications')) {
        setupReadTracking();
        
        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            const storyModal = document.getElementById('notificationStoryModal');
            const quickModal = document.getElementById('quickReplyModal');
            
            if (event.target === storyModal) {
                closeNotificationStory();
            }
            
            if (event.target === quickModal) {
                closeQuickReply();
            }
        });
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeNotificationStory();
                closeQuickReply();
            }
        });
    }
});

// Auto-show filters on notifications page
document.addEventListener('DOMContentLoaded', function() {
    if (window.location.pathname.includes('/notifications')) {
        // Auto-expand filters on load
        setTimeout(() => {
            const filters = document.getElementById('notificationFilters');
            if (filters && !filters.classList.contains('active')) {
                toggleNotificationFilters();
            }
        }, 500);
        
        // Rest of your initialization code...
        setupReadTracking();
    }
});

//Message tab

// Floating Bubble Chat System
let openWindows = new Map();
let windowZIndex = 1001;
let draggedWindow = null;
let dragOffset = { x: 0, y: 0 };

document.addEventListener('DOMContentLoaded', function() {
    if (window.location.pathname.includes('/messages')) {
        initializeBubbleSystem();
        setupWindowDragging();
        randomizeBubblePositions();
    }
});

function initializeBubbleSystem() {
    // Add floating animation to bubbles
    const bubbles = document.querySelectorAll('.chat-bubble');
    bubbles.forEach((bubble, index) => {
        // Add subtle floating animation with different delays
        bubble.style.animationDelay = `${index * 0.2}s`;
        bubble.classList.add('floating-bubble');
    });
}

function randomizeBubblePositions() {
    const bubbles = document.querySelectorAll('.chat-bubble');
    const container = document.querySelector('.chat-bubbles-container');
    
    bubbles.forEach(bubble => {
        // Add slight randomization to positions for more natural look
        const randomX = Math.random() * 10 - 5; // -5 to 5px
        const randomY = Math.random() * 10 - 5; // -5 to 5px
        bubble.style.transform = `translate(${randomX}px, ${randomY}px)`;
    });
}

function burstBubble(bubbleElement, userName, type) {
    // Create burst effect
    bubbleElement.style.animation = 'burstEffect 0.5s ease-out';
    
    // Create floating particles
    createBurstParticles(bubbleElement);
    
    // Wait for animation to complete, then open window
    setTimeout(() => {
        openFloatingWindow(bubbleElement.dataset.chatId, userName, type);
        // Reset bubble
        bubbleElement.style.animation = '';
        bubbleElement.style.transform = '';
        
        // Remove unread indicators
        bubbleElement.classList.remove('unread-bubble');
        const unreadBadge = bubbleElement.querySelector('.unread-badge');
        if (unreadBadge) unreadBadge.remove();
        
    }, 500);
}

function createBurstParticles(element) {
    const rect = element.getBoundingClientRect();
    const centerX = rect.left + rect.width / 2;
    const centerY = rect.top + rect.height / 2;
    
    // Create 8 particles
    for (let i = 0; i < 8; i++) {
        const particle = document.createElement('div');
        particle.style.position = 'fixed';
        particle.style.left = centerX + 'px';
        particle.style.top = centerY + 'px';
        particle.style.width = '6px';
        particle.style.height = '6px';
        particle.style.background = '#e10600';
        particle.style.borderRadius = '50%';
        particle.style.pointerEvents = 'none';
        particle.style.zIndex = '9999';
        
        document.body.appendChild(particle);
        
        // Animate particle
        const angle = (Math.PI * 2 * i) / 8;
        const distance = 100 + Math.random() * 50;
        const endX = centerX + Math.cos(angle) * distance;
        const endY = centerY + Math.sin(angle) * distance;
        
        particle.animate([
            { transform: 'translate(0, 0) scale(1)', opacity: 1 },
            { transform: `translate(${endX - centerX}px, ${endY - centerY}px) scale(0)`, opacity: 0 }
        ], {
            duration: 800,
            easing: 'ease-out'
        }).onfinish = () => {
            document.body.removeChild(particle);
        };
    }
}

function openFloatingWindow(chatId, userName, type) {
    // Check if window is already open
    if (openWindows.has(chatId)) {
        const existingWindow = openWindows.get(chatId);
        existingWindow.style.zIndex = ++windowZIndex;
        existingWindow.classList.remove('minimized');
        return;
    }
    
    // Create new floating window
    const windowElement = createFloatingWindow(chatId, userName, type);
    const container = document.getElementById('floatingWindows');
    container.appendChild(windowElement);
    
    // Store reference
    openWindows.set(chatId, windowElement);
    
    // Position window
    positionWindow(windowElement);
    
    // Load messages
    loadWindowMessages(chatId, windowElement);
    
    // Focus on input
    setTimeout(() => {
        const input = windowElement.querySelector('.window-message-input');
        if (input) input.focus();
    }, 100);
}

function createFloatingWindow(chatId, userName, type) {
    const windowDiv = document.createElement('div');
    windowDiv.className = 'floating-chat-window';
    windowDiv.dataset.chatId = chatId;
    windowDiv.style.zIndex = ++windowZIndex;
    
    // Get avatar HTML based on type
    let avatarHtml = '';
    if (type === 'ai') {
        avatarHtml = `<div class="ai-avatar"><i class="fas fa-robot"></i></div>`;
    } else {
        const avatarMap = {
            'tech-guru': 'https://via.placeholder.com/35/1d9bf0/ffffff?text=TG',
            'laravel-team': 'https://via.placeholder.com/35/e10600/ffffff?text=LT',
            'design-pro': 'https://via.placeholder.com/35/00ba7c/ffffff?text=DP',
            'code-master': 'https://via.placeholder.com/35/8b5cf6/ffffff?text=CM',
            'js-study': 'https://via.placeholder.com/35/ffd400/000000?text=JS'
        };
        avatarHtml = `<img src="${avatarMap[chatId]}" alt="${userName}">`;
    }
    
    const statusText = type === 'ai' ? 'AI Assistant' : type === 'group' ? 'Group Chat' : 'Online';
    
    windowDiv.innerHTML = `
        <div class="window-header">
            <div class="window-user-info">
                <div class="window-avatar">${avatarHtml}</div>
                <div class="window-user-details">
                    <h3>${userName}</h3>
                    <span>${statusText}</span>
                </div>
            </div>
            <div class="window-controls">
                <button class="window-control-btn minimize-btn" onclick="toggleMinimize('${chatId}')">
                    <i class="fas fa-minus"></i>
                </button>
                <button class="window-control-btn close-btn" onclick="closeWindow('${chatId}')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="window-messages" id="messages-${chatId}"></div>
        <div class="window-input">
            <div class="window-input-wrapper">
                <textarea 
                    class="window-message-input" 
                    placeholder="Type a message..." 
                    onkeydown="handleWindowInput(event, '${chatId}')"
                    oninput="autoResizeWindowInput(this, '${chatId}')"
                ></textarea>
                <button class="window-send-btn" onclick="sendWindowMessage('${chatId}')" disabled>
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    `;
    
    return windowDiv;
}

function positionWindow(windowElement) {
    // Calculate position to avoid overlap
    const windows = document.querySelectorAll('.floating-chat-window');
    const windowCount = windows.length;
    
    // Stagger windows diagonally
    const offsetX = ((windowCount - 1) * 30) % (window.innerWidth - 400);
    const offsetY = ((windowCount - 1) * 30) % (window.innerHeight - 500);
    
    windowElement.style.left = Math.max(20, offsetX) + 'px';
    windowElement.style.top = Math.max(80, offsetY) + 'px';
}

function loadWindowMessages(chatId, windowElement) {
    const messagesContainer = windowElement.querySelector(`#messages-${chatId}`);
    
    // Sample messages for each chat
    const sampleMessages = {
        'ai-assistant': [
            { type: 'received', content: 'Hello! How can I help you today? 🤖', time: 'now' }
        ],
        'tech-guru': [
            { type: 'received', content: 'Your S App design is incredible! 🦸‍♂️', time: '5m' },
            { type: 'sent', content: 'Thank you so much! 😊', time: '3m' }
        ],
        'laravel-team': [
            { type: 'received', content: 'New authentication ready! 🔐', time: '10m', sender: 'Sarah' }
        ],
        'design-pro': [
            { type: 'received', content: 'Check this design! 🎨', time: '1h' }
        ],
        'code-master': [
            { type: 'received', content: 'Thanks for the Laravel tips! 👨‍💻', time: '2h' }
        ],
        'js-study': [
            { type: 'received', content: 'Coding challenge time! 🥷', time: '3h', sender: 'Alex' }
        ]
    };
    
    const messages = sampleMessages[chatId] || [];
    messages.forEach(msg => {
        addWindowMessage(chatId, msg.type, msg.content, msg.sender);
    });
    
    // Scroll to bottom
    setTimeout(() => {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }, 100);
}

function addWindowMessage(chatId, type, content, sender = null) {
    const messagesContainer = document.querySelector(`#messages-${chatId}`);
    if (!messagesContainer) return;
    
    const messageDiv = document.createElement('div');
    messageDiv.className = `window-message ${type}`;
    
    let avatarHtml = '';
    if (type === 'received') {
        if (chatId === 'ai-assistant') {
            avatarHtml = `<div class="window-message-avatar"><div class="ai-avatar"><i class="fas fa-robot"></i></div></div>`;
        } else {
            const avatarMap = {
                'tech-guru': 'https://via.placeholder.com/28/1d9bf0/ffffff?text=TG',
                'laravel-team': 'https://via.placeholder.com/28/00ba7c/ffffff?text=S',
                'design-pro': 'https://via.placeholder.com/28/00ba7c/ffffff?text=DP',
                'code-master': 'https://via.placeholder.com/28/8b5cf6/ffffff?text=CM',
                'js-study': 'https://via.placeholder.com/28/ffd400/000000?text=A'
            };
            avatarHtml = `<div class="window-message-avatar"><img src="${avatarMap[chatId]}" alt="User"></div>`;
        }
    }
    
    const senderText = sender ? `<strong>${sender}:</strong> ` : '';
    
    messageDiv.innerHTML = `
        ${avatarHtml}
        <div class="window-message-bubble">
            ${senderText}${content}
        </div>
    `;
    
    messagesContainer.appendChild(messageDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

function handleWindowInput(event, chatId) {
    if (event.key === 'Enter' && !event.shiftKey) {
        event.preventDefault();
        sendWindowMessage(chatId);
    }
}

function sendWindowMessage(chatId) {
    const windowElement = openWindows.get(chatId);
    if (!windowElement) return;
    
    const input = windowElement.querySelector('.window-message-input');
    const content = input.value.trim();
    
    if (!content) return;
    
    // Add message
    addWindowMessage(chatId, 'sent', content);
    
    // Clear input
    input.value = '';
    input.style.height = 'auto';
    updateWindowSendButton(chatId);
    
    // Simulate response
    setTimeout(() => {
        const responses = {
            'ai-assistant': "I understand! How can I help you with that? 🤖",
            'tech-guru': "Sounds great! Let's collaborate 🚀",
            'laravel-team': "Perfect! Moving forward 👍",
            'design-pro': "Thanks! Will update soon 🎨",
            'code-master': "Happy to help! 👨‍💻",
            'js-study': "Great! Let's code together 💻"
        };
        
        const response = responses[chatId] || "Thanks for your message! 😊";
        addWindowMessage(chatId, 'received', response);
    }, 1000);
}

function autoResizeWindowInput(textarea, chatId) {
    textarea.style.height = 'auto';
    textarea.style.height = Math.min(textarea.scrollHeight, 80) + 'px';
    updateWindowSendButton(chatId);
}

function updateWindowSendButton(chatId) {
    const windowElement = openWindows.get(chatId);
    if (!windowElement) return;
    
    const input = windowElement.querySelector('.window-message-input');
    const sendBtn = windowElement.querySelector('.window-send-btn');
    
    if (input.value.trim()) {
        sendBtn.disabled = false;
        sendBtn.style.opacity = '1';
    } else {
        sendBtn.disabled = true;
        sendBtn.style.opacity = '0.5';
    }
}

function toggleMinimize(chatId) {
    const windowElement = openWindows.get(chatId);
    if (!windowElement) return;
    
    windowElement.classList.toggle('minimized');
    
    const messages = windowElement.querySelector('.window-messages');
    const input = windowElement.querySelector('.window-input');
    
    if (windowElement.classList.contains('minimized')) {
        messages.classList.add('minimized');
        input.classList.add('minimized');
    } else {
        messages.classList.remove('minimized');
        input.classList.remove('minimized');
    }
}

function closeWindow(chatId) {
    const windowElement = openWindows.get(chatId);
    if (!windowElement) return;
    
    // Animate close
    windowElement.style.animation = 'burstEffect 0.3s ease-out reverse';
    
    setTimeout(() => {
        windowElement.remove();
        openWindows.delete(chatId);
    }, 300);
}

// Window dragging functionality
function setupWindowDragging() {
    document.addEventListener('mousedown', startDrag);
    document.addEventListener('mousemove', drag);
    document.addEventListener('mouseup', stopDrag);
}

function startDrag(event) {
    const header = event.target.closest('.window-header');
    if (!header) return;
    
    const windowElement = header.closest('.floating-chat-window');
    if (!windowElement) return;
    
    draggedWindow = windowElement;
    windowElement.style.zIndex = ++windowZIndex;
    
    const rect = windowElement.getBoundingClientRect();
    dragOffset.x = event.clientX - rect.left;
    dragOffset.y = event.clientY - rect.top;
    
    windowElement.style.cursor = 'grabbing';
    event.preventDefault();
}

function drag(event) {
    if (!draggedWindow) return;
    
    const x = event.clientX - dragOffset.x;
    const y = event.clientY - dragOffset.y;
    
    // Keep window in viewport
    const maxX = window.innerWidth - draggedWindow.offsetWidth;
    const maxY = window.innerHeight - draggedWindow.offsetHeight;
    
    draggedWindow.style.left = Math.max(0, Math.min(x, maxX)) + 'px';
    draggedWindow.style.top = Math.max(60, Math.min(y, maxY)) + 'px';
}

function stopDrag() {
    if (draggedWindow) {
        draggedWindow.style.cursor = '';
        draggedWindow = null;
    }
}

// New chat functionality
function showNewChatOptions() {
    document.getElementById('newChatPopup').style.display = 'block';
}

function hideNewChatOptions() {
    document.getElementById('newChatPopup').style.display = 'none';
}

function createNewBubble(userId, userName, initials) {
    hideNewChatOptions();
    
    // Create new bubble element
    const bubblesContainer = document.getElementById('chatBubblesContainer');
    const newBubble = document.createElement('div');
    newBubble.className = 'chat-bubble';
    newBubble.dataset.chatId = userId;
    newBubble.onclick = () => burstBubble(newBubble, userName, 'user');
    
    newBubble.innerHTML = `
        <div class="bubble-avatar">
            <img src="https://via.placeholder.com/60/ff6b6b/ffffff?text=${initials}" alt="${userName}">
            <div class="online-indicator"></div>
        </div>
        <div class="bubble-content">
            <div class="bubble-name">${userName}</div>
            <div class="bubble-preview">Say hello! 👋</div>
        </div>
        <div class="bubble-effects">
            <div class="pulse-ring"></div>
        </div>
    `;
    
    bubblesContainer.appendChild(newBubble);
    
    // Add entrance animation
    newBubble.style.transform = 'scale(0)';
    newBubble.style.animation = 'burstEffect 0.5s ease-out reverse';
    
    setTimeout(() => {
        newBubble.style.animation = '';
        newBubble.style.transform = '';
    }, 500);
}

// Close popup when clicking outside
document.addEventListener('click', function(event) {
    const popup = document.getElementById('newChatPopup');
    const newChatBubble = document.querySelector('.new-chat-bubble');
    
    if (!popup.contains(event.target) && !newChatBubble.contains(event.target)) {
        hideNewChatOptions();
    }
});

// ESC key to close all windows
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        // Close all windows
        openWindows.forEach((windowElement, chatId) => {
            closeWindow(chatId);
        });
        hideNewChatOptions();
    }
});

//bookmark tab

// Bookmarks functionality
let currentSort = 'recent';
let currentView = 'grid';
let activeCollection = 'all';
let currentBookmarkMenu = null;

document.addEventListener('DOMContentLoaded', function() {
    if (window.location.pathname.includes('/bookmarks')) {
        initializeBookmarks();
    }
});

function initializeBookmarks() {
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        closeAllDropdowns(event);
    });
    
    // Initialize masonry layout for better visual organization
    setTimeout(organizeBookmarksLayout, 100);
}

function toggleView() {
    const grid = document.getElementById('bookmarksGrid');
    const toggleBtn = document.getElementById('viewToggle');
    
    if (currentView === 'grid') {
        currentView = 'list';
        grid.classList.add('list-view');
        toggleBtn.innerHTML = '<i class="fas fa-th"></i>';
    } else {
        currentView = 'grid';
        grid.classList.remove('list-view');
        toggleBtn.innerHTML = '<i class="fas fa-th-large"></i>';
    }
    
    // Animate transition
    grid.style.opacity = '0.5';
    setTimeout(() => {
        grid.style.opacity = '1';
    }, 150);
}

function toggleSortMenu() {
    const menu = document.getElementById('sortMenu');
    const isVisible = menu.style.display === 'block';
    
    closeAllDropdowns();
    
    if (!isVisible) {
        menu.style.display = 'block';
    }
}

function toggleFilterMenu() {
    const menu = document.getElementById('filterMenu');
    const isVisible = menu.style.display === 'block';
    
    closeAllDropdowns();
    
    if (!isVisible) {
        menu.style.display = 'block';
    }
}

function closeAllDropdowns(event) {
    const sortMenu = document.getElementById('sortMenu');
    const filterMenu = document.getElementById('filterMenu');
    const contextMenu = document.getElementById('bookmarkMenu');
    
    if (!event || (!event.target.closest('.sort-btn') && !event.target.closest('.sort-menu'))) {
        sortMenu.style.display = 'none';
    }
    
    if (!event || (!event.target.closest('.filter-btn') && !event.target.closest('.filter-menu'))) {
        filterMenu.style.display = 'none';
    }
    
    if (contextMenu && (!event || !event.target.closest('.bookmark-context-menu'))) {
        contextMenu.style.display = 'none';
    }
}

function sortBookmarks(sortType) {
    currentSort = sortType;
    
    // Update active sort option
    document.querySelectorAll('.sort-menu .menu-item').forEach(item => {
        item.classList.remove('active');
    });
    event.target.closest('.menu-item').classList.add('active');
    
    const bookmarks = Array.from(document.querySelectorAll('.bookmark-item'));
    const container = document.getElementById('bookmarksGrid');
    
    // Sort logic would go here - for now, just animate
    container.style.opacity = '0.7';
    
    setTimeout(() => {
        // In a real app, this would reorder the bookmarks based on sortType
        console.log(`Sorting bookmarks by: ${sortType}`);
        container.style.opacity = '1';
    }, 300);
    
    closeAllDropdowns();
}

function filterBookmarks() {
    // Get checked filters
    const checkedFilters = Array.from(document.querySelectorAll('.filter-checkbox input:checked'))
        .map(input => input.nextElementSibling.textContent.toLowerCase());
    
    const bookmarks = document.querySelectorAll('.bookmark-item');
    
    bookmarks.forEach(bookmark => {
        const shouldShow = true; // Implement actual filtering logic here
        
        if (shouldShow) {
            bookmark.style.display = 'block';
            bookmark.style.animation = 'fadeInUp 0.3s ease';
        } else {
            bookmark.style.display = 'none';
        }
    });
    
    console.log('Filtering by:', checkedFilters);
}

function filterByCollection(collection) {
    activeCollection = collection;
    
    // Update active collection chip
    document.querySelectorAll('.collection-chip').forEach(chip => {
        chip.classList.remove('active');
    });
    event.target.classList.add('active');
    
    const bookmarks = document.querySelectorAll('.bookmark-item');
    
    bookmarks.forEach(bookmark => {
        const bookmarkCollection = bookmark.dataset.collection;
        
        if (collection === 'all' || bookmarkCollection === collection) {
            bookmark.style.display = 'block';
            bookmark.style.animation = 'fadeInUp 0.3s ease';
        } else {
            bookmark.style.display = 'none';
        }
    });
}

function createNewCollection() {
    const name = prompt('Enter collection name:');
    if (!name) return;
    
    // Create new collection chip
    const collectionsContainer = document.querySelector('.collections-scroll');
    const newChip = document.createElement('div');
    newChip.className = 'collection-chip';
    newChip.onclick = () => filterByCollection(name.toLowerCase().replace(/\s+/g, '-'));
    
    newChip.innerHTML = `
        <i class="fas fa-folder"></i>
        <span>${name}</span>
        <div class="chip-count">0</div>
    `;
    
    // Insert before the "New Collection" button
    const newCollectionBtn = document.querySelector('.collection-chip.new-collection');
    collectionsContainer.insertBefore(newChip, newCollectionBtn);
    
    // Animate in
    newChip.style.transform = 'scale(0)';
    setTimeout(() => {
        newChip.style.transition = 'transform 0.3s ease';
        newChip.style.transform = 'scale(1)';
    }, 10);
}

// Media interactions
function openImageModal(btn) {
    const bookmarkCard = btn.closest('.bookmark-card');
    const img = bookmarkCard.querySelector('.bookmark-image img');
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    
    modalImg.src = img.src;
    modalImg.alt = img.alt;
    modal.style.display = 'flex';
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.style.display = 'none';
    document.body.style.overflow = '';
}

function downloadImage(btn) {
    const img = btn.closest('.bookmark-card').querySelector('.bookmark-image img');
    const link = document.createElement('a');
    link.href = img.src;
    link.download = 'bookmark-image.jpg';
    link.click();
}

function downloadCurrentImage() {
    const img = document.getElementById('modalImage');
    const link = document.createElement('a');
    link.href = img.src;
    link.download = 'bookmark-image.jpg';
    link.click();
}

function shareCurrentImage() {
    const img = document.getElementById('modalImage');
    
    if (navigator.share) {
        navigator.share({
            title: 'S App Bookmark',
            text: 'Check out this image I bookmarked!',
            url: img.src
        });
    } else {
        navigator.clipboard.writeText(img.src);
        alert('Image URL copied to clipboard!');
    }
}

function playVideo(btn) {
    const bookmarkCard = btn.closest('.bookmark-card');
    const title = bookmarkCard.querySelector('.bookmark-title').textContent;
    alert(`Playing video: ${title}\n\nIn a real app, this would open the video player.`);
}

function openExternalLink(btn) {
    const bookmarkCard = btn.closest('.bookmark-card');
    const title = bookmarkCard.querySelector('.link-title').textContent;
    alert(`Opening external link: ${title}\n\nIn a real app, this would open the external URL.`);
}

function copyCode(btn) {
    const codeBlock = btn.closest('.bookmark-card').querySelector('code');
    const code = codeBlock.textContent;
    
    navigator.clipboard.writeText(code).then(() => {
        // Visual feedback
        const originalIcon = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i>';
        btn.style.color = '#00ba7c';
        
        setTimeout(() => {
            btn.innerHTML = originalIcon;
            btn.style.color = '';
        }, 2000);
    });
}

// Context menu
function showBookmarkMenu(bookmarkId) {
    const menu = document.getElementById('bookmarkMenu');
    const rect = event.target.getBoundingClientRect();
    
    currentBookmarkMenu = bookmarkId;
    
    menu.style.display = 'block';
    menu.style.left = (rect.left - menu.offsetWidth + rect.width) + 'px';
    menu.style.top = (rect.bottom + 5) + 'px';
    
    // Adjust position if menu goes off-screen
    if (parseInt(menu.style.left) < 0) {
        menu.style.left = '10px';
    }
    
    if (parseInt(menu.style.top) + menu.offsetHeight > window.innerHeight) {
        menu.style.top = (rect.top - menu.offsetHeight - 5) + 'px';
    }
}

function editBookmark() {
    alert(`Edit bookmark ${currentBookmarkMenu} - This would open an edit dialog`);
    closeAllDropdowns();
}

function moveToCollection() {
    const collections = ['Web Design', 'Laravel Tips', 'UI Inspiration', 'Tutorials', 'Dev Tools'];
    const collection = prompt(`Move to collection:\n${collections.join('\n')}\n\nEnter collection name:`);
    
    if (collection) {
        alert(`Moved bookmark ${currentBookmarkMenu} to collection: ${collection}`);
    }
    closeAllDropdowns();
}

function copyBookmarkLink() {
    const dummyUrl = `https://sapp.com/bookmark/${currentBookmarkMenu}`;
    navigator.clipboard.writeText(dummyUrl).then(() => {
        alert('Bookmark link copied to clipboard!');
    });
    closeAllDropdowns();
}

function shareBookmark() {
    const dummyUrl = `https://sapp.com/bookmark/${currentBookmarkMenu}`;
    
    if (navigator.share) {
        navigator.share({
            title: 'S App Bookmark',
            text: 'Check out this bookmark I saved!',
            url: dummyUrl
        });
    } else {
        navigator.clipboard.writeText(dummyUrl);
        alert('Bookmark link copied to clipboard!');
    }
    closeAllDropdowns();
}

function removeBookmark() {
    if (confirm('Are you sure you want to remove this bookmark?')) {
        const bookmarkElement = document.querySelector(`[onclick*="${currentBookmarkMenu}"]`).closest('.bookmark-item');
        
        // Animate removal
        bookmarkElement.style.animation = 'fadeOut 0.3s ease';
        setTimeout(() => {
            bookmarkElement.remove();
            organizeBookmarksLayout();
        }, 300);
        
        alert(`Bookmark ${currentBookmarkMenu} removed!`);
    }
    closeAllDropdowns();
}

function organizeBookmarksLayout() {
    // Simple masonry-like organization
    const grid = document.getElementById('bookmarksGrid');
    const items = grid.querySelectorAll('.bookmark-item');
    
    // Reset any transforms
    items.forEach(item => {
        item.style.transform = '';
    });
}

// Keyboard shortcuts
document.addEventListener('keydown', function(event) {
    if (window.location.pathname.includes('/bookmarks')) {
        // Escape to close modals and menus
        if (event.key === 'Escape') {
            closeImageModal();
            closeAllDropdowns();
        }
        
        // Ctrl/Cmd + F to focus search (if implemented)
        if ((event.ctrlKey || event.metaKey) && event.key === 'f') {
            event.preventDefault();
            // Focus search functionality would go here
        }
    }
});

// Add fadeOut animation
const style = document.createElement('style');
style.textContent += `
    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: scale(1);
        }
        to {
            opacity: 0;
            transform: scale(0.8);
        }
    }
`;
document.head.appendChild(style);

//Profile Tab

// Profile functionality
let currentAvatarConfig = {
    faceShape: 'oval',
    eyeStyle: 'normal',
    mask: 'none',
    hairStyle: 'short',
    suitStyle: 'classic',
    cape: false,
    powers: [],
    primaryColor: '#e10600',
    secondaryColor: '#000'
};

document.addEventListener('DOMContentLoaded', function() {
    if (window.location.pathname.includes('/profile')) {
        initializeProfile();
    }
});

function initializeProfile() {
    // Initialize avatar based on current config
    updateAvatarPreview();
    
    // Close modals when clicking outside
    document.addEventListener('click', function(event) {
        const avatarModal = document.getElementById('avatarCreatorModal');
        const editModal = document.getElementById('editProfileModal');
        
        if (event.target === avatarModal) {
            closeAvatarCreator();
        }
        
        if (event.target === editModal) {
            closeEditProfile();
        }
    });
}

// Profile Tab Switching
function switchProfileTab(tabElement, tabName) {
    // Update active tab
    document.querySelectorAll('.tab-item').forEach(tab => {
        tab.classList.remove('active');
    });
    tabElement.classList.add('active');
    
    // Update content
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.remove('active');
    });
    
    const targetContent = document.getElementById(`${tabName}-content`);
    if (targetContent) {
        targetContent.classList.add('active');
    }
    
    console.log(`Switched to ${tabName} tab`);
}

// Profile Actions
function editCoverPhoto() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.onchange = function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const coverImage = document.querySelector('.cover-image');
                coverImage.style.backgroundImage = `linear-gradient(135deg, rgba(225, 6, 0, 0.7), rgba(26, 0, 0, 0.7)), url(${e.target.result})`;
                coverImage.style.backgroundSize = 'cover';
                coverImage.style.backgroundPosition = 'center';
            };
            reader.readAsDataURL(file);
        }
    };
    input.click();
}

function uploadPhoto() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.onchange = function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarImage').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    };
    input.click();
}

function generateAI() {
    // Simulate AI avatar generation
    const aiAvatars = [
        'https://via.placeholder.com/120/1d9bf0/ffffff?text=AI1',
        'https://via.placeholder.com/120/00ba7c/ffffff?text=AI2',
        'https://via.placeholder.com/120/8b5cf6/ffffff?text=AI3',
        'https://via.placeholder.com/120/ffd400/000000?text=AI4'
    ];
    
    const randomAvatar = aiAvatars[Math.floor(Math.random() * aiAvatars.length)];
    document.getElementById('avatarImage').src = randomAvatar;
    
    // Show notification
    alert('AI Avatar generated! 🤖');
}

function editProfile() {
    document.getElementById('editProfileModal').style.display = 'flex';
}

function closeEditProfile() {
    document.getElementById('editProfileModal').style.display = 'none';
}

function saveProfile() {
    // Simulate saving profile
    const form = document.querySelector('.edit-profile-form');
    const formData = new FormData(form);
    
    alert('Profile updated successfully! ✅');
    closeEditProfile();
}

function shareProfile() {
    const profileUrl = `${window.location.origin}/profile/johndoe`;
    
    if (navigator.share) {
        navigator.share({
            title: 'John Doe - S App Profile',
            text: 'Check out my superhero profile on S App!',
            url: profileUrl
        });
    } else {
        navigator.clipboard.writeText(profileUrl);
        alert('Profile link copied to clipboard! 📋');
    }
}

// Stats Functions
function showFollowing() {
    alert('Following list - This would show all users you follow');
}

function showFollowers() {
    alert('Followers list - This would show all your followers');
}

function showLikes() {
    alert('Liked posts - This would show all posts you liked');
}

function showPosts() {
    alert('Your posts - This would show all your posts');
}

// Avatar Creator Functions
function openAvatarCreator() {
    document.getElementById('avatarCreatorModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
    updateAvatarPreview();
}

function closeAvatarCreator() {
    document.getElementById('avatarCreatorModal').style.display = 'none';
    document.body.style.overflow = '';
}

function switchCustomTab(tabElement, tabName) {
    // Update active tab
    document.querySelectorAll('.custom-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    tabElement.classList.add('active');
    
    // Update content
    document.querySelectorAll('.custom-section').forEach(section => {
        section.classList.remove('active');
    });
    
    document.getElementById(`${tabName}-section`).classList.add('active');
}

// Avatar Customization Functions
function setFaceShape(shape) {
    currentAvatarConfig.faceShape = shape;
    updateActiveButton(event.target, '.option-buttons');
    updateAvatarPreview();
}

function setEyeStyle(style) {
    currentAvatarConfig.eyeStyle = style;
    updateActiveButton(event.target, '.option-buttons');
    updateAvatarPreview();
}

function setMask(maskType) {
    currentAvatarConfig.mask = maskType;
    updateActiveButton(event.target, '.option-buttons');
}

//setting tab

// Settings functionality
let currentSettingsSection = 'account';
let pendingAction = null;

document.addEventListener('DOMContentLoaded', function() {
    if (window.location.pathname.includes('/settings')) {
        initializeSettings();
    }
});

function initializeSettings() {
    // Initialize color pickers
    const colorPickers = document.querySelectorAll('.color-picker');
    colorPickers.forEach(picker => {
        picker.addEventListener('change', function() {
            const preview = this.parentNode.querySelector('.color-preview');
            const code = this.parentNode.querySelector('.color-code');
            preview.style.backgroundColor = this.value;
            code.textContent = this.value.toUpperCase();
            applyColorChanges();
        });
        
        // Make color preview clickable
        const preview = picker.parentNode.querySelector('.color-preview');
        preview.addEventListener('click', () => picker.click());
    });
    
    // Initialize sliders
    const sliders = document.querySelectorAll('.settings-slider');
    sliders.forEach(slider => {
        slider.addEventListener('input', function() {
            updateSliderBackground(this);
        });
        updateSliderBackground(slider);
    });
    
    // Initialize toggle switches
    const toggles = document.querySelectorAll('.toggle-switch input');
    toggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            handleToggleChange(this);
        });
    });
}

function switchSettingsSection(navElement, sectionId) {
    // Update active navigation
    document.querySelectorAll('.nav-item').forEach(item => {
        item.classList.remove('active');
    });
    navElement.classList.add('active');
    
    // Update content sections
    document.querySelectorAll('.settings-section').forEach(section => {
        section.classList.remove('active');
    });
    
    document.getElementById(`${sectionId}-section`).classList.add('active');
    currentSettingsSection = sectionId;
    
    // Scroll to top of main content
    document.querySelector('.settings-main').scrollTop = 0;
}

function searchSettings(query) {
    const navItems = document.querySelectorAll('.nav-item');
    const searchQuery = query.toLowerCase();
    
    navItems.forEach(item => {
        const text = item.textContent.toLowerCase();
        if (text.includes(searchQuery) || searchQuery === '') {
            item.classList.remove('hidden');
        } else {
            item.classList.add('hidden');
        }
    });
}

// Theme Functions
function selectTheme(theme) {
    document.querySelectorAll('.theme-option').forEach(option => {
        option.classList.remove('active');
    });
    
    event.target.closest('.theme-option').classList.add('active');
    
    // Apply theme
    applyTheme(theme);
    
    // Save to localStorage
    localStorage.setItem('sapp-theme', theme);
    
    showNotification('Theme updated successfully!', 'success');
}

function applyTheme(theme) {
    const root = document.documentElement;
    
    switch(theme) {
        case 'light':
            root.style.setProperty('--bg-primary', '#ffffff');
            root.style.setProperty('--bg-secondary', '#f8f9fa');
            root.style.setProperty('--text-primary', '#1a1a1a');
            root.style.setProperty('--text-secondary', '#6c757d');
            break;
        case 'dark':
        default:
            root.style.setProperty('--bg-primary', '#000000');
            root.style.setProperty('--bg-secondary', '#1a1a1a');
            root.style.setProperty('--text-primary', '#e1e8ed');
            root.style.setProperty('--text-secondary', '#8b98a5');
            break;
        case 'auto':
            // Use system preference
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            applyTheme(prefersDark ? 'dark' : 'light');
            break;
    }
}

// Color Functions
function applyPreset(presetName) {
    const presets = {
        'classic': { primary: '#e10600', accent: '#ff3333' },
        'blue': { primary: '#1d9bf0', accent: '#00d4ff' },
        'green': { primary: '#00ba7c', accent: '#00ff9f' },
        'purple': { primary: '#8b5cf6', accent: '#a78bfa' }
    };
    
    const preset = presets[presetName];
    if (!preset) return;
    
    // Update color pickers and previews
    const colorInputs = document.querySelectorAll('.color-picker');
    const colorPreviews = document.querySelectorAll('.color-preview');
    const colorCodes = document.querySelectorAll('.color-code');
    
    colorInputs[0].value = preset.primary;
    colorPreviews[0].style.backgroundColor = preset.primary;
    colorCodes[0].textContent = preset.primary.toUpperCase();
    
    colorInputs[1].value = preset.accent;
    colorPreviews[1].style.backgroundColor = preset.accent;
    colorCodes[1].textContent = preset.accent.toUpperCase();
    
    applyColorChanges();
    showNotification(`Applied ${presetName} theme preset!`, 'success');
}

function applyColorChanges() {
    const primaryColor = document.querySelectorAll('.color-picker')[0].value;
    const accentColor = document.querySelectorAll('.color-picker')[1].value;
    
    // Apply colors to CSS custom properties
    const root = document.documentElement;
    root.style.setProperty('--color-primary', primaryColor);
    root.style.setProperty('--color-accent', accentColor);
    
    // Save to localStorage
    localStorage.setItem('sapp-primary-color', primaryColor);
    localStorage.setItem('sapp-accent-color', accentColor);
}

// Display Functions
function updateFontSize(size) {
    const root = document.documentElement;
    root.style.setProperty('--font-size-base', `${size}px`);
    localStorage.setItem('sapp-font-size', size);
    
    showNotification(`Font size updated to ${size}px`, 'success');
}

function updateSliderBackground(slider) {
    const value = (slider.value - slider.min) / (slider.max - slider.min) * 100;
    slider.style.background = `linear-gradient(to right, #e10600 0%, #e10600 ${value}%, #2f3336 ${value}%, #2f3336 100%)`;
}

// Toggle Functions
function handleToggleChange(toggle) {
    const settingName = toggle.id;
    const isEnabled = toggle.checked;
    
    console.log(`${settingName} ${isEnabled ? 'enabled' : 'disabled'}`);
    
    // Handle specific settings
    switch(settingName) {
        case 'animations':
            if (!isEnabled) {
                document.body.classList.add('reduce-animations');
            } else {
                document.body.classList.remove('reduce-animations');
            }
            break;
        case 'reduce-motion':
            if (isEnabled) {
                document.body.classList.add('reduce-motion');
            } else {
                document.body.classList.remove('reduce-motion');
            }
            break;
    }
    
    // Save to localStorage
    localStorage.setItem(`sapp-${settingName}`, isEnabled);
    
    showNotification(`${settingName.replace('-', ' ')} ${isEnabled ? 'enabled' : 'disabled'}`, 'success');
}

// Action Functions
function syncSettings() {
    const syncBtn = document.querySelector('.sync-btn');
    const originalContent = syncBtn.innerHTML;
    
    syncBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Syncing...</span>';
    syncBtn.disabled = true;
    
    setTimeout(() => {
        syncBtn.innerHTML = originalContent;
        syncBtn.disabled = false;
        showNotification('Settings synced successfully!', 'success');
    }, 2000);
}

function exportSettings() {
    // Gather all settings
    const settings = {
        theme: localStorage.getItem('sapp-theme') || 'dark',
        primaryColor: localStorage.getItem('sapp-primary-color') || '#e10600',
        accentColor: localStorage.getItem('sapp-accent-color') || '#ff3333',
        fontSize: localStorage.getItem('sapp-font-size') || '16',
        // Add more settings as needed
    };
    
    // Create and download JSON file
    const dataStr = JSON.stringify(settings, null, 2);
    const dataBlob = new Blob([dataStr], { type: 'application/json' });
    
    const link = document.createElement('a');
    link.href = URL.createObjectURL(dataBlob);
    link.download = 's-app-settings.json';
    link.click();
    
    showNotification('Settings exported successfully!', 'success');
}

// Confirmation Functions
function showConfirmation(title, message, action) {
    const modal = document.getElementById('confirmationModal');
    const titleEl = document.getElementById('confirmationTitle');
    const messageEl = document.getElementById('confirmationMessage');
    
    titleEl.textContent = title;
    messageEl.textContent = message;
    pendingAction = action;
    
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeConfirmation() {
    document.getElementById('confirmationModal').style.display = 'none';
    document.body.style.overflow = '';
    pendingAction = null;
}

function confirmAction() {
    if (pendingAction) {
        pendingAction();
    }
    closeConfirmation();
}

// Specific Action Functions
function clearCache() {
    showConfirmation(
        'Clear Cache',
        'This will clear all cached data. Your settings will be preserved.',
        () => {
            // Simulate cache clearing
            setTimeout(() => {
                showNotification('Cache cleared successfully!', 'success');
            }, 1000);
        }
    );
}

function deactivateAccount() {
    showConfirmation(
        'Deactivate Account',
        'Your account will be temporarily disabled. You can reactivate it by logging in again.',
        () => {
            // Simulate account deactivation
            setTimeout(() => {
                showNotification('Account deactivated', 'warning');
            }, 1000);
        }
    );
}

function deleteAccount() {
    showConfirmation(
        'Delete Account',
        'This action is permanent and cannot be undone. All your data will be lost.',
        () => {
            // Simulate account deletion
            setTimeout(() => {
                showNotification('Account deletion initiated', 'error');
            }, 1000);
        }
    );
}

function changePassword() {
    // This would typically open a password change modal
    alert('Password change modal would open here');
}

function changeEmail() {
    // This would typically open an email change modal
    alert('Email change modal would open here');
}

function changePhone() {
    // This would typically open a phone change modal
    alert('Phone change modal would open here');
}

// Notification Function
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas fa-${getNotificationIcon(type)}"></i>
            <span>${message}</span>
        </div>
        <button class="notification-close" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    `;
    
    // Add to page
    document.body.appendChild(notification);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        if (notification.parentElement) {
            notification.remove();
        }
    }, 3000);
}

function getNotificationIcon(type) {
    switch(type) {
        case 'success': return 'check-circle';
        case 'warning': return 'exclamation-triangle';
        case 'error': return 'exclamation-circle';
        default: return 'info-circle';
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    // Load saved settings
    const savedTheme = localStorage.getItem('sapp-theme');
    if (savedTheme) {
        applyTheme(savedTheme);
    }
    
    const savedPrimaryColor = localStorage.getItem('sapp-primary-color');
    const savedAccentColor = localStorage.getItem('sapp-accent-color');
    if (savedPrimaryColor && savedAccentColor) {
        const root = document.documentElement;
        root.style.setProperty('--color-primary', savedPrimaryColor);
        root.style.setProperty('--color-accent', savedAccentColor);
    }
    
    const savedFontSize = localStorage.getItem('sapp-font-size');
    if (savedFontSize) {
        const root = document.documentElement;
        root.style.setProperty('--font-size-base', `${savedFontSize}px`);
    }
});

// Add CSS for notifications
const notificationStyles = document.createElement('style');
notificationStyles.textContent = `
.notification {
    position: fixed;
    top: 80px;
    right: 20px;
    background-color: #1a1a1a;
    border: 2px solid #2f3336;
    border-radius: 12px;
    padding: 16px;
    display: flex;
    align-items: center;
    gap: 12px;
    max-width: 400px;
    z-index: 1000;
    animation: slideInRight 0.3s ease;
}

.notification.success {
    border-color: #00ba7c;
}

.notification.warning {
    border-color: #fbbf24;
}

.notification.error {
    border-color: #ef4444;
}

.notification-content {
    display: flex;
    align-items: center;
    gap: 8px;
    flex: 1;
    color: #e1e8ed;
    font-size: 0.9rem;
}

.notification.success .notification-content i {
    color: #00ba7c;
}

.notification.warning .notification-content i {
    color: #fbbf24;
}

.notification.error .notification-content i {
    color: #ef4444;
}

.notification-close {
    background: none;
    border: none;
    color: #8b98a5;
    cursor: pointer;
    padding: 4px;
    border-radius: 4px;
    transition: all 0.2s ease;
}

.notification-close:hover {
    background-color: rgba(225, 6, 0, 0.1);
    color: #e10600;
}

/* Reduce animations class */
.reduce-animations * {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
}

.reduce-motion * {
    animation: none !important;
    transition: none !important;
}
`;
document.head.appendChild(notificationStyles);
// Additional Settings Functions

// Notifications
function toggleQuietHours() {
    const toggle = document.getElementById('quiet-hours');
    const timeSection = document.getElementById('quietHoursTime');
    
    if (toggle.checked) {
        timeSection.style.display = 'flex';
    } else {
        timeSection.style.display = 'none';
    }
}

// Accessibility
function toggleHighContrast() {
    const isEnabled = document.getElementById('high-contrast').checked;
    document.body.classList.toggle('high-contrast', isEnabled);
    localStorage.setItem('sapp-high-contrast', isEnabled);
    showNotification(`High contrast ${isEnabled ? 'enabled' : 'disabled'}`, 'success');
}

function toggleLargeText() {
    const isEnabled = document.getElementById('large-text').checked;
    document.body.classList.toggle('large-text', isEnabled);
    localStorage.setItem('sapp-large-text', isEnabled);
    showNotification(`Large text ${isEnabled ? 'enabled' : 'disabled'}`, 'success');
}

// Language & Region
function changeLanguage(languageCode) {
    console.log(`Language changed to: ${languageCode}`);
    localStorage.setItem('sapp-language', languageCode);
    showNotification('Language updated! Page will reload.', 'success');
    
    // Simulate language change
    setTimeout(() => {
        // In a real app, this would reload with new language
        console.log('Language change applied');
    }, 2000);
}

// Update current time display
function updateCurrentTime() {
    const timeElement = document.getElementById('currentTime');
    if (timeElement) {
        const now = new Date();
        timeElement.textContent = now.toLocaleTimeString();
    }
}

// Update time every second
setInterval(updateCurrentTime, 1000);

// Blocked & Muted
function unblockUser(username) {
    showConfirmation(
        'Unblock User',
        `Are you sure you want to unblock @${username}?`,
        () => {
            // Simulate unblocking
            const userItem = document.querySelector(`[onclick*="${username}"]`).closest('.blocked-user-item');
            userItem.style.animation = 'fadeOut 0.3s ease';
            setTimeout(() => userItem.remove(), 300);
            showNotification(`@${username} has been unblocked`, 'success');
        }
    );
}

function addMutedKeyword() {
    const input = document.getElementById('keywordInput');
    const keyword = input.value.trim();
    
    if (!keyword) return;
    
    // Create keyword item
    const keywordsList = document.querySelector('.keywords-list');
    const keywordItem = document.createElement('div');
    keywordItem.className = 'keyword-item';
    keywordItem.innerHTML = `
        <span class="keyword">${keyword}</span>
        <button class="remove-keyword" onclick="removeMutedKeyword('${keyword}')">
            <i class="fas fa-times"></i>
        </button>
    `;
    
    keywordsList.appendChild(keywordItem);
    input.value = '';
    
    showNotification(`Keyword "${keyword}" muted`, 'success');
}

function removeMutedKeyword(keyword) {
    const keywordItem = event.target.closest('.keyword-item');
    keywordItem.style.animation = 'fadeOut 0.3s ease';
    setTimeout(() => keywordItem.remove(), 300);
    
    showNotification(`Keyword "${keyword}" unmuted`, 'success');
}

// Advanced Settings
function openAPIConsole() {
    alert('API Console would open here with developer tools and API testing interface');
}

function downloadLogs() {
    // Simulate log download
    const logs = {
        timestamp: new Date().toISOString(),
        userAgent: navigator.userAgent,
        logs: ['App started', 'User logged in', 'Settings accessed']
    };
    
    const dataStr = JSON.stringify(logs, null, 2);
    const dataBlob = new Blob([dataStr], { type: 'application/json' });
    
    const link = document.createElement('a');
    link.href = URL.createObjectURL(dataBlob);
    link.download = 's-app-logs.json';
    link.click();
    
    showNotification('Logs downloaded successfully!', 'success');
}

function requestDataDownload() {
    showConfirmation(
        'Download Your Data',
        'We will prepare your data for download and email you when it\'s ready.',
        () => {
            showNotification('Data download request submitted. You will receive an email when ready.', 'success');
        }
    );
}

function clearAllData() {
    showConfirmation(
        'Clear All Data',
        'This will remove all locally stored data including settings, cache, and preferences. This cannot be undone.',
        () => {
            // Clear localStorage
            Object.keys(localStorage).forEach(key => {
                if (key.startsWith('sapp-')) {
                    localStorage.removeItem(key);
                }
            });
            
            showNotification('All local data cleared. Page will reload.', 'success');
            
            setTimeout(() => {
                location.reload();
            }, 2000);
        }
    );
}

function resetPreferences() {
    showConfirmation(
        'Reset Preferences',
        'This will reset all settings to their default values.',
        () => {
            // Reset all form elements to default values
            document.querySelectorAll('.settings-input, .settings-select').forEach(input => {
                if (input.defaultValue !== undefined) {
                    input.value = input.defaultValue;
                }
            });
            
            document.querySelectorAll('.toggle-switch input').forEach(toggle => {
                toggle.checked = toggle.defaultChecked;
            });
            
            showNotification('All preferences reset to defaults', 'success');
        }
    );
}

function toggleIntegration(service) {
    const integrationItem = event.target.closest('.integration-item');
    const button = event.target.closest('.integration-btn');
    const info = integrationItem.querySelector('.integration-info p');
    
    if (button.classList.contains('connected')) {
        // Disconnect
        button.innerHTML = '<i class="fas fa-link"></i> Connect';
        button.classList.remove('connected');
        info.textContent = 'Not connected';
        showNotification(`${service} disconnected`, 'success');
    } else {
        // Connect
        button.innerHTML = '<i class="fas fa-unlink"></i> Disconnect';
        button.classList.add('connected');
        info.textContent = 'Connected • Last sync: Just now';
        showNotification(`${service} connected successfully`, 'success');
    }
}

// About Section
function checkForUpdates() {
    const button = event.target;
    const originalText = button.textContent;
    
    button.textContent = 'Checking...';
    button.disabled = true;
    
    setTimeout(() => {
        button.textContent = originalText;
        button.disabled = false;
        showNotification('You are running the latest version!', 'success');
    }, 2000);
}

function openHelpCenter() {
    window.open('#', '_blank');
}

function contactSupport() {
    alert('Support contact form would open here');
}

function submitFeedback() {
    alert('Feedback form would open here');
}

function reportBug() {
    alert('Bug report form would open here');
}

// Handle Enter key for keyword input
document.addEventListener('DOMContentLoaded', function() {
    const keywordInput = document.getElementById('keywordInput');
    if (keywordInput) {
        keywordInput.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                addMutedKeyword();
            }
        });
    }
});
