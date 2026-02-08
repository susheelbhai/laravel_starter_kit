import { Link } from '@inertiajs/react';
import { ChevronDown, ChevronUp } from 'lucide-react';
import { useState } from 'react';
import {
    SidebarGroup,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';

import { canAny } from '@/lib/can';
import { type NavItem } from '@/types';

// Helper to get current route name from Ziggy
const getCurrentRouteName = (): string => {
    try {
        return (window as any).route().current() || '';
    } catch {
        return '';
    }
};

export function NavMain({ items = [] }: { items: NavItem[] }) {
    const filteredItems = items.filter(
        (item) => !item.permission || canAny(item.permission),
    );

    return (
        <SidebarGroup className="px-2 py-0">
            {/* <SidebarGroupLabel>Platform</SidebarGroupLabel> */}
            <SidebarMenu>
                {filteredItems.map((item) => (
                    <SidebarMenuTree key={item.title} item={item} level={0} />
                ))}
            </SidebarMenu>
        </SidebarGroup>
    );
}

function hasActiveChild(
    item: NavItem,
    currentUrl: string,
    currentRoute: string,
): boolean {
    // Check if current URL matches exactly
    if (item.href === currentUrl) return true;

    // If item has sibling routes, use exact matching only
    if ((item as any).hasSiblingRoutes) {
        if (
            (item as any).routePattern &&
            currentRoute === (item as any).routePattern
        ) {
            return true;
        }
    } else {
        // No sibling routes - use pattern matching for CRUD routes
        if (
            (item as any).routePattern &&
            currentRoute.startsWith((item as any).routePattern + '.')
        ) {
            return true;
        }
        // Also check exact match for the pattern itself
        if (
            (item as any).routePattern &&
            currentRoute === (item as any).routePattern
        ) {
            return true;
        }
    }

    if (item.children) {
        return item.children.some((child) =>
            hasActiveChild(child, currentUrl, currentRoute),
        );
    }
    return false;
}

function SidebarMenuTree({ item, level }: { item: NavItem; level: number }) {
    const fullUrl = window.location.href;
    const currentRoute = getCurrentRouteName();
    const hasChildren = item.children && item.children.length > 0;

    // ✅ Use canAny instead of can
    if (item.permission && !canAny(item.permission)) {
        return null;
    }

    // Check if item is active
    let isActive = item.href === fullUrl;

    // If no sibling routes exist, use pattern matching
    if (!isActive && (item as any).routePattern) {
        if ((item as any).hasSiblingRoutes) {
            // Has siblings - only exact match
            isActive = currentRoute === (item as any).routePattern;
        } else {
            // No siblings - pattern match for CRUD routes
            isActive =
                currentRoute === (item as any).routePattern ||
                currentRoute.startsWith((item as any).routePattern + '.');
        }
    }

    const hasActive = hasActiveChild(item, fullUrl, currentRoute);

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
                                {item.icon && <item.icon className="h-4 w-4" />}
                                <span>{item.title}</span>
                            </div>
                            {open ? (
                                <ChevronUp className="h-4 w-4" />
                            ) : (
                                <ChevronDown className="h-4 w-4" />
                            )}
                        </button>
                    </SidebarMenuButton>

                    {open && (
                        <div
                            className={`pl-${(level + 1) * 4} mt-2 flex flex-col gap-1`}
                        >
                            <ul>
                                {item.children?.map((child) =>
                                    !child.permission ||
                                    canAny(child.permission) ? (
                                        <SidebarMenuTree
                                            key={child.title}
                                            item={child}
                                            level={level + 1}
                                        />
                                    ) : null,
                                )}
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
                        {item.icon && <item.icon className="h-4 w-4" />}
                        <span>{item.title}</span>
                    </Link>
                </SidebarMenuButton>
            )}
        </SidebarMenuItem>
    );
}

