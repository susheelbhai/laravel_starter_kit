import { LayoutGrid, LogOut, Settings } from 'lucide-react';

const mainNavItems = [
    {
        title: 'Dashboard',
        routeName: 'seller.dashboard',
        icon: LayoutGrid,
    },
];

interface NavItem {
    title: string;
    routeName?: string;
    href?: string | null;
    icon: React.ComponentType;
    permission?: string[];
    children?: NavItem[];
}

const footerNavItems: NavItem[] = [];
const profileNavItems = [
    {
        title: 'Settings',
        routeName: 'seller.profile.edit',
        icon: Settings,
    },
    {
        title: 'Log Out',
        routeName: 'seller.logout',
        icon: LogOut,
    },
];

export { footerNavItems, mainNavItems, profileNavItems };