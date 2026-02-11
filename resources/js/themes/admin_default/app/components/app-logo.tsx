import { usePage } from '@inertiajs/react';
import { useSidebar } from '@/components/ui/sidebar';
import { useAppearance } from '@/hooks/use-appearance';

interface AppData {
    square_light_logo: string;
    square_dark_logo: string;
    light_logo: string;
    dark_logo: string;
}

interface AppPageProps {
    appData: AppData;
}

export default function AppLogo() {
    const appData = usePage<AppPageProps>().props.appData;
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
