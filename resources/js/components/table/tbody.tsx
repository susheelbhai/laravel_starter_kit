

export default function TBody({ children, className }: { children?: React.ReactNode; className?: string }) {
    return (
        <tbody className={`text-gray-700 ${className}`} >
            {children}
        </tbody>
    );
}
