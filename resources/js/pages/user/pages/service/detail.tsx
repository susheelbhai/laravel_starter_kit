import { Container } from '@/components/ui/container';
import { usePage } from '@inertiajs/react';
import AppLayout from '@/layouts/user/app-layout';

export default function Create() {
    const service = usePage().props.data as any;
    return (
        <AppLayout title={service.title}>
            <div className="bg-background text-foreground">
                {/* Banner */}
                <div
                    className="h-64 w-full bg-cover bg-center"
                    style={{ backgroundImage: `url('${service.display_img}')` }}
                >
                    <div className="flex h-full w-full items-center justify-center bg-black/40">
                        <h1 className="text-4xl font-bold text-primary-foreground md:text-5xl">
                            {service.title}
                        </h1>
                    </div>
                </div>

                {/* Main Content */}
                <Container className="grid grid-cols-1 gap-10 py-16 md:grid-cols-3">
                    <div className="space-y-6 md:col-span-2">
                        {/* Image */}
                        {service.display_img && (
                            <img
                                src={`${service.display_img}`}
                                alt={service.title}
                                className="mb-4 w-full rounded-xl shadow"
                            />
                        )}

                        {/* Short Description */}
                        <p className="text-lg text-muted-foreground">
                            {service.short_description}
                        </p>

                        {/* Long Descriptions */}
                        <div className="space-y-4">
                            <section>
                                <h2 className="mb-2 text-xl font-semibold">
                                    Overview
                                </h2>
                                <div
                                    dangerouslySetInnerHTML={{
                                        __html: service.long_description1,
                                    }}
                                />
                            </section>
                            <section>
                                <h2 className="mb-2 text-xl font-semibold">
                                    How It Works
                                </h2>
                                <div
                                    dangerouslySetInnerHTML={{
                                        __html: service.long_description2,
                                    }}
                                />
                            </section>
                            <section>
                                <h2 className="mb-2 text-xl font-semibold">
                                    Why Choose Us
                                </h2>
                                <div
                                    dangerouslySetInnerHTML={{
                                        __html: service.long_description3,
                                    }}
                                />
                            </section>
                        </div>
                    </div>

                    {/* Sidebar */}
                    <div className="space-y-4 rounded-xl bg-sidebar border border-sidebar-border p-6 shadow">
                        <h3 className="mb-2 text-xl font-semibold text-sidebar-foreground">
                            Why Choose This Service
                        </h3>
                        <ul className="list-inside list-disc space-y-2 text-sm text-sidebar-foreground">
                            {service.features?.map((feature: any) => (
                                <li key={feature.id}>{feature}</li>
                            ))}
                        </ul>
                        <button className="mt-6 w-full rounded-md bg-sidebar-primary py-2 text-sidebar-primary-foreground transition hover:bg-sidebar-primary/90">
                            Book Now
                        </button>
                    </div>
                </Container>
            </div>
        </AppLayout>
    );
}
