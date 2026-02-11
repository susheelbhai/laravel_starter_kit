interface PreviewImagesProps {
    label: string;
    urls: string | string[] | { original_url?: string; url?: string } | null; // can be string, array, or object
    single?: boolean;
}

export default function PreviewImages({ label, urls, single = false }: PreviewImagesProps) {
    if (!urls) return null;

    // Normalize URLs just like before
    const normalizeUrls = (value: string | string[] | { original_url?: string; url?: string } | null): string[] => {
        if (!value) return [];
        if (typeof value === "string") return [value];
        if (Array.isArray(value)) {
            return value
                .map((v) =>
                    typeof v === "string"
                        ? v
                        : v?.original_url || v?.url || ""
                )
                .filter(Boolean);
        }
        if (value?.original_url) return [value.original_url];
        if (value?.url) return [value.url];
        return [];
    };

    const imageUrls = normalizeUrls(urls);
    if (imageUrls.length === 0) return null;

    return (
        <div className="space-y-1">
            <h3 className="text-sm font-semibold text-gray-600">{label}</h3>
            {single ? (
                <img
                    src={imageUrls[0]}
                    alt={label}
                    className="w-40 h-40 rounded-lg object-cover border"
                />
            ) : (
                <div className="flex flex-wrap gap-3">
                    {imageUrls.map((url, i) => (
                        <img
                            key={i}
                            src={url}
                            alt={`${label} ${i + 1}`}
                            className="w-32 h-20 rounded-lg object-cover border"
                        />
                    ))}
                </div>
            )}
        </div>
    );
}
