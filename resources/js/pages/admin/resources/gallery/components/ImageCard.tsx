import { Check, Copy } from 'lucide-react';

interface ImageCardProps {
    media: any;
    onFullscreen: (url: string) => void;
    copiedUrl: string | null;
    onCopy: (url: string) => void;
}

export function ImageCard({
    media,
    onFullscreen,
    copiedUrl,
    onCopy,
}: ImageCardProps) {
    const getConversionUrls = (media: any) => {
        const urls: { [key: string]: string } = {
            Original: media.original_url,
        };

        if (media.generated_conversions) {
            Object.keys(media.generated_conversions).forEach((conversion) => {
                const urlParts = media.original_url.split('/');
                const fileName = urlParts.pop();
                const fileNameWithoutExt = fileName.substring(
                    0,
                    fileName.lastIndexOf('.'),
                );
                const ext = fileName.substring(fileName.lastIndexOf('.'));
                urlParts.push('conversions');
                urlParts.push(`${fileNameWithoutExt}-${conversion}${ext}`);
                urls[conversion.charAt(0).toUpperCase() + conversion.slice(1)] =
                    urlParts.join('/');
            });
        }

        return urls;
    };

    const urls = getConversionUrls(media);

    return (
        <div className="rounded-lg border p-4">
            <div className="grid grid-cols-1 gap-6 lg:grid-cols-2">
                {/* Image Preview */}
                <div>
                    <div
                        className="aspect-square cursor-pointer overflow-hidden rounded-lg bg-gray-100 transition-opacity hover:opacity-90"
                        onClick={() => onFullscreen(media.original_url)}
                    >
                        <img
                            src={media.original_url}
                            alt={media.name}
                            className="h-full w-full object-cover"
                        />
                    </div>
                    <div className="mt-3">
                        <p className="text-sm font-semibold text-gray-700">
                            {media.name}
                        </p>
                        <p className="text-xs text-gray-500">
                            {(media.size / 1024).toFixed(2)} KB •{' '}
                            {media.mime_type}
                        </p>
                    </div>
                </div>

                {/* URLs List */}
                <div>
                    <h3 className="mb-3 text-sm font-semibold text-gray-700">
                        Image URLs
                    </h3>
                    <div className="space-y-2">
                        {Object.entries(urls).map(([label, url]) => (
                            <div key={label} className="rounded bg-gray-50 p-3">
                                <div className="mb-1 flex items-center justify-between">
                                    <span className="text-xs font-medium text-gray-600">
                                        {label}
                                    </span>
                                    <button
                                        onClick={() => onCopy(url)}
                                        className="text-primary transition-colors hover:text-primary/80"
                                    >
                                        {copiedUrl === url ? (
                                            <Check className="h-4 w-4 text-green-600" />
                                        ) : (
                                            <Copy className="h-4 w-4 cursor-pointer" />
                                        )}
                                    </button>
                                </div>
                                <input
                                    type="text"
                                    value={url}
                                    readOnly
                                    className="w-full rounded border border-gray-200 bg-white px-2 py-1 font-mono text-xs text-gray-600"
                                />
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </div>
    );
}

