import { type NavItem } from '@/types';
import { LayoutGrid, LogOut, Settings } from 'lucide-react';

const mainNavItems = [
    {
        title: 'Dashboard',
        href: route('partner.dashboard'),
        icon: LayoutGrid,
    },
];

const footerNavItems: NavItem[] = [];
const profileNavItems: NavItem[] = [
    {
        title: 'Settings',
        href: route('partner.profile.edit'),
        icon: Settings,
    },
    {
        title: 'Log Out',
        href: route('partner.logout'),
        icon: LogOut,
    },
];

export { footerNavItems, mainNavItems, profileNavItems };
