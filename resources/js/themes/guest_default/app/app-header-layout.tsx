import { usePage } from "@inertiajs/react";
import type { PropsWithChildren } from "react";
import { useEffect, useState } from "react";
import type { FlashType } from "@/components/ui/alert/flash1";
import { FlashMessage } from "@/components/ui/alert/flash1";
import { type BreadcrumbItem, type SharedData } from "@/types";
import Footer from "./app-footer";
import Header from "./header";
import TopHeader from "./top-header";

interface MenuItem {
    title: string;
    href: string;
    icon?: React.ComponentType;
}

interface ProfileItem {
    title: string;
    href: string;
    icon?: React.ComponentType;
}

export default function AppHeaderLayout({
    children,
    menuItems,
    profileItems,
    loginRoute
}: PropsWithChildren<{
    breadcrumbs?: BreadcrumbItem[];
    authUser?: { name: string; email: string };
    footerNavItems?: MenuItem[];
    mainNavItems?: MenuItem[];
    profileNavItems?: ProfileItem[];
    menuItems: MenuItem[];
    profileItems: ProfileItem[];
    loginRoute: string;
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
        // Use a timeout to avoid calling setState directly in effect
        const timer = setTimeout(() => {
            if (flash.success) {
                setVisibleFlash({ type: "success", message: flash.success });
            } else if (flash.warning) {
                setVisibleFlash({ type: "warning", message: flash.warning });
            } else if (flash.error) {
                setVisibleFlash({ type: "error", message: flash.error });
            } else {
                setVisibleFlash(null);
            }
        }, 0);

        // ⏱ Auto-hide after 3 seconds if any flash is present
        if (flash.success || flash.warning || flash.error) {
            const hideTimer = setTimeout(() => setVisibleFlash(null), 5000);
            return () => {
                clearTimeout(timer);
                clearTimeout(hideTimer);
            };
        }

        return () => clearTimeout(timer);
    }, [flash]);
    return (
        <div className="overflow-x-hidden bg-background text-foreground">
            <header className="w-full">
                <TopHeader />
                <Header menuItems={menuItems} profileItems={profileItems} loginRoute={loginRoute} />
            </header>

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

            <Footer />
        </div>
    );
}
