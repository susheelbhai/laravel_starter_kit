

export default function TBody({ children, className }: { children?: React.ReactNode; className?: string }) {
    return (
        <tbody className={`text-foreground ${className}`} >
            {children}
        </tbody>
    );
}
