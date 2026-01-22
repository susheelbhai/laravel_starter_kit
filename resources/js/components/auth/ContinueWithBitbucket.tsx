import { Button } from '@/components/ui/button';

export default function ContinueWithBitbucket({href}: {href?: string}) {
    return (
        <div className="mb-1">
            <Button
                type="button"
                variant="outline"
                className="w-full"
                onClick={() => window.location.href = href ?? route('social.login', 'bitbucket')}
            >
                <svg className="mr-2 h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M.778 1.211c-.424 0-.772.346-.772.77 0 .04.004.08.012.12l3.482 19.984c.074.452.466.785.927.785h15.104c.346 0 .642-.235.734-.571l3.482-20.074c.068-.396-.229-.783-.627-.783H.778zm14.497 15.188h-6.55l-1.771-9.293h10.092l-1.771 9.293z"/>
                </svg>
                Continue with Bitbucket
            </Button>
        </div>
    );
}
