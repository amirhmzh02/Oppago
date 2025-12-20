class CarouselUpload {
    constructor() {
        this.currentSlot = 1;
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        this.initialize();
    }

    initialize() {
        // Wait for DOM to be fully loaded
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setup());
        } else {
            this.setup();
        }
    }

    setup() {
        this.setupSlotButtons();
        this.setupFileUpload();
        this.loadExistingCarouselImages();
    }

    setupSlotButtons() {
        const slotButtons = document.querySelectorAll('#carousel-slot-buttons .slot-btn');
        
        slotButtons.forEach(button => {
            button.addEventListener('click', async () => {
                // Remove active class from all carousel slot buttons
                slotButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                button.classList.add('active');
                
                // Update current slot
                this.currentSlot = parseInt(button.getAttribute('data-slot'));
                document.getElementById('carousel-selected-slot').value = this.currentSlot;
                
                // Clear preview
                this.clearCarouselPreview();
                
                // Try to load existing image for this slot
                await this.loadCarouselImageForSlot(this.currentSlot);
            });
        });
    }

    setupFileUpload() {
        const fileInput = document.getElementById('carousel-file');
        const uploadArea = document.getElementById('carousel-upload-area');
        const uploadForm = document.getElementById('carousel-upload-form');

        if (!fileInput || !uploadArea) return;

        // Click on upload area to trigger file input
        uploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        // Handle file selection
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                this.previewCarouselImage(file);
                this.uploadCarouselImage(file);
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
                    this.previewCarouselImage(file);
                    this.uploadCarouselImage(file);
                } else {
                    this.showCarouselError('Please select an image file (JPEG, PNG, GIF, etc.)');
                }
            }
        });
    }

    async loadExistingCarouselImages() {
        try {
            const response = await fetch('/admin/carousel/images');
            if (!response.ok) {
                throw new Error('Failed to load images');
            }
            
            const images = await response.json();

            // Update slot buttons with status indicators
            for (let slot = 1; slot <= 5; slot++) {
                if (images[slot]) {
                    this.updateCarouselSlotStatus(slot, true);
                    
                    // If this is current slot, show the image
                    if (slot === this.currentSlot) {
                        this.showCarouselPreview(images[slot]);
                    }
                }
            }
        } catch (error) {
            console.error('Error loading carousel images:', error);
        }
    }

    async loadCarouselImageForSlot(slot) {
        try {
            const response = await fetch(`/admin/carousel/image/${slot}`);
            if (!response.ok) {
                throw new Error('Failed to load image');
            }
            
            const data = await response.json();

            if (data.exists && data.image_url) {
                this.showCarouselPreview(data.image_url);
            }
        } catch (error) {
            console.error('Error loading carousel image for slot:', error);
        }
    }

    previewCarouselImage(file) {
        const reader = new FileReader();
        const preview = document.getElementById('carousel-preview');
        const placeholder = document.getElementById('carousel-preview-placeholder');

        reader.onload = (e) => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            if (placeholder) placeholder.style.display = 'none';
        };

        reader.readAsDataURL(file);
    }

    clearCarouselPreview() {
        const preview = document.getElementById('carousel-preview');
        const placeholder = document.getElementById('carousel-preview-placeholder');

        if (preview) {
            preview.style.display = 'none';
            preview.src = '';
        }
        
        if (placeholder) {
            placeholder.style.display = 'block';
        }
    }

    showCarouselPreview(imageUrl) {
        const preview = document.getElementById('carousel-preview');
        const placeholder = document.getElementById('carousel-preview-placeholder');

        if (preview && imageUrl) {
            preview.src = imageUrl;
            preview.style.display = 'block';
            if (placeholder) placeholder.style.display = 'none';
        }
    }

    async uploadCarouselImage(file) {
        // Validate file
        const maxSize = 5 * 1024 * 1024; // 5MB
        if (file.size > maxSize) {
            this.showCarouselError('File size too large. Maximum size is 5MB.');
            return;
        }

        // Show progress
        this.showCarouselProgress();

        // Create form data
        const formData = new FormData();
        formData.append('slot', this.currentSlot);
        formData.append('image', file);
        formData.append('_token', this.csrfToken);

        try {
            const response = await fetch('/admin/carousel/upload', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (response.ok && result.success) {
                // Update preview with new image URL
                this.showCarouselPreview(result.image_url);

                // Update slot button status
                this.updateCarouselSlotStatus(this.currentSlot, true);

                // Show success message
                this.showCarouselSuccess(result.message || 'Image uploaded successfully!');
            } else {
                this.showCarouselError(result.message || 'Upload failed');
            }
        } catch (error) {
            console.error('Carousel upload error:', error);
            this.showCarouselError('Network error. Please try again.');
        } finally {
            this.hideCarouselProgress();
        }
    }

    updateCarouselSlotStatus(slot, hasImage) {
        const slotBtn = document.getElementById(`carousel-slot-btn-${slot}`);
        if (slotBtn) {
            if (hasImage) {
                // Add or update status indicator
                let statusSpan = slotBtn.querySelector('.slot-status');
                if (!statusSpan) {
                    statusSpan = document.createElement('span');
                    statusSpan.className = 'slot-status';
                    statusSpan.textContent = '✓';
                    slotBtn.appendChild(statusSpan);
                }
            } else {
                // Remove status indicator
                const statusSpan = slotBtn.querySelector('.slot-status');
                if (statusSpan) {
                    statusSpan.remove();
                }
            }
        }
    }

    showCarouselProgress() {
        const progressElement = document.getElementById('carousel-upload-progress');
        if (progressElement) {
            progressElement.style.display = 'block';
        }
    }

    hideCarouselProgress() {
        const progressElement = document.getElementById('carousel-upload-progress');
        if (progressElement) {
            progressElement.style.display = 'none';
        }
    }

    showCarouselSuccess(message) {
        this.showCarouselAlert(message, 'success');
    }

    showCarouselError(message) {
        this.showCarouselAlert(message, 'error');
    }

    showCarouselAlert(message, type) {
        const alertsContainer = document.getElementById('carousel-alerts');
        if (!alertsContainer) return;

        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type}`;
        alertDiv.textContent = message;
        alertDiv.style.display = 'block';

        alertsContainer.appendChild(alertDiv);

        // Remove after 3 seconds for success, 5 seconds for error
        const duration = type === 'success' ? 3000 : 5000;
        setTimeout(() => {
            alertDiv.style.display = 'none';
            setTimeout(() => {
                if (alertDiv.parentNode === alertsContainer) {
                    alertsContainer.removeChild(alertDiv);
                }
            }, 500);
        }, duration);
    }
}

// Initialize carousel upload when the page loads
document.addEventListener('DOMContentLoaded', () => {
    // Only initialize if we're on the carousel tab
    const carouselTab = document.getElementById('carousel-tab');
    if (carouselTab) {
        window.carouselUpload = new CarouselUpload();
    }
});