export default function FeatureSection({ data }: any) {
    return (
        <section id="features" className="bg-background py-20 md:py-28">
            <div className="mx-auto grid max-w-[1320px] items-center gap-12 px-4 md:grid-cols-2 md:px-6">
                <div>
                    <span className="text-sm font-semibold tracking-wider text-primary uppercase">
                        Why Choose Us
                    </span>
                    <h2 className="mt-4 mb-6 text-3xl leading-tight font-bold md:text-5xl">
                        {data?.why_us_heading}
                    </h2>
                    <div
                        className="prose max-w-none text-gray-600"
                        dangerouslySetInnerHTML={{
                            __html: data?.why_us_description,
                        }}
                    />
                </div>

                <div className="relative">
                    <img
                        src={data?.why_us_image}
                        alt="About"
                        className="w-full rounded-md"
                    />
                </div>
            </div>
        </section>
    );
}
