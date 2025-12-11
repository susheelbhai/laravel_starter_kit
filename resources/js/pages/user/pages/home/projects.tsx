export default function ProjectSection() {
    return (
        <section id="projects" className="bg-background2 py-20 md:py-28">
            <div className="mx-auto max-w-[1320px] px-4 text-center md:px-6">
                <span className="text-sm font-semibold text-primary uppercase">
                    Our Projects
                </span>
                <h2 className="mt-2 mb-12 text-3xl font-bold md:text-5xl">
                    Latest Case Studies
                </h2>
                <div className="grid gap-8 md:grid-cols-3">
                    {[
                        {
                            img: 'https://images.unsplash.com/photo-1556157382-97eda2d62296',
                            title: 'Designing Dashboards',
                            category: 'Dashboard',
                        },
                        {
                            img: 'https://images.unsplash.com/photo-1504208434309-cb69f4fe52b0',
                            title: 'Vibrant Portraits',
                            category: 'Illustration',
                        },
                        {
                            img: 'https://images.unsplash.com/photo-1508780709619-79562169bc64',
                            title: '36 Days of Malayalam type',
                            category: 'Typography',
                        },
                    ].map((project, i) => (
                        <div
                            key={i}
                            className="overflow-hidden rounded-lg bg-white shadow transition hover:shadow-lg"
                        >
                            <img
                                src={project.img}
                                alt={project.title}
                                className="w-full"
                            />
                            <div className="p-6 text-left">
                                <span className="text-xs font-semibold tracking-wider text-primary uppercase">
                                    {project.category}
                                </span>
                                <h3 className="mt-1 text-xl font-semibold">
                                    {project.title}
                                </h3>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
}
