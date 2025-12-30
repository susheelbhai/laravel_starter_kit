import { LayoutGrid, LogOut, Settings } from 'lucide-react';

const mainNavItems = [
    {
        title: 'Dashboard',
        routeName: 'partner.dashboard',
        icon: LayoutGrid,
    },
];

const footerNavItems:any = [];
const profileNavItems = [
    {
        title: 'Settings',
        routeName: 'partner.profile.edit',
        icon: Settings,
    },
    {
        title: 'Log Out',
        routeName: 'partner.logout',
        icon: LogOut,
    },
];

export { footerNavItems, mainNavItems, profileNavItems };