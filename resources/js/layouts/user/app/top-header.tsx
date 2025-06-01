import { usePage } from '@inertiajs/react';
import React from 'react';
import { FaFacebookF, FaInstagram, FaLinkedinIn, FaTwitter, FaYoutube } from 'react-icons/fa';

const TopHeader: React.FC = () => {
    const appData = (usePage().props as any).appData;
    return (
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
                            <FaLinkedinIn className="h-5 w-5" />
                        </a>
                    )}
                    {appData.instagram && (
                        <a href={appData.instagram} target="_blank" rel="noopener noreferrer" className="hover:text-[#FAB915]">
                            <FaInstagram className="h-5 w-5" />
                        </a>
                    )}
                    {appData.youtube && (
                        <a href={appData.youtube} target="_blank" rel="noopener noreferrer" className="hover:text-[#FAB915]">
                            <FaYoutube className="h-5 w-5" />
                        </a>
                    )}
                </div>
            </div>
        </div>
    );
};

export default TopHeader;
