import type { BreadcrumbItem } from '@/types';
import type { PropsWithChildren } from 'react';
import Footer from './app-footer';
import Header from './header';
import TopHeader from './top-header';

export default function AppSidebarLayout({
    children,
}: PropsWithChildren<{
    breadcrumbs?: BreadcrumbItem[];
    authUser?: any;
    footerNavItems?: any;
    mainNavItems?: any;
    profileNavItems?: any;
}>) {
    return (
        <div className="overflow-x-hidden bg-white font-['Urbanist'] text-[#0E1339]">
            <header className="w-full">
                <TopHeader />
                <Header />
            </header>

            {children}

            <Footer />
        </div>
    );
}
