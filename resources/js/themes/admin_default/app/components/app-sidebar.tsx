import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { Link } from '@inertiajs/react';
import type { PropsWithChildren } from 'react';
// import { type NavItem } from '@/types';

import AppLogo from './app-logo';

export function AppSidebar({
    authUser,
    mainNavItems,
    footerNavItems,
    profileNavItems,
}: PropsWithChildren<{
    authUser?: any;
    footerNavItems?: any;
    mainNavItems?: any;
    profileNavItems?: any;
}>) {
    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader className="mb-5 p-0">
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link
                                href={authUser?.dashboard_url || '/dashboard'}
                                prefetch
                            >
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={mainNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter items={footerNavItems} className="mt-auto" />
                <NavUser
                    authUser={authUser}
                    profileNavItems={profileNavItems}
                />
            </SidebarFooter>
        </Sidebar>
    );
}

