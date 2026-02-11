import type { PropsWithChildren } from "react";
import type { BreadcrumbItem } from "@/types";
import Footer from "./app-footer";
import Header from "./header";
import TopHeader from "./top-header";

interface MenuItem {
    name: string;
    routeName: string;
}

interface ProfileItem {
    name: string;
    routeName: string;
    method?: string;
}

export default function AppSidebarLayout({
    children,
    menuItems,
    profileItems,
    loginRoute,
}: PropsWithChildren<{
    breadcrumbs?: BreadcrumbItem[];
    authUser?: Record<string, unknown>;
    footerNavItems?: Record<string, unknown>[];
    mainNavItems?: Record<string, unknown>[];
    profileNavItems?: Record<string, unknown>[];
    menuItems: MenuItem[];
    profileItems: ProfileItem[];
    loginRoute: string;
}>) {
    return (
        <div className="overflow-x-hidden bg-background text-foreground">
            <header className="w-full">
                <TopHeader />
                <Header
                    menuItems={menuItems}
                    profileItems={profileItems}
                    loginRoute={loginRoute}
                />
            </header>

            {children}

            <Footer />
        </div>
    );
}
