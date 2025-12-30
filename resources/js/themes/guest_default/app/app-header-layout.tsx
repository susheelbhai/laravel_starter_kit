import type { PropsWithChildren } from "react";
import Footer from "./app-footer";
import Header from "./header";
import TopHeader from "./top-header";
import { FlashMessage, FlashType } from "@/components/ui/alert/flash1";
import { useEffect, useState, type ReactNode } from "react";
import { type BreadcrumbItem, type SharedData } from "@/types";
import { usePage } from "@inertiajs/react";

export default function AppHeaderLayout({
    children,
    menuItems,
    profileItems,
    loginRoute
}: PropsWithChildren<{
    breadcrumbs?: BreadcrumbItem[];
    authUser?: any;
    footerNavItems?: any;
    mainNavItems?: any;
    profileNavItems?: any;
    menuItems: any;
    profileItems: any;
    loginRoute:string
}>) {
    const page = usePage<SharedData>();
    console.log(menuItems);
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

        // ⏱ Auto-hide after 3 seconds if any flash is present
        if (flash.success || flash.warning || flash.error) {
            const timer = setTimeout(() => setVisibleFlash(null), 5000);
            return () => clearTimeout(timer);
        }
    }, [flash]);
    return (
        <div className="overflow-x-hidden bg-background text-[#0E1339]">
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
