import { Link, usePage } from "@inertiajs/react";
import { useState } from "react";
import { FaBars, FaTimes } from "react-icons/fa";
import AuthSection from "./auth-section";

const routeExists = (name: string): boolean => {
    try {
        route(name);
        return true;
    } catch {
        return false;
    }
};

export default function Header({
    menuItems,
    profileItems,
    loginRoute
}: {
    menuItems: any;
    profileItems: any;
    loginRoute: string;
}) {
    const appData = (usePage().props as any).appData;
    const loginExists = routeExists(loginRoute);
    const [menuOpen, setMenuOpen] = useState(false);

    return (
        <header className="sticky top-0 z-50 bg-white/90 shadow-sm backdrop-blur-xl">
            <div className="mx-auto flex items-center justify-between px-4 py-3.5 md:py-4">
                {/* Logo */}
                <div className="flex items-center gap-2">
                    <Link href="/" className="flex items-center">
                        <img
                            src={appData.dark_logo}
                            alt="Logo"
                            className="h-10 w-auto md:h-12"
                        />
                    </Link>
                </div>

                {/* Desktop Menu */}
                <nav className="hidden items-center gap-1 text-sm font-medium text-slate-700 md:flex">
                    {menuItems.map((item: any) => (
                        <Link
                            key={item.name}
                            href={route(item.routeName)}
                            className="rounded-full px-3 py-2 transition-colors hover:bg-slate-100 hover:text-[#FAB915]"
                        >
                            {item.name}
                        </Link>
                    ))}
                </nav>

                {/* Right: Profile / Login (Desktop) */}
                {loginExists && <AuthSection profileItems={profileItems} loginRoute={loginRoute} />}

                {/* Mobile Menu Toggle */}
                <button
                    onClick={() => {
                        setMenuOpen((prev) => !prev);
                    }}
                    className="flex items-center text-xl text-slate-700 md:hidden"
                >
                    {menuOpen ? <FaTimes /> : <FaBars />}
                </button>
            </div>

            {/* Mobile Menu Dropdown */}
            {menuOpen && (
                <div className="border-t border-slate-200 bg-white px-4 pb-4 shadow md:hidden">
                    <nav className="flex flex-col space-y-1.5 pt-3 text-sm font-medium text-slate-700">
                        {menuItems.map((item: any) => (
                            <Link
                                key={item.name}
                                href={route(item.routeName)}
                                className="rounded-lg px-3 py-2 transition-colors hover:bg-slate-100 hover:text-[#FAB915]"
                                onClick={() => setMenuOpen(false)}
                            >
                                {item.name}
                            </Link>
                        ))}

                        {/* Mobile Profile / Login */}
                        {loginExists && (
                            <AuthSection profileItems={profileItems} loginRoute={loginRoute} isMobile />
                        )}
                    </nav>
                </div>
            )}
        </header>
    );
}
