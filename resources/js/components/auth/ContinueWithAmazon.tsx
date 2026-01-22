import { Button } from '@/components/ui/button';

export default function ContinueWithAmazon({href}: {href?: string}) {
    return (
        <div className="mb-1">
            <Button
                type="button"
                variant="outline"
                className="w-full"
                onClick={() => window.location.href = href ?? route('social.login', 'amazon')}
            >
                <svg className="mr-2 h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M13.582 8.182c0-2.051.771-3.682 2.421-4.883 1.102-.8 2.65-1.267 4.641-1.4v1.733c-1.42.117-2.52.567-3.301 1.35-.78.783-1.171 1.9-1.171 3.35v.3c0 1.45.39 2.567 1.171 3.35.78.783 1.881 1.233 3.301 1.35v1.733c-1.991-.133-3.539-.6-4.641-1.4-1.65-1.201-2.421-2.832-2.421-4.883zm-6.808 0c0-2.051.771-3.682 2.421-4.883 1.102-.8 2.65-1.267 4.641-1.4v1.733c-1.42.117-2.52.567-3.301 1.35-.78.783-1.171 1.9-1.171 3.35v.3c0 1.45.39 2.567 1.171 3.35.78.783 1.881 1.233 3.301 1.35v1.733c-1.991-.133-3.539-.6-4.641-1.4-1.65-1.201-2.421-2.832-2.421-4.883z"/>
                </svg>
                Continue with Amazon
            </Button>
        </div>
    );
}