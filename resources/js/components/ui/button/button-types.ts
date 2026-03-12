import React from 'react';

export type ButtonProps = {
    className?: string;
    href?: string;
    size?: 'small' | 'medium' | 'full' | 'icon' | 'sm' | 'lg';
    style?: 'primary' | 'secondary' | 'success' | 'warning' | 'destructive';
    text?: string;
    children?: React.ReactNode;
    /** HTTP method or other action; catch 'delete' specially */
    method?: string;
    /** allow any other prop (e.g. data-*, aria-*, etc.) */
    [key: string]: unknown;
};
