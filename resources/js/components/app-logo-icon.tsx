import { usePage } from '@inertiajs/react';

interface AppData {
    light_logo: string;
}

export default function AppLogoIcon() {
    const appData = (usePage().props as { appData: AppData }).appData;
    return <img src={appData.light_logo} alt="Logo" className="h-10 w-auto" />;
}
