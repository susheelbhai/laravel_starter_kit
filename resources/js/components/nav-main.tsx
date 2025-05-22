import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem
} from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/react';
import { ChevronDown, ChevronUp } from 'lucide-react';
import { useState } from 'react';

export function NavMain({ items = [] }: { items: NavItem[] }) {
    return (
        <SidebarGroup className="px-2 py-0">
            <SidebarGroupLabel>Platform</SidebarGroupLabel>
            <SidebarMenu>
                {items.map((item) => (
                    <SidebarMenuTree key={item.title} item={item} level={0} />
                ))}
            </SidebarMenu>
        </SidebarGroup>
    );
}

// 🔁 Recursive check if any child is active
function hasActiveChild(item: NavItem, currentUrl: string): boolean {
    if (item.href === currentUrl) return true;
    if (item.children) {
        return item.children.some(child => hasActiveChild(child, currentUrl));
    }
    return false;
}

function SidebarMenuTree({ item, level }: { item: NavItem; level: number }) {
    const fullUrl = window.location.href;
    const hasChildren = item.children && item.children.length > 0;

    // 🔁 Check if this item or any of its children is active
    const isActive = item.href === fullUrl;
    const hasActive = hasActiveChild(item, fullUrl);

    // 🔄 Open if current or child is active
    const [open, setOpen] = useState(hasActive);

    return (
        <SidebarMenuItem key={item.title} className={level > 0 ? 'ml-4' : ''}>
            {hasChildren ? (
                <>
                    <SidebarMenuButton
                        asChild
                        isActive={isActive || hasActive}
                        onClick={() => setOpen(!open)}
                        tooltip={{ children: item.title }}
                    >
                        <button className="w-full flex justify-between items-center">
                            <div className="flex items-center gap-2">
                                {item.icon && <item.icon />}
                                <span>{item.title}</span>
                            </div>
                            {open ? <ChevronUp className="w-4 h-4" /> : <ChevronDown className="w-4 h-4" />}
                        </button>
                    </SidebarMenuButton>

                    {open && (
                        <div className={`pl-${(level + 1) * 4} mt-2 flex flex-col gap-1`}>
                            <ul>
                                {item.children?.map((child) => (
                                    <SidebarMenuTree key={child.title} item={child} level={level + 1} />
                                ))}
                            </ul>
                        </div>
                    )}
                </>
            ) : (
                <SidebarMenuButton
                    asChild
                    isActive={isActive}
                    tooltip={{ children: item.title }}
                >
                    <Link href={item.href ?? '#'} prefetch>
                        {item.icon && <item.icon />}
                        <span>{item.title}</span>
                    </Link>
                </SidebarMenuButton>
            )}
        </SidebarMenuItem>
    );
}
