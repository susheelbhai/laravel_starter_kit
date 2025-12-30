import Button from "@/components/button";
import { Link, usePage } from "@inertiajs/react";
import React, { useState } from "react";

interface AuthSectionProps {
    isMobile?: boolean;
    profileItems: any;
    loginRoute: string;
}

// Helper to check if route exists
const routeExists = (name: string): boolean => {
    try {
        route(name);
        return true;
    } catch {
        return false;
    }
};

export default function AuthSection({
    isMobile = false,
    profileItems,
    loginRoute,
}: AuthSectionProps) {
    const user = (usePage().props as any).auth?.user;
    const loginExists = routeExists(loginRoute);
    const [profileOpen, setProfileOpen] = useState(false);

    // Profile menu items (only show if loginExists)
    const profileItems1 = loginExists ? profileItems : [];

    const renderProfileMenu = () => (
        <div
            className={
                isMobile
                    ? ""
                    : "absolute right-0 z-50 mt-2 w-48 overflow-hidden rounded-xl bg-white shadow-lg ring-1 ring-slate-200"
            }
        >
            <ul className="py-1 text-sm text-slate-700">
                {profileItems1.map((item: any) => (
                    <li key={item.name}>
                        {item.method ? (
                            <Link
                                href={route(item.routeName)}
                                method={item.method as any}
                                as="button"
                                className="block w-full px-4 py-2 text-left hover:bg-slate-50"
                            >
                                {item.name}
                            </Link>
                        ) : (
                            <Link
                                href={route(item.routeName)}
                                className="block px-4 py-2 hover:bg-slate-50"
                            >
                                {item.name}
                            </Link>
                        )}
                    </li>
                ))}
            </ul>
        </div>
    );

    // Desktop view
    if (!isMobile) {
        return (
            <div className="hidden items-center md:flex">
                {user ? (
                    <div className="relative ml-4">
                        <button
                            onClick={() => setProfileOpen((prev) => !prev)}
                            className="flex h-10 w-10 items-center justify-center overflow-hidden rounded-full border border-slate-200 bg-slate-50 transition hover:border-[#FAB915]"
                        >
                            <img
                                src={user?.profile_pic || "/default-avatar.png"}
                                alt="Profile"
                                className="h-full w-full object-cover"
                            />
                        </button>
                        {profileOpen && renderProfileMenu()}
                    </div>
                ) : loginExists ? (
                    <div className="ml-4">
                        <Button
                            className="inline-block"
                            href={route(loginRoute)}
                            text="Login"
                        />
                    </div>
                ) : null}
            </div>
        );
    }

    // Mobile view
    return (
        <>
            {user ? (
                <div className="mt-3 border-t border-slate-200 pt-3">
                    <button
                        onClick={() => setProfileOpen((prev) => !prev)}
                        className="flex items-center gap-2 rounded-lg px-2 py-2"
                    >
                        <img
                            src={user?.profile_pic || "/default-avatar.png"}
                            alt="Profile"
                            className="h-9 w-9 rounded-full border border-slate-200 object-cover"
                        />
                        <span className="text-sm font-semibold">Account</span>
                    </button>
                    {profileOpen && (
                        <div className="mt-1 rounded-xl border border-slate-200 bg-white">
                            {renderProfileMenu()}
                        </div>
                    )}
                </div>
            ) : loginExists ? (
                <div className="mt-3 border-t border-slate-200 pt-3">
                    <Button href={route(loginRoute)} text="Login" />
                </div>
            ) : null}
        </>
    );
}
