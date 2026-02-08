import type { NavItem } from "@/types";

export const sidebarNavItems: NavItem[] = [
        {
            title: 'Profile',
            href: route('seller.profile.edit'),
            icon: null,
        },
        {
            title: 'Password',
            href: route('seller.password.edit'),
            icon: null,
        },
        
    ];