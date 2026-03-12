import type { LucideIcon } from 'lucide-react';
import type { Config } from 'ziggy-js';
import type { PageProps as InertiaPageProps } from '@inertiajs/core';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavGroup {
    title: string;
    items: NavItem[];
}

interface NavItem {
    title: string;
    href?: string | null;
    icon?: LucideIcon | null;
    isActive?: boolean;
    children?: NavItem[];
    permission?: string | string[];
}

export interface SharedData extends InertiaPageProps {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
    [key: string]: unknown;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    [key: string]: unknown; // This allows for additional properties...
}

// Helper type for pages with data prop
export interface PageWithData<T> extends SharedData {
    data: T;
}

// Helper type for paginated data
export interface PaginatedData<T> {
    data: T[];
    links: Array<{ url: string | null; label: string; active: boolean }>;
    prev_page_url: string | null;
    next_page_url: string | null;
    from: number;
    to: number;
    total: number;
    current_page: number;
    last_page: number;
    per_page: number;
}

export interface PageWithPaginatedData<T> extends SharedData {
    data: PaginatedData<T>;
}
