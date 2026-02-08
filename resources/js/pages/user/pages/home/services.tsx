import { Container } from '@/components/ui/container';
export default function ServicesSection(data: any) {
    return (
        <section id="services" className="bg-background2 py-20 md:py-28">
            <Container className="text-center">
                <span className="text-sm font-semibold text-primary uppercase">
                    What We Do
                </span>
                <h2 className="mt-2 mb-12 text-3xl font-bold md:text-5xl">
                    Our Services
                </h2>
                <div className="grid gap-8 md:grid-cols-3">
                    {data.data.map((service: any, i: number) => (
                        <div
                            key={i}
                            className="rounded-lg bg-card p-8 shadow transition hover:shadow-lg"
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
