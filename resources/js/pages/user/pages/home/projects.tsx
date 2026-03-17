import { Container } from '@/components/ui/layout/container';
import Heading from '@/components/ui/typography/heading';
interface ProjectData {
    image: string;
    title: string;
    category: string;
}

export default function ProjectSection({data}: {data: ProjectData[]}) {
    return (
        <section id="projects" className="bg-background2 py-20 md:py-28">
            <Container className="text-center">
                <Heading title="Latest Case Studies" description="Our Projects" />
                <div className="grid gap-8 md:grid-cols-3">
                    {data.map((project: ProjectData, i: number) => (
                        <div
                            key={i}
                            className="overflow-hidden rounded-div bg-card shadow transition hover:shadow-lg"
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
