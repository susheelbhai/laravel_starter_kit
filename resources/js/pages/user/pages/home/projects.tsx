import { Container } from '@/components/ui/container';
export default function ProjectSection({data}: {data: any}) {
    return (
        <section id="projects" className="bg-background2 py-20 md:py-28">
            <Container className="text-center">
                <span className="text-sm font-semibold text-primary uppercase">
                    Our Projects
                </span>
                <h2 className="mt-2 mb-12 text-3xl font-bold md:text-5xl">
                    Latest Case Studies
                </h2>
                <div className="grid gap-8 md:grid-cols-3">
                    {data.map((project: any, i: number) => (
                        <div
                            key={i}
                            className="overflow-hidden rounded-lg bg-card shadow transition hover:shadow-lg"
                        >
                            <img
                                src={project.image}
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
            </Container>
        </section>
    );
}
