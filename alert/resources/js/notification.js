/* Alert Notification Plugin JavaScript */
class AlertNotificationManager {
    constructor(config) {
        this.config = config;
        this.initializeExistingToasts();
    }

    initializeExistingToasts() {
        // Load from server (PHP injected JSON)
        if (window.ServerNotifications && Array.isArray(window.ServerNotifications)) {
            window.ServerNotifications.forEach((notif, i) => {
                setTimeout(() => {
                    this.showAlert(notif.type, notif.message, notif.title);
                }, i * 150);
            });
            window.ServerNotifications = []; // clear after rendering
        }
    }

    dismissToast(toast) {
        toast.classList.remove('show');
        setTimeout(() => {
            if (toast.parentNode) {
                toast.remove();
            }
        }, 300);
    }

    showAlert(type, message, title = null) {
        const container = this.getOrCreateContainer();
        const toast = this.createToast(type, message, title);
        container.appendChild(toast);
        this.initializeToast(toast);
    }

    getOrCreateContainer() {
        let container = document.querySelector('.toast-container');
        if (!container) {
            container = document.createElement('div');
            container.className = 'toast-container';
            document.body.appendChild(container);
        }
        return container;
    }

    createToast(type, message, title = null) {
        const toast = document.createElement('div');
        toast.className = `custom-toast toast-${type}`;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');

        const icon = this.config.icons[type] || this.config.icons.info;
        const toastTitle = title || type.charAt(0).toUpperCase() + type.slice(1);

        toast.innerHTML = `
            <div class="toast-header">
                <div class="toast-icon-wrapper">${icon}</div>
                <strong class="toast-title">${toastTitle}</strong>
                <small class="toast-time">Just now</small>
                <button type="button" class="toast-close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">${message}</div>
            ${this.config.enable_progress_bar ? '<div class="toast-progress"></div>' : ''}
        `;

        return toast;
    }
    initializeToast(toast) {
        setTimeout(() => {
            toast.classList.add('show');
    
            // Start progress bar animation if enabled
            if (this.config.enable_progress_bar) {
                const progress = toast.querySelector('.toast-progress');
                if (progress) {
                    progress.style.transition = `transform ${this.config.animation.dismiss_timeout}ms linear`;
                    progress.style.transform = 'scaleX(0)';
                }
            }
        }, 100);
    
        if (this.config.animation.auto_dismiss) {
            let dismissTimeout = setTimeout(() => {
                this.dismissToast(toast);
            }, this.config.animation.dismiss_timeout);
    
            toast.addEventListener('mouseenter', () => {
                clearTimeout(dismissTimeout);
    
                // Pause progress bar
                const progress = toast.querySelector('.toast-progress');
                if (progress) {
                    const computedStyle = window.getComputedStyle(progress);
                    const matrix = new DOMMatrix(computedStyle.transform);
                    const scaleX = matrix.a; // current progress
                    progress.style.transition = "none";
                    progress.style.transform = `scaleX(${scaleX})`;
                }
            });
    
            toast.addEventListener('mouseleave', () => {
                // Resume progress bar
                const progress = toast.querySelector('.toast-progress');
                if (progress) {
                    progress.style.transition = `transform 1000ms linear`;
                    progress.style.transform = 'scaleX(0)';
                }
    
                dismissTimeout = setTimeout(() => {
                    this.dismissToast(toast);
                }, 1000);
            });
        }
    
        const closeBtn = toast.querySelector('.toast-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => this.dismissToast(toast));
        }
    }
    
}

// Global functions for easy access
window.showAlert = function(type, message, title = null) {
    if (window.alertNotificationManager) {
        window.alertNotificationManager.showAlert(type, message, title);
    }
};
let alert = window.alertNotificationManager = new AlertNotificationManager(window.AlertNotificationConfig);
function notify(type, message, title) {
    alert.showAlert(type, message, title);
}



