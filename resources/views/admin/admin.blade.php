<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OppaGo Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;800&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>

    </style>
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <h1>OppaGo</h1>
            <p>Chicken Wings & Topside</p>
        </div>
        <ul class="nav-list">
            <li class="nav-item">
                <a href="#" class="nav-link active" id="nav-images">
                    <i class="fas fa-images"></i>
                    <span>Manage Image</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" id="nav-menu">
                    <i class="fas fa-utensils"></i>
                    <span>Manage Menu</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h2 id="page-title">Manage Images</h2>
            <div class="user-info">
                <div class="user-avatar">AJ</div>
                <span>Admin User</span>
            </div>
        </div>

        <!-- Tab Panel -->
        <div class="tab-panel">
            <div class="tab-header">
                <button class="tab-btn active" data-tab="slideshow">Slide Show</button>
                <button class="tab-btn" data-tab="carousel">Carousel</button>
                <button class="tab-btn" data-tab="menu">Menu</button>
            </div>

            <!-- Slide Show Tab -->
            <div class="tab-content active" id="slideshow-tab">
                <div class="tab-layout">
                    <div class="slot-panel">
                        <h3 class="panel-title">Choose Slot</h3>
                        <div class="slot-buttons">
                            @for($i = 1; $i <= 5; $i++)
                                <button class="slot-btn {{ $i == 1 ? 'active' : '' }}" data-slot="{{ $i }}"
                                    id="slot-btn-{{ $i }}">
                                    Slot {{ $i }}
                                    @if(isset($slideshowImages[$i]))
                                        <span class="slot-status">✓</span>
                                    @endif
                                </button>
                            @endfor
                        </div>
                    </div>
                    <div class="upload-panel">
                        <h3 class="panel-title">Slide Show Image</h3>

                        <!-- Display current image for selected slot -->
                        <div class="image-preview">
                            <div class="preview-placeholder" id="preview-placeholder">
                                <i class="fas fa-image"></i>
                                <p>No image selected</p>
                            </div>
                            <img src="" alt="Preview" class="preview-image" id="slideshow-preview">
                        </div>

                        <!-- Upload Form -->
                        <form id="slideshow-upload-form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="selected-slot" name="slot" value="1">

                            <div class="upload-area" id="slideshow-upload">
                                <div class="upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <p class="upload-text">Upload image</p>
                                <p class="upload-subtext">or</p>
                                <p class="upload-subtext">Drop a file here</p>
                                <input type="file" class="file-input" id="slideshow-file" accept="image/*" name="image">
                                <label for="slideshow-file" class="choose-btn">Choose Image</label>
                            </div>
                        </form>

                        <!-- Upload Progress -->
                        <div class="upload-progress" style="display: none; margin-top: 20px;">
                            <div class="progress-bar"
                                style="width: 100%; height: 10px; background: #353535; border-radius: 5px;">
                                <div class="progress-fill"
                                    style="width: 0%; height: 100%; background: #F8BD13; border-radius: 5px; transition: width 0.3s;">
                                </div>
                            </div>
                            <p class="progress-text" style="text-align: center; margin-top: 10px; color: #D9D9D9;">
                                Uploading...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carousel Tab -->
            <div class="tab-content" id="carousel-tab">
                <div class="tab-layout">
                    <div class="slot-panel">
                        <h3 class="panel-title">Choose Slot</h3>
                        <div class="slot-buttons" id="carousel-slot-buttons">
                            @for($i = 1; $i <= 5; $i++)
                                <button class="slot-btn {{ $i == 1 ? 'active' : '' }}" data-slot="{{ $i }}"
                                    id="carousel-slot-btn-{{ $i }}">
                                    Slot {{ $i }}
                                    @if(isset($carouselImages[$i]))
                                        <span class="slot-status">✓</span>
                                    @endif
                                </button>
                            @endfor
                        </div>
                    </div>

                    <form id="carousel-upload-form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="carousel-selected-slot" name="slot" value="1">
                        <div class="upload-panel">
                            <h3 class="panel-title">Carousel Image</h3>

                            <!-- Display current image for selected slot -->
                            <div class="image-preview">
                                <div class="preview-placeholder" id="carousel-preview-placeholder">
                                    <i class="fas fa-image"></i>
                                    <p>No image selected</p>
                                </div>
                                <img src="" alt="Preview" class="preview-image" id="carousel-preview">
                            </div>

                            <!-- Upload Area -->
                            <div class="upload-area" id="carousel-upload-area">
                                <div class="upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <p class="upload-text">Upload image</p>
                                <p class="upload-subtext">or</p>
                                <p class="upload-subtext">Drop a file here</p>
                                <input type="file" class="file-input" id="carousel-file" accept="image/*" name="image">
                                <label for="carousel-file" class="choose-btn">Choose Image</label>
                            </div>

                            <!-- Upload Progress -->
                            <div class="upload-progress" id="carousel-upload-progress"
                                style="display: none; margin-top: 20px;">
                                <div class="progress-bar"
                                    style="width: 100%; height: 10px; background: #353535; border-radius: 5px;">
                                    <div class="progress-fill"
                                        style="width: 0%; height: 100%; background: #F8BD13; border-radius: 5px; transition: width 0.3s;">
                                    </div>
                                </div>
                                <p class="progress-text" style="text-align: center; margin-top: 10px; color: #D9D9D9;">
                                    Uploading...</p>
                            </div>

                            <!-- Alerts container -->
                            <div id="carousel-alerts"></div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Menu Tab -->
            <div class="tab-content" id="menu-tab">
                <div class="tab-layout">
                    <div class="slot-panel">
                        <div class="category-dropdown">
                            <label class="dropdown-label">Menu Category</label>
                            <h3 class="panel-title">Choose Category</h3>
                            <select class="dropdown-select" id="menu-category">
                                <option value="">Select a category</option>
                                <option value="wings">Wings</option>
                                <option value="rabokki">Rabokki</option>
                                <option value="toppoki">Toppoki</option>
                                <option value="fries">Fries</option>
                                <option value="rice">Rice</option>
                            </select>
                        </div>
                        <h3 class="panel-title">Choose Slot</h3>
                        <div class="slot-buttons" id="menu-slot-buttons">
                            @for($i = 1; $i <= 5; $i++)
                                <button class="slot-btn {{ $i == 1 ? 'active' : '' }}" data-slot="{{ $i }}"
                                    id="menu-slot-btn-{{ $i }}">
                                    Slot {{ $i }}
                                </button>
                            @endfor
                        </div>
                    </div>

                    <!-- ADD THIS FORM WRAPPER -->
                    <form id="menu-upload-form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="menu-selected-slot" name="slot" value="1">
                        <input type="hidden" id="menu-selected-category" name="food_type" value="">

                        <div class="upload-panel">
                            <h3 class="panel-title">Menu Item Details</h3>

                            <!-- Alerts container -->
                            <div id="menu-alerts"></div>

                            <!-- Loading indicator -->
                            <div id="menu-loading" style="display: none; text-align: center; padding: 20px;">
                                <div style="color: #F8BD13;">Loading...</div>
                            </div>

                            <!-- Menu Form -->
                            <div id="menu-form-content">
                                <div class="form-group">
                                    <label for="menu-name">Item Name *</label>
                                    <input type="text" id="menu-name" class="form-control" placeholder="Enter item name"
                                        name="name" required>
                                </div>

                                <div class="form-group">
                                    <label for="menu-description">Description</label>
                                    <textarea id="menu-description" class="form-control" rows="3"
                                        placeholder="Enter item description (optional)" name="description"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Item Image</label>
                                    <div class="image-preview">
                                        <div class="preview-placeholder" id="menu-preview-placeholder">
                                            <i class="fas fa-image"></i>
                                            <p>No image selected</p>
                                        </div>
                                        <img src="" alt="Preview" class="preview-image" id="menu-preview">
                                    </div>

                                    <div class="upload-area" id="menu-upload-area">
                                        <div class="upload-icon">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </div>
                                        <p class="upload-text">Upload image</p>
                                        <p class="upload-subtext">or</p>
                                        <p class="upload-subtext">Drop a file here</p>
                                        <input type="file" class="file-input" id="menu-file" accept="image/*"
                                            name="image">
                                        <label for="menu-file" class="choose-btn">Choose Image</label>
                                    </div>
                                    <p class="help-text">Recommended: Square image, max 5MB</p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button class="btn btn-cancel">Cancel</button>
                <button class="btn btn-save">Save Changes</button>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/carousel-upload.js') }}"></script>
    <script src="{{ asset('js/slideshow-upload.js') }}"></script>
    <script src="{{ asset('js/menu-upload.js') }}"></script>

    <script>


        // Global variables
        let currentSlot = 1;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function () {
            // Load existing images for all slots
            loadExistingImages();

            // Set up slot buttons
            setupSlotButtons();

            // Set up file upload
            setupFileUpload();
        });

        // Keep your existing tab switching and other functionality
        document.querySelectorAll('.tab-btn').forEach(button => {
            button.addEventListener('click', () => {
                const tabId = button.getAttribute('data-tab');

                // Update active tab button
                document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                // Show active tab content
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.remove('active');
                });
                document.getElementById(`${tabId}-tab`).classList.add('active');
            });
        });

        // Sidebar navigation
        document.getElementById('nav-images').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('page-title').textContent = 'Manage Images';
            document.getElementById('nav-images').classList.add('active');
            document.getElementById('nav-menu').classList.remove('active');
        });

        document.getElementById('nav-menu').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('page-title').textContent = 'Manage Menu';
            document.getElementById('nav-menu').classList.add('active');
            document.getElementById('nav-images').classList.remove('active');
            alert('Menu management functionality will be available soon!');
        });
    </script>

    <script>
        // Cancel button functionality
        document.querySelector('.btn-cancel').addEventListener('click', function () {
            // Check which tab is active
            const activeTab = document.querySelector('.tab-content.active');

            if (activeTab.id === 'menu-tab') {
                // If menu tab is active
                const categorySelect = document.getElementById('menu-category');
                if (categorySelect && categorySelect.value) {
                    // Reload current menu item
                    if (window.menuUpload) {
                        const currentSlot = window.menuUpload.currentSlot;
                        const currentFoodType = window.menuUpload.currentFoodType;

                        if (currentFoodType && currentSlot) {
                            window.menuUpload.showLoading(true);
                            window.menuUpload.loadMenuItem(currentFoodType, currentSlot).then(() => {
                                window.menuUpload.showLoading(false);
                            });
                        }
                    }
                } else {
                    // Clear form if no category selected
                    if (window.menuUpload) {
                        window.menuUpload.clearForm();
                    }
                }
            }
            // Add similar functionality for other tabs if needed
        });
    </script>
</body>

</html>