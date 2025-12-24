import { type NavItem } from '@/types';
import {
    BookOpen,
    Box,
    Calendar,
    FileEdit,
    FileSignature,
    FileText,
    FileUp,
    FolderTree,
    Home,
    Image,
    ImageUp,
    Info,
    Key,
    Layout,
    LayoutGrid,
    Link2,
    ListFilter,
    Lock,
    LogOut,
    MessageSquare,
    Newspaper,
    Notebook,
    Phone,
    Server,
    Settings,
    Shield,
    ShieldCheck,
    User,
    Users,
    Users2,
    Workflow,
} from 'lucide-react';

// Helper to check if route exists
const routeExists = (name: string | null): boolean => {
    if (!name) return false;
    try {
        route(name);
        return true;
    } catch {
        return false;
    }
};

// Helper to filter menu items based on route existence
const filterMenuItems = (items: any[]): NavItem[] => {
    return items
        .filter((item) => {
            // If item has routeName, check if route exists
            if (item.routeName && !routeExists(item.routeName)) {
                return false;
            }
            return true;
        })
        .map((item) => {
            // Create route pattern by removing .index/.create/.edit/.show
            const routePattern = item.routeName 
                ? item.routeName.replace(/\.(index|create|edit|show)$/, '') 
                : null;
            
            const processedItem = {
                ...item,
                href: item.routeName ? route(item.routeName) : item.href,
                routePattern: routePattern,
            };
            delete processedItem.routeName;

            // If item has children, recursively filter them and check for siblings
            if (processedItem.children) {
                // First, process all children
                const filteredChildren = filterMenuItems(processedItem.children);
                
                // Check which children have siblings (same route pattern)
                const patternCounts = new Map<string, number>();
                filteredChildren.forEach((child: any) => {
                    if (child.routePattern) {
                        patternCounts.set(child.routePattern, (patternCounts.get(child.routePattern) || 0) + 1);
                    }
                });
                
                // Mark children that have siblings
                const childrenWithSiblingFlags = filteredChildren.map((child: any) => {
                    const hasSiblingRoutes = child.routePattern && (patternCounts.get(child.routePattern) || 0) > 1;
                    return { ...child, hasSiblingRoutes };
                });
                
                // Only include parent if it has visible children or its own href
                if (childrenWithSiblingFlags.length === 0 && !processedItem.href) {
                    return null;
                }
                return { ...processedItem, children: childrenWithSiblingFlags };
            }
            return processedItem;
        })
        .filter((item): item is NavItem => item !== null);
};

const mainNavItems = [
    {
        title: 'Dashboard',
        routeName: 'admin.dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Category',
        routeName: 'admin.product_category.index',
        icon: FolderTree,
    },
    {
        title: 'Product',
        routeName: 'admin.product.index',
        icon: Box,
    },
    {
        title: 'Product Enquiry',
        routeName: 'admin.productEnquiry.index',
        icon: MessageSquare,
    },
    {
        title: 'Admin',
        routeName: 'admin.admin.index',
        icon: Users2,
        permission: ['all rights'],
    },
    {
        title: 'Role',
        routeName: 'admin.role.index',
        icon: Shield,
        permission: 'all rights',
    },
    {
        title: 'Permission',
        routeName: 'admin.permission.index',
        icon: Key,
        permission: 'all rights',
    },
    {
        title: 'Seller',
        routeName: 'admin.seller.index',
        icon: User,
    },
    {
        title: 'Partner',
        routeName: 'admin.partner.index',
        icon: Users,
    },
    {
        title: 'User',
        routeName: 'admin.user.index',
        icon: User,
    },
    {
        title: 'User Query',
        routeName: 'admin.userQuery.index',
        icon: MessageSquare,
    },
    {
        title: 'Newsletter',
        routeName: 'admin.newsletter.index',
        icon: Newspaper,
    },
    {
        title: 'Forms',
        icon: FileText,
        children: [
            {
                title: 'Simple',
                routeName: 'admin.forms.simple',
                icon: Notebook,
            },
            {
                title: 'Editor',
                routeName: 'admin.forms.editor',
                icon: FileEdit,
            },
            { title: 'Date', routeName: 'admin.forms.date', icon: Calendar },
            {
                title: 'Select',
                routeName: 'admin.forms.select',
                icon: ListFilter,
            },
            { title: 'File', routeName: 'admin.forms.file', icon: FileUp },
            { title: 'Image', routeName: 'admin.forms.image', icon: ImageUp },
            {
                title: 'Widzard',
                routeName: 'admin.forms.wizard',
                icon: Workflow,
            },
        ],
    },

    {
        title: 'Pages',
        icon: FileText,
        children: [
            { title: 'Auth', routeName: 'admin.pages.authPage', icon: Home },
            { title: 'Home', routeName: 'admin.pages.homePage', icon: Home },
            {
                title: 'About Us',
                routeName: 'admin.pages.aboutPage',
                icon: Info,
            },
            {
                title: 'Contact Us',
                routeName: 'admin.pages.contactPage',
                icon: Phone,
            },
            {
                title: 'Testimonial',
                routeName: 'admin.testimonial.index',
                icon: MessageSquare,
            },
            {
                title: 'Team',
                routeName: 'admin.team.index',
                icon: MessageSquare,
            },
            {
                title: 'Portfolio',
                routeName: 'admin.portfolio.index',
                icon: Image,
            },
            {
                title: 'FAQ',
                routeName: 'admin.faq.index',
                icon: Image,
            },
            {
                title: 'Terms & Conditions',
                routeName: 'admin.pages.tncPage',
                icon: FileSignature,
            },
            {
                title: 'Privacy Policy',
                routeName: 'admin.pages.privacyPage',
                icon: ShieldCheck,
            },
            {
                title: 'Refund Policy',
                routeName: 'admin.pages.refundPage',
                icon: ShieldCheck,
            },
        ],
    },
    {
        title: 'Services',
        icon: Server,
        children: [
            {
                title: 'All Services',
                routeName: 'admin.service.index',
                icon: Server,
            },
            {
                title: 'Create Services',
                routeName: 'admin.service.create',
                icon: FileSignature,
            },
        ],
    },
    {
        title: 'Blogs',
        icon: BookOpen,
        children: [
            {
                title: 'All Blog',
                routeName: 'admin.blog.index',
                icon: BookOpen,
            },
            {
                title: 'Create Blog',
                routeName: 'admin.blog.create',
                icon: FileSignature,
            },
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
                children: [
                    {
                        title: 'Important Links',
                        routeName: 'admin.important_links.index',
                        icon: Link2,
                    },
                ],
            },
        ],
    },
];

const footerNavItems = [
    {
        title: 'Settings',
        routeName: 'admin.settings.general',
        icon: Settings,
    },
];
const profileNavItems = [
    {
        title: 'Settings',
        routeName: 'admin.profile.edit',
        icon: Settings,
    },
    {
        title: 'Log Out',
        routeName: 'admin.logout',
        icon: LogOut,
    },
];

export const filteredMainNavItems = filterMenuItems(mainNavItems);
export const filteredFooterNavItems = filterMenuItems(footerNavItems);
export const filteredProfileNavItems = filterMenuItems(profileNavItems);

export { footerNavItems, mainNavItems, profileNavItems };
