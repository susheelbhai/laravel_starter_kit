export default function Heading({ title, description }: { title: string; description?: string }) {
    return (
        <div className="mb-12">
            {description && (
                <span className="text-sm font-semibold tracking-wider text-primary uppercase">
                    {description}
                </span>
            )}
            <h2 className="mt-4 text-2xl leading-tight font-bold md:text-4xl">
                {title}
            </h2>
        </div>
    );
}
