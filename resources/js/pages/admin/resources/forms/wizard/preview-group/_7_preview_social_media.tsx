import PreviewItem from "../components/PreviewItem";
import PreviewSection from "../components/PreviewSection";

export default function PreviewSocialMedia({ data }: { data: any }) {
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
                                href={data.facebook}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="text-blue-600 underline break-all"
                            >
                                {data.facebook}
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
                                href={data.twitter}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="text-blue-600 underline break-all"
                            >
                                {data.twitter}
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
                                href={data.instagram}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="text-blue-600 underline break-all"
                            >
                                {data.instagram}
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
                                href={data.linkedin}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="text-blue-600 underline break-all"
                            >
                                {data.linkedin}
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
                                href={data.youtube}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="text-blue-600 underline break-all"
                            >
                                {data.youtube}
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
                                href={`https://wa.me/${data.whatsapp.replace(/\D/g, "")}`}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="text-blue-600 underline break-all"
                            >
                                {data.whatsapp}
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
                                href={data.telegram}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="text-blue-600 underline break-all"
                            >
                                {data.telegram}
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
