import { usePage } from '@inertiajs/react';

export function useCan() {
    const { admin } = (usePage().props as unknown) as {
        admin: {
            permissions: string[];
        };
    };

    const can = (permission: string): boolean => {
        return admin.permissions.includes(permission);
    };

    const canAny = (permissions: string | string[]): boolean => {
        if (typeof permissions === 'string') {
            return can(permissions);
        }

        return permissions.some(p => can(p));
    };

    return { can, canAny };
}

// Legacy functions for backward compatibility - these should be replaced with useCan hook
export function can(): boolean {
    // This is a legacy function that should not be used directly
    // Use useCan hook instead
    throw new Error('Use useCan hook instead of can function');
}

export function canAny(): boolean {
    // This is a legacy function that should not be used directly
    // Use useCan hook instead
    throw new Error('Use useCan hook instead of canAny function');
}
