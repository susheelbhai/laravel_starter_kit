import { Card, CardContent } from "@/components/ui/card";

interface PreviewSectionProps {
    title: string;
    children: React.ReactNode;
    description?: string;
}

export default function PreviewSection({ title, children, description }: PreviewSectionProps) {
    return (
        <Card className="mb-6 border border-gray-200 shadow-sm bg-amber-100">
            <CardContent className="space-y-6 pt-6">
                <div>
                    <h2 className="text-xl font-semibold text-gray-800">{title}</h2>
                    {description && (
                        <p className="text-sm text-gray-500 mt-1">{description}</p>
                    )}
                </div>
                {children}
            </CardContent>
        </Card>
    );
}
