import { ChevronLeft, ChevronRight } from 'lucide-react';
import { useState } from 'react';

interface ProductImage {
    id: number;
    url: string;
    thumbnail: string;
    name: string;
    file_name: string;
    size: number;
    mime_type: string;
}

interface ImageSliderProps {
    images: ProductImage[];
    productTitle: string;
}

export default function ImageSlider({ images, productTitle }: ImageSliderProps) {
    const [currentImageIndex, setCurrentImageIndex] = useState(0);
    const [isDragging, setIsDragging] = useState(false);
    const [startX, setStartX] = useState(0);
    const [dragOffset, setDragOffset] = useState(0);

    if (!images || images.length === 0) {
        return null;
    }

    const nextImage = () => {
        setCurrentImageIndex((prev) =>
            prev === images.length - 1 ? 0 : prev + 1,
        );
    };

    const prevImage = () => {
        setCurrentImageIndex((prev) =>
            prev === 0 ? images.length - 1 : prev - 1,
        );
    };

    const goToImage = (index: number) => {
        setCurrentImageIndex(index);
    };

    const handleDragStart = (e: React.MouseEvent | React.TouchEvent) => {
        e.preventDefault();
        setIsDragging(true);
        const clientX = 'touches' in e ? e.touches[0].clientX : e.clientX;
        setStartX(clientX);
        setDragOffset(0);
    };

    const handleDragMove = (e: React.MouseEvent | React.TouchEvent) => {
        if (!isDragging) return;
        e.preventDefault();
        const clientX = 'touches' in e ? e.touches[0].clientX : e.clientX;
        setDragOffset(clientX - startX);
    };

    const handleDragEnd = () => {
        if (!isDragging) return;
        setIsDragging(false);
        
        const threshold = 50;

        if (dragOffset < -threshold) {
            nextImage();
        } else if (dragOffset > threshold) {
            prevImage();
        }
        
        setDragOffset(0);
    };

    return (
        <div className="flex gap-4">
            {/* Thumbnail Navigation */}
            {images.length > 1 && (
                <div className="flex flex-col gap-2 overflow-y-auto">
                    {images.map((image, index) => (
                        <button
                            key={index}
                            onClick={() => goToImage(index)}
                            className={`relative flex-shrink-0 overflow-hidden rounded-lg transition-all ${
                                index === currentImageIndex
                                    ? 'ring-2 ring-primary ring-offset-2'
                                    : 'opacity-60 hover:opacity-100'
                            }`}
                            aria-label={`Go to image ${index + 1}`}
                            type="button"
                        >
                            <img
                                src={image.thumbnail || image.url}
                                alt={`${productTitle} thumbnail ${index + 1}`}
                                className="h-20 w-20 object-cover"
                                loading="lazy"
                            />
                        </button>
                    ))}
                </div>
            )}

            {/* Carousel Container */}
            <div 
                className="relative flex-1 overflow-hidden rounded-xl shadow-lg cursor-grab active:cursor-grabbing select-none aspect-square"
                onMouseDown={handleDragStart}
                onMouseMove={handleDragMove}
                onMouseUp={handleDragEnd}
                onMouseLeave={handleDragEnd}
                onTouchStart={handleDragStart}
                onTouchMove={handleDragMove}
                onTouchEnd={handleDragEnd}
            >
                {/* Images Slider */}
                <div
                    className={`flex h-full ${isDragging ? '' : 'transition-transform duration-500 ease-out'}`}
                    style={{
                        transform: `translateX(calc(-${currentImageIndex * 100}% + ${dragOffset}px))`,
                    }}
                >
                    {images.map((image, index) => (
                        <div
                            key={image.id}
                            className="w-full h-full flex-shrink-0 flex items-center justify-center bg-muted"
                        >
                            <img
                                src={image.url}
                                alt={`${productTitle} - Image ${index + 1}`}
                                className="w-full h-full object-contain pointer-events-none"
                                loading={index === 0 ? 'eager' : 'lazy'}
                                draggable="false"
                            />
                        </div>
                    ))}
                </div>

                {/* Navigation Arrows */}
                {images.length > 1 && (
                    <>
                        <button
                            onClick={prevImage}
                            className="absolute left-2 top-1/2 -translate-y-1/2 rounded-full bg-black/50 p-2 text-white transition-all hover:bg-black/70 focus:outline-none focus:ring-2 focus:ring-white"
                            aria-label="Previous image"
                            type="button"
                        >
                            <ChevronLeft className="h-6 w-6" />
                        </button>
                        <button
                            onClick={nextImage}
                            className="absolute right-2 top-1/2 -translate-y-1/2 rounded-full bg-black/50 p-2 text-white transition-all hover:bg-black/70 focus:outline-none focus:ring-2 focus:ring-white"
                            aria-label="Next image"
                            type="button"
                        >
                            <ChevronRight className="h-6 w-6" />
                        </button>
                    </>
                )}

                {/* Image Counter */}
                {images.length > 1 && (
                    <div className="absolute bottom-4 right-4 rounded-full bg-black/60 px-3 py-1 text-sm text-white">
                        {currentImageIndex + 1} / {images.length}
                    </div>
                )}
            </div>
        </div>
    );
}
