import { AppContent } from "@/components/app-content";
import { AppShell } from "@/components/app-shell";
import { AppSidebar } from "@/themes/admin_default/app/components/app-sidebar";
import { AppSidebarHeader } from "@/themes/admin_default/app/components/app-sidebar-header";
import { type BreadcrumbItem } from "@/types";
import { type PropsWithChildren } from "react";
import { FlashMessage, FlashType } from "@/components/ui/alert/flash1";
import { useEffect, useState } from "react";
import { usePage } from "@inertiajs/react";
import { type SharedData } from "@/types";
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
    const page = usePage<SharedData>();

    const { flash = {} } = page.props as {
        flash?: Partial<Record<FlashType, string>>;
    };

    const [visibleFlash, setVisibleFlash] = useState<{
        type: FlashType;
        message: string;
    } | null>(null);

    // 🔁 Handle flash on every Inertia response
    useEffect(() => {
        if (flash.success) {
            setVisibleFlash({ type: "success", message: flash.success });
        } else if (flash.warning) {
            setVisibleFlash({ type: "warning", message: flash.warning });
        } else if (flash.error) {
            setVisibleFlash({ type: "error", message: flash.error });
        } else {
            setVisibleFlash(null);
        }

        // ⏱ Auto-hide after 5 seconds if any flash is present
        if (flash.success || flash.warning || flash.error) {
            const timer = setTimeout(() => setVisibleFlash(null), 5000);
            return () => clearTimeout(timer);
        }
    }, [flash]);
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
                <div className="mx-auto items-center justify-between">
                    {visibleFlash && (
                        <FlashMessage
                            type={visibleFlash.type}
                            message={visibleFlash.message}
                            onClose={() => setVisibleFlash(null)}
                        />
                    )}
                </div>
                {children}
            </AppContent>
        </AppShell>
    );
}
