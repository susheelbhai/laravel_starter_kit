import { Container } from "@/components/ui/layout/container";
import Heading from "@/components/ui/typography/heading";

interface FeatureData {
    why_us_heading: string;
    why_us_description: string;
    why_us_image_converted: {
        medium: string;
    };
}

export default function FeatureSection({ data }: { data: FeatureData }) {
    return (
        <section id="features" className="bg-background py-20 md:py-28">
            <Container className="grid gap-12 px-4 md:grid-cols-2">
                <div>
                    <Heading title={data?.why_us_heading} description="Why Choose Us" />
                    <div
                        className="prose max-w-none text-muted-foreground"
                        dangerouslySetInnerHTML={{
                            __html: data?.why_us_description,
                        }}
                    />
                </div>

                <div className="relative">
                    <img
                        src={data?.why_us_image_converted.medium}
                        alt="About"
                        className="w-full rounded-div"
                    />
                </div>
            </Container>
        </section>
    );
}
