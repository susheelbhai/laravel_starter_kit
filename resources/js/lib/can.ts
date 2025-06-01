import { usePage } from '@inertiajs/react';

export function can(permission: string): boolean {
    const { admin } = (usePage().props as unknown) as {
        admin: {
            permissions: string[];
        };
    };
    return admin.permissions.includes(permission);
}

export function canAny(permissions: string | string[]): boolean {
    if (typeof permissions === 'string') {
        return can(permissions);
    }

    return permissions.some(p => can(p));
}
