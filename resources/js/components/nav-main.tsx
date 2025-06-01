import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/react';
import { ChevronDown, ChevronUp } from 'lucide-react';
import { useState } from 'react';

import { canAny } from '@/lib/can';

export function NavMain({ items = [] }: { items: NavItem[] }) {
    const filteredItems = items.filter((item) => !item.permission || canAny(item.permission));

    return (
        <SidebarGroup className="px-2 py-0">
            <SidebarGroupLabel>Platform</SidebarGroupLabel>
            <SidebarMenu>
                {filteredItems.map((item) => (
                    <SidebarMenuTree key={item.title} item={item} level={0} />
                ))}
            </SidebarMenu>
        </SidebarGroup>
    );
}

function hasActiveChild(item: NavItem, currentUrl: string): boolean {
    if (item.href === currentUrl) return true;
    if (item.children) {
        return item.children.some((child) => hasActiveChild(child, currentUrl));
    }
    return false;
}

function SidebarMenuTree({ item, level }: { item: NavItem; level: number }) {
    const fullUrl = window.location.href;
    const hasChildren = item.children && item.children.length > 0;

    // ✅ Use canAny instead of can
    if (item.permission && !canAny(item.permission)) {
        return null;
    }

    const isActive = item.href === fullUrl;
    const hasActive = hasActiveChild(item, fullUrl);

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
                        <button className="flex w-full items-center justify-between">
                            <div className="flex items-center gap-2">
                                {item.icon && <item.icon />}
                                <span>{item.title}</span>
                            </div>
                            {open ? <ChevronUp className="h-4 w-4" /> : <ChevronDown className="h-4 w-4" />}
                        </button>
                    </SidebarMenuButton>

                    {open && (
                        <div className={`pl-${(level + 1) * 4} mt-2 flex flex-col gap-1`}>
                            <ul>
                                {item.children?.map((child) =>
                                    !child.permission || canAny(child.permission)
                                        ? <SidebarMenuTree key={child.title} item={child} level={level + 1} />
                                        : null
                                )}
                            </ul>
                        </div>
                    )}
                </>
            ) : (
                <SidebarMenuButton asChild isActive={isActive} tooltip={{ children: item.title }}>
                    <Link href={item.href ?? '#'} prefetch>
                        {item.icon && <item.icon />}
                        <span>{item.title}</span>
                    </Link>
                </SidebarMenuButton>
            )}
        </SidebarMenuItem>
    );
}
