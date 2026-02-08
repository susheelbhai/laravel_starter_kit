import { Link } from '@inertiajs/react';
import type { ComponentProps } from 'react';
import { cn } from '@/lib/utils';

type LinkProps = ComponentProps<typeof Link>;

export default function BtnLink({ className = '', children, ...props }: LinkProps) {
    return (
        <Link
            className={cn(
                ' decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500',
                className,
            )}
            {...props}
        >
            <div className="inline bg-yellow-500 px-6 py-3 rounded">

            {children}
            </div>
        </Link>
    );
}
