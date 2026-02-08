import { usePage } from '@inertiajs/react';
import AppLayout from '@/layouts/user/app-layout';

export default function Create() {
    const blog = usePage().props.data as any;
    return (
        <AppLayout title={blog.title}>
            <div className="bg-background text-foreground">
                {/* Banner */}
                <div className="h-64 w-full bg-cover bg-center" style={{ backgroundImage: `url('${blog.display_img}')` }}>
                    <div className="flex h-full w-full items-center justify-center bg-black/40 dark:bg-black/70">
                        <h1 className="text-4xl font-bold text-primary-foreground dark:text-white dark:drop-shadow-lg md:text-5xl">{blog.title}</h1>
                    </div>
                </div>

                {/* Main Content */}
                <div className="mx-auto grid max-w-7xl grid-cols-1 gap-10 px-4 py-16 md:grid-cols-3">
                    <div className="space-y-6 md:col-span-2">
                        {/* Image */}
                        {blog.display_img && <img src={blog.display_img} alt={blog.title} className="mb-4 w-full rounded-xl shadow" />}

                        {/* Short Description */}
                        <p className="text-lg text-muted-foreground">{blog.short_description}</p>

                        {/* Long Descriptions */}
                        <div className="space-y-4">
                            <section>
                                <div dangerouslySetInnerHTML={{ __html: blog.long_description1 }} />
                            </section>
                            <section>
                                <div dangerouslySetInnerHTML={{ __html: blog.long_description2 }} />
                            </section>
                            <section>
                                <div dangerouslySetInnerHTML={{ __html: blog.long_description3 }} />
                            </section>
                        </div>
                    </div>

                    {/* Sidebar */}
                    <div className="right">
                        <a href={blog.ad_url} target='_blank' className="space-y-4 rounded-xl bg-background2 shadow mb-6 overflow-hidden block">
                            <img src={blog.ad_img} alt="" />
                        </a>

                        <div className="space-y-4 rounded-xl bg-[var(--sidebar)] border border-[var(--sidebar-border)] p-6 shadow">
                            <h3 className="mb-2 text-xl font-semibold text-[var(--sidebar-foreground)]">Related Blogs</h3>
                            <ul className="list-inside list-disc space-y-2 text-sm text-[var(--sidebar-foreground)]">
                                {blog.related_blogs?.map((related_blog: any) => (
                                    <div key={related_blog.id}>
                                        <a href={route('blog.show', related_blog.slug)} className="ml-2 hover:underline">
                                            <div className="flex">
                                                <div className="img_div flex-1">
                                                    <img src={related_blog.display_img} alt={related_blog.title} />
                                                </div>
                                                <div className="img_title flex-3">
                                                    {related_blog.title}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                ))}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
