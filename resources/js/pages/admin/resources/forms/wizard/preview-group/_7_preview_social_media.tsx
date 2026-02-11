import PreviewItem from "../components/PreviewItem";
import PreviewSection from "../components/PreviewSection";

export default function PreviewSocialMedia({ data }: { data: Record<string, unknown> }) {
    return (
        <PreviewSection
            title="Social Media"
            description="Official social and communication channels of your festival."
        >
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <PreviewItem
                    label="Facebook"
                    value={
                        data.facebook ? (
                            <a
                                href={data.facebook as string}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="text-blue-600 underline break-all"
                            >
                                {data.facebook as string}
                            </a>
                        ) : (
                            "—"
                        )
                    }
                />
                <PreviewItem
                    label="X (formerly Twitter)"
                    value={
                        data.twitter ? (
                            <a
                                href={data.twitter as string}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="text-blue-600 underline break-all"
                            >
                                {data.twitter as string}
                            </a>
                        ) : (
                            "—"
                        )
                    }
                />
                <PreviewItem
                    label="Instagram"
                    value={
                        data.instagram ? (
                            <a
                                href={data.instagram as string}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="text-blue-600 underline break-all"
                            >
                                {data.instagram as string}
                            </a>
                        ) : (
                            "—"
                        )
                    }
                />
                <PreviewItem
                    label="LinkedIn"
                    value={
                        data.linkedin ? (
                            <a
                                href={data.linkedin as string}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="text-blue-600 underline break-all"
                            >
                                {data.linkedin as string}
                            </a>
                        ) : (
                            "—"
                        )
                    }
                />
                <PreviewItem
                    label="YouTube"
                    value={
                        data.youtube ? (
                            <a
                                href={data.youtube as string}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="text-blue-600 underline break-all"
                            >
                                {data.youtube as string}
                            </a>
                        ) : (
                            "—"
                        )
                    }
                />
                <PreviewItem
                    label="WhatsApp"
                    value={
                        data.whatsapp ? (
                            <a
                                href={`https://wa.me/${(data.whatsapp as string).replace(/\D/g, "")}`}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="text-blue-600 underline break-all"
                            >
                                {data.whatsapp as string}
                            </a>
                        ) : (
                            "—"
                        )
                    }
                />
                <PreviewItem
                    label="Telegram"
                    value={
                        data.telegram ? (
                            <a
                                href={data.telegram as string}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="text-blue-600 underline break-all"
                            >
                                {data.telegram as string}
                            </a>
                        ) : (
                            "—"
                        )
                    }
                />
            </div>
        </PreviewSection>
    );
}
