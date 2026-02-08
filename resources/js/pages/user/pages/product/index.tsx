import { usePage } from "@inertiajs/react";
import AppLayout from "@/layouts/user/app-layout";
import CategorySection from "../product_category/components/category_box";
import ProductSection from "./components/product_box";

export default function Products() {
  const product_categories = usePage().props.categories as any;
  const data = usePage().props.data as any; // 👉 products list

  return (
    <AppLayout title="Products">
      <div className="min-h-screen bg-gradient-to-br from-background via-card to-background">
        {/* Banner */}
        <section className="relative h-48 md:h-56 w-full flex items-center justify-center bg-background2 border-b border-border mb-8">
          <div className="flex flex-col items-center justify-center w-full px-4">
            <h1 className="text-3xl md:text-5xl font-black text-foreground mb-2">Our Products</h1>
            <p className="max-w-2xl text-center text-base md:text-lg text-muted-foreground font-medium leading-relaxed">
              Explore our diverse range of high-quality products designed to meet your Hazardous & Safe Area Applications.
            </p>
          </div>
        </section>
        {/* Main Content */}
        <section className="mx-auto max-w-7xl px-4 py-14 md:py-16 space-y-16">
          {/* ---------- CATEGORIES ---------- */}
          <CategorySection categories={product_categories} />
          {/* ---------- PRODUCTS (data) ---------- */}
          <ProductSection products={data} />
        </section>
      </div>
    </AppLayout>
  );
}
