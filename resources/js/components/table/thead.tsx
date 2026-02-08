interface THeadProps {
    className: string;
    title: string;
    colSpan?: number;
}

export default function THead({ children, data }: { children?: React.ReactNode; data?: THeadProps[] }) {
    return (
        <thead className="bg-primary/10 text-left text-foreground border-b border-border">
            <tr>
                {data?.map((item, index) => (
                    <th key={index} className={item.className} colSpan={item.colSpan}>
                        {item.title}
                    </th>
                ))}
                {children}
            </tr>
        </thead>
    );
}
