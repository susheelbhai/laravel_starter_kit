interface THeadProps {
    className: string;
    title: string;
    colSpan: number;
}

export default function THead({ children, data }: { children?: React.ReactNode; data?: THeadProps[] }) {
    return (
        <thead className="bg-gray-100 text-left text-gray-700">
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
