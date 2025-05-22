import { usePage } from '@inertiajs/react';

import AppLayout from '@/layouts/user/app-layout';

export default function Create() {
    const data = usePage().props.data as any;

    return (
        <AppLayout title="About Us">
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 overflow-hidden rounded-xl border md:min-h-min">
                    <div className="text-gray-800">
                        {/* Banner Image */}
                        <div className="h-64 w-full bg-cover bg-center" style={{ backgroundImage: `url('/storage/${data.banner}')` }}>
                            <div className="flex h-full w-full items-center justify-center bg-black/40">
                                <h1 className="text-4xl font-bold text-white md:text-5xl">About Us</h1>
                            </div>
                        </div>

                        {/* Introduction */}
                        <div className="mx-auto max-w-5xl space-y-6 px-4 py-12">
                            <div dangerouslySetInnerHTML={{ __html: data.para1 }} />
                            <div dangerouslySetInnerHTML={{ __html: data.para2 }} />

                            {/* Highlights Section */}
                            <div className="mt-12 grid gap-6 md:grid-cols-3">
                                <div className="rounded-xl bg-blue-50 p-6 shadow-md">
                                    <h2 className="mb-2 text-xl font-semibold text-blue-700">Our Objective</h2>
                                    <div dangerouslySetInnerHTML={{ __html: data.objective }} />
                                </div>
                                <div className="rounded-xl bg-green-50 p-6 shadow-md">
                                    <h2 className="mb-2 text-xl font-semibold text-green-700">Our Mission</h2>
                                    <div dangerouslySetInnerHTML={{ __html: data.mission }} />
                                </div>
                                <div className="rounded-xl bg-purple-50 p-6 shadow-md">
                                    <h2 className="mb-2 text-xl font-semibold text-purple-700">Our Vision</h2>
                                    <div dangerouslySetInnerHTML={{ __html: data.vision }} />
                                </div>
                            </div>

                            {/* Founder Message */}
                            <div className="mt-16 flex flex-col items-center gap-8 md:flex-row">
                                <img src={`/storage/${data.founder_image}`} alt="Founder" className="h-48 w-48 rounded-full object-cover shadow-md" />
                                <div>
                                    <h3 className="mb-2 text-2xl font-bold">A Message from Our Founder</h3>
                                    <div dangerouslySetInnerHTML={{ __html: data.founder_message }} />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
