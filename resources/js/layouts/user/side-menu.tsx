import { type NavItem } from '@/types';
import {
    BookOpen,
    FileSignature,
    FileText,
    Folder,
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
} from 'lucide-react';

const mainNavItems = [
    {
        title: 'Dashboard',
        href: route('user.dashboard'),
        icon: LayoutGrid,
    },
    {
        title: 'Partner',
        href: route('user.partner.index'),
        icon: Users,
    },
    {
        title: 'User',
        href: route('user.user.index'),
        icon: User,
    },
    {
        title: 'User Query',
        href: route('user.userQuery.index'),
        icon: MessageSquare,
    },
    {
        title: 'Newsletter',
        href: route('user.newsletter.index'),
        icon: Newspaper,
    },
    {
        title: 'Pages',
        icon: FileText,
        children: [
            { title: 'Home', href: route('user.pages.homePage'), icon: Home },
            { title: 'About Us', href: route('user.pages.aboutPage'), icon: Info },
            { title: 'Contact Us', href: route('user.pages.contactPage'), icon: Phone },
            { title: 'Testimonial', href: route('user.testimonial.index'), icon: MessageSquare },
            { title: 'Portfolio', href: route('user.portfolio.index'), icon: Image },
            { title: 'Terms & Conditions', href: route('user.pages.tncPage'), icon: FileSignature },
            { title: 'Privacy Policy', href: route('user.pages.privacyPage'), icon: ShieldCheck },
        ],
    },
    {
        title: 'Services',
        icon: Server,
        children: [
            { title: 'All Services', href: route('user.service.index'), icon: Server },
            { title: 'Create Services', href: route('user.service.create'), icon: FileSignature },
        ],
    },
    {
        title: 'Blogs',
        icon: BookOpen,
        children: [
            { title: 'All Blog', href: route('user.blog.index'), icon: BookOpen },
            { title: 'Create Blog', href: route('user.blog.create'), icon: FileSignature },
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
                children: [{ title: 'Important Links', href: route('user.important_links.index'), icon: Link2 }],
            },
        ],
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Footer Link 1',
        href: '/',
        icon: Folder,
    },
    {
        title: 'Footer Link 2',
        href: '/',
        icon: Folder,
    },
];
const profileNavItems: NavItem[] = [
    {
        title: 'Settings',
        href: route('user.profile.edit'),
        icon: Settings,
    },
    {
        title: 'Log Out',
        href: route('user.logout'),
        icon: LogOut,
    },
];

export { footerNavItems, mainNavItems, profileNavItems };
