import { AppContent } from '@/components/app-content';
import { AppShell } from '@/components/app-shell';
import { AppSidebar } from '@/components/app-sidebar';
import { AppSidebarHeader } from '@/components/app-sidebar-header';
import { type BreadcrumbItem } from '@/types';
import { type PropsWithChildren } from 'react';

export default function AppSidebarLayout({ children, authUser, mainNavItems, footerNavItems, profileNavItems, breadcrumbs = [] }: PropsWithChildren<{ breadcrumbs?: BreadcrumbItem[]; authUser?: any; footerNavItems?: any; mainNavItems?: any, profileNavItems?: any }>) {
    return (
        <AppShell variant="sidebar">
            <AppSidebar authUser={authUser} mainNavItems={mainNavItems} footerNavItems={footerNavItems} profileNavItems={profileNavItems} />
            <AppContent variant="sidebar">
                <AppSidebarHeader breadcrumbs={breadcrumbs} />
                {children}
            </AppContent>
        </AppShell>
    );
}
