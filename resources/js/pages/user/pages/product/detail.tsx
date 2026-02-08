import { usePage } from '@inertiajs/react';
import { useState } from 'react';
import AppLayout from '@/layouts/user/app-layout';
import ImageSlider from './components/image-slider';
import ProductCTA from './components/product-cta';
import ProductDescription from './components/product-description';
import ProductEnquiryModal from './components/product-enquiry-modal';
import ProductFeatures from './components/product-features';
import ProductPricing from './components/product-pricing';
import ProductSections from './components/product-sections';

export default function ProductDetail() {
    const { data: product } = usePage().props as any;
    const [isModalOpen, setIsModalOpen] = useState(false);
    console.log(product);
    if (!product) {
        return (
            <AppLayout title="Product Not Found">
                <div className="flex min-h-[400px] items-center justify-center">
                    <p className="text-lg text-muted-foreground">Product not found</p>
                </div>
            </AppLayout>
        );
    }

    const hasPrice = product.price && product.price > 0;
    const displayImages =
        product.images && product.images.length > 0
            ? product.images
            : product.display_img
              ? [
                    {
                        id: 0,
                        url: product.display_img,
                        thumbnail: product.display_img,
                        name: product.title,
                        file_name: '',
                        size: 0,
                        mime_type: '',
                    },
                ]
              : [];

    return (
        <AppLayout title={product.title}>
            <div className="bg-background text-foreground">
                <div className="mx-auto max-w-7xl px-4 py-12 lg:py-16">
                    {/* Upper Section: Images and Price */}
                    <div className="mb-12 grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-12">
                        {/* Image Slider */}
                        <div>
                            {displayImages.length > 0 && (
                                <ImageSlider
                                    images={displayImages}
                                    productTitle={product.title}
                                />
                            )}
                        </div>

                        {/* Price and Features Sidebar */}
                        <aside className="flex flex-col space-y-6">
                            {/* Product Title */}
                            <div>
                                <h1 className="text-3xl font-bold text-foreground lg:text-4xl">
                                    {product.title}
                                </h1>
                                {product.category && (
                                    <p className="mt-2 text-sm text-muted-foreground">
                                        Category: {product.category.title}
                                    </p>
                                )}
                            </div>

                            {hasPrice ? (
                                <ProductPricing
                                    price={product.price}
                                    mrp={product.mrp}
                                    currency={product.currency}
                                />
                            ) : (
                                <ProductCTA onClick={() => setIsModalOpen(true)} />
                            )}

                            {product.features &&
                                product.features.length > 0 && (
                                    <ProductFeatures
                                        features={product.features}
                                    />
                                )}

                            <div className="sticky bottom-4 mt-auto">
                                <ProductCTA onClick={() => setIsModalOpen(true)} />
                            </div>
                        </aside>
                    </div>

                    {/* Lower Section: Full Width Details */}
                    <div className="space-y-8">
                        <ProductDescription
                            shortDescription={product.short_description}
                        />

                        <ProductSections
                            description={product.description}
                            longDescription2={product.long_description2}
                            longDescription3={product.long_description3}
                        />
                    </div>
                </div>
            </div>

            {/* Enquiry Modal */}
            <ProductEnquiryModal
                isOpen={isModalOpen}
                onClose={() => setIsModalOpen(false)}
                productId={product.id}
                productTitle={product.title}
            />
        </AppLayout>
    );
}
