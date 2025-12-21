import { type NavItem } from '@/types';
import { LayoutGrid, LogOut, Settings } from 'lucide-react';

const mainNavItems = [
    {
        title: 'Dashboard',
        href: route('seller.dashboard'),
        icon: LayoutGrid,
    },
];

const footerNavItems: NavItem[] = [];
const profileNavItems: NavItem[] = [
    {
        title: 'Settings',
        href: route('seller.profile.edit'),
        icon: Settings,
    },
    {
        title: 'Log Out',
        href: route('seller.logout'),
        icon: LogOut,
    },
];

export { footerNavItems, mainNavItems, profileNavItems };
