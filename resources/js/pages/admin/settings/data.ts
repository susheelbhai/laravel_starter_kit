import { NavItem } from "@/types";

export const sidebarNavItems: NavItem[] = [
        {
            title: 'Profile',
            href: route('admin.profile.edit'),
            icon: null,
        },
        {
            title: 'Password',
            href: route('admin.password.edit'),
            icon: null,
        },
        
    ];