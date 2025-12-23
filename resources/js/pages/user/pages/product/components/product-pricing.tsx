interface ProductPricingProps {
    price: number;
    mrp?: number;
    currency?: string;
}

export default function ProductPricing({
    price,
    mrp,
    currency,
}: ProductPricingProps) {
    const hasDiscount = mrp && mrp > price;

    return (
        <div className="flex items-baseline gap-2">
            <span className="text-4xl font-bold">
                {currency || '₹'}
                {price.toLocaleString()}
            </span>
            {hasDiscount && (
                <>
                    <span className="text-lg text-muted-foreground line-through">
                        MRP {currency || '₹'}
                        {mrp!.toLocaleString()}
                    </span>
                    <span className="text-lg font-semibold text-green-600">
                        {Math.round(
                            ((mrp! - price) / mrp!) * 100,
                        )}
                        % off
                    </span>
                </>
            )}
        </div>
    );
}
