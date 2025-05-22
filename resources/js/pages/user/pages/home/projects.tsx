export default function ProjectSection() {
    return (
        <section id="projects" className="bg-[#F5F6FA] py-20 md:py-28">
            <div className="mx-auto max-w-[1320px] px-4 text-center md:px-6">
                <span className="text-sm font-semibold text-[#FAB915] uppercase">Our Projects</span>
                <h2 className="mt-2 mb-12 text-3xl font-bold md:text-5xl">Latest Case Studies</h2>
                <div className="grid gap-8 md:grid-cols-3">
                    {[
                        {
                            img: '/images/project/project-01.png',
                            title: 'Designing Dashboards',
                            category: 'Dashboard',
                        },
                        {
                            img: '/images/project/project-02.png',
                            title: 'Vibrant Portraits',
                            category: 'Illustration',
                        },
                        {
                            img: '/images/project/project-03.png',
                            title: '36 Days of Malayalam type',
                            category: 'Typography',
                        },
                    ].map((project, i) => (
                        <div key={i} className="overflow-hidden rounded-lg bg-white shadow transition hover:shadow-lg">
                            <img src={project.img} alt={project.title} className="w-full" />
                            <div className="p-6 text-left">
                                <span className="text-xs font-semibold tracking-wider text-[#FAB915] uppercase">{project.category}</span>
                                <h3 className="mt-1 text-xl font-semibold">{project.title}</h3>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
}
