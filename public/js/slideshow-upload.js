// Load existing images from database
async function loadExistingImages() {
    try {
        const response = await fetch('/admin/slideshow/images');
        const images = await response.json();

        // Update slot buttons with status indicators
        for (let slot = 1; slot <= 5; slot++) {
            if (images[slot]) {
                const slotBtn = document.getElementById(`slot-btn-${slot}`);
                if (slotBtn) {
                    // Add or update status indicator
                    let statusSpan = slotBtn.querySelector('.slot-status');
                    if (!statusSpan) {
                        statusSpan = document.createElement('span');
                        statusSpan.className = 'slot-status';
                        statusSpan.textContent = '✓';
                        slotBtn.appendChild(statusSpan);
                    }

                    // If this is current slot, show the image
                    if (slot === currentSlot) {
                        showImagePreview(images[slot]);
                    }
                }
            }
        }
    } catch (error) {
        console.error('Error loading images:', error);
    }
}

// Setup slot button functionality
function setupSlotButtons() {
    document.querySelectorAll('.slot-btn').forEach(button => {
        button.addEventListener('click', async () => {
            // Remove active class from all buttons
            document.querySelectorAll('.slot-btn').forEach(btn => {
                btn.classList.remove('active');
            });

            // Add active class to clicked button
            button.classList.add('active');

            // Update current slot
            currentSlot = parseInt(button.getAttribute('data-slot'));
            document.getElementById('selected-slot').value = currentSlot;

            // Clear preview
            clearPreview();

            // Try to load existing image for this slot
            try {
                const response = await fetch(`/admin/slideshow/image/${currentSlot}`);
                const data = await response.json();

                if (data.exists) {
                    showImagePreview(data.image_url);
                }
            } catch (error) {
                console.error('Error loading slot image:', error);
            }
        });
    });
}

// Setup file upload functionality
function setupFileUpload() {
    const fileInput = document.getElementById('slideshow-file');
    const uploadArea = document.getElementById('slideshow-upload');
    const uploadForm = document.getElementById('slideshow-upload-form');

    // Click on upload area to trigger file input
    uploadArea.addEventListener('click', () => {
        fileInput.click();
    });

    // Handle file selection
    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            previewImage(file);
            uploadImage(file);
        }
    });

    // Drag and drop functionality
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('dragover');

        if (e.dataTransfer.files.length > 0) {
            const file = e.dataTransfer.files[0];

            // Check if it's an image
            if (file.type.startsWith('image/')) {
                previewImage(file);
                uploadImage(file);
            } else {
                showError('Please select an image file (JPEG, PNG, GIF, etc.)');
            }
        }
    });
}

// Preview image before upload
function previewImage(file) {
    const reader = new FileReader();
    const preview = document.getElementById('slideshow-preview');
    const placeholder = document.getElementById('preview-placeholder');

    reader.onload = (e) => {
        preview.src = e.target.result;
        preview.style.display = 'block';
        placeholder.style.display = 'none';
    };

    reader.readAsDataURL(file);
}

// Clear preview
function clearPreview() {
    const preview = document.getElementById('slideshow-preview');
    const placeholder = document.getElementById('preview-placeholder');

    preview.style.display = 'none';
    preview.src = '';
    placeholder.style.display = 'block';
}

// Upload image to server
async function uploadImage(file) {
    // Validate file
    const maxSize = 5 * 1024 * 1024; // 5MB
    if (file.size > maxSize) {
        showError('File size too large. Maximum size is 5MB.');
        return;
    }

    // Show progress
    showProgress();

    // Create form data
    const formData = new FormData();
    formData.append('slot', currentSlot);
    formData.append('image', file);
    formData.append('_token', csrfToken);

    try {
        const response = await fetch('/admin/slideshow/upload', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (response.ok && result.success) {
            // Update preview with new image URL
            showImagePreview(result.image_url);

            // Update slot button status
            updateSlotStatus(currentSlot);

            // Show success message
            showSuccess(result.message);
        } else {
            showError(result.message || 'Upload failed');
        }
    } catch (error) {
        console.error('Upload error:', error);
        showError('Network error. Please try again.');
    } finally {
        hideProgress();
    }
}

// Show image in preview
function showImagePreview(imageUrl) {
    const preview = document.getElementById('slideshow-preview');
    const placeholder = document.getElementById('preview-placeholder');

    preview.src = imageUrl;
    preview.style.display = 'block';
    placeholder.style.display = 'none';
}

// Update slot button status
function updateSlotStatus(slot) {
    const slotBtn = document.getElementById(`slot-btn-${slot}`);
    if (slotBtn) {
        // Add or update status indicator
        let statusSpan = slotBtn.querySelector('.slot-status');
        if (!statusSpan) {
            statusSpan = document.createElement('span');
            statusSpan.className = 'slot-status';
            statusSpan.textContent = '✓';
            slotBtn.appendChild(statusSpan);
        }
    }
}

// Show progress bar
function showProgress() {
    document.querySelector('.upload-progress').style.display = 'block';
}

// Hide progress bar
function hideProgress() {
    document.querySelector('.upload-progress').style.display = 'none';
}

// Show success message
function showSuccess(message) {
    // Create or get alert element
    let alertDiv = document.querySelector('.alert-success');
    if (!alertDiv) {
        alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-success';
        document.querySelector('.upload-panel').prepend(alertDiv);
    }

    alertDiv.textContent = message;
    alertDiv.style.display = 'block';

    // Hide after 3 seconds
    setTimeout(() => {
        alertDiv.style.display = 'none';
    }, 3000);
}

// Show error message
function showError(message) {
    // Create or get alert element
    let alertDiv = document.querySelector('.alert-error');
    if (!alertDiv) {
        alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-error';
        document.querySelector('.upload-panel').prepend(alertDiv);
    }

    alertDiv.textContent = message;
    alertDiv.style.display = 'block';

    // Hide after 5 seconds
    setTimeout(() => {
        alertDiv.style.display = 'none';
    }, 5000);
}