export default function ClientSection(data: any) {
    return (
        <section className="bg-[#F5F6FA] py-10 md:py-16">
                <div className="mx-auto max-w-[1320px] px-4 text-center md:px-6">
                    <h3 className="mb-6 text-sm font-semibold text-[#6B7280] uppercase">Our Partners</h3>
                    <div className="flex flex-wrap items-center justify-center gap-10">
                        {data.data.map((logo) => (
                            <img key={logo.id} src={logo.logo} alt={logo.name} className="h-12 object-contain grayscale transition hover:grayscale-0" />
                        ))}
                    </div>
                </div>
            </section>
    );
}