import { Container } from '@/components/ui/layout/container';
import Heading from '@/components/ui/typography/heading';
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
                <Heading title="What Our Clients Say" description="Testimonials" />
                <div className="grid gap-8 md:grid-cols-3">
                    {data.data.map((testimonial: TestimonialData) => (
                        <div
                            key={testimonial.id}
                            className="rounded-div bg-card p-8 shadow transition hover:shadow-lg"
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
