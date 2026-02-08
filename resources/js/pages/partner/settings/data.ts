import type { NavItem } from "@/types";

export const sidebarNavItems: NavItem[] = [
        {
            title: 'Profile',
            href: route('partner.profile.edit'),
            icon: null,
        },
        {
            title: 'Password',
            href: route('partner.password.edit'),
            icon: null,
        },
        
    ];