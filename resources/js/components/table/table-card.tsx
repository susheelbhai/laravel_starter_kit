export default function TableCard({ children, className }: { children?: React.ReactNode; className?: string }) {
    return (
        <div className={`flex h-full flex-1 flex-col gap-4 rounded-xl p-4 ${className}`}>
            <div className="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 overflow-hidden rounded-xl border md:min-h-min">
                <div className="p-4">
                    <div className="overflow-x-auto">{children}</div>
                </div>
            </div>
        </div>
    );
}
