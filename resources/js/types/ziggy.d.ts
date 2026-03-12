declare module 'ziggy-js' {
    export type RouteName = string;
    export function route(name: RouteName, params?: any, absolute?: boolean): string;
    export interface Config {
        url: string;
        port: number | null;
        defaults: Record<string, any>;
        routes: Record<string, any>;
    }
}
