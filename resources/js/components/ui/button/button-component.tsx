import React from 'react';
import { cn } from '@/lib/utils';
import { SizeIt } from './button-styles';

export function ButtonComponent({
    className = '',
    size = 'medium',
    children,
    ...props
}: {
    className?: string;
    size?: 'small' | 'medium' | 'full' | 'icon' | 'sm' | 'lg';
    children?: React.ReactNode;
    [key: string]: unknown;
}) {
    return (
        <button className={cn('mt-auto w-full cursor-pointer items-center rounded-button p-2 text-center', SizeIt(size), className)} {...props}>
            {children}
        </button>
    );
}
