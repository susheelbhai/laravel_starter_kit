import { Link, usePage } from '@inertiajs/react';
import AppLayout from '@/layouts/user/app-layout';

export default function Create() {
    const blogs = usePage().props.data as any;

    return (
        <AppLayout title="Blogs">
            <div className="bg-gradient-to-b from-background to-card text-foreground min-h-screen">
                {/* Banner */}
                <div className="h-64 w-full bg-cover bg-center relative" style={{ backgroundImage: "url('/images/blogs-banner.jpg')" }}>
                    <div className="absolute inset-0 flex items-center justify-center bg-black/40">
                        <h1 className="text-4xl font-extrabold text-primary-foreground drop-shadow-lg md:text-5xl tracking-tight">Blogs</h1>
                    </div>
                </div>

                {/* Blog Grid */}
                <div className="mx-auto max-w-7xl px-4 py-16">
                    <div className="grid gap-12 sm:grid-cols-2 lg:grid-cols-3">
                        {blogs.map((blog:any) => (
                            <Link href={route('blog.show', blog.slug)} className="group" key={blog.id}>
                                <div className="rounded-2xl border border-border bg-card p-6 shadow-sm transition-all duration-200 hover:-translate-y-1 hover:shadow-xl flex flex-col h-full">
                                    {blog.display_img && (
                                        <div className="mb-4 flex justify-center">
                                            <img src={`${blog.display_img}`} alt={blog.title} className="h-32 w-32 object-cover rounded-full border-4 border-primary shadow-md group-hover:scale-105 transition-transform duration-200" />
                                        </div>
                                    )}
                                    <h3 className="mb-2 text-2xl font-bold text-foreground group-hover:text-primary transition-colors duration-200">{blog.title}</h3>
                                    <p className="text-base text-muted-foreground mb-4 line-clamp-3">{blog.short_description}</p>
                                    <div className="mt-auto flex justify-end">
                                        <span className="inline-block px-4 py-1 text-xs font-semibold text-primary-foreground bg-primary rounded-full group-hover:bg-foreground group-hover:text-primary transition-colors duration-200">Read More</span>
                                    </div>
                                </div>
                            </Link>
                        ))}
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
