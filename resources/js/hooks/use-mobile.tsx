import { useEffect, useState } from 'react';

const MOBILE_BREAKPOINT = 768;

export function useIsMobile() {
    const [isMobile, setIsMobile] = useState<boolean>(false);

    useEffect(() => {
        const mql = window.matchMedia(`(max-width: ${MOBILE_BREAKPOINT - 1}px)`);

        const onChange = () => {
            setIsMobile(window.innerWidth < MOBILE_BREAKPOINT);
        };

        mql.addEventListener('change', onChange);
        // Use a timeout to avoid calling setState directly in effect
        const timer = setTimeout(() => {
            setIsMobile(window.innerWidth < MOBILE_BREAKPOINT);
        }, 0);

        return () => {
            mql.removeEventListener('change', onChange);
            clearTimeout(timer);
        };
    }, []);

    return !!isMobile;
}
