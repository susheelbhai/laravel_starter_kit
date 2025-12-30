import AppearanceToggleDropdown from '@/components/appearance-dropdown';
import { usePage } from '@inertiajs/react';
import React from 'react';
import {
    FaFacebookF,
    FaInstagram,
    FaLinkedinIn,
    FaTwitter,
    FaYoutube,
    FaEnvelope,
} from 'react-icons/fa';

const TopHeader: React.FC = () => {
    const appData = (usePage().props as any).appData;

    return (
        <div className="border-b border-gray-200 bg-primary/5 backdrop-blur dark:border-slate-800 dark:bg-slate-900/80">
            <div className="mx-auto flex items-center justify-between px-4 py-2 text-xs text-gray-600 sm:text-sm dark:text-slate-200">
                {/* Left: Email + Working hours */}
                <div className="flex items-center gap-3 sm:gap-4">
                    <a
                        href={`mailto:${appData.email}`}
                        className="inline-flex items-center gap-2 font-medium text-gray-700 transition-colors hover:text-primary dark:text-slate-100"
                    >
                        <FaEnvelope className="h-3.5 w-3.5" />
                        <span className="truncate">{appData.email}</span>
                    </a>

                    <span className="hidden h-4 w-px bg-gray-300 md:inline-block dark:bg-slate-600" />

                    <span className="hidden text-xs text-gray-500 md:inline-block dark:text-slate-300">
                        Working:&nbsp;
                        <span className="font-medium text-gray-700 dark:text-slate-100">
                            8:00am – 5:00pm
                        </span>
                    </span>
                </div>

                {/* Right: Social icons + Theme toggle */}
                <div className="flex items-center gap-3 sm:gap-4">
                    <div className="hidden items-center gap-2 md:flex">
                        {appData.facebook && (
                            <a
                                href={appData.facebook}
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="Facebook"
                                className="flex h-8 w-8 items-center justify-center rounded-full border border-gray-200 text-gray-500 transition-all hover:-translate-y-0.5 hover:border-primary/40 hover:bg-primary/5 hover:text-primary dark:border-slate-700 dark:text-slate-200 dark:hover:border-primary/60"
                            >
                                <FaFacebookF className="h-3.5 w-3.5" />
                            </a>
                        )}
                        {appData.twitter && (
                            <a
                                href={appData.twitter}
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="Twitter"
                                className="flex h-8 w-8 items-center justify-center rounded-full border border-gray-200 text-gray-500 transition-all hover:-translate-y-0.5 hover:border-primary/40 hover:bg-primary/5 hover:text-primary dark:border-slate-700 dark:text-slate-200 dark:hover:border-primary/60"
                            >
                                <FaTwitter className="h-3.5 w-3.5" />
                            </a>
                        )}
                        {appData.linkedin && (
                            <a
                                href={appData.linkedin}
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="LinkedIn"
                                className="flex h-8 w-8 items-center justify-center rounded-full border border-gray-200 text-gray-500 transition-all hover:-translate-y-0.5 hover:border-primary/40 hover:bg-primary/5 hover:text-primary dark:border-slate-700 dark:text-slate-200 dark:hover:border-primary/60"
                            >
                                <FaLinkedinIn className="h-3.5 w-3.5" />
                            </a>
                        )}
                        {appData.instagram && (
                            <a
                                href={appData.instagram}
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="Instagram"
                                className="flex h-8 w-8 items-center justify-center rounded-full border border-gray-200 text-gray-500 transition-all hover:-translate-y-0.5 hover:border-primary/40 hover:bg-primary/5 hover:text-primary dark:border-slate-700 dark:text-slate-200 dark:hover:border-primary/60"
                            >
                                <FaInstagram className="h-3.5 w-3.5" />
                            </a>
                        )}
                        {appData.youtube && (
                            <a
                                href={appData.youtube}
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="YouTube"
                                className="flex h-8 w-8 items-center justify-center rounded-full border border-gray-200 text-gray-500 transition-all hover:-translate-y-0.5 hover:border-primary/40 hover:bg-primary/5 hover:text-primary dark:border-slate-700 dark:text-slate-200 dark:hover:border-primary/60"
                            >
                                <FaYoutube className="h-3.5 w-3.5" />
                            </a>
                        )}
                    </div>

                    <span className="hidden h-4 w-px bg-gray-300 md:inline-block dark:bg-slate-600" />

                    <AppearanceToggleDropdown />
                </div>
            </div>
        </div>
    );
};

export default TopHeader;
