import AppLayout from '@/layouts/user/app-layout';
import { usePage } from '@inertiajs/react';

export default function Create() {
    const blog = usePage().props.data as any;
    return (
        <AppLayout title={blog.title}>
            <div className="bg-white font-['Urbanist'] text-[#0E1339]">
                {/* Banner */}
                <div className="h-64 w-full bg-cover bg-center" style={{ backgroundImage: `url('${blog.display_img}')` }}>
                    <div className="flex h-full w-full items-center justify-center bg-black/40">
                        <h1 className="text-4xl font-bold text-white md:text-5xl">{blog.title}</h1>
                    </div>
                </div>

                {/* Main Content */}
                <div className="mx-auto grid max-w-7xl grid-cols-1 gap-10 px-4 py-16 md:grid-cols-3">
                    <div className="space-y-6 md:col-span-2">
                        {/* Image */}
                        {blog.display_img && <img src={blog.display_img} alt={blog.title} className="mb-4 w-full rounded-xl shadow" />}

                        {/* Short Description */}
                        <p className="text-lg text-gray-700">{blog.short_description}</p>

                        {/* Long Descriptions */}
                        <div className="space-y-4">
                            <section>
                                <h2 className="mb-2 text-xl font-semibold">Overview</h2>
                                <div dangerouslySetInnerHTML={{ __html: blog.long_description1 }} />
                            </section>
                            <section>
                                <h2 className="mb-2 text-xl font-semibold">How It Works</h2>
                                <div dangerouslySetInnerHTML={{ __html: blog.long_description2 }} />
                            </section>
                            <section>
                                <h2 className="mb-2 text-xl font-semibold">Why Choose Us</h2>
                                <div dangerouslySetInnerHTML={{ __html: blog.long_description3 }} />
                            </section>
                        </div>
                    </div>

                    {/* Sidebar */}
                    <div className="space-y-4 rounded-xl bg-gray-50 p-6 shadow">
                        <h3 className="mb-2 text-xl font-semibold">Why Choose This Service</h3>
                        <ul className="list-inside list-disc space-y-2 text-sm text-gray-600">
                            {blog.features?.map((feature, i) => <li key={i}>{feature}</li>)}
                        </ul>
                        <button className="mt-6 w-full rounded-md bg-[#FAB915] py-2 text-white transition hover:bg-yellow-500">Book Now</button>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
