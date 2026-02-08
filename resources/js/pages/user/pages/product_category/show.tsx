
import { usePage } from "@inertiajs/react";
import AppLayout from "@/layouts/user/app-layout";
import ProductDescription from "../product/components/product-description";
import ProductSection from "../product/components/product_box";

export default function ProductCategoryShow() {
  const data = usePage().props.data as any;
  // data: { id, title, description, icon, image, products: [] }
  const category = data;
  const products = data.products || [];

  return (
    <AppLayout title={category.title}>
      <div className="min-h-screen bg-linear-to-br from-slate-50 via-white to-slate-50">
        {/* Banner */}
        <section className="relative h-72 md:h-80 w-full overflow-hidden mb-8 flex items-center justify-center">
          <div
            className="absolute inset-0 bg-cover bg-center scale-105"
            style={{ backgroundImage: `url('${category.image || "/images/products-banner.jpg"}')` }}
          />
          <div className="absolute inset-0 bg-linear-to-br from-primary/90 via-secondary/80 to-primary/70" />
          <div className="absolute inset-0 backdrop-blur-[2px]" />
          <div className="relative z-10 flex h-full items-center justify-center px-4">
            <div className="flex flex-row items-center justify-center w-full max-w-5xl gap-8">
              {/* Icon left */}
              {category.icon && (
                <div className="hidden md:flex items-center justify-center h-32 w-32 rounded-2xl bg-white/80 shadow-lg overflow-hidden">
                  <img
                    src={category.icon}
                    alt={category.title}
                    className="object-contain"
                  />
                </div>
              )}
              {/* Title & Description right */}
              <div className="flex-1 text-left space-y-4">
                <h1 className="text-3xl md:text-5xl font-black text-white tracking-tight drop-shadow-2xl">
                  {category.title}
                </h1>
                {category.description && (
                  <p className="max-w-2xl text-base text-white/95 md:text-lg font-medium leading-relaxed drop-shadow-lg">
                    {category.description}
                  </p>
                )}
              </div>
            </div>
          </div>
          <div className="absolute bottom-0 left-0 right-0 h-16 bg-linear-to-t from-slate-50/50 to-transparent"></div>
        </section>

        {/* Category Description (optional) */}
        {category.short_description && (
          <div className="mx-auto max-w-4xl px-4 mb-10">
            <ProductDescription shortDescription={category.short_description} />
          </div>
        )}

        {/* Products List */}
        <section className="mx-auto max-w-7xl px-4 py-8 md:py-12">
          <ProductSection products={products} />
        </section>
      </div>
    </AppLayout>
  );
}
