import type { BreadcrumbItem } from "@/types";
import type { PropsWithChildren } from "react";
import Footer from "./app-footer";
import Header from "./header";
import TopHeader from "./top-header";

export default function AppSidebarLayout({
    children,
    menuItems,
    profileItems,
    loginRoute,
}: PropsWithChildren<{
    breadcrumbs?: BreadcrumbItem[];
    authUser?: any;
    footerNavItems?: any;
    mainNavItems?: any;
    profileNavItems?: any;
    menuItems: any;
    profileItems: any;
    loginRoute: string;
}>) {
    return (
        <div className="overflow-x-hidden bg-background text-[#0E1339]">
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
