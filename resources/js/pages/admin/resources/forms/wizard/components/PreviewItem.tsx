interface PreviewItemProps {
    label: string;
    value?: string | string[] | React.ReactNode;
    isHtml?: boolean;
}

export default function PreviewItem({ label, value, isHtml = false }: PreviewItemProps) {
    if (!value || (Array.isArray(value) && value.length === 0)) return null;

    return (
        <div className="space-y-1">
            <h3 className="text-sm font-semibold text-gray-600">{label}</h3>
            {isHtml ? (
                <div
                    className="prose prose-sm max-w-none text-gray-800"
                    dangerouslySetInnerHTML={{ __html: value as string }}
                />
            ) : Array.isArray(value) ? (
                <ul className="list-disc list-inside text-gray-800">
                    {value.map((v) => (
                        <li key={v}>{v}</li>
                    ))}
                </ul>
            ) : (
                <p className="text-gray-800 break-words">{value}</p>
            )}
        </div>
    );
}
