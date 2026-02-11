import { Container } from '@/components/ui/container';

interface AboutData {
    about_image_converted: {
        medium: string;
    };
    about_heading: string;
    about_description: string;
}

export default function AboutSection({ data }: { data: AboutData }) {
    return (
        <section id="about" className="bg-background py-20 md:py-28">
            <Container className="grid items-center gap-12 md:grid-cols-2">
                <div className="relative">
                    <img
                        src={data?.about_image_converted.medium}
                        alt="About"
                        className="w-full rounded-md"
                    />
                </div>
                <div>
                    <span className="text-sm font-semibold tracking-wider text-primary uppercase">
                        About Us
                    </span>
                    <h2 className="mt-4 mb-6 text-3xl leading-tight font-bold md:text-5xl">
                        {data?.about_heading}
                    </h2>
                    <div
                        className="prose max-w-none text-muted-foreground"
                        dangerouslySetInnerHTML={{
                            __html: data?.about_description,
                        }}
                    />
                </div>
            </Container>
        </section>
    );
}
