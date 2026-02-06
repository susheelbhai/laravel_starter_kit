import '../css/app.css';

import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createRoot } from 'react-dom/client';
import { AppearanceProvider } from './contexts/AppearanceContext';


createInertiaApp({
    title: (title) => `${title}`,
    resolve: (name) => resolvePageComponent(`./pages/${name}.tsx`, import.meta.glob('./pages/**/*.tsx')),
    setup({ el, App, props }) {
        const root = createRoot(el);

        root.render(
            <AppearanceProvider>
                <App {...props} />
            </AppearanceProvider>
        );
    },
    progress: {
        color: '#4B5563',
    },
});
