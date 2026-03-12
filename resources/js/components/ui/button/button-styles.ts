export function StyleIt(style: 'primary' | 'secondary' | 'success' | 'warning' | 'destructive') {
    switch (style) {
        case 'primary':
            return 'bg-primary/80 text-primary-foreground hover:bg-primary';
        case 'secondary':
            return 'bg-secondary/80 text-secondary-foreground hover:bg-secondary';
        case 'success':
            return 'bg-success/80 text-success-foreground hover:bg-success';
        case 'warning':
            return 'bg-warning/80 text-warning-foreground hover:bg-warning';
        case 'destructive':
            return 'bg-destructive/80 text-destructive-foreground hover:bg-destructive';
        default:
            return '';
    }
}

export function SizeIt(size: 'small' | 'medium' | 'full' | 'icon' | 'sm' | 'lg') {
    switch (size) {
        case 'small':
        case 'sm':
            return 'w-fit px-3 py-1 text-sm';
        case 'medium':
            return 'w-fit px-4 py-2 text-base';
        case 'full':
            return 'w-full px-4 py-2 text-base';
        case 'lg':
            return 'w-fit px-6 py-3 text-lg';
        case 'icon':
            return 'w-fit p-2';
        default:
            return '';
    }
}
