export default function ServicesSection(data: any) {
    return (
        <section id="services" className="bg-background2 py-20 md:py-28">
            <div className="mx-auto max-w-[1320px] px-4 text-center md:px-6">
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
                            className="rounded-lg bg-white p-8 shadow transition hover:shadow-lg"
                        >
                            <img
                                src={`${service.display_img}`}
                                alt={service.title}
                                className="mx-auto mb-6 h-16 w-16"
                            />
                            <h3 className="mb-2 text-xl font-semibold">
                                {service.title}
                            </h3>
                            <p className="text-[#6B7280]">{service.desc}</p>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
}
