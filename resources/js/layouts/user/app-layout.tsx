import AppLayoutTemplate from '@/layouts/user/app/app-sidebar-layout';
import { type BreadcrumbItem } from '@/types';
import { type ReactNode } from 'react';
import { type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import { mainNavItems, footerNavItems, profileNavItems } from './side-menu';

interface AppLayoutProps {
    children: ReactNode;
    breadcrumbs?: BreadcrumbItem[];
    title: string;
}


export default ({ children, breadcrumbs, title, ...props }: AppLayoutProps) => {
    const { admin } = usePage<SharedData>().props;
    const appData = (usePage().props as any).appData ;
    
    return (
        <AppLayoutTemplate authUser={admin} mainNavItems={mainNavItems} footerNavItems={footerNavItems} profileNavItems={profileNavItems} breadcrumbs={breadcrumbs} {...props}>
            <Head title={`${title} - ${appData.name}`} />
            {children}
        </AppLayoutTemplate>
    );
};
