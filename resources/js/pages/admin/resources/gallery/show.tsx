import { Head, usePage } from '@inertiajs/react';
import { useState } from 'react';
import AppLayout from '@/layouts/admin/app-layout';
import type { BreadcrumbItem } from '@/types';

import { FullscreenModal } from './components/FullscreenModal';
import { GalleryHeader } from './components/GalleryHeader';
import { ImageCard } from './components/ImageCard';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Gallery',
        href: '/admin/gallery',
    },
    {
        title: 'View',
        href: '/dashboard',
    },
];

interface GalleryShowPageProps {
    data: {
        id: number;
        title: string;
        media?: Array<{
            id: number;
            name: string;
            original_url: string;
            size: number;
            mime_type: string;
            generated_conversions?: Record<string, boolean>;
        }>;
    };
}

export default function Show() {
    const { data } = usePage<GalleryShowPageProps>().props;
    const item = data;
    const [copiedUrl, setCopiedUrl] = useState<string | null>(null);
    const [fullscreenImage, setFullscreenImage] = useState<string | null>(null);

    const handleCopy = (url: string) => {
        navigator.clipboard.writeText(url);
        setCopiedUrl(url);
        setTimeout(() => setCopiedUrl(null), 2000);
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Gallery - ${item.title}`} />

            <div className="overflow-hidden rounded-lg bg-white shadow-md">
                <GalleryHeader item={item} />

                {/* Images Gallery */}
                <div className="p-6">
                    <h2 className="mb-4 text-xl font-semibold text-gray-800">
                        Images ({item.media?.length || 0})
                    </h2>

                    {item.media && item.media.length > 0 ? (
                        <div className="space-y-8">
                            {item.media.map((media: GalleryShowPageProps['data']['media'][0]) => (
                                <ImageCard
                                    key={media.id}
                                    media={media}
                                    onFullscreen={setFullscreenImage}
                                    copiedUrl={copiedUrl}
                                    onCopy={handleCopy}
                                />
                            ))}
                        </div>
                    ) : (
                        <div className="py-12 text-center text-gray-400">
                            No images found
                        </div>
                    )}
                </div>
            </div>

            <FullscreenModal
                image={fullscreenImage}
                onClose={() => setFullscreenImage(null)}
            />
        </AppLayout>
    );
}

