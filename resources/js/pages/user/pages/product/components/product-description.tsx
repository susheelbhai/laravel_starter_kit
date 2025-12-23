interface ProductDescriptionProps {
    shortDescription?: string;
}

export default function ProductDescription({
    shortDescription,
}: ProductDescriptionProps) {
    if (!shortDescription) return null;

    return (
        <div className="rounded-lg bg-blue-50 p-6">
            <p className="text-lg leading-relaxed text-gray-800">
                {shortDescription}
            </p>
        </div>
    );
}
