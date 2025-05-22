import { cn } from '@/lib/utils';
import TextLink from './text-link';

export default function Button({ className = '', href, children, ...props }: { className?: string; href?: string; children: React.ReactNode }) {
    if (!href) {
        return <button className={cn('cursor-pointer rounded bg-white p-2 text-black', className)}>{children}</button>;
    } else {
        return (
            <TextLink href={href} className={cn('mx-8 cursor-pointer rounded bg-white p-2 text-black', className)} {...props}>
                {children}
            </TextLink>
        );
    }
}
