export default function TeamSection(data: any) {
    return data.data.length === 0 ? null : (
        <section id="team" className="bg-background py-20 md:py-28">
            <div className="mx-auto max-w-[1320px] px-4 text-center md:px-6">
                <span className="text-sm font-semibold text-accent uppercase">
                    Our Team
                </span>
                <h2 className="mt-2 mb-12 text-3xl font-bold md:text-5xl">
                    Meet Our Experts
                </h2>
                <div className="grid gap-8 md:grid-cols-4">
                    {data.data.map((team: any) => (
                        <div
                            key={team.id}
                            className="rounded-lg bg-background2 p-6"
                        >
                            <img
                                src={`${team.image}`}
                                alt={team.name}
                                className="mx-auto mb-4 h-32 w-32 rounded-full object-cover"
                            />
                            <h3 className="text-xl font-semibold">
                                {team.name}
                            </h3>
                            <p className="text-[#6B7280]">{team.designation}</p>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
}
