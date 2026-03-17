import { usePage } from '@inertiajs/react';
import type { SharedData } from '@/types';
import { useAppearance } from '@/hooks/use-appearance';

interface AppData {
    light_logo: string;
    dark_logo: string;
}

interface AppLogoPageProps extends SharedData {
    appData: AppData;
}

export default function AppLogoIcon({ className = '' }: { className?: string }) {
    const { appData } = usePage<AppLogoPageProps>().props;
    const { isDark } = useAppearance();
    const logoSrc = isDark ? appData.light_logo : appData.dark_logo;
    console.log(isDark);
    return <img src={logoSrc} alt="Logo" className={className || "h-10 w-auto"} />;
}
