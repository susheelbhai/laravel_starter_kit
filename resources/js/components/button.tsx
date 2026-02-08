
import { router } from '@inertiajs/react';
import React from 'react';
import Swal from 'sweetalert2';
import { cn } from '@/lib/utils';
import TextLink from './text-link';

const handleDelete = (action: string): void => {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won’t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'hsl(var(--primary))',
        cancelButtonColor: 'hsl(var(--muted-foreground))',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(action, {
                onSuccess: (): void => {
                    Swal.fire('Deleted!', 'Record has been deleted.', 'success');
                },
                onError: (): void => {
                    Swal.fire('Error!', 'Failed to delete the record.', 'error');
                },
            });
        }
    });
};

const handleSubmit = (action: string): void => {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won’t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'hsl(var(--primary))',
        cancelButtonColor: 'hsl(var(--muted-foreground))',
        confirmButtonText: 'Yes, Submit it!',
    }).then((result) => {
        if (result.isConfirmed) {
            router.post(
                action,
                {},
                {
                    onSuccess: (): void => {
                        Swal.fire('Submitted!', 'Record has been submitted.', 'success');
                    },
                    onError: (): void => {
                        Swal.fire('Error!', 'Failed to submit the record.', 'error');
                    },
                },
            );
        }
    });
};

type ButtonProps = {
    className?: string;
    href?: string;
    size?: 'small' | 'medium' | 'full';
    style?: 'primary' | 'secondary' | 'success' | 'warning' | 'danger';
    text?: string;
    children?: React.ReactNode;
    /** HTTP method or other action; catch 'delete' specially */
    method?: string;
    /** allow any other prop (e.g. data-*, aria-*, etc.) */
    [key: string]: any;
};

export default function Button({
    className = '',
    href,
    size = 'small',
    style = 'primary',
    text,
    children,
    method, // ← pull out method
    ...props
}: ButtonProps) {
    // 1) if it's a post action, call the "other" component:
    if (method === 'post') {
        return (
            <ButtonComponent
                className={cn(StyleIt(style), className)}
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
                className={cn(StyleIt(style), className)}
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
            <ButtonComponent className={cn(StyleIt(style), className)} size={size} {...props}>
                {text ?? children}
            </ButtonComponent>
        );
    } else {
        return (
            <LinkComponent href={href} className={cn(StyleIt(style), className, 'block')} size={size} {...props}>
                {text ?? children}
            </LinkComponent>
        );
    }
}

function ButtonComponent({
    className = '',
    size = 'medium',
    children,
    ...props
}: {
    className?: string;
    size?: 'small' | 'medium' | 'full';
    children?: React.ReactNode;
    [key: string]: any;
}) {
    return (
        <button className={cn('mt-auto w-full cursor-pointer items-center rounded p-2 text-center', SizeIt(size), className)} {...props}>
            {children}
        </button>
    );
}

function LinkComponent({
    className = '',
    href,
    size,
    children,
    ...props
}: {
    className?: string;
    href: string;
    size: 'small' | 'medium' | 'full';
    children?: React.ReactNode;
    [key: string]: any;
}) {
    return (
        <TextLink href={href} className={cn('mt-auto w-full cursor-pointer items-center rounded p-2 text-center', SizeIt(size), className)} {...props}>
            {children}
        </TextLink>
    );
}

function StyleIt(style: 'primary' | 'secondary' | 'success' | 'warning' | 'danger') {
    switch (style) {
        case 'primary':
            return 'bg-primary/80 text-primary-foreground hover:bg-primary';
        case 'secondary':
            return 'bg-secondary/80 text-secondary-foreground hover:bg-secondary';
        case 'success':
            return 'bg-success/80 text-success-foreground hover:bg-success';
        case 'warning':
            return 'bg-warning/80 text-warning-foreground hover:bg-warning';
        case 'danger':
            return 'bg-danger/80 text-danger-foreground hover:bg-danger';
        default:
            return '';
    }
}
function SizeIt(size: 'small' | 'medium' | 'full') {
    switch (size) {
        case 'small':
            return 'w-fit px-3 py-1 text-sm';
        case 'medium':
            return 'w-fit px-4 py-2 text-base';
        case 'full':
            return 'w-full px-4 py-2 text-base';
        default:
            return '';
    }
}