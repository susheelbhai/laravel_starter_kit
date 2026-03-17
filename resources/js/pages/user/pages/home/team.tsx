import { Container } from '@/components/ui/layout/container';
import Heading from '@/components/ui/typography/heading';
interface TeamMember {
    id: number;
    name: string;
    designation: string;
    image_converted: {
        small: string;
    };
}

export default function TeamSection(data: { data: TeamMember[] }) {
    return data.data.length === 0 ? null : (
        <section id="team" className="bg-background py-20 md:py-28">
            <Container className="text-center">
                <Heading title="Meet Our Experts" description="Our Team" />
                <div className="grid gap-8 md:grid-cols-4">
                    {data.data.map((team: TeamMember) => (
                        <div
                            key={team.id}
                            className="rounded-div bg-background2 p-6"
                        >
                            <img
                                src={`${team.image_converted.small}`}
                                alt={team.name}
                                className="mx-auto mb-4 h-32 w-32 rounded-full object-cover"
                            />
                            <h3 className="text-xl font-semibold">
                                {team.name}
                            </h3>
                            <p className="text-muted-foreground">{team.designation}</p>
                        </div>
                    ))}
                </div>
            </Container>
        </section>
    );
}
