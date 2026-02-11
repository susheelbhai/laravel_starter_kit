import { Container } from '@/components/ui/container';
interface ClientLogo {
    id: number;
    name: string;
    url: string;
    logo: string;
}

interface ClientData {
    data: ClientLogo[];
}

export default function ClientSection(data: ClientData) {
    return (
        <section className="bg-background2 py-10 md:py-16">
            <Container className="text-center">
                <h3 className="mb-6 text-sm font-semibold text-muted-foreground uppercase">Our Partners</h3>
                <div className="flex flex-wrap items-center justify-center gap-10">
                    {data.data.map((logo: ClientLogo) => (
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
            </Container>
        </section>
    );
}