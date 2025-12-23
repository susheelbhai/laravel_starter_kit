interface ProductSectionsProps {
    description?: string;
    longDescription2?: string;
    longDescription3?: string;
}

export default function ProductSections({
    description,
    longDescription2,
    longDescription3,
}: ProductSectionsProps) {
    if (!description && !longDescription2 && !longDescription3) {
        return null;
    }

    return (
        <div className="space-y-8">
            {description && (
                <section className="rounded-lg border border-gray-200 p-6">
                    <h2 className="mb-4 text-2xl font-bold text-foreground">
                        Overview
                    </h2>
                    <div
                        className="prose prose-lg max-w-none text-gray-700"
                        dangerouslySetInnerHTML={{
                            __html: description,
                        }}
                    />
                </section>
            )}

            {longDescription2 && (
                <section className="rounded-lg border border-gray-200 p-6">
                    <h2 className="mb-4 text-2xl font-bold text-foreground">
                        How It Works
                    </h2>
                    <div
                        className="prose prose-lg max-w-none text-gray-700"
                        dangerouslySetInnerHTML={{
                            __html: longDescription2,
                        }}
                    />
                </section>
            )}

            {longDescription3 && (
                <section className="rounded-lg border border-gray-200 p-6">
                    <h2 className="mb-4 text-2xl font-bold text-foreground">
                        Why Choose Us
                    </h2>
                    <div
                        className="prose prose-lg max-w-none text-gray-700"
                        dangerouslySetInnerHTML={{
                            __html: longDescription3,
                        }}
                    />
                </section>
            )}
        </div>
    );
}
