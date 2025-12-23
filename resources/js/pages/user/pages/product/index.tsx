import AppLayout from "@/layouts/user/app-layout";
import { Link, usePage } from "@inertiajs/react";

export default function Products() {
  const product_categories = usePage().props.categories as any;
  const data = usePage().props.data as any; // 👉 products list

  const hasCategories = Array.isArray(product_categories) && product_categories.length > 0;
  const hasProducts = Array.isArray(data) && data.length > 0;

  return (
    <AppLayout title="Products">
      <div className="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-50">
        {/* Banner */}
        <section className="relative h-80 md:h-96 w-full overflow-hidden">
          <div
            className="absolute inset-0 bg-cover bg-center scale-105"
            style={{ backgroundImage: "url('/images/products-banner.jpg')" }}
          />
          <div className="absolute inset-0 bg-gradient-to-br from-[#FAB915]/90 via-orange-600/80 to-purple-900/90" />
          <div className="absolute inset-0 backdrop-blur-[2px]" />
          <div className="relative z-10 flex h-full items-center justify-center px-4">
            <div className="text-center space-y-6 max-w-4xl">
              <div className="inline-flex items-center gap-2 rounded-full bg-white/20 backdrop-blur-sm px-5 py-2 text-xs font-bold uppercase tracking-widest text-white border border-white/30">
                <span className="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                What We Offer
              </div>

              <h1 className="text-4xl font-black text-white sm:text-5xl md:text-6xl tracking-tight drop-shadow-2xl">
                Our Products
              </h1>

              <p className="mx-auto max-w-2xl text-base text-white/95 md:text-lg font-medium leading-relaxed drop-shadow-lg">
                Discover premium solutions crafted to elevate your business and drive success
              </p>
            </div>
          </div>
          
          {/* Decorative elements */}
          <div className="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-slate-50/50 to-transparent"></div>
        </section>

        {/* Main Content */}
        <section className="mx-auto max-w-7xl px-4 py-14 md:py-16 space-y-16">
          {/* ---------- CATEGORIES ---------- */}
          <div>
            <div className="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
              <div>
                <h2 className="text-2xl md:text-3xl font-semibold text-slate-900">
                  Product Categories
                </h2>
                <p className="mt-2 max-w-2xl text-sm md:text-base text-slate-600">
                  Browse by category to quickly find the type of solution you’re looking for.
                </p>
              </div>

              {hasCategories && (
                <p className="text-xs font-medium uppercase tracking-wide text-slate-500">
                  {product_categories.length} categor
                  {product_categories.length > 1 ? "ies" : "y"}
                </p>
              )}
            </div>

            {!hasCategories ? (
              <div className="rounded-3xl border-2 border-dashed border-slate-200 bg-gradient-to-br from-white to-slate-50 px-8 py-16 text-center shadow-sm">
                <div className="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-100 flex items-center justify-center">
                  <span className="text-3xl">📦</span>
                </div>
                <p className="text-lg font-semibold text-slate-700 mb-2">
                  No categories available yet
                </p>
                <p className="text-sm text-slate-500 max-w-md mx-auto">
                  We're working on adding new categories. Check back soon!
                </p>
              </div>
            ) : (
              <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                {product_categories.map((category: any) => (
                  <Link
                    key={category.id}
                    href={route("home", category.slug)}
                    className="group block"
                  >
                    <div className="relative h-full rounded-3xl bg-gradient-to-br from-white to-slate-50 p-8 shadow-md border border-slate-200/50 transition-all duration-500 hover:-translate-y-3 hover:shadow-2xl hover:shadow-[#FAB915]/20 hover:border-[#FAB915]/30 overflow-hidden">
                      {/* Decorative gradient overlay */}
                      <div className="absolute inset-0 bg-gradient-to-br from-[#FAB915]/0 to-[#FAB915]/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                      
                      <div className="relative z-10">
                        {/* Icon */}
                        {category.icon && (
                          <div className="mb-5 inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-[#FAB915]/20 to-[#FAB915]/10 p-3 shadow-lg group-hover:shadow-xl group-hover:scale-110 transition-all duration-300">
                            <img
                              src={category.icon}
                              alt={category.title}
                              className="h-full w-full object-contain"
                              loading="lazy"
                            />
                          </div>
                        )}

                        {/* Title */}
                        <h3 className="mb-3 text-xl font-bold text-slate-900 transition-colors group-hover:text-[#FAB915]">
                          {category.title}
                        </h3>

                        {/* Description */}
                        {category.short_description && (
                          <p className="text-sm leading-relaxed text-slate-600 mb-4 line-clamp-3">
                            {category.short_description}
                          </p>
                        )}

                        {/* CTA */}
                        <div className="inline-flex items-center gap-2 text-sm font-semibold text-[#FAB915] translate-x-0 group-hover:translate-x-2 transition-transform duration-300">
                          <span>Explore</span>
                          <span className="text-lg">→</span>
                        </div>
                      </div>
                    </div>
                  </Link>
                ))}
              </div>
            )}
          </div>

          {/* ---------- PRODUCTS (data) ---------- */}
          <div className="relative">
            {/* Decorative line */}
            <div className="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-1 bg-gradient-to-r from-transparent via-[#FAB915] to-transparent rounded-full"></div>
            
            <div className="mb-10 text-center pt-10">
              <div className="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-[#FAB915]/10 to-orange-500/10 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-[#FAB915] mb-4">
                Featured
              </div>
              <h2 className="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
                All Products
              </h2>
              <p className="max-w-2xl mx-auto text-base text-slate-600 leading-relaxed">
                Discover our complete collection of premium products and solutions
              </p>
              {hasProducts && (
                <p className="mt-4 text-sm font-semibold text-slate-500">
                  {data.length} {data.length > 1 ? "Products" : "Product"} Available
                </p>
              )}
            </div>

            {!hasProducts ? (
              <div className="rounded-3xl border-2 border-dashed border-slate-200 bg-gradient-to-br from-white to-slate-50 px-8 py-16 text-center shadow-sm">
                <div className="w-16 h-16 mx-auto mb-4 rounded-full bg-slate-100 flex items-center justify-center">
                  <span className="text-3xl">🎯</span>
                </div>
                <p className="text-lg font-semibold text-slate-700 mb-2">
                  No products available yet
                </p>
                <p className="text-sm text-slate-500 max-w-md mx-auto">
                  Explore categories above or check back soon for new additions
                </p>
              </div>
            ) : (
              <div className="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                {data.map((item: any) => {
                  const title = item.title ?? item.name;
                  const description = item.short_description ?? item.description;
                  const image = item.thumbnail ?? item.image ?? null;

                  return (
                    <Link
                      key={item.id}
                      href={route("product.show", item.slug)}
                      className="group block"
                    >
                      <div className="relative flex h-full flex-col overflow-hidden rounded-3xl bg-white shadow-lg border border-slate-200/50 transition-all duration-500 hover:-translate-y-3 hover:shadow-2xl hover:shadow-slate-900/10 hover:border-[#FAB915]/50">
                        {/* Image */}
                        {image && (
                          <div className="relative h-56 w-full overflow-hidden bg-slate-100">
                            <div className="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <img
                              src={image}
                              alt={title}
                              className="h-full w-full object-cover transition-all duration-700 group-hover:scale-110 group-hover:rotate-1"
                              loading="lazy"
                            />
                            {/* Category badge overlay */}
                            {item.category && (
                              <div className="absolute top-4 left-4 z-20">
                                <span className="inline-flex items-center rounded-full bg-white/95 backdrop-blur-sm px-3 py-1 text-xs font-bold uppercase tracking-wide text-slate-700 shadow-lg">
                                  {item.category.title ?? item.category.name ?? "Category"}
                                </span>
                              </div>
                            )}
                          </div>
                        )}

                        {/* Content */}
                        <div className="flex flex-1 flex-col p-6">
                          <h3 className="text-xl font-bold text-slate-900 mb-3 transition-colors group-hover:text-[#FAB915] line-clamp-2">
                            {title}
                          </h3>

                          {description && (
                            <p className="flex-1 text-sm leading-relaxed text-slate-600 line-clamp-3 mb-4">
                              {description}
                            </p>
                          )}

                          <div className="flex items-center justify-between pt-4 border-t border-slate-100">
                            {/* Price (if exists) */}
                            {item.price && (
                              <div>
                                <p className="text-xs text-slate-500 mb-0.5">Starting at</p>
                                <p className="text-xl font-bold text-slate-900">
                                  ₹{item.price.toLocaleString()}
                                </p>
                              </div>
                            )}

                            <div className="inline-flex items-center gap-2 text-sm font-bold text-[#FAB915] bg-[#FAB915]/10 px-4 py-2 rounded-full translate-x-0 group-hover:translate-x-1 group-hover:bg-[#FAB915] group-hover:text-white transition-all duration-300">
                              <span>Details</span>
                              <span className="text-base group-hover:translate-x-1 transition-transform duration-300">→</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </Link>
                  );
                })}
              </div>
            )}
          </div>
        </section>
      </div>
    </AppLayout>
  );
}
