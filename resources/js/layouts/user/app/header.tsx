import { Link, usePage } from '@inertiajs/react';
import React, { useState } from 'react';
import { FaBars, FaTimes } from 'react-icons/fa';
import AuthSection from './auth-section';

// Helper to check if route exists
const routeExists = (name: string): boolean => {
    try {
        route(name);
        return true;
    } catch {
        return false;
    }
};

const Header: React.FC = () => {
    const appData = (usePage().props as any).appData;
    const user = (usePage().props as any).auth?.user;
    const loginExists = routeExists('login');
    const [menuOpen, setMenuOpen] = useState(false);

    // Main menu items
    let menuItems = [
        { name: 'Home', route: route('home') },
        { name: 'About', route: route('about') },
        { name: 'Product', route: route('product.index') },
        { name: 'Services', route: route('services') },
        { name: 'Blogs', route: route('blog.index') },
        { name: 'Contact', route: route('contact') },
    ];

    if (user != null && user.user_type_id == '1') {
        menuItems = [
            { name: 'Dashboard', route: route('dashboard') },
            { name: 'About', route: route('about') },
            { name: 'Product', route: route('product.index') },
            { name: 'Services', route: route('services') },
            { name: 'Blogs', route: route('blog.index') },
            { name: 'Contact', route: route('contact') },
        ];
    }

    if (user != null && user.user_type_id == '2') {
        menuItems = [
            { name: 'Browse Festival', route: route('festivals.index') },
            { name: 'About', route: route('about') },
            { name: 'Product', route: route('product.index') },
            { name: 'Services', route: route('services') },
            { name: 'Blogs', route: route('blog.index') },
            { name: 'Contact', route: route('contact') },
        ];
    }

    return (
        <header className="sticky top-0 z-50 bg-white/90 shadow-sm backdrop-blur-xl">
            <div className="mx-auto flex max-w-[1320px] items-center justify-between px-4 py-3.5 md:py-4">
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
                    {menuItems.map((item) => (
                        <Link
                            key={item.name}
                            href={item.route}
                            className="rounded-full px-3 py-2 transition-colors hover:bg-slate-100 hover:text-[#FAB915]"
                        >
                            {item.name}
                        </Link>
                    ))}
                </nav>

                {/* Right: Profile / Login (Desktop) */}
                {loginExists && <AuthSection />}

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
                        {menuItems.map((item) => (
                            <Link
                                key={item.name}
                                href={item.route}
                                className="rounded-lg px-3 py-2 transition-colors hover:bg-slate-100 hover:text-[#FAB915]"
                                onClick={() => setMenuOpen(false)}
                            >
                                {item.name}
                            </Link>
                        ))}

                        {/* Mobile Profile / Login */}
                        {loginExists && <AuthSection isMobile />}
                    </nav>
                </div>
            )}
        </header>
    );
};

export default Header;
