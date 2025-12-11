import Button from "../button";
import { Plus } from "lucide-react";

export default function ButtonCreate({ href, text }: { href: string; text: string }) {
    return (
        <div className="mx-4 mt-4">
            <Button href={href}>
                <div className="flex items-center gap-3">
                    <Plus size={16} />

                    {/* Vertical bar that stretches to match row height */}
                    <div className="self-stretch border-l border-white mx-0" />

                    <span>{text}</span>
                </div>
            </Button>
        </div>
    );
}
