import { type NavItem } from '@/types';
import {
    BookOpen,
    FileSignature,
    FileText,
    Home,
    Image,
    Info,
    Layout,
    LayoutGrid,
    Link2,
    LogOut,
    MessageSquare,
    Newspaper,
    Phone,
    Server,
    Settings,
    ShieldCheck,
    User,
    Users,
    Users2,
    Notebook
} from 'lucide-react';

const mainNavItems = [
    {
        title: 'Dashboard',
        href: route('admin.dashboard'),
        icon: LayoutGrid,
    },
    {
        title: 'Admin',
        href: route('admin.admin.index'),
        icon: Users2,
        permission: ['all rights'],
    },
    {
        title: 'Role',
        href: route('admin.role.index'),
        icon: Notebook,
        permission: 'all rights',
    },
    {
        title: 'Permission',
        href: route('admin.permission.index'),
        icon: Notebook,
        permission: 'all rights',
    },
    {
        title: 'Partner',
        href: route('admin.partner.index'),
        icon: Users,
    },
    {
        title: 'User',
        href: route('admin.user.index'),
        icon: User,
    },
    {
        title: 'User Query',
        href: route('admin.userQuery.index'),
        icon: MessageSquare,
    },
    {
        title: 'Newsletter',
        href: route('admin.newsletter.index'),
        icon: Newspaper,
    },
    {
        title: 'Pages',
        icon: FileText,
        children: [
            { title: 'Home', href: route('admin.pages.homePage'), icon: Home },
            { title: 'About Us', href: route('admin.pages.aboutPage'), icon: Info },
            { title: 'Contact Us', href: route('admin.pages.contactPage'), icon: Phone },
            { title: 'Testimonial', href: route('admin.testimonial.index'), icon: MessageSquare },
            { title: 'Team', href: route('admin.team.index'), icon: MessageSquare },
            { title: 'Portfolio', href: route('admin.portfolio.index'), icon: Image },
            { title: 'Terms & Conditions', href: route('admin.pages.tncPage'), icon: FileSignature },
            { title: 'Privacy Policy', href: route('admin.pages.privacyPage'), icon: ShieldCheck },
            { title: 'Refund Policy', href: route('admin.pages.refundPage'), icon: ShieldCheck },
        ],
    },
    {
        title: 'Services',
        icon: Server,
        children: [
            { title: 'All Services', href: route('admin.service.index'), icon: Server },
            { title: 'Create Services', href: route('admin.service.create'), icon: FileSignature },
        ],
    },
    {
        title: 'Blogs',
        icon: BookOpen,
        children: [
            { title: 'All Blog', href: route('admin.blog.index'), icon: BookOpen },
            { title: 'Create Blog', href: route('admin.blog.create'), icon: FileSignature },
        ],
    },
    {
        title: 'Layouts',
        icon: Layout,
        children: [
            {
                title: 'Footer',
                href: null,
                icon: Layout,
                children: [{ title: 'Important Links', href: route('admin.important_links.index'), icon: Link2 }],
            },
        ],
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Settings',
        href: route('admin.settings.general'),
        icon: Settings,
    },
];
const profileNavItems: NavItem[] = [
    {
        title: 'Settings',
        href: route('admin.profile.edit'),
        icon: Settings,
    },
    {
        title: 'Log Out',
        href: route('admin.logout'),
        icon: LogOut,
    },
];

export { footerNavItems, mainNavItems, profileNavItems };
