import { Container } from '@/components/ui/layout/container';
import Heading from '@/components/ui/typography/heading';
interface ServiceData {
    title: string;
    desc: string;
    display_img_converted: {
        thumb: string;
    };
}

export default function ServicesSection(data: { data: ServiceData[] }) {
    return (
        <section id="services" className="bg-background2 py-20 md:py-28">
            <Container className="text-center">
                <Heading title="Our Services" description="What We Do" />
                <div className="grid gap-8 md:grid-cols-3">
                    {data.data.map((service: ServiceData, i: number) => (
                        <div
                            key={i}
                            className="rounded-div bg-card p-8 shadow transition hover:shadow-lg"
                        >
                            <img
                                src={`${service.display_img_converted.thumb}`}
                                alt={service.title}
                                className="mx-auto mb-6 h-16 w-16"
                            />
                            <h3 className="mb-2 text-xl font-semibold">
                                {service.title}
                            </h3>
                            <p className="text-muted-foreground">{service.desc}</p>
                        </div>
                    ))}
                </div>
            </Container>
        </section>
    );
}
