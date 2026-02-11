import React, { createContext, useContext, useCallback, useEffect, useState } from 'react';

export type Appearance = 'light' | 'dark' | 'system';

const AppearanceContext = createContext<{
    appearance: Appearance;
    isDark: boolean;
    updateAppearance: (mode: Appearance) => void;
} | null>(null);

export const useAppearance = () => {
    const context = useContext(AppearanceContext);
    if (!context) {
        throw new Error('useAppearance must be used within AppearanceProvider');
    }
    return context;
};

const prefersDark = () => {
    if (typeof window === 'undefined') {
        return false;
    }
    return window.matchMedia('(prefers-color-scheme: dark)').matches;
};

const getDefaultAppearance = (): Appearance => {
    if (typeof document === 'undefined') {
        return 'system';
    }
    const attr = document.documentElement.getAttribute('data-appearance');
    if (attr === 'light' || attr === 'dark' || attr === 'system') {
        return attr;
    }
    return 'system';
};

const getStoredAppearance = (): Appearance | null => {
    if (typeof window === 'undefined') {
        return null;
    }
    const value = localStorage.getItem('appearance');
    if (value === 'light' || value === 'dark' || value === 'system') {
        return value;
    }
    return null;
};

const setCookie = (name: string, value: string, days = 365) => {
    if (typeof document === 'undefined') {
        return;
    }
    const maxAge = days * 24 * 60 * 60;
    document.cookie = `${name}=${value};path=/;max-age=${maxAge};SameSite=Lax`;
};

const mediaQuery = () => {
    if (typeof window === 'undefined') {
        return null;
    }
    return window.matchMedia('(prefers-color-scheme: dark)');
};

export const AppearanceProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
    const defaultAppearance = getDefaultAppearance();
    const [appearance, setAppearance] = useState<Appearance>(defaultAppearance);
    const [isDark, setIsDark] = useState(false);

    const applyTheme = useCallback((mode: Appearance) => {
        const newIsDark = mode === 'dark' || (mode === 'system' && prefersDark());
        setIsDark(newIsDark);
        document.documentElement.classList.toggle('dark', newIsDark);
    }, []);

    const updateAppearance = useCallback((mode: Appearance) => {
        setAppearance(mode);
        localStorage.setItem('appearance', mode);
        setCookie('appearance', mode);
        applyTheme(mode);
    }, [applyTheme]);

    const handleSystemThemeChange = useCallback(() => {
        const currentAppearance = getStoredAppearance() ?? defaultAppearance;
        applyTheme(currentAppearance);
    }, [applyTheme, defaultAppearance]);

    useEffect(() => {
        const savedAppearance = getStoredAppearance();
        // Use a timeout to avoid calling setState directly in effect
        const timer = setTimeout(() => {
            updateAppearance(savedAppearance ?? defaultAppearance);
        }, 0);

        const mq = mediaQuery();
        mq?.addEventListener('change', handleSystemThemeChange);

        return () => {
            clearTimeout(timer);
            mq?.removeEventListener('change', handleSystemThemeChange);
        };
    }, [updateAppearance, handleSystemThemeChange, defaultAppearance]);

    return (
        <AppearanceContext.Provider value={{ appearance, isDark, updateAppearance }}>
            {children}
        </AppearanceContext.Provider>
    );
};