import { Container } from '@/components/ui/layout/container';
import Heading from '@/components/ui/typography/heading';

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
                        className="w-full rounded-div"
                    />
                </div>
                <div>
                    <Heading title={data?.about_heading} description="About Us" />
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
