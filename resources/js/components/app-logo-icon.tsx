import { usePage } from '@inertiajs/react';
import { SVGAttributes } from 'react';

export default function AppLogoIcon(props: SVGAttributes<SVGElement>) {
        const appData = (usePage().props as any).appData;
    
    return (
       <img src={appData.light_logo} alt="Logo" className="h-10 w-auto" />
    );
}
