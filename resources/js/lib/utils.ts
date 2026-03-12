import { type ClassValue, clsx } from 'clsx';
import { twMerge } from 'tailwind-merge';

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}

export function toUrl(path: string, params?: Record<string, any>): string {
    if (typeof window !== 'undefined' && (window as any).route) {
        return (window as any).route(path, params);
    }
    return path;
}
