// Menu Upload functionality - Similar to Slideshow
class MenuUpload {
    constructor() {
        this.currentSlot = 1;
        this.currentFoodType = '';
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        this.initialize();
    }

    initialize() {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setup());
        } else {
            this.setup();
        }
    }

    setup() {
        this.setupCategoryDropdown();
        this.setupSlotButtons();
        this.setupFileUpload();
        this.setupSaveButton();
    }

    setupCategoryDropdown() {
        const categorySelect = document.getElementById('menu-category');
        const categoryHidden = document.getElementById('menu-selected-category');
        
        categorySelect.addEventListener('change', async (e) => {
            this.currentFoodType = e.target.value;
            categoryHidden.value = this.currentFoodType;
            
            if (this.currentFoodType) {
                // Load menu items for this category
                await this.loadMenuItemsForCategory(this.currentFoodType);
            } else {
                this.clearForm();
            }
        });
    }

    setupSlotButtons() {
        const slotButtons = document.querySelectorAll('#menu-slot-buttons .slot-btn');
        
        slotButtons.forEach(button => {
            button.addEventListener('click', async () => {
                if (!this.currentFoodType) {
                    this.showMenuAlert('Please select a category first', 'error');
                    return;
                }
                
                // Remove active class from all menu slot buttons
                slotButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                button.classList.add('active');
                
                // Update current slot
                this.currentSlot = parseInt(button.getAttribute('data-slot'));
                document.getElementById('menu-selected-slot').value = this.currentSlot;
                
                // Clear preview
                this.clearMenuPreview();
                
                // Load menu item for this slot
                await this.loadMenuItem(this.currentFoodType, this.currentSlot);
            });
        });
    }

    setupFileUpload() {
        const fileInput = document.getElementById('menu-file');
        const uploadArea = document.getElementById('menu-upload-area');

        if (!fileInput || !uploadArea) return;

        // Click on upload area to trigger file input
        uploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        // Handle file selection
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                this.previewMenuImage(file);
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
                    this.previewMenuImage(file);
                } else {
                    this.showMenuAlert('Please select an image file (JPEG, PNG, GIF, etc.)', 'error');
                }
            }
        });
    }

    setupSaveButton() {
        const saveBtn = document.querySelector('.btn-save');
        
        saveBtn.addEventListener('click', async (e) => {
            e.preventDefault();
            
            if (!this.currentFoodType) {
                this.showMenuAlert('Please select a category first', 'error');
                return;
            }
            
            const nameInput = document.getElementById('menu-name');
            const name = nameInput.value.trim();
            
            if (!name) {
                this.showMenuAlert('Item name is required', 'error');
                nameInput.focus();
                return;
            }
            
            await this.saveMenuItem();
        });
    }

    async loadMenuItemsForCategory(foodType) {
        try {
            const response = await fetch(`/admin/menu/${foodType}`);
            if (!response.ok) {
                throw new Error('Failed to load menu items');
            }
            
            const menuItems = await response.json();

            // Update slot buttons with status indicators
            for (let slot = 1; slot <= 5; slot++) {
                if (menuItems[slot]) {
                    this.updateMenuSlotStatus(slot, true);
                    
                    // If this is current slot, load the data
                    if (slot === this.currentSlot) {
                        this.loadMenuItemData(menuItems[slot]);
                    }
                } else {
                    this.updateMenuSlotStatus(slot, false);
                }
            }
        } catch (error) {
            console.error('Error loading menu items:', error);
            this.showMenuAlert('Failed to load menu items', 'error');
        }
    }

    async loadMenuItem(foodType, slot) {
        try {
            const response = await fetch(`/admin/menu/${foodType}/${slot}`);
            if (!response.ok) {
                throw new Error('Failed to load menu item');
            }
            
            const data = await response.json();

            if (data.exists && data.item) {
                this.loadMenuItemData(data.item);
                this.updateMenuSlotStatus(slot, true);
            } else {
                this.clearForm();
                this.updateMenuSlotStatus(slot, false);
            }
        } catch (error) {
            console.error('Error loading menu item:', error);
            this.showMenuAlert('Failed to load menu item', 'error');
        }
    }

    loadMenuItemData(item) {
        // Set form values
        document.getElementById('menu-name').value = item.name || '';
        document.getElementById('menu-description').value = item.description || '';
        
        // Show image if exists
        if (item.image_url) {
            this.showMenuPreview(item.image_url);
        } else {
            this.clearMenuPreview();
        }
    }

    async saveMenuItem() {
        const form = document.getElementById('menu-upload-form');
        const formData = new FormData(form);
        
        // Get the file input
        const fileInput = document.getElementById('menu-file');
        
        // Validate file size if image is provided
        if (fileInput.files[0]) {
            const maxSize = 5 * 1024 * 1024; // 5MB
            if (fileInput.files[0].size > maxSize) {
                this.showMenuAlert('File size too large. Maximum size is 5MB.', 'error');
                return;
            }
        }

        // Show loading
        this.showLoading(true);

        try {
            const response = await fetch('/admin/menu/upload', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (response.ok && result.success) {
                // Update slot button status
                this.updateMenuSlotStatus(this.currentSlot, true);
                
                // Update preview with new image URL if provided
                if (result.item && result.item.image_url) {
                    this.showMenuPreview(result.item.image_url);
                }
                
                // Clear file input
                fileInput.value = '';
                
                // Show success message
                this.showMenuAlert(result.message || 'Menu item saved successfully!', 'success');
            } else {
                this.showMenuAlert(result.message || 'Save failed', 'error');
            }
        } catch (error) {
            console.error('Menu save error:', error);
            this.showMenuAlert('Network error. Please try again.', 'error');
        } finally {
            this.showLoading(false);
        }
    }

    previewMenuImage(file) {
        const reader = new FileReader();
        const preview = document.getElementById('menu-preview');
        const placeholder = document.getElementById('menu-preview-placeholder');

        reader.onload = (e) => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            if (placeholder) placeholder.style.display = 'none';
        };

        reader.readAsDataURL(file);
    }

    clearMenuPreview() {
        const preview = document.getElementById('menu-preview');
        const placeholder = document.getElementById('menu-preview-placeholder');

        if (preview) {
            preview.style.display = 'none';
            preview.src = '';
        }
        
        if (placeholder) {
            placeholder.style.display = 'block';
        }
    }

    showMenuPreview(imageUrl) {
        const preview = document.getElementById('menu-preview');
        const placeholder = document.getElementById('menu-preview-placeholder');

        if (preview && imageUrl) {
            preview.src = imageUrl;
            preview.style.display = 'block';
            if (placeholder) placeholder.style.display = 'none';
        }
    }

    clearForm() {
        document.getElementById('menu-name').value = '';
        document.getElementById('menu-description').value = '';
        document.getElementById('menu-file').value = '';
        this.clearMenuPreview();
    }

    updateMenuSlotStatus(slot, hasItem) {
        const slotBtn = document.getElementById(`menu-slot-btn-${slot}`);
        if (slotBtn) {
            if (hasItem) {
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

    showLoading(show) {
        const loadingElement = document.getElementById('menu-loading');
        if (loadingElement) {
            loadingElement.style.display = show ? 'block' : 'none';
        }
    }

    showMenuAlert(message, type) {
        const alertsContainer = document.getElementById('menu-alerts');
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

// Initialize menu upload when the page loads
document.addEventListener('DOMContentLoaded', () => {
    // Only initialize if we're on the menu tab
    const menuTab = document.getElementById('menu-tab');
    if (menuTab) {
        window.menuUpload = new MenuUpload();
    }
});