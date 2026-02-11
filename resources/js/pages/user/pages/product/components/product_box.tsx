import { Link } from "@inertiajs/react";

interface Product {
    id: number;
    title?: string;
    name?: string;
    short_description?: string;
    description?: string;
    thumbnail?: string;
    image?: string;
    slug: string;
    price?: number;
    category?: {
        title?: string;
        name?: string;
    };
}

interface ProductSectionProps {
  products: Product[];
}

export default function ProductSection({ products }: ProductSectionProps) {
  const hasProducts = Array.isArray(products) && products.length > 0;

  return (
    <div className="relative">
      <div className="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-1 bg-linear-to-r from-transparent via-primary to-transparent rounded-full"></div>
      <div className="mb-10 text-center pt-10">
        <div className="inline-flex items-center gap-2 rounded-full bg-linear-to-r from-secondary/10 to-secondary/5 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-secondary mb-4">
          Featured
        </div>
        <h2 className="text-3xl md:text-4xl font-bold text-foreground mb-4">
          All Products
        </h2>
        <p className="max-w-2xl mx-auto text-base text-muted-foreground leading-relaxed">
          Discover our complete collection of premium products and solutions
        </p>
        {hasProducts && (
          <p className="mt-4 text-sm font-semibold text-muted-foreground">
            {products.length} {products.length > 1 ? "Products" : "Product"} Available
          </p>
        )}
      </div>
      {!hasProducts ? (
        <div className="rounded-3xl border-2 border-dashed border-border bg-linear-to-br from-card to-muted px-8 py-16 text-center shadow-sm">
          <div className="w-16 h-16 mx-auto mb-4 rounded-full bg-muted flex items-center justify-center">
            <span className="text-3xl">🎯</span>
          </div>
          <p className="text-lg font-semibold text-foreground mb-2">
            No products available yet
          </p>
          <p className="text-sm text-muted-foreground max-w-md mx-auto">
            Explore categories above or check back soon for new additions
          </p>
        </div>
      ) : (
        <div className="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
          {products.map((item: Product) => {
            const title = item.title ?? item.name;
            const description = item.short_description ?? item.description;
            const image = item.thumbnail ?? item.image ?? null;
            return (
              <Link
                key={item.id}
                href={route("product.show", item.slug)}
                className="group block"
              >
                <div className="relative flex h-full flex-col overflow-hidden rounded-3xl bg-card shadow-lg border border-border/50 transition-all duration-500 hover:-translate-y-3 hover:shadow-2xl hover:shadow-primary/10 hover:border-primary/50">
                  {image && (
                    <div className="relative h-56 w-full overflow-hidden bg-muted">
                      <div className="absolute inset-0 bg-linear-to-t from-black/20 to-transparent z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                      <img
                        src={image}
                        alt={title}
                        className="h-full w-full object-cover transition-all duration-700 group-hover:scale-110 group-hover:rotate-1"
                        loading="lazy"
                      />
                      {item.category && (
                        <div className="absolute top-4 left-4 z-20">
                          <span className="inline-flex items-center rounded-full bg-card/95 backdrop-blur-sm px-3 py-1 text-xs font-bold uppercase tracking-wide text-foreground shadow-lg">
                            {item.category.title ?? item.category.name ?? "Category"}
                          </span>
                        </div>
                      )}
                    </div>
                  )}
                  <div className="flex flex-1 flex-col p-6">
                    <h3 className="text-xl font-bold text-foreground mb-3 transition-colors group-hover:text-primary line-clamp-2">
                      {title}
                    </h3>
                    <div className="flex-1">
                      {description && (
                        <p className="text-sm leading-relaxed text-muted-foreground line-clamp-3 mb-4">
                          {description}
                        </p>
                      )}
                    </div>
                    <div className="flex items-center justify-between pt-4 border-t border-border mt-2">
                      {item.price && (
                        <div>
                          <p className="text-xs text-muted-foreground mb-0.5">Starting at</p>
                          <p className="text-xl font-bold text-foreground">
                            ₹{item.price.toLocaleString()}
                          </p>
                        </div>
                      )}
                      <div className="inline-flex items-center gap-2 text-sm font-bold text-primary bg-primary/10 px-4 py-2 rounded-full translate-x-0 group-hover:translate-x-1 group-hover:bg-primary group-hover:text-primary-foreground transition-all duration-300">
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
  );
}
