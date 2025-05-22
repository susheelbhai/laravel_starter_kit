import { useState } from 'react';
import { Link, usePage } from '@inertiajs/react';
import { FaFacebookF, FaInstagram, FaLinkedin, FaTwitter, FaBars, FaTimes } from 'react-icons/fa';
import Footer from './app-footer';
import type { PropsWithChildren } from 'react';
import type { BreadcrumbItem } from '@/types';

export default function AppSidebarLayout({
  children,
}: PropsWithChildren<{
  breadcrumbs?: BreadcrumbItem[];
  authUser?: any;
  footerNavItems?: any;
  mainNavItems?: any;
  profileNavItems?: any;
}>) {
  const { appData } = usePage().props as any;
  const [menuOpen, setMenuOpen] = useState(false);

  return (
    <div className="overflow-x-hidden bg-white font-['Urbanist'] text-[#0E1339]">
      {/* Header */}
      <header className="w-full">
        {/* Top Bar */}
        <div className="border-b border-gray-200 bg-white py-2">
          <div className="mx-auto flex max-w-[1320px] items-center justify-between px-4 text-sm text-gray-600">
            <div className="flex items-center space-x-4">
              <a href={`mailto:${appData.email}`}>{appData.email}</a>
              <span className="mx-2 hidden h-4 border-l border-gray-300 md:inline-block"></span>
              <span className="hidden md:inline-block">Working: 8.00am - 5.00pm</span>
            </div>
            <div className="hidden space-x-4 md:flex">
              {appData.facebook && (
                <a href={appData.facebook} target="_blank" rel="noopener noreferrer" className="hover:text-[#FAB915]">
                  <FaFacebookF className="h-5 w-5" />
                </a>
              )}
              {appData.twitter && (
                <a href={appData.twitter} target="_blank" rel="noopener noreferrer" className="hover:text-[#FAB915]">
                  <FaTwitter className="h-5 w-5" />
                </a>
              )}
              {appData.linkedin && (
                <a href={appData.linkedin} target="_blank" rel="noopener noreferrer" className="hover:text-[#FAB915]">
                  <FaLinkedin className="h-5 w-5" />
                </a>
              )}
              {appData.instagram && (
                <a href={appData.instagram} target="_blank" rel="noopener noreferrer" className="hover:text-[#FAB915]">
                  <FaInstagram className="h-5 w-5" />
                </a>
              )}
            </div>
          </div>
        </div>

        {/* Sticky Navbar */}
        <div className="sticky top-0 z-50 bg-white shadow">
          <div className="mx-auto flex max-w-[1320px] items-center justify-between px-4 py-4">
            {/* Logo */}
            <div className="text-xl font-bold">
              <Link href="/" className="flex items-center">
                <img src={`/${appData.dark_logo}`} alt="Logo" className="h-10 w-auto" />
              </Link>
            </div>

            {/* Desktop Menu */}
            <nav className="hidden space-x-6 text-sm font-medium text-gray-700 md:flex">
              <Link href="/" className="hover:text-[#FAB915]">Home</Link>
              <Link href={route('about')} className="hover:text-[#FAB915]">About</Link>
              <Link href={route('services')} className="hover:text-[#FAB915]">Services</Link>
              <Link href={route('blog.index')} className="hover:text-[#FAB915]">Blogs</Link>
              <Link href={route('contact')} className="hover:text-[#FAB915]">Contact</Link>
            </nav>

            {/* Mobile Menu Toggle */}
            <button onClick={() => setMenuOpen(!menuOpen)} className="md:hidden text-xl">
              {menuOpen ? <FaTimes /> : <FaBars />}
            </button>
          </div>

          {/* Mobile Menu Dropdown */}
          {menuOpen && (
            <div className="md:hidden bg-white px-4 pb-4 shadow">
              <nav className="flex flex-col space-y-2 text-sm font-medium text-gray-700">
                <Link href="/" className="hover:text-[#FAB915]" onClick={() => setMenuOpen(false)}>Home</Link>
                <Link href={route('about')} className="hover:text-[#FAB915]" onClick={() => setMenuOpen(false)}>About</Link>
                <Link href={route('services')} className="hover:text-[#FAB915]" onClick={() => setMenuOpen(false)}>Services</Link>
                <Link href={route('blog.index')} className="hover:text-[#FAB915]">Blogs</Link>
                <Link href={route('contact')} className="hover:text-[#FAB915]" onClick={() => setMenuOpen(false)}>Contact</Link>
              </nav>
            </div>
          )}
        </div>
      </header>

      {/* Content */}
      {children}

      {/* Footer */}
      <Footer />
    </div>
  );
}
