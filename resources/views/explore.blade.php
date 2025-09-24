@extends('layouts.app')

@section('title', 'Explore / S App')

@section('content')
<div class="explore-header">
    <h1>Explore</h1>
    <div class="explore-search">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search for topics, users, or content..." id="exploreSearch">
    </div>
</div>

<div class="explore-tabs">
    <div class="explore-tab active" onclick="switchExploreTab(this, 'trending')">
        <i class="fas fa-fire"></i>
        <span>Trending</span>
    </div>
    <div class="explore-tab" onclick="switchExploreTab(this, 'media')">
        <i class="fas fa-play-circle"></i>
        <span>Media</span>
    </div>
    <div class="explore-tab" onclick="switchExploreTab(this, 'topics')">
        <i class="fas fa-hashtag"></i>
        <span>Topics</span>
    </div>
    <div class="explore-tab" onclick="switchExploreTab(this, 'people')">
        <i class="fas fa-users"></i>
        <span>People</span>
    </div>
</div>

<div class="explore-content">
    <!-- Trending Section -->
    <div class="explore-section" id="trending-section">
        <div class="hero-trend">
            <div class="hero-trend-bg" style="background: linear-gradient(135deg, rgba(225,6,0,0.8), rgba(0,0,0,0.6)), url('https://via.placeholder.com/600x300/1a1a1a/e10600?text=Laravel+Superhero+Apps') center/cover;"></div>
            <div class="hero-trend-content">
                <span class="hero-trend-category">Tech · Trending</span>
                <h2 class="hero-trend-title">#LaravelSuperhero</h2>
                <p class="hero-trend-desc">Developers creating superhero-themed web applications using Laravel framework</p>
                <div class="hero-trend-stats">
                    <span><i class="fas fa-chart-line"></i> 45.2K posts</span>
                    <span><i class="fas fa-users"></i> 12.8K talking</span>
                </div>
            </div>
        </div>

        <div class="trending-grid">
            <div class="trend-card featured">
                <div class="trend-media">
                    <img src="https://via.placeholder.com/400x300/e10600/ffffff?text=Comic+UI+Design" alt="Comic UI Design">
                    <div class="trend-overlay">
                        <i class="fas fa-play"></i>
                    </div>
                </div>
                <div class="trend-info">
                    <span class="trend-category">Design · Trending</span>
                    <h3 class="trend-title">Comic-inspired UI Revolution</h3>
                    <p class="trend-stats">28.5K posts · 2 hours ago</p>
                </div>
            </div>

            <div class="trend-card">
                <div class="trend-media">
                    <img src="https://via.placeholder.com/300x200/1a1a1a/ff3333?text=Red+Black+Aesthetic" alt="Red Black Aesthetic">
                </div>
                <div class="trend-info">
                    <span class="trend-category">Web Design</span>
                    <h3 class="trend-title">#RedBlackAesthetic</h3>
                    <p class="trend-stats">15.7K posts</p>
                </div>
            </div>

            <div class="trend-card">
                <div class="trend-media">
                    <img src="https://via.placeholder.com/300x200/2d2d2d/e10600?text=Full+Stack+Hero" alt="Full Stack Hero">
                </div>
                <div class="trend-info">
                    <span class="trend-category">Programming</span>
                    <h3 class="trend-title">Full Stack Heroes</h3>
                    <p class="trend-stats">22.1K posts</p>
                </div>
            </div>

            <div class="trend-card">
                <div class="trend-media">
                    <img src="https://via.placeholder.com/300x200/000000/ff6b6b?text=Marvel+DC+Web" alt="Marvel DC Web">
                </div>
                <div class="trend-info">
                    <span class="trend-category">Entertainment</span>
                    <h3 class="trend-title">Marvel DC Web Apps</h3>
                    <p class="trend-stats">8.9K posts</p>
                </div>
            </div>

            <div class="trend-card wide">
                <div class="trend-media">
                    <img src="https://via.placeholder.com/500x250/0d0d0d/e10600?text=Interactive+Animations" alt="Interactive Animations">
                </div>
                <div class="trend-info">
                    <span class="trend-category">Frontend</span>
                    <h3 class="trend-title">Interactive Web Animations</h3>
                    <p class="trend-stats">19.3K posts · Trending in Tech</p>
                </div>
            </div>

            <div class="trend-card">
                <div class="trend-media">
                    <img src="https://via.placeholder.com/300x200/1a0000/ff4444?text=S+App+Clone" alt="S App Clone">
                </div>
                <div class="trend-info">
                    <span class="trend-category">Projects</span>
                    <h3 class="trend-title">#SAppClone</h3>
                    <p class="trend-stats">5.2K posts</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Media Section -->
    <div class="explore-section hidden" id="media-section">
        <div class="media-filters">
            <button class="filter-btn active" onclick="filterMedia('all')">All</button>
            <button class="filter-btn" onclick="filterMedia('videos')">Videos</button>
            <button class="filter-btn" onclick="filterMedia('images')">Images</button>
            <button class="filter-btn" onclick="filterMedia('gifs')">GIFs</button>
        </div>

        <div class="media-grid">
            <div class="media-item video">
                <img src="https://via.placeholder.com/300x400/e10600/ffffff?text=Laravel+Tutorial" alt="Laravel Tutorial">
                <div class="media-overlay">
                    <i class="fas fa-play"></i>
                    <span class="media-duration">2:34</span>
                </div>
                <div class="media-meta">
                    <span class="media-views">45.2K views</span>
                    <span class="media-author">@codehero</span>
                </div>
            </div>

            <div class="media-item image">
                <img src="https://via.placeholder.com/300x300/1a1a1a/ff3333?text=Design+Showcase" alt="Design Showcase">
                <div class="media-overlay">
                    <i class="fas fa-heart"></i>
                    <span class="media-likes">1.2K</span>
                </div>
                <div class="media-meta">
                    <span class="media-author">@designpro</span>
                </div>
            </div>

            <div class="media-item video">
                <img src="https://via.placeholder.com/300x350/2d2d2d/e10600?text=CSS+Animation" alt="CSS Animation">
                <div class="media-overlay">
                    <i class="fas fa-play"></i>
                    <span class="media-duration">1:45</span>
                </div>
                <div class="media-meta">
                    <span class="media-views">28.7K views</span>
                    <span class="media-author">@frontendwiz</span>
                </div>
            </div>

            <div class="media-item image">
                <img src="https://via.placeholder.com/300x250/0d0d0d/ff6b6b?text=UI+Components" alt="UI Components">
                <div class="media-overlay">
                    <i class="fas fa-bookmark"></i>
                    <span class="media-saves">892</span>
                </div>
                <div class="media-meta">
                    <span class="media-author">@uimaster</span>
                </div>
            </div>

            <div class="media-item gif">
                <img src="https://via.placeholder.com/300x200/000000/ff4444?text=Loading+Animation" alt="Loading Animation">
                <div class="media-overlay">
                    <span class="gif-badge">GIF</span>
                </div>
                <div class="media-meta">
                    <span class="media-author">@animateguru</span>
                </div>
            </div>

            <div class="media-item video">
                <img src="https://via.placeholder.com/300x380/1a0000/e10600?text=React+Heroes" alt="React Heroes">
                <div class="media-overlay">
                    <i class="fas fa-play"></i>
                    <span class="media-duration">5:12</span>
                </div>
                <div class="media-meta">
                    <span class="media-views">67.1K views</span>
                    <span class="media-author">@reacthero</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Topics Section -->
    <div class="explore-section hidden" id="topics-section">
        <div class="topics-header">
            <h2>Discover Topics</h2>
            <p>Find communities and conversations that match your interests</p>
        </div>

        <div class="topics-grid">
            <div class="topic-card tech">
                <div class="topic-icon">
                    <i class="fas fa-code"></i>
                </div>
                <div class="topic-content">
                    <h3>Web Development</h3>
                    <p>Frontend, Backend, Full Stack</p>
                    <div class="topic-stats">
                        <span><i class="fas fa-users"></i> 125K followers</span>
                        <span><i class="fas fa-comments"></i> 2.5K daily posts</span>
                    </div>
                </div>
                <button class="follow-topic-btn" onclick="followTopic('webdev')">Follow</button>
            </div>

            <div class="topic-card design">
                <div class="topic-icon">
                    <i class="fas fa-palette"></i>
                </div>
                <div class="topic-content">
                    <h3>UI/UX Design</h3>
                    <p>Interface Design, User Experience</p>
                    <div class="topic-stats">
                        <span><i class="fas fa-users"></i> 89K followers</span>
                        <span><i class="fas fa-comments"></i> 1.8K daily posts</span>
                    </div>
                </div>
                <button class="follow-topic-btn" onclick="followTopic('design')">Follow</button>
            </div>

            <div class="topic-card superhero">
                <div class="topic-icon">
                    <i class="fas fa-mask"></i>
                </div>
                <div class="topic-content">
                    <h3>Superhero Culture</h3>
                    <p>Comics, Movies, Fan Art</p>
                    <div class="topic-stats">
                        <span><i class="fas fa-users"></i> 67K followers</span>
                        <span><i class="fas fa-comments"></i> 3.2K daily posts</span>
                    </div>
                </div>
                <button class="follow-topic-btn" onclick="followTopic('superhero')">Follow</button>
            </div>

            <div class="topic-card gaming">
                <div class="topic-icon">
                    <i class="fas fa-gamepad"></i>
                </div>
                <div class="topic-content">
                    <h3>Gaming</h3>
                    <p>Game Development, Reviews</p>
                    <div class="topic-stats">
                        <span><i class="fas fa-users"></i> 156K followers</span>
                        <span><i class="fas fa-comments"></i> 4.1K daily posts</span>
                    </div>
                </div>
                <button class="follow-topic-btn" onclick="followTopic('gaming')">Follow</button>
            </div>

            <div class="topic-card startup">
                <div class="topic-icon">
                    <i class="fas fa-rocket"></i>
                </div>
                <div class="topic-content">
                    <h3>Startups</h3>
                    <p>Entrepreneurship, Innovation</p>
                    <div class="topic-stats">
                        <span><i class="fas fa-users"></i> 93K followers</span>
                        <span><i class="fas fa-comments"></i> 1.9K daily posts</span>
                    </div>
                </div>
                <button class="follow-topic-btn" onclick="followTopic('startup')">Follow</button>
            </div>

            <div class="topic-card ai">
                <div class="topic-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <div class="topic-content">
                    <h3>AI & Machine Learning</h3>
                    <p>Artificial Intelligence, ML</p>
                    <div class="topic-stats">
                        <span><i class="fas fa-users"></i> 78K followers</span>
                        <span><i class="fas fa-comments"></i> 2.1K daily posts</span>
                    </div>
                </div>
                <button class="follow-topic-btn" onclick="followTopic('ai')">Follow</button>
            </div>
        </div>
    </div>

    <!-- People Section -->
    <div class="explore-section hidden" id="people-section">
        <div class="people-header">
            <h2>Discover People</h2>
            <p>Find creators and experts in your areas of interest</p>
        </div>

        <div class="people-grid">
            <div class="person-card verified">
                <div class="person-cover" style="background: linear-gradient(135deg, #e10600, #ff3333);"></div>
                <div class="person-avatar">
                    <img src="https://via.placeholder.com/80/1a1a1a/e10600?text=TG" alt="Tech Guru">
                    <i class="fas fa-check-circle verified-badge"></i>
                </div>
                <div class="person-info">
                    <h3>Tech Guru</h3>
                    <p>@techguru</p>
                    <div class="person-bio">Full-stack developer & tech educator. Building the future with Laravel & React ⚡</div>
                    <div class="person-stats">
                        <span>125K followers</span>
                        <span>2.3K posts</span>
                    </div>
                </div>
                <button class="follow-person-btn" onclick="followPerson('techguru')">Follow</button>
            </div>

            <div class="person-card">
                <div class="person-cover" style="background: linear-gradient(135deg, #2d2d2d, #1a1a1a);"></div>
                <div class="person-avatar">
                    <img src="https://via.placeholder.com/80/e10600/ffffff?text=DP" alt="Design Pro">
                </div>
                <div class="person-info">
                    <h3>Design Pro</h3>
                    <p>@designpro</p>
                    <div class="person-bio">UI/UX Designer creating superhero-inspired interfaces. Marvel & DC enthusiast 🦸‍♀️</div>
                    <div class="person-stats">
                        <span>89K followers</span>
                        <span>1.8K posts</span>
                    </div>
                </div>
                <button class="follow-person-btn" onclick="followPerson('designpro')">Follow</button>
            </div>

            <div class="person-card">
                <div class="person-cover" style="background: linear-gradient(135deg, #ff3333, #cc0500);"></div>
                <div class="person-avatar">
                    <img src="https://via.placeholder.com/80/000000/ff4444?text=CM" alt="Code Master">
                </div>
                <div class="person-info">
                    <h3>Code Master</h3>
                    <p>@codemaster</p>
                    <div class="person-bio">Senior Software Engineer. Teaching others to code like superheroes 💻</div>
                    <div class="person-stats">
                        <span>67K followers</span>
                        <span>987 posts</span>
                    </div>
                </div>
                <button class="follow-person-btn" onclick="followPerson('codemaster')">Follow</button>
            </div>

            <div class="person-card">
                <div class="person-cover" style="background: linear-gradient(135deg, #1a0000, #2d0000);"></div>
                <div class="person-avatar">
                    <img src="https://via.placeholder.com/80/ff6b6b/000000?text=UD" alt="UI Designer">
                </div>
                <div class="person-info">
                    <h3>UI Designer</h3>
                    <p>@uidesigner</p>
                    <div class="person-bio">Creating stunning user interfaces with comic-book flair ✨</div>
                    <div class="person-stats">
                        <span>45K followers</span>
                        <span>743 posts</span>
                    </div>
                </div>
                <button class="follow-person-btn" onclick="followPerson('uidesigner')">Follow</button>
            </div>
        </div>
    </div>
</div>

<div class="explore-loading" id="exploreLoading" style="display: none;">
    <div class="spinner"></div>
    <span>Loading more content...</span>
</div>
@endsection
