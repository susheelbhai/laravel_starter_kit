import React from 'react';
import { cn } from '@/lib/utils';
import { ButtonComponent } from './button-component';
import { LinkComponent } from './link-component';
import { handleDelete, handleSubmit } from './button-handlers';
import { StyleIt } from './button-styles';
import type { ButtonProps } from './button-types';

export default function Button({
    className = '',
    href,
    size = 'small',
    style,
    text,
    children,
    method, // ← pull out method
    ...props
}: ButtonProps) {
    // Auto-set style to 'destructive' if method is 'delete' and style is not provided
    const finalStyle = style ?? (method === 'delete' ? 'destructive' : 'primary');

    // 1) if it's a post action, call the "other" component:
    if (method === 'post') {
        return (
            <ButtonComponent
                className={cn(StyleIt(finalStyle), className)}
                size={size}
                onClick={() => handleSubmit(href || '')} // use href as action
                {...props}
            >
                {text ?? children}
            </ButtonComponent>
        );
    }
    if (method === 'delete') {
        return (
            <ButtonComponent
                className={cn(StyleIt(finalStyle), className)}
                size={size}
                onClick={() => handleDelete(href || '')} // use href as action
                {...props}
            >
                {text ?? children}
            </ButtonComponent>
        );
    }

    // 2) otherwise, your existing split logic:
    if (!href) {
        return (
            <ButtonComponent className={cn(StyleIt(finalStyle), className)} size={size} {...props}>
                {text ?? children}
            </ButtonComponent>
        );
    } else {
        return (
            <LinkComponent href={href} className={cn(StyleIt(finalStyle), className, 'block')} size={size} {...props}>
                {text ?? children}
            </LinkComponent>
        );
    }
}

// Also export as named export for compatibility with existing imports
export { Button };
