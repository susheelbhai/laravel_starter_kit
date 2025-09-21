import Button from '@/components/button';
import { Link, usePage } from '@inertiajs/react';
import React, { useState } from 'react';
import { FaBars, FaTimes } from 'react-icons/fa';

const Header: React.FC = () => {
    const appData = (usePage().props as any).appData;
    const user = (usePage().props as any).auth?.user;
    const [menuOpen, setMenuOpen] = useState(false);
    const [profileOpen, setProfileOpen] = useState(false);


  
    let menuItems = [
        { name: 'Home', route: route('home') },
        { name: 'About', route: route('about') },
        { name: 'Services', route: route('services') },
        { name: 'Blogs', route: route('blog.index') },
        { name: 'Contact', route: route('contact') },
    ];
    if (user != null && user.user_type_id == '1') {
        menuItems = [
            { name: 'Dashboard', route: route('dashboard') },
            { name: 'Browse Festival', route: route('festivals.index') },
            { name: 'My Festival', route: route('my-events.edit') },
            { name: 'Submission', route: route('organiser.submitted-project.index') },
            { name: 'Festival Marketing', route: route('marketing_package.index') },
        ];
    }
    if (user != null && user.user_type_id == '2') {
        menuItems = [
            // { name: 'Dashboard', route: route('dashboard') },
            { name: 'Browse Festival', route: route('festivals.index') },
            { name: 'My project', route: route('my-project.index') },
            { name: 'Submission', route: route('order.index') },
            { name: 'Membership', route: route('gold-membership.index') },
            { name: 'Student', route: route('submitter-students.index') },
            { name: 'Cart', route: route('cart.index') },
        ];
    }
    // Main menu items

    // Profile menu items
    const profileItems = [
        { name: 'Profile', route: route('profile.edit') },
        { name: 'Logout', route: route('logout'), method: 'post' },
    ];

    const renderProfileMenu = () => (
        <div className="absolute right-0 z-50 mt-2 w-48 rounded-md bg-white shadow-lg">
            <ul className="py-2">
                {profileItems.map((item) => (
                    <li key={item.name}>
                        {item.method ? (
                            <Link
                                href={item.route}
                                method={item.method}
                                as="button"
                                className="block w-full px-4 py-2 text-left text-sm hover:bg-gray-100"
                            >
                                {item.name}
                            </Link>
                        ) : (
                            <Link href={item.route} className="block px-4 py-2 text-sm hover:bg-gray-100">
                                {item.name}
                            </Link>
                        )}
                    </li>
                ))}
            </ul>
        </div>
    );

    return (
        <div className="sticky top-0 z-50 bg-white shadow">
            <div className="mx-auto flex max-w-[1320px] items-center justify-between px-4 py-4">
                {/* Logo */}
                <div className="text-xl font-bold">
                    <Link href="/" className="flex items-center">
                        <img src={appData.dark_logo} alt="Logo" className="h-12 w-auto" />
                    </Link>
                </div>

                {/* Desktop Menu */}
                <nav className="hidden space-x-6 text-sm font-medium text-gray-700 md:flex">
                    {menuItems.map((item) => (
                        <Link key={item.name} href={item.route} className="hover:text-[#FAB915]">
                            {item.name}
                        </Link>
                    ))}
                </nav>

                {/* Profile Menu (Desktop) */}
                {user ? (
                    <div className="relative ml-4 hidden md:block">
                        <button onClick={() => setProfileOpen(!profileOpen)} className="focus:outline-none">
                            <img src={user?.profile_pic || '/default-avatar.png'} alt="Profile" className="h-10 w-10 rounded-full border" />
                        </button>
                        {profileOpen && renderProfileMenu()}
                    </div>
                ) : (
                    <div className="relative ml-4 hidden md:block">
                        <Button className='inline-block mx-2' href={route('login')} text="Login" />
                    </div>
                )}

                {/* Mobile Menu Toggle */}
                <button onClick={() => setMenuOpen(!menuOpen)} className="text-xl md:hidden">
                    {menuOpen ? <FaTimes /> : <FaBars />}
                </button>
            </div>

            {/* Mobile Menu Dropdown */}
            {menuOpen && (
                <div className="bg-white px-4 pb-4 shadow md:hidden">
                    <nav className="flex flex-col space-y-2 text-sm font-medium text-gray-700">
                        {menuItems.map((item) => (
                            <Link key={item.name} href={item.route} className="hover:text-[#FAB915]" onClick={() => setMenuOpen(false)}>
                                {item.name}
                            </Link>
                        ))}
                        {/* Profile Menu (Mobile) */}
                        {user ? (
                            <div className="mt-4 border-t pt-2">
                                <button onClick={() => setProfileOpen(!profileOpen)} className="flex items-center space-x-2 focus:outline-none">
                                    <img src={user?.profile_pic || '/default-avatar.png'} alt="Profile" className="h-10 w-10 rounded-full border" />
                                    <span className="font-medium">Profile</span>
                                </button>
                                {profileOpen && renderProfileMenu()}
                            </div>
                        ) : (
                            <div className="relative">
                                <Button href={route('login')} text="Login" />
                            </div>
                        )}
                    </nav>
                </div>
            )}
        </div>
    );
};

export default Header;
