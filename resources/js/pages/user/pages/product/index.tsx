import AppLayout from "@/layouts/user/app-layout";
import { Link, usePage } from "@inertiajs/react";

export default function Products() {
  const product_categories = usePage().props.categories as any;
  const data = usePage().props.data as any; // 👉 products list

  const hasCategories = Array.isArray(product_categories) && product_categories.length > 0;
  const hasProducts = Array.isArray(data) && data.length > 0;

  return (
    <AppLayout title="Products">
      <div className="min-h-screen bg-slate-50 text-slate-900">
        {/* Banner */}
        <section className="relative h-64 md:h-80 w-full overflow-hidden">
          <div
            className="absolute inset-0 bg-cover bg-center"
            style={{ backgroundImage: "url('/images/products-banner.jpg')" }}
          />
          <div className="absolute inset-0 bg-gradient-to-b from-black/50 via-black/40 to-black/60" />
          <div className="relative z-10 flex h-full items-center justify-center px-4">
            <div className="text-center">
              <span className="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.16em] text-white">
                What We Offer
              </span>

              <h1 className="mt-4 text-3xl font-bold text-white sm:text-4xl md:text-5xl tracking-tight">
                Our Products
              </h1>

              <p className="mx-auto mt-3 max-w-2xl text-sm text-slate-200 md:text-base">
                Providing exceptional value through tailored solutions designed
                to help you grow.
              </p>
            </div>
          </div>
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
              <div className="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-10 text-center">
                <p className="text-base font-medium text-slate-700">
                  No product categories available.
                </p>
                <p className="mt-2 text-sm text-slate-500 max-w-md mx-auto">
                  Please check back later or contact us for more information.
                </p>
              </div>
            ) : (
              <div className="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                {product_categories.map((category: any) => (
                  <Link
                    key={category.id}
                    href={route("home", category.slug)}
                    className="group block"
                  >
                    <div className="h-full rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:ring-[#FAB915]/40">
                      {/* Icon */}
                      {category.icon && (
                        <div className="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-xl bg-[#FAB915]/10 p-2 shadow-sm">
                          <img
                            src={category.icon}
                            alt={category.title}
                            className="h-10 w-10 object-contain"
                            loading="lazy"
                          />
                        </div>
                      )}

                      {/* Title */}
                      <h3 className="mb-2 text-xl font-semibold transition-colors group-hover:text-[#FAB915]">
                        {category.title}
                      </h3>

                      {/* Description */}
                      {category.short_description && (
                        <p className="text-sm leading-relaxed text-slate-600">
                          {category.short_description}
                        </p>
                      )}

                      {/* CTA */}
                      <div className="mt-4 inline-flex items-center gap-1 text-sm font-medium text-[#FAB915] opacity-0 transition-all duration-200 group-hover:translate-x-1 group-hover:opacity-100">
                        <span>View Category</span>
                        <span aria-hidden="true">→</span>
                      </div>
                    </div>
                  </Link>
                ))}
              </div>
            )}
          </div>

          {/* ---------- PRODUCTS (data) ---------- */}
          <div className="border-t border-slate-200 pt-10">
            <div className="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
              <div>
                <h2 className="text-2xl md:text-3xl font-semibold text-slate-900">
                  All Products
                </h2>
                <p className="mt-2 max-w-2xl text-sm md:text-base text-slate-600">
                  Explore our complete list of products with details and specifications.
                </p>
              </div>

              {hasProducts && (
                <p className="text-xs font-medium uppercase tracking-wide text-slate-500">
                  {data.length} product{data.length > 1 ? "s" : ""}
                </p>
              )}
            </div>

            {!hasProducts ? (
              <div className="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-10 text-center">
                <p className="text-base font-medium text-slate-700">
                  No products available right now.
                </p>
                <p className="mt-2 text-sm text-slate-500 max-w-md mx-auto">
                  Try exploring categories above or come back later.
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
                      <div className="flex h-full flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:ring-[#FAB915]/40">
                        {/* Image */}
                        {image && (
                          <div className="relative h-48 w-full overflow-hidden">
                            <img
                              src={image}
                              alt={title}
                              className="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                              loading="lazy"
                            />
                          </div>
                        )}

                        {/* Content */}
                        <div className="flex flex-1 flex-col p-5">
                          {/* Category badge (if you pass category in each product) */}
                          {item.category && (
                            <span className="mb-2 inline-flex w-fit items-center rounded-full bg-slate-100 px-2.5 py-0.5 text-[11px] font-medium uppercase tracking-wide text-slate-600">
                              {item.category.title ?? item.category.name ?? "Category"}
                            </span>
                          )}

                          <h3 className="text-lg font-semibold text-slate-900 transition-colors group-hover:text-[#FAB915]">
                            {title}
                          </h3>

                          {description && (
                            <p className="mt-2 flex-1 text-sm leading-relaxed text-slate-600 line-clamp-3">
                              {description}
                            </p>
                          )}

                          <div className="mt-4 flex items-center justify-between">
                            {/* Price (if exists) */}
                            {item.price && (
                              <p className="text-base font-semibold text-slate-900">
                                ₹{item.price}
                              </p>
                            )}

                            <div className="inline-flex items-center gap-1 text-sm font-medium text-[#FAB915] transition-transform group-hover:translate-x-1">
                              <span>View Details</span>
                              <span aria-hidden="true">→</span>
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
