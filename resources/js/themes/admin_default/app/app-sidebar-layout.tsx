import { type PropsWithChildren } from "react";
import { AppContent } from "@/components/app-content";
import { AppShell } from "@/components/app-shell";
import FlashMessageHandler from "@/components/FlashMessageHandler";
import { AppSidebar } from "@/themes/admin_default/app/components/app-sidebar";
import { AppSidebarHeader } from "@/themes/admin_default/app/components/app-sidebar-header";
import { type BreadcrumbItem } from "@/types";
export default function AppSidebarLayout({
    children,
    authUser,
    mainNavItems,
    footerNavItems,
    profileNavItems,
    notificationData,
    breadcrumbs = [],
}: PropsWithChildren<{
    authUser?: any;
    footerNavItems?: any;
    mainNavItems?: any;
    profileNavItems?: any;
    notificationData?: {
        unreadNotificationsCount: number;
        unreadNotifications: any[];
        all_notifications_url: string;
    };
    breadcrumbs?: BreadcrumbItem[];
}>) {
    return (
        <AppShell variant="sidebar">
            <AppSidebar
                authUser={authUser}
                mainNavItems={mainNavItems}
                footerNavItems={footerNavItems}
                profileNavItems={profileNavItems}
            />
            <AppContent variant="sidebar">
                <AppSidebarHeader breadcrumbs={breadcrumbs} notificationData={notificationData} />
                <FlashMessageHandler />
                {children}
            </AppContent>
        </AppShell>
    );
}
