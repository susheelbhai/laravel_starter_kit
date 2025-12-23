import { Link } from '@inertiajs/react';
import { ChevronRight, Tag } from 'lucide-react';

interface ProductBannerProps {
    title: string;
    displayImage: string;
    category?: {
        id: number;
        name: string;
        slug: string;
    };
}

export default function ProductBanner({
    title,
    displayImage,
    category,
}: ProductBannerProps) {
    return (
        <div className="relative h-96 w-full overflow-hidden bg-muted md:h-[500px]">
            {/* Background Image with Overlay */}
            <div
                className="absolute inset-0 bg-cover bg-center"
                style={{ backgroundImage: `url('${displayImage}')` }}
            >
                <div className="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-transparent" />
            </div>

            {/* Content */}
            <div className="relative flex h-full items-center">
                <div className="mx-auto w-full max-w-7xl px-4 py-12 lg:py-16">
                    <div className="max-w-3xl space-y-6">
                        {/* Breadcrumb */}
                        {category && (
                            <nav className="flex items-center gap-2 text-sm text-white/90">
                                <Link
                                    href="/products"
                                    className="transition-colors hover:text-white"
                                >
                                    Products
                                </Link>
                                <ChevronRight className="h-4 w-4" />
                                <Link
                                    href={`/products?category=${category.slug}`}
                                    className="flex items-center gap-1.5 transition-colors hover:text-white"
                                >
                                    <Tag className="h-3.5 w-3.5" />
                                    {category.name}
                                </Link>
                            </nav>
                        )}

                        {/* Title */}
                        <h1 className="text-4xl font-bold leading-tight text-white drop-shadow-2xl md:text-6xl lg:text-7xl">
                            {title}
                        </h1>

                        {/* Decorative Line */}
                        <div className="h-1.5 w-24 rounded-full bg-gradient-to-r from-accent to-accent/50" />
                    </div>
                </div>
            </div>

            {/* Bottom Fade Effect */}
            <div className="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-background to-transparent" />
        </div>
    );
}
