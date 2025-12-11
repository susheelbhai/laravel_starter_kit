// resources/js/components/ui/alert/flash1.tsx
import React from "react";

export type FlashType = "success" | "warning" | "error";

interface FlashMessageProps {
    type: FlashType;
    message: string;
    onClose?: () => void;
}

const colorClasses: Record<FlashType, string> = {
    success: "border-green-500 bg-green-50 text-green-700",
    warning: "border-yellow-500 bg-yellow-50 text-yellow-700",
    error: "border-red-500 bg-red-50 text-red-700",
};

export function FlashMessage({ type, message, onClose }: FlashMessageProps) {
    return (
        <div
            className={`
                fixed 
                top-6 
                right-6 
                z-[9999]
                flex items-center justify-between
                gap-3 rounded-md border px-8 py-6 text-sm shadow-lg
                w-auto max-w-[320px]
                ${colorClasses[type]}
            `}
            role="alert"
        >
            <span className="font-medium text-lg">{message}</span>

            {onClose && (
                <button
                    type="button"
                    onClick={onClose}
                    className="ml-2 text-xs font-semibold opacity-70 hover:opacity-100"
                >
                    ✕
                </button>
            )}
        </div>
    );
}
