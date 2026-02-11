import { Breadcrumbs } from '@/components/breadcrumbs';
import { NotificationComponent } from '@/components/notification/notification-component';
import { SidebarTrigger } from '@/components/ui/sidebar';
import { type BreadcrumbItem as BreadcrumbItemType } from '@/types';
import AppearanceToggleDropdown from '../../../../components/appearance-dropdown';

interface NotificationItem {
    id: string;
    title: string;
    message: string;
    [key: string]: unknown;
}

export function AppSidebarHeader({
    breadcrumbs = [],
    notificationData,
}: {
    breadcrumbs?: BreadcrumbItemType[];
    notificationData?: {
        unreadNotificationsCount: number;
        unreadNotifications: NotificationItem[];
        all_notifications_url: string;
    };
}) {
    return (
        <header className="flex h-16 shrink-0 items-center gap-2 border-b border-sidebar-border/50 px-6 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12 md:px-4">
            <div className="flex w-full items-center justify-between space-x-2">
                <div className="flex items-center gap-2">
                    <SidebarTrigger className="-ml-1" />
                    <Breadcrumbs breadcrumbs={breadcrumbs} />
                </div>
                <div className="flex items-center gap-4">
                    <NotificationComponent notificationData={notificationData} />
                    <AppearanceToggleDropdown />
                </div>
            </div>
        </header>
    );
}
