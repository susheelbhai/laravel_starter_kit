import ContinueWithAmazon from "./ContinueWithAmazon";
import ContinueWithApple from "./ContinueWithApple";
import ContinueWithBitbucket from "./ContinueWithBitbucket";
import ContinueWithFacebook from "./ContinueWithFacebook";
import ContinueWithGitHub from "./ContinueWithGitHub";
import ContinueWithGitLab from "./ContinueWithGitLab";
import ContinueWithGoogle from "./ContinueWithGoogle";
import ContinueWithLinkedIn from "./ContinueWithLinkedIn";
import ContinueWithSlack from "./ContinueWithSlack";
import ContinueWithX from "./ContinueWithX";

export default function ContinueWithSocial({ platform, href }: { platform: string; href?: string }) {

    switch (platform) {
        case 'google':
            return <ContinueWithGoogle href={href ?? route('social.login', 'google')} />;
        case 'facebook':
            return <ContinueWithFacebook href={href ?? route('social.login', 'facebook')} />;
        case 'x':
            return <ContinueWithX href={href ?? route('social.login', 'x')} />;
        case 'linkedin':
            return <ContinueWithLinkedIn href={href ?? route('social.login', 'linkedin')} />;
        case 'github':
            return <ContinueWithGitHub href={href ?? route('social.login', 'github')} />;
        case 'gitlab':
            return <ContinueWithGitLab href={href ?? route('social.login', 'gitlab')} />;
        case 'bitbucket':
            return <ContinueWithBitbucket href={href ?? route('social.login', 'bitbucket')} />;
        case 'slack':
            return <ContinueWithSlack href={href ?? route('social.login', 'slack')} />;
        case 'apple':
            return <ContinueWithApple href={href ?? route('social.login', 'apple')} />;
        case 'amazon':
            return <ContinueWithAmazon href={href ?? route('social.login', 'amazon')} />;
        default:
            return null;
    }
}
