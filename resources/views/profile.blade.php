@extends('layouts.app')

@section('title', 'Profile / S App')

@section('content')
<div class="profile-container">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-cover">
            <div class="cover-image" style="background: linear-gradient(135deg, #e10600 0%, #1a0000 50%, #000 100%);">
                <div class="cover-overlay"></div>
                <button class="edit-cover-btn" onclick="editCoverPhoto()">
                    <i class="fas fa-camera"></i>
                </button>
            </div>
        </div>

        <div class="profile-main">
            <div class="profile-avatar-section">
                <div class="avatar-container" onclick="openAvatarCreator()">
                    <div class="current-avatar" id="currentAvatar">
                        <img src="https://via.placeholder.com/120/e10600/ffffff?text=JD" alt="Current Avatar" id="avatarImage">
                        <div class="avatar-ring"></div>
                        <div class="avatar-status online"></div>
                    </div>
                    <div class="avatar-edit-overlay">
                        <i class="fas fa-edit"></i>
                        <span>Edit Avatar</span>
                    </div>
                </div>

                <div class="avatar-options">
                    <button class="avatar-option-btn" onclick="uploadPhoto()" title="Upload Photo">
                        <i class="fas fa-upload"></i>
                    </button>
                    <button class="avatar-option-btn superhero-btn" onclick="openAvatarCreator()" title="Create Superhero Avatar">
                        <i class="fas fa-mask"></i>
                    </button>
                    <button class="avatar-option-btn" onclick="generateAI()" title="AI Generated">
                        <i class="fas fa-robot"></i>
                    </button>
                </div>
            </div>

            <div class="profile-info">
                <div class="profile-name">
                    <h1>John Doe</h1>
                    <div class="verification-badge">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
                <div class="profile-handle">@johndoe</div>
                <div class="profile-bio">
                    Full-stack developer passionate about creating superhero-themed web applications. Building the future with Laravel & React ⚡
                </div>
                <div class="profile-details">
                    <div class="detail-item">
                        <i class="fas fa-calendar"></i>
                        <span>Joined February 2024</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-link"></i>
                        <span>superherodev.com</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Superhero HQ, Earth</span>
                    </div>
                </div>
            </div>

            <div class="profile-actions">
                <button class="primary-btn edit-profile-btn" onclick="editProfile()">
                    <i class="fas fa-edit"></i>
                    Edit Profile
                </button>
                <button class="secondary-btn share-profile-btn" onclick="shareProfile()">
                    <i class="fas fa-share"></i>
                    Share Profile
                </button>
            </div>
        </div>

        <div class="profile-stats">
            <div class="stat-item" onclick="showFollowing()">
                <div class="stat-number">1,234</div>
                <div class="stat-label">Following</div>
            </div>
            <div class="stat-item" onclick="showFollowers()">
                <div class="stat-number">5,678</div>
                <div class="stat-label">Followers</div>
            </div>
            <div class="stat-item" onclick="showLikes()">
                <div class="stat-number">45.2K</div>
                <div class="stat-label">Likes</div>
            </div>
            <div class="stat-item" onclick="showPosts()">
                <div class="stat-number">892</div>
                <div class="stat-label">Posts</div>
            </div>
        </div>
    </div>

    <!-- Profile Content Tabs -->
    <div class="profile-tabs">
        <div class="tab-item active" onclick="switchProfileTab(this, 'posts')">
            <i class="fas fa-th-large"></i>
            <span>Posts</span>
        </div>
        <div class="tab-item" onclick="switchProfileTab(this, 'media')">
            <i class="fas fa-images"></i>
            <span>Media</span>
        </div>
        <div class="tab-item" onclick="switchProfileTab(this, 'likes')">
            <i class="fas fa-heart"></i>
            <span>Likes</span>
        </div>
        <div class="tab-item" onclick="switchProfileTab(this, 'about')">
            <i class="fas fa-user"></i>
            <span>About</span>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="profile-content" id="profileContent">
        <!-- Posts Tab Content -->
        <div class="tab-content active" id="posts-content">
            <div class="posts-grid">
                <!-- Sample posts would be loaded here -->
                <div class="post-preview">
                    <div class="post-image">
                        <img src="https://via.placeholder.com/300x300/e10600/ffffff?text=Superhero+UI" alt="Post">
                    </div>
                    <div class="post-overlay">
                        <div class="post-stats">
                            <span><i class="fas fa-heart"></i> 234</span>
                            <span><i class="fas fa-comment"></i> 45</span>
                        </div>
                    </div>
                </div>
                <!-- More posts... -->
            </div>
        </div>
    </div>
</div>

<!-- Superhero Avatar Creator Modal -->
<div class="avatar-creator-modal" id="avatarCreatorModal" style="display: none;">
    <div class="modal-backdrop" onclick="closeAvatarCreator()"></div>
    <div class="creator-container">
        <div class="creator-header">
            <h2>Create Your Superhero Avatar</h2>
            <button class="close-creator" onclick="closeAvatarCreator()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="creator-content">
            <!-- Avatar Preview -->
            <div class="avatar-preview-section">
                <div class="preview-container">
                    <div class="avatar-preview" id="avatarPreview">
                        <div class="hero-base" id="heroBase">
                            <!-- Face -->
                            <div class="hero-face" id="heroFace">
                                <div class="hero-eyes" id="heroEyes"></div>
                                <div class="hero-nose" id="heroNose"></div>
                                <div class="hero-mouth" id="heroMouth"></div>
                            </div>
                            <!-- Hair -->
                            <div class="hero-hair" id="heroHair"></div>
                            <!-- Mask -->
                            <div class="hero-mask" id="heroMask" style="display: none;"></div>
                            <!-- Body -->
                            <div class="hero-body" id="heroBody"></div>
                            <!-- Cape -->
                            <div class="hero-cape" id="heroCape" style="display: none;"></div>
                        </div>
                    </div>
                </div>

                <div class="preview-actions">
                    <button class="preview-btn" onclick="randomizeAvatar()">
                        <i class="fas fa-random"></i>
                        Randomize
                    </button>
                    <button class="preview-btn" onclick="resetAvatar()">
                        <i class="fas fa-undo"></i>
                        Reset
                    </button>
                </div>
            </div>

            <!-- Customization Options -->
            <div class="customization-section">
                <div class="customization-tabs">
                    <button class="custom-tab active" onclick="switchCustomTab(this, 'face')">
                        <i class="fas fa-user-circle"></i>
                        Face
                    </button>
                    <button class="custom-tab" onclick="switchCustomTab(this, 'hair')">
                        <i class="fas fa-cut"></i>
                        Hair
                    </button>
                    <button class="custom-tab" onclick="switchCustomTab(this, 'outfit')">
                        <i class="fas fa-tshirt"></i>
                        Outfit
                    </button>
                    <button class="custom-tab" onclick="switchCustomTab(this, 'powers')">
                        <i class="fas fa-magic"></i>
                        Powers
                    </button>
                    <button class="custom-tab" onclick="switchCustomTab(this, 'colors')">
                        <i class="fas fa-palette"></i>
                        Colors
                    </button>
                </div>

                <div class="customization-content">
                    <!-- Face Customization -->
                    <div class="custom-section active" id="face-section">
                        <div class="section-title">
                            <h3>Face Features</h3>
                            <p>Customize your superhero's facial features</p>
                        </div>
                        <div class="options-grid">
                            <div class="option-group">
                                <label>Face Shape</label>
                                <div class="option-buttons">
                                    <button class="option-btn active" onclick="setFaceShape('oval')">Oval</button>
                                    <button class="option-btn" onclick="setFaceShape('round')">Round</button>
                                    <button class="option-btn" onclick="setFaceShape('square')">Square</button>
                                    <button class="option-btn" onclick="setFaceShape('heart')">Heart</button>
                                </div>
                            </div>
                            <div class="option-group">
                                <label>Eyes</label>
                                <div class="option-buttons">
                                    <button class="option-btn active" onclick="setEyeStyle('normal')">Normal</button>
                                    <button class="option-btn" onclick="setEyeStyle('sharp')">Sharp</button>
                                    <button class="option-btn" onclick="setEyeStyle('large')">Large</button>
                                    <button class="option-btn" onclick="setEyeStyle('glowing')">Glowing</button>
                                </div>
                            </div>
                            <div class="option-group">
                                <label>Mask</label>
                                <div class="option-buttons">
                                    <button class="option-btn active" onclick="setMask('none')">No Mask</button>
                                    <button class="option-btn" onclick="setMask('classic')">Classic</button>
                                    <button class="option-btn" onclick="setMask('full')">Full Face</button>
                                    <button class="option-btn" onclick="setMask('eyes')">Eyes Only</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hair Customization -->
                    <div class="custom-section" id="hair-section">
                        <div class="section-title">
                            <h3>Hair Style</h3>
                            <p>Choose your superhero hairstyle</p>
                        </div>
                        <div class="hair-grid">
                            <div class="hair-option" onclick="setHairStyle('short')">
                                <div class="hair-preview short"></div>
                                <span>Short</span>
                            </div>
                            <div class="hair-option" onclick="setHairStyle('long')">
                                <div class="hair-preview long"></div>
                                <span>Long</span>
                            </div>
                            <div class="hair-option" onclick="setHairStyle('spiky')">
                                <div class="hair-preview spiky"></div>
                                <span>Spiky</span>
                            </div>
                            <div class="hair-option" onclick="setHairStyle('wavy')">
                                <div class="hair-preview wavy"></div>
                                <span>Wavy</span>
                            </div>
                            <div class="hair-option" onclick="setHairStyle('none')">
                                <div class="hair-preview bald"></div>
                                <span>Bald</span>
                            </div>
                        </div>
                    </div>

                    <!-- Outfit Customization -->
                    <div class="custom-section" id="outfit-section">
                        <div class="section-title">
                            <h3>Superhero Outfit</h3>
                            <p>Design your hero costume</p>
                        </div>
                        <div class="outfit-options">
                            <div class="outfit-category">
                                <h4>Suit Style</h4>
                                <div class="outfit-grid">
                                    <div class="outfit-item active" onclick="setSuitStyle('classic')">
                                        <div class="outfit-preview classic-suit"></div>
                                        <span>Classic</span>
                                    </div>
                                    <div class="outfit-item" onclick="setSuitStyle('armored')">
                                        <div class="outfit-preview armored-suit"></div>
                                        <span>Armored</span>
                                    </div>
                                    <div class="outfit-item" onclick="setSuitStyle('tech')">
                                        <div class="outfit-preview tech-suit"></div>
                                        <span>Tech</span>
                                    </div>
                                    <div class="outfit-item" onclick="setSuitStyle('mystic')">
                                        <div class="outfit-preview mystic-suit"></div>
                                        <span>Mystic</span>
                                    </div>
                                </div>
                            </div>
                            <div class="outfit-category">
                                <h4>Cape</h4>
                                <div class="cape-options">
                                    <label class="toggle-option">
                                        <input type="checkbox" id="capeToggle" onchange="toggleCape()">
                                        <span class="toggle-slider"></span>
                                        <span class="toggle-label">Add Cape</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Powers Customization -->
                    <div class="custom-section" id="powers-section">
                        <div class="section-title">
                            <h3>Superpowers</h3>
                            <p>Add visual effects to your avatar</p>
                        </div>
                        <div class="powers-grid">
                            <div class="power-item" onclick="addPower('fire')">
                                <div class="power-icon fire">
                                    <i class="fas fa-fire"></i>
                                </div>
                                <span>Fire</span>
                            </div>
                            <div class="power-item" onclick="addPower('lightning')">
                                <div class="power-icon lightning">
                                    <i class="fas fa-bolt"></i>
                                </div>
                                <span>Lightning</span>
                            </div>
                            <div class="power-item" onclick="addPower('ice')">
                                <div class="power-icon ice">
                                    <i class="fas fa-snowflake"></i>
                                </div>
                                <span>Ice</span>
                            </div>
                            <div class="power-item" onclick="addPower('energy')">
                                <div class="power-icon energy">
                                    <i class="fas fa-magic"></i>
                                </div>
                                <span>Energy</span>
                            </div>
                            <div class="power-item" onclick="addPower('tech')">
                                <div class="power-icon tech">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <span>Tech</span>
                            </div>
                            <div class="power-item" onclick="addPower('psychic')">
                                <div class="power-icon psychic">
                                    <i class="fas fa-brain"></i>
                                </div>
                                <span>Psychic</span>
                            </div>
                        </div>
                    </div>

                    <!-- Colors Customization -->
                    <div class="custom-section" id="colors-section">
                        <div class="section-title">
                            <h3>Color Scheme</h3>
                            <p>Customize your hero's colors</p>
                        </div>
                        <div class="color-options">
                            <div class="color-group">
                                <label>Primary Color</label>
                                <div class="color-palette">
                                    <div class="color-swatch active" style="background: #e10600" onclick="setPrimaryColor('#e10600')"></div>
                                    <div class="color-swatch" style="background: #1d9bf0" onclick="setPrimaryColor('#1d9bf0')"></div>
                                    <div class="color-swatch" style="background: #00ba7c" onclick="setPrimaryColor('#00ba7c')"></div>
                                    <div class="color-swatch" style="background: #8b5cf6" onclick="setPrimaryColor('#8b5cf6')"></div>
                                    <div class="color-swatch" style="background: #ffd400" onclick="setPrimaryColor('#ffd400')"></div>
                                    <div class="color-swatch" style="background: #ff6b6b" onclick="setPrimaryColor('#ff6b6b')"></div>
                                </div>
                            </div>
                            <div class="color-group">
                                <label>Secondary Color</label>
                                <div class="color-palette">
                                    <div class="color-swatch active" style="background: #000" onclick="setSecondaryColor('#000')"></div>
                                    <div class="color-swatch" style="background: #fff" onclick="setSecondaryColor('#fff')"></div>
                                    <div class="color-swatch" style="background: #1a1a1a" onclick="setSecondaryColor('#1a1a1a')"></div>
                                    <div class="color-swatch" style="background: #2f3336" onclick="setSecondaryColor('#2f3336')"></div>
                                    <div class="color-swatch" style="background: #8b98a5" onclick="setSecondaryColor('#8b98a5')"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="creator-footer">
            <div class="preset-avatars">
                <span>Quick Presets:</span>
                <button class="preset-btn" onclick="loadPreset('hero1')">🦸‍♂️ Classic</button>
                <button class="preset-btn" onclick="loadPreset('hero2')">⚡ Speedster</button>
                <button class="preset-btn" onclick="loadPreset('hero3')">🔥 Fire Hero</button>
                <button class="preset-btn" onclick="loadPreset('hero4')">🧠 Mind Master</button>
            </div>
            <div class="creator-actions">
                <button class="secondary-btn" onclick="closeAvatarCreator()">Cancel</button>
                <button class="primary-btn" onclick="saveAvatar()">
                    <i class="fas fa-save"></i>
                    Save Avatar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="edit-profile-modal" id="editProfileModal" style="display: none;">
    <div class="modal-backdrop" onclick="closeEditProfile()"></div>
    <div class="modal-container">
        <div class="modal-header">
            <h3>Edit Profile</h3>
            <button class="close-modal" onclick="closeEditProfile()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-content">
            <form class="edit-profile-form">
                <div class="form-group">
                    <label>Display Name</label>
                    <input type="text" value="John Doe" placeholder="Your display name">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" value="johndoe" placeholder="Your username">
                </div>
                <div class="form-group">
                    <label>Bio</label>
                    <textarea placeholder="Tell us about yourself" rows="3">Full-stack developer passionate about creating superhero-themed web applications. Building the future with Laravel & React ⚡</textarea>
                </div>
                <div class="form-group">
                    <label>Website</label>
                    <input type="url" value="superherodev.com" placeholder="Your website">
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" value="Superhero HQ, Earth" placeholder="Your location">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="secondary-btn" onclick="closeEditProfile()">Cancel</button>
            <button class="primary-btn" onclick="saveProfile()">Save Changes</button>
        </div>
    </div>
</div>

@endsection
