import React from 'react';
import { cn } from '@/lib/utils';
import TextLink from '@/components/ui/button/text-link';
import { SizeIt } from './button-styles';

export function LinkComponent({
    className = '',
    href,
    size,
    children,
    ...props
}: {
    className?: string;
    href: string;
    size: 'small' | 'medium' | 'full' | 'icon' | 'sm' | 'lg';
    children?: React.ReactNode;
    [key: string]: unknown;
}) {
    return (
        <TextLink href={href} className={cn('mt-auto w-full cursor-pointer items-center rounded p-2 text-center', SizeIt(size), className)} {...props}>
            {children}
        </TextLink>
    );
}
