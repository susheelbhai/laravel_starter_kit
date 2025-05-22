

export default function Table({ children, className }: { children?: React.ReactNode; className?: string }) {
    return (
        <table className={`min-w-full rounded-lg border border-gray-200 bg-white ${className}`} >
            {children}
        </table>
    );
}
