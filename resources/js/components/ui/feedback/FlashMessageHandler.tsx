import { usePage } from "@inertiajs/react";
import { useEffect, useState } from "react";
import type { FlashType } from "@/components/ui/alert/flash1";
import { FlashMessage } from "@/components/ui/alert/flash1";
import { type SharedData } from "@/types";

export default function FlashMessageHandler() {
    const page = usePage<SharedData>();

    const { flash = {} } = page.props as {
        flash?: Partial<Record<FlashType, string>>;
    };

    const [visibleFlash, setVisibleFlash] = useState<{
        type: FlashType;
        message: string;
    } | null>(null);

    // 🔁 Handle flash on every Inertia response
    useEffect(() => {
        // Use a timeout to avoid calling setState directly in effect
        const timer = setTimeout(() => {
            if (flash.success) {
                setVisibleFlash({ type: "success", message: flash.success });
            } else if (flash.warning) {
                setVisibleFlash({ type: "warning", message: flash.warning });
            } else if (flash.error) {
                setVisibleFlash({ type: "error", message: flash.error });
            } else {
                setVisibleFlash(null);
            }
        }, 0);

        // ⏱ Auto-hide after 5 seconds if any flash is present
        if (flash.success || flash.warning || flash.error) {
            const hideTimer = setTimeout(() => setVisibleFlash(null), 5000);
            return () => {
                clearTimeout(timer);
                clearTimeout(hideTimer);
            };
        }

        return () => clearTimeout(timer);
    }, [flash]);
    
    return (
        <div className="mx-auto items-center justify-between">
            {visibleFlash && (
                <FlashMessage
                    type={visibleFlash.type}
                    message={visibleFlash.message}
                    onClose={() => setVisibleFlash(null)}
                />
            )}
        </div>
    );
}