import { Send } from 'lucide-react';

interface ProductCTAProps {
    onClick: () => void;
}

export default function ProductCTA({ onClick }: ProductCTAProps) {
    return (
        <button
            onClick={onClick}
            className="flex w-full items-center justify-center gap-2 rounded-lg bg-primary px-6 py-3 font-semibold text-white transition-all hover:bg-primary/90 hover:shadow-lg cursor-pointer"
        >
            <Send className="h-5 w-5" />
            Send Enquiry
        </button>
    );
}
