import { LayoutGrid, LogOut, Settings } from 'lucide-react';

const mainNavItems = [
    {
        title: 'Dashboard',
        routeName: 'seller.dashboard',
        icon: LayoutGrid,
    },
];

const footerNavItems:any = [];
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