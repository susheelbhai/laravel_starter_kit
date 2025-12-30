import { type NavItem } from "@/types";

const routeExists = (name: string | null): boolean => {
    if (!name) return false;
    try {
        route(name);
        return true;
    } catch {
        return false;
    }
};

export const filterMenuItems = (items: any[]): NavItem[] => {
    return items
        .filter((item) => {
            if (item.routeName && !routeExists(item.routeName)) {
                return false;
            }
            return true;
        })
        .map((item) => {
            const routePattern = item.routeName
                ? item.routeName.replace(/\.(index|create|edit|show)$/, "")
                : null;

            const processedItem = {
                ...item,
                href: item.routeName ? route(item.routeName) : item.href,
                routePattern: routePattern,
            };
            delete processedItem.routeName;

            if (processedItem.children) {
                // First, process all children
                const filteredChildren = filterMenuItems(
                    processedItem.children
                );

                // Check which children have siblings (same route pattern)
                const patternCounts = new Map<string, number>();
                filteredChildren.forEach((child: any) => {
                    if (child.routePattern) {
                        patternCounts.set(
                            child.routePattern,
                            (patternCounts.get(child.routePattern) || 0) + 1
                        );
                    }
                });

                // Mark children that have siblings
                const childrenWithSiblingFlags = filteredChildren.map(
                    (child: any) => {
                        const hasSiblingRoutes =
                            child.routePattern &&
                            (patternCounts.get(child.routePattern) || 0) > 1;
                        return { ...child, hasSiblingRoutes };
                    }
                );

                // Only include parent if it has visible children or its own href
                if (
                    childrenWithSiblingFlags.length === 0 &&
                    !processedItem.href
                ) {
                    return null;
                }
                return { ...processedItem, children: childrenWithSiblingFlags };
            }
            return processedItem;
        })
        .filter((item): item is NavItem => item !== null);
};
