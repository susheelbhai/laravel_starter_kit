import { Container } from "@/components/ui/container";

export default function FeatureSection({ data }: any) {
    return (
        <section id="features" className="bg-background py-20 md:py-28">
            <Container className="grid gap-12 px-4 md:grid-cols-2">
                <div>
                    <span className="text-sm font-semibold tracking-wider text-primary uppercase">
                        Why Choose Us
                    </span>
                    <h2 className="mt-4 mb-6 text-3xl leading-tight font-bold md:text-5xl">
                        {data?.why_us_heading}
                    </h2>
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
                        className="w-full rounded-md"
                    />
                </div>
            </Container>
        </section>
    );
}
