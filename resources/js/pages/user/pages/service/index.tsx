import { Container } from '@/components/ui/container';
import { Link, usePage } from "@inertiajs/react";
import AppLayout from "@/layouts/user/app-layout";

export default function Services() {
  const services = usePage().props.data as any;

  return (
    <AppLayout title="Services">
      <div className="min-h-screen bg-background text-foreground">
        {/* Banner */}
        <section className="relative h-64 md:h-80 w-full overflow-hidden">
          <div
            className="absolute inset-0 bg-cover bg-center"
            style={{ backgroundImage: "url('/images/services-banner.jpg')" }}
          />
          <div className="absolute inset-0 bg-gradient-to-b from-black/50 via-black/40 to-black/60" />
          <div className="relative z-10 flex h-full items-center justify-center px-4">
            <div className="text-center">
              <span className="inline-flex items-center rounded-full bg-card/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.16em] text-primary-foreground">
                What We Offer
              </span>

              <h1 className="mt-4 text-3xl font-bold text-primary-foreground sm:text-4xl md:text-5xl tracking-tight">
                Our Services
              </h1>

              <p className="mx-auto mt-3 max-w-2xl text-sm text-muted-foreground md:text-base">
                Providing exceptional value through tailored solutions designed
                to help you grow.
              </p>
            </div>
          </div>
        </section>

        {/* Services List */}
        <Container className="py-14 md:py-16">
          <div className="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            {services.map((service: any) => (
              <Link
                key={service.id}
                href={route("serviceDetail", service.slug)}
                className="group block"
              >
                <div className="h-full rounded-2xl bg-card p-6 shadow-sm ring-1 ring-border transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                  {/* Image/Icon */}
                  {service.display_img && (
                    <div className="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 p-2 shadow-sm">
                      <img
                        src={service.display_img}
                        alt={service.title}
                        className="h-10 w-10 object-contain"
                      />
                    </div>
                  )}

                  {/* Title */}
                  <h3 className="mb-2 text-xl font-semibold group-hover:text-primary transition-colors">
                    {service.title}
                  </h3>

                  {/* Short Description */}
                  <p className="text-sm leading-relaxed text-muted-foreground">
                    {service.short_description}
                  </p>

                  {/* Read More */}
                  <div className="mt-4 inline-flex items-center gap-1 text-sm font-medium text-primary opacity-0 transition-all group-hover:opacity-100">
                    Read More →
                  </div>
                </div>
              </Link>
            ))}
          </div>
        </Container>
      </div>
    </AppLayout>
  );
}
