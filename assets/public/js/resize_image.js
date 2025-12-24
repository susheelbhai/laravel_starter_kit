/**
         * Resize an image to the specified dimensions and return it as a Blob.
         * @param {File} imageFile - The original image file (e.g., from an input[type="file"] element).
         * @param {number} width - The desired width of the resized image.
         * @param {number} height - The desired height of the resized image.
         * @param {string} mimeType - The MIME type of the output image (e.g., 'image/jpeg', 'image/png').
         * @param {number} quality - The quality of the output image (0 to 1, applicable for 'image/jpeg' or 'image/webp').
         * @returns {Promise<Blob>} A promise that resolves with the resized image as a Blob.
         */
function resizeImageToBlob(imageFile, width, height, mimeType = 'image/jpeg', quality = 0.9) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();

            // Load the image file as a data URL
            reader.onload = (event) => {
                const img = new Image();

                img.onload = () => {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');

                    // Set canvas dimensions to target size
                    canvas.width = width;
                    canvas.height = height;

                    // Draw the image onto the canvas with resizing
                    ctx.drawImage(img, 0, 0, width, height);

                    // Convert canvas content to Blob
                    canvas.toBlob((blob) => {
                        if (blob) {
                            resolve(blob);
                        } else {
                            reject(new Error('Canvas conversion to Blob failed.'));
                        }
                    }, mimeType, quality);
                };

                img.onerror = () => reject(new Error('Failed to load image.'));
                img.src = event.target.result;
            };

            reader.onerror = () => reject(new Error('Failed to read image file.'));
            reader.readAsDataURL(imageFile);
        });
    }