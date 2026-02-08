import { Link } from '@inertiajs/react';

interface PaginationProps {
    data: {
        links: Array<{
            url: string | null;
            label: string;
            active: boolean;
        }>;
        prev_page_url: string | null;
        next_page_url: string | null;
        from: number;
        to: number;
        total: number;
    };
}

export default function Pagination({ data }: PaginationProps) {
    if (!data?.links || data.links.length <= 3) {
        return null;
    }

    return (
        <div className="flex items-center justify-between border-t border-border bg-background px-4 py-3 sm:px-6">
            <div className="flex flex-1 justify-between sm:hidden">
                {data.prev_page_url && (
                    <Link
                        href={data.prev_page_url}
                        className="relative inline-flex items-center rounded-md border border-border bg-background px-4 py-2 text-sm font-medium text-foreground hover:bg-muted"
                    >
                        Previous
                    </Link>
                )}
                {data.next_page_url && (
                    <Link
                        href={data.next_page_url}
                        className="relative ml-3 inline-flex items-center rounded-md border border-border bg-background px-4 py-2 text-sm font-medium text-foreground hover:bg-muted"
                    >
                        Next
                    </Link>
                )}
            </div>
            <div className="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <div>
                    <p className="text-sm text-muted-foreground">
                        Showing <span className="font-medium">{data.from}</span> to{' '}
                        <span className="font-medium">{data.to}</span> of{' '}
                        <span className="font-medium">{data.total}</span> results
                    </p>
                </div>
                <div>
                    <nav className="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                        {data.links.map((link, index) => (
                            <Link
                                key={index}
                                href={link.url || '#'}
                                preserveScroll
                                className={`relative inline-flex items-center px-4 py-2 text-sm font-medium ${
                                    link.active
                                        ? 'z-10 bg-primary text-primary-foreground'
                                        : 'bg-background text-foreground hover:bg-muted'
                                } ${
                                    index === 0 ? 'rounded-l-md' : ''
                                } ${
                                    index === data.links.length - 1 ? 'rounded-r-md' : ''
                                } border border-border ${
                                    !link.url ? 'cursor-not-allowed opacity-50' : ''
                                }`}
                                dangerouslySetInnerHTML={{ __html: link.label }}
                            />
                        ))}
                    </nav>
                </div>
            </div>
        </div>
    );
}
