import { X } from 'lucide-react';

interface FullscreenModalProps {
    image: string | null;
    onClose: () => void;
}

export function FullscreenModal({ image, onClose }: FullscreenModalProps) {
    if (!image) return null;

    return (
        <div
            className="bg-opacity-90 fixed inset-0 z-50 flex items-center justify-center bg-black p-4"
            onClick={onClose}
        >
            <button
                onClick={onClose}
                className="absolute top-4 right-4 text-white transition-colors hover:text-gray-300"
            >
                <X className="h-8 w-8" />
            </button>
            <img
                src={image}
                alt="Fullscreen view"
                className="max-h-full max-w-full object-contain"
                onClick={(e) => e.stopPropagation()}
            />
        </div>
    );
}

