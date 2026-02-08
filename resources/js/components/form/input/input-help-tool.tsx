import { useState, useRef } from "react";

export default function HelpTooltip({ help }: { help?: string }) {
  const [show, setShow] = useState(false);
  const timeoutRef = useRef<NodeJS.Timeout | null>(null);

  if (!help) return null;

  const handleMouseEnter = () => {
    timeoutRef.current = setTimeout(() => setShow(true), 300);
  };

  const handleMouseLeave = () => {
    if (timeoutRef.current) clearTimeout(timeoutRef.current);
    setShow(false);
  };

  return (
    <div
      className="relative inline-block"
      onMouseEnter={handleMouseEnter}
      onMouseLeave={handleMouseLeave}
    >
      <span className="text-sm text-[var(--muted-foreground)] cursor-help italic ">
        What is this?
      </span>

      {show && (
        <div className="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 w-max max-w-xs rounded bg-gray-800 text-white px-4 py-4 shadow-lg z-10">
          <div dangerouslySetInnerHTML={{ __html: help }} />
        </div>
      )}
    </div>
  );
}
