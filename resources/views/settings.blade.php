@extends('layouts.app')

@section('title', 'Settings / S App')

@section('content')
<div class="settings-container">
    <!-- Settings Header -->
    <div class="settings-header">
        <div class="header-content">
            <div class="header-info">
                <h1>Settings</h1>
                <p>Customize your S App experience</p>
            </div>
            <div class="header-actions">
                <button class="sync-btn" onclick="syncSettings()">
                    <i class="fas fa-sync"></i>
                    <span>Sync</span>
                </button>
                <button class="export-btn" onclick="exportSettings()">
                    <i class="fas fa-download"></i>
                    <span>Export</span>
                </button>
            </div>
        </div>
    </div>

    <div class="settings-content">
        <!-- Settings Sidebar -->
        <div class="settings-sidebar">
            <div class="settings-search">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search settings..." onkeyup="searchSettings(this.value)">
            </div>

            <div class="settings-nav">
                <div class="nav-section">
                    <div class="section-title">Personal</div>
                    <div class="nav-item active" onclick="switchSettingsSection(this, 'account')">
                        <div class="nav-icon">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <span>Account</span>
                        <i class="fas fa-chevron-right nav-arrow"></i>
                    </div>
                    <div class="nav-item" onclick="switchSettingsSection(this, 'privacy')">
                        <div class="nav-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <span>Privacy & Security</span>
                        <i class="fas fa-chevron-right nav-arrow"></i>
                    </div>
                    <div class="nav-item" onclick="switchSettingsSection(this, 'notifications')">
                        <div class="nav-icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <span>Notifications</span>
                        <div class="notification-badge">3</div>
                        <i class="fas fa-chevron-right nav-arrow"></i>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="section-title">Experience</div>
                    <div class="nav-item" onclick="switchSettingsSection(this, 'appearance')">
                        <div class="nav-icon">
                            <i class="fas fa-palette"></i>
                        </div>
                        <span>Appearance</span>
                        <i class="fas fa-chevron-right nav-arrow"></i>
                    </div>
                    <div class="nav-item" onclick="switchSettingsSection(this, 'accessibility')">
                        <div class="nav-icon">
                            <i class="fas fa-universal-access"></i>
                        </div>
                        <span>Accessibility</span>
                        <i class="fas fa-chevron-right nav-arrow"></i>
                    </div>
                    <div class="nav-item" onclick="switchSettingsSection(this, 'language')">
                        <div class="nav-icon">
                            <i class="fas fa-language"></i>
                        </div>
                        <span>Language & Region</span>
                        <i class="fas fa-chevron-right nav-arrow"></i>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="section-title">Content</div>
                    <div class="nav-item" onclick="switchSettingsSection(this, 'feeds')">
                        <div class="nav-icon">
                            <i class="fas fa-stream"></i>
                        </div>
                        <span>Content Feeds</span>
                        <i class="fas fa-chevron-right nav-arrow"></i>
                    </div>
                    <div class="nav-item" onclick="switchSettingsSection(this, 'blocked')">
                        <div class="nav-icon">
                            <i class="fas fa-ban"></i>
                        </div>
                        <span>Blocked & Muted</span>
                        <i class="fas fa-chevron-right nav-arrow"></i>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="section-title">System</div>
                    <div class="nav-item" onclick="switchSettingsSection(this, 'data')">
                        <div class="nav-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <span>Data & Storage</span>
                        <i class="fas fa-chevron-right nav-arrow"></i>
                    </div>
                    <div class="nav-item" onclick="switchSettingsSection(this, 'advanced')">
                        <div class="nav-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <span>Advanced</span>
                        <i class="fas fa-chevron-right nav-arrow"></i>
                    </div>
                    <div class="nav-item" onclick="switchSettingsSection(this, 'about')">
                        <div class="nav-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <span>About S App</span>
                        <i class="fas fa-chevron-right nav-arrow"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Main Content -->
        <div class="settings-main">
            <!-- Account Settings -->
            <div class="settings-section active" id="account-section">
                <div class="section-header">
                    <h2>Account Settings</h2>
                    <p>Manage your account information and preferences</p>
                </div>

                <div class="settings-cards">
                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="card-title">
                                <h3>Profile Information</h3>
                                <p>Update your basic profile details</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="form-group">
                                <label>Display Name</label>
                                <input type="text" value="John Doe" class="settings-input">
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" value="@johndoe" class="settings-input">
                            </div>
                            <div class="form-group">
                                <label>Bio</label>
                                <textarea class="settings-input" rows="3">Full-stack developer passionate about superhero-themed applications ⚡</textarea>
                            </div>
                        </div>
                        <div class="card-actions">
                            <button class="save-btn">Save Changes</button>
                        </div>
                    </div>

                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="card-title">
                                <h3>Email & Phone</h3>
                                <p>Manage your contact information</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="contact-item">
                                <div class="contact-info">
                                    <span class="contact-label">Primary Email</span>
                                    <span class="contact-value">john.doe@email.com</span>
                                    <span class="verified-badge"><i class="fas fa-check-circle"></i> Verified</span>
                                </div>
                                <button class="change-btn" onclick="changeEmail()">Change</button>
                            </div>
                            <div class="contact-item">
                                <div class="contact-info">
                                    <span class="contact-label">Phone Number</span>
                                    <span class="contact-value">+1 (555) 123-4567</span>
                                    <span class="verified-badge"><i class="fas fa-check-circle"></i> Verified</span>
                                </div>
                                <button class="change-btn" onclick="changePhone()">Change</button>
                            </div>
                        </div>
                    </div>

                    <div class="settings-card danger-card">
                        <div class="card-header">
                            <div class="card-icon danger">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="card-title">
                                <h3>Danger Zone</h3>
                                <p>Irreversible account actions</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="danger-action">
                                <div class="danger-info">
                                    <h4>Deactivate Account</h4>
                                    <p>Temporarily disable your account. You can reactivate it anytime.</p>
                                </div>
                                <button class="danger-btn outline" onclick="deactivateAccount()">Deactivate</button>
                            </div>
                            <div class="danger-action">
                                <div class="danger-info">
                                    <h4>Delete Account</h4>
                                    <p>Permanently delete your account and all data. This cannot be undone.</p>
                                </div>
                                <button class="danger-btn" onclick="deleteAccount()">Delete Account</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Privacy & Security Settings -->
            <div class="settings-section" id="privacy-section">
                <div class="section-header">
                    <h2>Privacy & Security</h2>
                    <p>Control your privacy settings and security preferences</p>
                </div>

                <div class="settings-cards">
                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div class="card-title">
                                <h3>Account Security</h3>
                                <p>Strengthen your account protection</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="security-item">
                                <div class="security-info">
                                    <h4>Two-Factor Authentication</h4>
                                    <p>Add an extra layer of security to your account</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="2fa" checked>
                                    <label for="2fa"></label>
                                </div>
                            </div>
                            <div class="security-item">
                                <div class="security-info">
                                    <h4>Login Notifications</h4>
                                    <p>Get notified of new login attempts</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="login-notifications" checked>
                                    <label for="login-notifications"></label>
                                </div>
                            </div>
                            <div class="security-item">
                                <div class="security-info">
                                    <h4>Password</h4>
                                    <p>Last changed 3 months ago</p>
                                </div>
                                <button class="change-password-btn" onclick="changePassword()">Change Password</button>
                            </div>
                        </div>
                    </div>

                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-eye"></i>
                            </div>
                            <div class="card-title">
                                <h3>Profile Visibility</h3>
                                <p>Control who can see your profile and content</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="privacy-setting">
                                <label>Profile Visibility</label>
                                <select class="settings-select">
                                    <option value="public">Public</option>
                                    <option value="followers">Followers Only</option>
                                    <option value="private">Private</option>
                                </select>
                            </div>
                            <div class="privacy-setting">
                                <label>Show Activity Status</label>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="activity-status" checked>
                                    <label for="activity-status"></label>
                                </div>
                            </div>
                            <div class="privacy-setting">
                                <label>Allow Search Engines</label>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="search-engines">
                                    <label for="search-engines"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notifications Settings -->
            <div class="settings-section" id="notifications-section">
                <div class="section-header">
                    <h2>Notifications</h2>
                    <p>Control how and when you receive notifications</p>
                </div>

                <div class="settings-cards">
                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="card-title">
                                <h3>Push Notifications</h3>
                                <p>Manage push notification preferences</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="notification-setting">
                                <div class="notification-info">
                                    <h4>New Messages</h4>
                                    <p>Get notified when you receive new messages</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="new-messages" checked>
                                    <label for="new-messages"></label>
                                </div>
                            </div>
                            <div class="notification-setting">
                                <div class="notification-info">
                                    <h4>Post Interactions</h4>
                                    <p>Likes, comments, and shares on your posts</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="post-interactions" checked>
                                    <label for="post-interactions"></label>
                                </div>
                            </div>
                            <div class="notification-setting">
                                <div class="notification-info">
                                    <h4>Follower Updates</h4>
                                    <p>When someone follows or unfollows you</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="follower-updates" checked>
                                    <label for="follower-updates"></label>
                                </div>
                            </div>
                            <div class="notification-setting">
                                <div class="notification-info">
                                    <h4>Mentions</h4>
                                    <p>When someone mentions you in a post or comment</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="mentions" checked>
                                    <label for="mentions"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="card-title">
                                <h3>Email Notifications</h3>
                                <p>Choose what emails you want to receive</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="notification-setting">
                                <div class="notification-info">
                                    <h4>Weekly Digest</h4>
                                    <p>Summary of your activity and trending content</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="weekly-digest" checked>
                                    <label for="weekly-digest"></label>
                                </div>
                            </div>
                            <div class="notification-setting">
                                <div class="notification-info">
                                    <h4>Security Alerts</h4>
                                    <p>Important security and login notifications</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="security-alerts" checked>
                                    <label for="security-alerts"></label>
                                </div>
                            </div>
                            <div class="notification-setting">
                                <div class="notification-info">
                                    <h4>Product Updates</h4>
                                    <p>New features and S App announcements</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="product-updates">
                                    <label for="product-updates"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="card-title">
                                <h3>Quiet Hours</h3>
                                <p>Set times when notifications should be paused</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="quiet-hours-setting">
                                <div class="quiet-hours-toggle">
                                    <label>Enable Quiet Hours</label>
                                    <div class="toggle-switch">
                                        <input type="checkbox" id="quiet-hours" onchange="toggleQuietHours()">
                                        <label for="quiet-hours"></label>
                                    </div>
                                </div>
                                <div class="quiet-hours-time" id="quietHoursTime" style="display: none;">
                                    <div class="time-input">
                                        <label>From</label>
                                        <input type="time" value="22:00" class="settings-input">
                                    </div>
                                    <div class="time-input">
                                        <label>To</label>
                                        <input type="time" value="08:00" class="settings-input">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Appearance Settings -->
            <div class="settings-section" id="appearance-section">
                <div class="section-header">
                    <h2>Appearance</h2>
                    <p>Customize the look and feel of S App</p>
                </div>

                <div class="settings-cards">
                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-moon"></i>
                            </div>
                            <div class="card-title">
                                <h3>Theme Settings</h3>
                                <p>Choose your preferred theme</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="theme-options">
                                <div class="theme-option active" onclick="selectTheme('dark')">
                                    <div class="theme-preview dark-theme">
                                        <div class="preview-header"></div>
                                        <div class="preview-content">
                                            <div class="preview-line"></div>
                                            <div class="preview-line short"></div>
                                        </div>
                                    </div>
                                    <div class="theme-info">
                                        <h4>Dark Mode</h4>
                                        <p>Default S App experience</p>
                                    </div>
                                    <div class="theme-selector">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                                <div class="theme-option" onclick="selectTheme('light')">
                                    <div class="theme-preview light-theme">
                                        <div class="preview-header"></div>
                                        <div class="preview-content">
                                            <div class="preview-line"></div>
                                            <div class="preview-line short"></div>
                                        </div>
                                    </div>
                                    <div class="theme-info">
                                        <h4>Light Mode</h4>
                                        <p>Bright and clean interface</p>
                                    </div>
                                    <div class="theme-selector">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                                <div class="theme-option" onclick="selectTheme('auto')">
                                    <div class="theme-preview auto-theme">
                                        <div class="preview-header"></div>
                                        <div class="preview-content">
                                            <div class="preview-line"></div>
                                            <div class="preview-line short"></div>
                                        </div>
                                    </div>
                                    <div class="theme-info">
                                        <h4>Auto</h4>
                                        <p>Matches system settings</p>
                                    </div>
                                    <div class="theme-selector">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-paint-brush"></i>
                            </div>
                            <div class="card-title">
                                <h3>Superhero Theme</h3>
                                <p>Customize your superhero colors</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="color-customization">
                                <div class="color-group">
                                    <label>Primary Color</label>
                                    <div class="color-picker-container">
                                        <div class="color-preview" style="background-color: #e10600;"></div>
                                        <input type="color" value="#e10600" class="color-picker">
                                        <span class="color-code">#e10600</span>
                                    </div>
                                </div>
                                <div class="color-group">
                                    <label>Accent Color</label>
                                    <div class="color-picker-container">
                                        <div class="color-preview" style="background-color: #ff3333;"></div>
                                        <input type="color" value="#ff3333" class="color-picker">
                                        <span class="color-code">#ff3333</span>
                                    </div>
                                </div>
                                <div class="preset-colors">
                                    <span>Popular themes:</span>
                                    <div class="preset-item" onclick="applyPreset('classic')" title="Classic Red">
                                        <div class="preset-primary" style="background: #e10600;"></div>
                                        <div class="preset-accent" style="background: #ff3333;"></div>
                                    </div>
                                    <div class="preset-item" onclick="applyPreset('blue')" title="Electric Blue">
                                        <div class="preset-primary" style="background: #1d9bf0;"></div>
                                        <div class="preset-accent" style="background: #00d4ff;"></div>
                                    </div>
                                    <div class="preset-item" onclick="applyPreset('green')" title="Emerald Green">
                                        <div class="preset-primary" style="background: #00ba7c;"></div>
                                        <div class="preset-accent" style="background: #00ff9f;"></div>
                                    </div>
                                    <div class="preset-item" onclick="applyPreset('purple')" title="Royal Purple">
                                        <div class="preset-primary" style="background: #8b5cf6;"></div>
                                        <div class="preset-accent" style="background: #a78bfa;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-text-height"></i>
                            </div>
                            <div class="card-title">
                                <h3>Display Settings</h3>
                                <p>Adjust text size and display preferences</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="display-setting">
                                <label>Font Size</label>
                                <div class="slider-container">
                                    <input type="range" min="12" max="20" value="16" class="settings-slider" oninput="updateFontSize(this.value)">
                                    <div class="slider-labels">
                                        <span>Small</span>
                                        <span>Medium</span>
                                        <span>Large</span>
                                    </div>
                                </div>
                            </div>
                            <div class="display-setting">
                                <label>Animations</label>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="animations" checked>
                                    <label for="animations"></label>
                                </div>
                            </div>
                            <div class="display-setting">
                                <label>Reduce Motion</label>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="reduce-motion">
                                    <label for="reduce-motion"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Accessibility Settings -->
            <div class="settings-section" id="accessibility-section">
                <div class="section-header">
                    <h2>Accessibility</h2>
                    <p>Make S App more accessible and comfortable for you</p>
                </div>

                <div class="settings-cards">
                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-universal-access"></i>
                            </div>
                            <div class="card-title">
                                <h3>Visual Accessibility</h3>
                                <p>Adjust visual elements for better readability</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="accessibility-setting">
                                <label>High Contrast Mode</label>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="high-contrast" onchange="toggleHighContrast()">
                                    <label for="high-contrast"></label>
                                </div>
                            </div>
                            <div class="accessibility-setting">
                                <label>Large Text</label>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="large-text" onchange="toggleLargeText()">
                                    <label for="large-text"></label>
                                </div>
                            </div>
                            <div class="accessibility-setting">
                                <label>Focus Indicators</label>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="focus-indicators" checked>
                                    <label for="focus-indicators"></label>
                                </div>
                            </div>
                            <div class="accessibility-setting">
                                <label>Color Blind Friendly</label>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="colorblind-mode">
                                    <label for="colorblind-mode"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-volume-up"></i>
                            </div>
                            <div class="card-title">
                                <h3>Audio & Motion</h3>
                                <p>Control sounds and animations</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="accessibility-setting">
                                <label>Sound Effects</label>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="sound-effects" checked>
                                    <label for="sound-effects"></label>
                                </div>
                            </div>
                            <div class="accessibility-setting">
                                <label>Reduce Motion</label>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="reduce-motion-accessibility">
                                    <label for="reduce-motion-accessibility"></label>
                                </div>
                            </div>
                            <div class="accessibility-setting">
                                <label>Auto-play Videos</label>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="autoplay-videos" checked>
                                    <label for="autoplay-videos"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-keyboard"></i>
                            </div>
                            <div class="card-title">
                                <h3>Keyboard Navigation</h3>
                                <p>Enhance keyboard accessibility</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="keyboard-shortcuts">
                                <h4>Keyboard Shortcuts</h4>
                                <div class="shortcut-list">
                                    <div class="shortcut-item">
                                        <span class="shortcut-keys">Ctrl + /</span>
                                        <span class="shortcut-desc">Show all shortcuts</span>
                                    </div>
                                    <div class="shortcut-item">
                                        <span class="shortcut-keys">Space</span>
                                        <span class="shortcut-desc">Like/Unlike post</span>
                                    </div>
                                    <div class="shortcut-item">
                                        <span class="shortcut-keys">Enter</span>
                                        <span class="shortcut-desc">Open post</span>
                                    </div>
                                    <div class="shortcut-item">
                                        <span class="shortcut-keys">Esc</span>
                                        <span class="shortcut-desc">Close modal</span>
                                    </div>
                                </div>
                            </div>
                            <div class="accessibility-setting">
                                <label>Tab Navigation</label>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="tab-navigation" checked>
                                    <label for="tab-navigation"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Language & Region Settings -->
            <div class="settings-section" id="language-section">
                <div class="section-header">
                    <h2>Language & Region</h2>
                    <p>Customize your language and regional preferences</p>
                </div>

                <div class="settings-cards">
                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-language"></i>
                            </div>
                            <div class="card-title">
                                <h3>Display Language</h3>
                                <p>Choose your preferred language</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="language-selector">
                                <select class="settings-select" onchange="changeLanguage(this.value)">
                                    <option value="en" selected>English (US)</option>
                                    <option value="en-gb">English (UK)</option>
                                    <option value="es">Español</option>
                                    <option value="fr">Français</option>
                                    <option value="de">Deutsch</option>
                                    <option value="it">Italiano</option>
                                    <option value="pt">Português</option>
                                    <option value="ru">Русский</option>
                                    <option value="ja">日本語</option>
                                    <option value="ko">한국어</option>
                                    <option value="zh">中文</option>
                                    <option value="hi">हिंदी</option>
                                    <option value="ar">العربية</option>
                                </select>
                            </div>
                            <div class="language-info">
                                <p><i class="fas fa-info-circle"></i> Some languages may have limited translations</p>
                            </div>
                        </div>
                    </div>

                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="card-title">
                                <h3>Region & Timezone</h3>
                                <p>Set your location and timezone preferences</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="form-group">
                                <label>Country/Region</label>
                                <select class="settings-select">
                                    <option value="US">United States</option>
                                    <option value="IN" selected>India</option>
                                    <option value="GB">United Kingdom</option>
                                    <option value="CA">Canada</option>
                                    <option value="AU">Australia</option>
                                    <option value="DE">Germany</option>
                                    <option value="FR">France</option>
                                    <option value="JP">Japan</option>
                                    <option value="BR">Brazil</option>
                                    <option value="MX">Mexico</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Timezone</label>
                                <select class="settings-select">
                                    <option value="UTC">UTC (Coordinated Universal Time)</option>
                                    <option value="Asia/Kolkata" selected>Asia/Kolkata (IST)</option>
                                    <option value="America/New_York">America/New_York (EST)</option>
                                    <option value="Europe/London">Europe/London (GMT)</option>
                                    <option value="Asia/Tokyo">Asia/Tokyo (JST)</option>
                                    <option value="Australia/Sydney">Australia/Sydney (AEST)</option>
                                </select>
                            </div>
                            <div class="current-time">
                                <i class="fas fa-clock"></i>
                                <span>Current time: <span id="currentTime">6:34 PM</span></span>
                            </div>
                        </div>
                    </div>

                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div class="card-title">
                                <h3>Date & Time Format</h3>
                                <p>Customize how dates and times are displayed</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="format-setting">
                                <label>Date Format</label>
                                <select class="settings-select">
                                    <option value="MM/DD/YYYY">MM/DD/YYYY (12/25/2024)</option>
                                    <option value="DD/MM/YYYY" selected>DD/MM/YYYY (25/12/2024)</option>
                                    <option value="YYYY-MM-DD">YYYY-MM-DD (2024-12-25)</option>
                                    <option value="DD MMM YYYY">DD MMM YYYY (25 Dec 2024)</option>
                                </select>
                            </div>
                            <div class="format-setting">
                                <label>Time Format</label>
                                <select class="settings-select">
                                    <option value="12h" selected>12 Hour (6:34 PM)</option>
                                    <option value="24h">24 Hour (18:34)</option>
                                </select>
                            </div>
                            <div class="format-setting">
                                <label>Week Starts On</label>
                                <select class="settings-select">
                                    <option value="sunday" selected>Sunday</option>
                                    <option value="monday">Monday</option>
                                    <option value="saturday">Saturday</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Feeds Settings -->
            <div class="settings-section" id="feeds-section">
                <div class="section-header">
                    <h2>Content Feeds</h2>
                    <p>Customize your content discovery and feed preferences</p>
                </div>

                <div class="settings-cards">
                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-stream"></i>
                            </div>
                            <div class="card-title">
                                <h3>Feed Algorithm</h3>
                                <p>Control how content is prioritized in your feed</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="algorithm-setting">
                                <label>Feed Type</label>
                                <div class="radio-group">
                                    <label class="radio-option">
                                        <input type="radio" name="feed-type" value="algorithmic" checked>
                                        <span class="radio-checkmark"></span>
                                        <div class="radio-content">
                                            <h4>Smart Feed</h4>
                                            <p>Curated based on your interests and activity</p>
                                        </div>
                                    </label>
                                    <label class="radio-option">
                                        <input type="radio" name="feed-type" value="chronological">
                                        <span class="radio-checkmark"></span>
                                        <div class="radio-content">
                                            <h4>Latest First</h4>
                                            <p>Show posts in chronological order</p>
                                        </div>
                                    </label>
                                    <label class="radio-option">
                                        <input type="radio" name="feed-type" value="following">
                                        <span class="radio-checkmark"></span>
                                        <div class="radio-content">
                                            <h4>Following Only</h4>
                                            <p>Show only posts from people you follow</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-tags"></i>
                            </div>
                            <div class="card-title">
                                <h3>Content Preferences</h3>
                                <p>Choose what types of content you want to see</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="content-types">
                                <div class="content-type-item">
                                    <div class="content-type-info">
                                        <i class="fas fa-code"></i>
                                        <div>
                                            <h4>Programming</h4>
                                            <p>Code snippets, tutorials, tech news</p>
                                        </div>
                                    </div>
                                    <div class="toggle-switch">
                                        <input type="checkbox" id="content-programming" checked>
                                        <label for="content-programming"></label>
                                    </div>
                                </div>
                                <div class="content-type-item">
                                    <div class="content-type-info">
                                        <i class="fas fa-palette"></i>
                                        <div>
                                            <h4>Design</h4>
                                            <p>UI/UX designs, creative inspiration</p>
                                        </div>
                                    </div>
                                    <div class="toggle-switch">
                                        <input type="checkbox" id="content-design" checked>
                                        <label for="content-design"></label>
                                    </div>
                                </div>
                                <div class="content-type-item">
                                    <div class="content-type-info">
                                        <i class="fas fa-briefcase"></i>
                                        <div>
                                            <h4>Career</h4>
                                            <p>Job opportunities, career advice</p>
                                        </div>
                                    </div>
                                    <div class="toggle-switch">
                                        <input type="checkbox" id="content-career" checked>
                                        <label for="content-career"></label>
                                    </div>
                                </div>
                                <div class="content-type-item">
                                    <div class="content-type-info">
                                        <i class="fas fa-gamepad"></i>
                                        <div>
                                            <h4>Gaming</h4>
                                            <p>Game development, gaming news</p>
                                        </div>
                                    </div>
                                    <div class="toggle-switch">
                                        <input type="checkbox" id="content-gaming">
                                        <label for="content-gaming"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-fire"></i>
                            </div>
                            <div class="card-title">
                                <h3>Trending & Discovery</h3>
                                <p>Control trending content and recommendations</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="discovery-setting">
                                <div class="discovery-info">
                                    <h4>Show Trending Topics</h4>
                                    <p>Display trending hashtags and topics</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="trending-topics" checked>
                                    <label for="trending-topics"></label>
                                </div>
                            </div>
                            <div class="discovery-setting">
                                <div class="discovery-info">
                                    <h4>Suggested Posts</h4>
                                    <p>Show posts you might be interested in</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="suggested-posts" checked>
                                    <label for="suggested-posts"></label>
                                </div>
                            </div>
                            <div class="discovery-setting">
                                <div class="discovery-info">
                                    <h4>Location-based Content</h4>
                                    <p>Show content from your area</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="location-content">
                                    <label for="location-content"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Blocked & Muted Settings -->
            <div class="settings-section" id="blocked-section">
                <div class="section-header">
                    <h2>Blocked & Muted</h2>
                    <p>Manage blocked users and muted keywords</p>
                </div>

                <div class="settings-cards">
                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-ban"></i>
                            </div>
                            <div class="card-title">
                                <h3>Blocked Users</h3>
                                <p>Users you've blocked won't be able to interact with you</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="blocked-users-list">
                                <div class="blocked-user-item">
                                    <img src="https://via.placeholder.com/40/ff6b6b/ffffff?text=SP" alt="Spam User">
                                    <div class="blocked-user-info">
                                        <h4>@spamuser123</h4>
                                        <p>Blocked 2 days ago</p>
                                    </div>
                                    <button class="unblock-btn" onclick="unblockUser('spamuser123')">Unblock</button>
                                </div>
                                <div class="blocked-user-item">
                                    <img src="https://via.placeholder.com/40/dc2626/ffffff?text=TR" alt="Troll User">
                                    <div class="blocked-user-info">
                                        <h4>@trolluser456</h4>
                                        <p>Blocked 1 week ago</p>
                                    </div>
                                    <button class="unblock-btn" onclick="unblockUser('trolluser456')">Unblock</button>
                                </div>
                            </div>
                            <div class="block-stats">
                                <p><i class="fas fa-info-circle"></i> You have blocked 2 users</p>
                            </div>
                        </div>
                    </div>

                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-volume-mute"></i>
                            </div>
                            <div class="card-title">
                                <h3>Muted Keywords</h3>
                                <p>Hide posts containing specific words or phrases</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="muted-keywords">
                                <div class="add-keyword">
                                    <input type="text" placeholder="Add keyword to mute..." class="keyword-input" id="keywordInput">
                                    <button class="add-keyword-btn" onclick="addMutedKeyword()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="keywords-list">
                                    <div class="keyword-item">
                                        <span class="keyword">spam</span>
                                        <button class="remove-keyword" onclick="removeMutedKeyword('spam')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="keyword-item">
                                        <span class="keyword">cryptocurrency</span>
                                        <button class="remove-keyword" onclick="removeMutedKeyword('cryptocurrency')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="keyword-item">
                                        <span class="keyword">politics</span>
                                        <button class="remove-keyword" onclick="removeMutedKeyword('politics')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-filter"></i>
                            </div>
                            <div class="card-title">
                                <h3>Content Filtering</h3>
                                <p>Control what content appears in your feed</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="filter-setting">
                                <div class="filter-info">
                                    <h4>Hide Sensitive Content</h4>
                                    <p>Filter out potentially sensitive or inappropriate content</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="hide-sensitive" checked>
                                    <label for="hide-sensitive"></label>
                                </div>
                            </div>
                            <div class="filter-setting">
                                <div class="filter-info">
                                    <h4>Quality Filter</h4>
                                    <p>Hide low-quality or duplicate content</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="quality-filter" checked>
                                    <label for="quality-filter"></label>
                                </div>
                            </div>
                            <div class="filter-setting">
                                <div class="filter-info">
                                    <h4>Block New Accounts</h4>
                                    <p>Limit interactions from recently created accounts</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="block-new-accounts">
                                    <label for="block-new-accounts"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data & Storage Settings -->
            <div class="settings-section" id="data-section">
                <div class="section-header">
                    <h2>Data & Storage</h2>
                    <p>Manage your data usage and storage preferences</p>
                </div>

                <div class="settings-cards">
                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <div class="card-title">
                                <h3>Storage Usage</h3>
                                <p>See how much space S App is using</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="storage-overview">
                                <div class="storage-total">
                                    <h4>Total Usage: 2.4 GB</h4>
                                    <div class="storage-bar">
                                        <div class="storage-used" style="width: 60%;"></div>
                                    </div>
                                </div>
                                <div class="storage-breakdown">
                                    <div class="storage-item">
                                        <div class="storage-icon media"></div>
                                        <span class="storage-label">Media Files</span>
                                        <span class="storage-size">1.8 GB</span>
                                    </div>
                                    <div class="storage-item">
                                        <div class="storage-icon cache"></div>
                                        <span class="storage-label">Cache</span>
                                        <span class="storage-size">450 MB</span>
                                    </div>
                                    <div class="storage-item">
                                        <div class="storage-icon data"></div>
                                        <span class="storage-label">App Data</span>
                                        <span class="storage-size">150 MB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-actions">
                            <button class="clear-cache-btn" onclick="clearCache()">Clear Cache</button>
                            <button class="manage-storage-btn">Manage Storage</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Advanced Settings -->
            <div class="settings-section" id="advanced-section">
                <div class="section-header">
                    <h2>Advanced Settings</h2>
                    <p>Advanced features and developer options</p>
                </div>

                <div class="settings-cards">
                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-code"></i>
                            </div>
                            <div class="card-title">
                                <h3>Developer Tools</h3>
                                <p>Tools for developers and power users</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="developer-setting">
                                <div class="developer-info">
                                    <h4>Enable Console Logging</h4>
                                    <p>Show debug information in browser console</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="console-logging">
                                    <label for="console-logging"></label>
                                </div>
                            </div>
                            <div class="developer-setting">
                                <div class="developer-info">
                                    <h4>Beta Features</h4>
                                    <p>Access experimental features before public release</p>
                                </div>
                                <div class="toggle-switch">
                                    <input type="checkbox" id="beta-features">
                                    <label for="beta-features"></label>
                                </div>
                            </div>
                            <div class="developer-actions">
                                <button class="developer-btn" onclick="openAPIConsole()">
                                    <i class="fas fa-terminal"></i>
                                    API Console
                                </button>
                                <button class="developer-btn" onclick="downloadLogs()">
                                    <i class="fas fa-download"></i>
                                    Download Logs
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-database"></i>
                            </div>
                            <div class="card-title">
                                <h3>Data Management</h3>
                                <p>Advanced data and privacy controls</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="data-actions">
                                <div class="data-action-item">
                                    <div class="data-action-info">
                                        <h4>Download Your Data</h4>
                                        <p>Get a copy of all your S App data</p>
                                    </div>
                                    <button class="data-action-btn" onclick="requestDataDownload()">Download</button>
                                </div>
                                <div class="data-action-item">
                                    <div class="data-action-info">
                                        <h4>Clear All Data</h4>
                                        <p>Remove all locally stored data</p>
                                    </div>
                                    <button class="data-action-btn danger" onclick="clearAllData()">Clear</button>
                                </div>
                                <div class="data-action-item">
                                    <div class="data-action-info">
                                        <h4>Reset Preferences</h4>
                                        <p>Reset all settings to default values</p>
                                    </div>
                                    <button class="data-action-btn" onclick="resetPreferences()">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-plug"></i>
                            </div>
                            <div class="card-title">
                                <h3>Integrations</h3>
                                <p>Connect with third-party services</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="integrations-list">
                                <div class="integration-item">
                                    <div class="integration-icon github">
                                        <i class="fab fa-github"></i>
                                    </div>
                                    <div class="integration-info">
                                        <h4>GitHub</h4>
                                        <p>Connected • Last sync: 2 hours ago</p>
                                    </div>
                                    <button class="integration-btn connected" onclick="toggleIntegration('github')">
                                        <i class="fas fa-unlink"></i>
                                        Disconnect
                                    </button>
                                </div>
                                <div class="integration-item">
                                    <div class="integration-icon discord">
                                        <i class="fab fa-discord"></i>
                                    </div>
                                    <div class="integration-info">
                                        <h4>Discord</h4>
                                        <p>Not connected</p>
                                    </div>
                                    <button class="integration-btn" onclick="toggleIntegration('discord')">
                                        <i class="fas fa-link"></i>
                                        Connect
                                    </button>
                                </div>
                                <div class="integration-item">
                                    <div class="integration-icon slack">
                                        <i class="fab fa-slack"></i>
                                    </div>
                                    <div class="integration-info">
                                        <h4>Slack</h4>
                                        <p>Not connected</p>
                                    </div>
                                    <button class="integration-btn" onclick="toggleIntegration('slack')">
                                        <i class="fas fa-link"></i>
                                        Connect
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- About S App -->
            <div class="settings-section" id="about-section">
                <div class="section-header">
                    <h2>About S App</h2>
                    <p>Information about the application and support resources</p>
                </div>

                <div class="settings-cards">
                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="card-title">
                                <h3>Application Information</h3>
                                <p>Version details and system information</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="app-info">
                                <div class="info-item">
                                    <span class="info-label">Version</span>
                                    <span class="info-value">2.1.0 (Build 2145)</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Release Date</span>
                                    <span class="info-value">September 24, 2025</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Platform</span>
                                    <span class="info-value">Web Application</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Last Updated</span>
                                    <span class="info-value">2 hours ago</span>
                                </div>
                            </div>
                            <div class="update-info">
                                <div class="update-status">
                                    <i class="fas fa-check-circle"></i>
                                    <span>You're running the latest version</span>
                                </div>
                                <button class="check-updates-btn" onclick="checkForUpdates()">
                                    Check for Updates
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="card-title">
                                <h3>Support & Feedback</h3>
                                <p>Get help or share your thoughts</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="support-actions">
                                <button class="support-btn" onclick="openHelpCenter()">
                                    <i class="fas fa-question-circle"></i>
                                    Help Center
                                </button>
                                <button class="support-btn" onclick="contactSupport()">
                                    <i class="fas fa-headset"></i>
                                    Contact Support
                                </button>
                                <button class="support-btn" onclick="submitFeedback()">
                                    <i class="fas fa-comment"></i>
                                    Send Feedback
                                </button>
                                <button class="support-btn" onclick="reportBug()">
                                    <i class="fas fa-bug"></i>
                                    Report Bug
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="settings-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-gavel"></i>
                            </div>
                            <div class="card-title">
                                <h3>Legal & Policies</h3>
                                <p>Terms, privacy policy, and legal information</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="legal-links">
                                <a href="#" class="legal-link">
                                    <i class="fas fa-file-contract"></i>
                                    <span>Terms of Service</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                <a href="#" class="legal-link">
                                    <i class="fas fa-shield-alt"></i>
                                    <span>Privacy Policy</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                <a href="#" class="legal-link">
                                    <i class="fas fa-cookie-bite"></i>
                                    <span>Cookie Policy</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                <a href="#" class="legal-link">
                                    <i class="fas fa-balance-scale"></i>
                                    <span>Community Guidelines</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            <div class="copyright-info">
                                <p>© 2025 S App. All rights reserved.</p>
                                <p>Made with ⚡ for superheroes everywhere</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="confirmation-modal" id="confirmationModal" style="display: none;">
    <div class="modal-backdrop" onclick="closeConfirmation()"></div>
    <div class="modal-content">
        <div class="modal-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h3 id="confirmationTitle">Confirm Action</h3>
        <p id="confirmationMessage">Are you sure you want to perform this action?</p>
        <div class="modal-actions">
            <button class="cancel-btn" onclick="closeConfirmation()">Cancel</button>
            <button class="confirm-btn" onclick="confirmAction()">Confirm</button>
        </div>
    </div>
</div>

@endsection
