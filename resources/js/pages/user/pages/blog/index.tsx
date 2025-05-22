import AppLayout from '@/layouts/user/app-layout';
import { Link, usePage } from '@inertiajs/react';

export default function Create() {
    const blogs = usePage().props.data as any;

    return (
        <AppLayout title="Blogs">
            <div className="bg-white font-['Urbanist'] text-[#0E1339]">
                {/* Banner */}
                <div className="h-64 w-full bg-cover bg-center" style={{ backgroundImage: "url('/images/blogs-banner.jpg')" }}>
                    <div className="flex h-full w-full items-center justify-center bg-black/40">
                        <h1 className="text-4xl font-bold text-white md:text-5xl">Blogs</h1>
                    </div>
                </div>

                {/* Services Grid */}
                <div className="mx-auto max-w-7xl px-4 py-16">
                    <div className="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
                        {blogs.map((blog) => (
                            <Link href={route('blog.show', blog.slug)}  className="group" key={blog.id}>

                            <div className="group rounded-xl border p-6 transition hover:shadow-lg">
                                {blog.display_img && (
                                    <img src={`/storage/${blog.display_img}`} alt={blog.title} className="mb-4 h-12 w-12" />
                                )}
                                <h3 className="mb-2 text-xl font-semibold group-hover:text-[#FAB915]">{blog.title}</h3>
                                <p className="text-sm text-gray-600">{blog.short_description}</p>
                            </div>
                                </Link>
                        ))}
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
