export default function ClientSection(data: any) {
    return (
        <section className="bg-background2 py-10 md:py-16">
            <div className="mx-auto max-w-[1320px] px-4 text-center md:px-6">
                <h3 className="mb-6 text-sm font-semibold text-muted-foreground uppercase">Our Partners</h3>
                <div className="flex flex-wrap items-center justify-center gap-10">
                    {data.data.map((logo: any) => (
                        <a
                            href={logo.url}
                            target="_blank"
                            key={logo.id}
                            className="h-12 w-32 transition md:h-16 flex items-center justify-center"
                        >
                            <img src={logo.logo} alt={logo.name} className="object-contain transition hover:scale-110" />
                        </a>
                    ))}
                </div>
            </div>
        </section>
    );
}