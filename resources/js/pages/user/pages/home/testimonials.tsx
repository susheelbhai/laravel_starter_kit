import { Container } from '@/components/ui/container';
interface TestimonialData {
    id: number;
    name: string;
    organisation: string;
    designation: string;
    message: string;
    image: string;
}

export default function TestimonialSection(data: { data: TestimonialData[] }) {
    return data.data.length === 0 ? null : (
        <section id="testimonials" className="bg-background2 py-20 md:py-28">
            <Container className="text-center">
                <span className="text-sm font-semibold text-primary uppercase">
                    Testimonials
                </span>
                <h2 className="mt-2 mb-12 text-3xl font-bold md:text-5xl">
                    What Our Clients Say
                </h2>
                <div className="grid gap-8 md:grid-cols-3">
                    {data.data.map((testimonial: TestimonialData) => (
                        <div
                            key={testimonial.id}
                            className="rounded-lg bg-card p-8 shadow transition hover:shadow-lg"
                        >
                            <img
                                src={`${testimonial.image}`}
                                alt={testimonial.name}
                                className="mx-auto mb-6 h-20 w-20 rounded-full object-cover"
                            />
                            <h3 className="mb-1 text-xl font-semibold">
                                {testimonial.name}
                            </h3>
                            <p className="mb-1 text-sm text-primary">
                                {testimonial.organisation}
                            </p>
                            <p className="text-muted-foreground">
                                {testimonial.designation}
                            </p>
                            <p className="text-muted-foreground">
                                {testimonial.message}
                            </p>
                        </div>
                    ))}
                </div>
            </Container>
        </section>
    );
}
