import React, { useState } from "react";
import { Link, usePage } from "@inertiajs/react";
import { FaBars, FaTimes } from "react-icons/fa";
import Button from "@/components/button";

const Header: React.FC = () => {
  const appData = (usePage().props as any).appData;
  const user = (usePage().props as any).auth?.user;
  const [menuOpen, setMenuOpen] = useState(false);
  const [profileOpen, setProfileOpen] = useState(false);

  // Main menu items
  let menuItems = [
    { name: "Home", route: route("home") },
    { name: "About", route: route("about") },
    { name: "Product", route: route("product") },
    { name: "Services", route: route("services") },
    { name: "Blogs", route: route("blog.index") },
    { name: "Contact", route: route("contact") },
  ];

  if (user != null && user.user_type_id == "1") {
    menuItems = [
      { name: "Dashboard", route: route("dashboard") },
      { name: "Browse Festival", route: route("festivals.index") },
      { name: "My Festival", route: route("my-events.edit") },
      { name: "Submission", route: route("organiser.submitted-project.index") },
      { name: "Festival Marketing", route: route("marketing_package.index") },
    ];
  }

  if (user != null && user.user_type_id == "2") {
    menuItems = [
      { name: "Browse Festival", route: route("festivals.index") },
      { name: "My project", route: route("my-project.index") },
      { name: "Submission", route: route("order.index") },
      { name: "Membership", route: route("gold-membership.index") },
      { name: "Student", route: route("submitter-students.index") },
      { name: "Cart", route: route("cart.index") },
    ];
  }

  // Profile menu items
  const profileItems = [
    { name: "Profile", route: route("profile.edit") },
    { name: "Logout", route: route("logout"), method: "post" },
  ];

  const renderProfileMenu = () => (
    <div className="absolute right-0 z-50 mt-2 w-48 overflow-hidden rounded-xl bg-white shadow-lg ring-1 ring-slate-200">
      <ul className="py-1 text-sm text-slate-700">
        {profileItems.map((item) => (
          <li key={item.name}>
            {item.method ? (
              <Link
                href={item.route}
                method={item.method as any}
                as="button"
                className="block w-full px-4 py-2 text-left hover:bg-slate-50"
              >
                {item.name}
              </Link>
            ) : (
              <Link
                href={item.route}
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
          ) : (
            <div className="ml-4">
              <Button
                className="inline-block"
                href={route("login")}
                text="Login"
              />
            </div>
          )}
        </div>

        {/* Mobile Menu Toggle */}
        <button
          onClick={() => {
            setMenuOpen((prev) => !prev);
            setProfileOpen(false);
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
            ) : (
              <div className="mt-3 border-t border-slate-200 pt-3">
                <Button href={route("login")} text="Login" />
              </div>
            )}
          </nav>
        </div>
      )}
    </header>
  );
};

export default Header;
