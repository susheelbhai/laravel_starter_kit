import { CheckCircle } from 'lucide-react';

interface ProductFeature {
    id: string | number;
    name?: string;
    description?: string;
}

interface ProductFeaturesProps {
    features: ProductFeature[] | string[];
}

export default function ProductFeatures({ features }: ProductFeaturesProps) {
    // Ensure features is an array
    const featuresList = Array.isArray(features) ? features : [];
    
    if (featuresList.length === 0) {
        return null;
    }

    return (
        <div>
            <h3 className="mb-4 text-lg font-semibold text-foreground">
                Key Features
            </h3>
            <ul className="space-y-3">
                {featuresList.map((feature, index) => {
                    const featureText =
                        typeof feature === 'string'
                            ? feature
                            : (feature as ProductFeature).name ||
                              (feature as ProductFeature).description ||
                              '';
                    return (
                        <li
                            key={
                                typeof feature === 'string'
                                    ? index
                                    : (feature as ProductFeature).id
                            }
                            className="flex items-start gap-3"
                        >
                            <CheckCircle className="mt-0.5 h-5 w-5 flex-shrink-0 text-primary" />
                            <span className="text-sm leading-relaxed text-foreground">
                                {featureText}
                            </span>
                        </li>
                    );
                })}
            </ul>
        </div>
    );
}
