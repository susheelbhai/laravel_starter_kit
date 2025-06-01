import { Link, usePage } from '@inertiajs/react';
import React, { useState } from 'react';
import { FaBars, FaTimes, FaLinkedinIn, FaTwitter } from 'react-icons/fa';

const Header: React.FC = () => {
    const appData = (usePage().props as any).appData;
    const [menuOpen, setMenuOpen] = useState(false);

    return (
        <div className="sticky top-0 z-50 bg-white shadow">
        <div className="mx-auto flex max-w-[1320px] items-center justify-between px-4 py-4">
          {/* Logo */}
          <div className="text-xl font-bold">
            <Link href="/" className="flex items-center">
              <img src={appData.dark_logo} alt="Logo" className="h-10 w-auto" />
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
    );
};

export default Header;
