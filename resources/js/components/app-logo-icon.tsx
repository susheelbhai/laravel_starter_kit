import { usePage } from '@inertiajs/react';
import type { SharedData } from '@/types';

interface AppData {
    light_logo: string;
}

export default function AppLogoIcon({ className = '' }: { className?: string }) {
    const { appData } = usePage<SharedData & { appData: AppData }>().props;
    return <img src={appData.light_logo} alt="Logo" className={className || "h-10 w-auto"} />;
}
