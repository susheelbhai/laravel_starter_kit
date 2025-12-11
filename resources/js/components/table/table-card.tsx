export default function TableCard({ children, className }: { children?: React.ReactNode; className?: string }) {
    return (
        <div className={`flex h-full flex-1 flex-col gap-4 rounded-xl px-4 pt-4 ${className}`}>
            <div className="border-sidebar-border/70 dark:border-sidebar-border relative min-h-[100vh] flex-1 overflow-hidden rounded-xl border md:min-h-min">
                <div className="">
                    <div className="overflow-x-auto">{children}</div>
                </div>
            </div>
        </div>
    );
}
