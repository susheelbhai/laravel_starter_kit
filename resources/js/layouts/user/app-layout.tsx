import { Head, usePage } from "@inertiajs/react";
import { type ReactNode } from "react";
import { type BreadcrumbItem, type SharedData } from "@/types";
import { menuItems, profileItems,loginRoute } from "../../../data/js/header_user";
import AppLayoutTemplate from "../../themes/guest_default/app/app-header-layout";

interface AppLayoutProps {
    children: ReactNode;
    breadcrumbs?: BreadcrumbItem[];
    title: string;
}

export default ({ children, breadcrumbs, title, ...props }: AppLayoutProps) => {
    const page = usePage<SharedData>();
    const { user } = page.props;
    const appData = (page.props as SharedData & { appData: { name: string } }).appData;

    return (
        <AppLayoutTemplate
            authUser={user}
            menuItems={menuItems}
            profileItems={profileItems}
            loginRoute={loginRoute}
            breadcrumbs={breadcrumbs}
            {...props}
        >
            <Head title={`${title} - ${appData.name}`} />
            {children}
        </AppLayoutTemplate>
    );
};
