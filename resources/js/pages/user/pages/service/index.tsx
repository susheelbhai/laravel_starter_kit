import AppLayout from '@/layouts/user/app-layout';
import { Link, usePage } from '@inertiajs/react';

export default function Create() {
    const services = usePage().props.data as any;

    return (
        <AppLayout title="Services">
            <div className="bg-white font-['Urbanist'] text-[#0E1339]">
                {/* Banner */}
                <div className="h-64 w-full bg-cover bg-center" style={{ backgroundImage: "url('/images/services-banner.jpg')" }}>
                    <div className="flex h-full w-full items-center justify-center bg-black/40">
                        <h1 className="text-4xl font-bold text-white md:text-5xl">Our Services</h1>
                    </div>
                </div>

                {/* Services Grid */}
                <div className="mx-auto max-w-7xl px-4 py-16">
                    <div className="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
                        {services.map((service) => (
                            <Link href={route('serviceDetail', service.slug)}  className="group" key={service.id}>

                            <div className="group rounded-xl border p-6 transition hover:shadow-lg">
                                {service.display_img && (
                                    <img src={`/storage/${service.display_img}`} alt={service.title} className="mb-4 h-12 w-12" />
                                )}
                                <h3 className="mb-2 text-xl font-semibold group-hover:text-[#FAB915]">{service.title}</h3>
                                <p className="text-sm text-gray-600">{service.short_description}</p>
                            </div>
                                </Link>
                        ))}
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
