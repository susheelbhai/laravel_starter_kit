import { usePage } from '@inertiajs/react';
import { useSidebar } from '@/components/ui/sidebar';
import { useAppearance } from '@/hooks/use-appearance';

export default function AppLogo() {
    const appData = (usePage().props as any).appData;
    const { isDark } = useAppearance();
    const { state } = useSidebar();

    const isCollapsed = state === 'collapsed';

    const logoSrc = isCollapsed
        ? (isDark ? appData.square_light_logo : appData.square_dark_logo)
        : (isDark ? appData.light_logo : appData.dark_logo);

    return (
        <>
            <div className="flex items-center justify-center">
                <img
                    src={logoSrc}
                    alt="Logo"
                    className={isCollapsed ? "h-8 w-8" : "h-10 w-auto"}
                />
            </div>
        </>
    );
}
