import React, { useRef } from "react";
import InputError from "@/components/input-error";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import type { InputDivProps } from "../container/input-types";
import { InputWrapper } from "../container/input-wrapper";
import HelpTooltip from "./input-help-tool";

export default function InputDate({
  label,
  name,
  type,
  help,
  inputDivData,
  readOnly,
  className,
}: InputDivProps) {
  const { data, setData, errors } = inputDivData;
  const inputRef = useRef<HTMLInputElement>(null);

  // Track whether we *think* the native picker is open
  const isPickerOpenRef = useRef(false);

  const handleClick = (e: React.MouseEvent<HTMLDivElement>) => {
    const input = inputRef.current;
    if (!input) return;

    const isActive = document.activeElement === input;

    // 🔁 TOGGLE: if input is already focused and picker is marked as open,
    // close it instead of re-opening.
    if (isActive && isPickerOpenRef.current) {
      e.preventDefault();
      isPickerOpenRef.current = false;
      input.blur(); // blurring closes the native date picker
      return;
    }

    const rect = input.getBoundingClientRect();
    const clickX = e.clientX - rect.left;

    const canvas = document.createElement("canvas");
    const ctx = canvas.getContext("2d");
    if (!ctx) return;

    const style = getComputedStyle(input);
    ctx.font = `${style.fontWeight} ${style.fontSize} ${style.fontFamily}`;

    const value = input.value || input.placeholder || "00/00/0000";
    const textWidth = ctx.measureText(value).width;
    const paddingLeft = parseFloat(style.paddingLeft) || 0;
    const buffer = 8;
    const textEnd = paddingLeft + textWidth + buffer;

    if (clickX > textEnd || clickX < paddingLeft - buffer) {
      e.preventDefault();
      input.showPicker?.();
      isPickerOpenRef.current = true; // mark as open
      input.focus();
    }
  };

  return (
    <InputWrapper className={className}>
      <div className="relative w-full" onMouseDown={handleClick}>
        <Label htmlFor={name}>{label}</Label>
        {help && <HelpTooltip help={help} />}
        <Input
          id={name}
          ref={inputRef}
          type={type}
          value={data?.[name] ?? ""}
          onChange={(e) => {
            setData(name, e.target.value);
            // When user selects a date, picker usually closes
            isPickerOpenRef.current = false;
          }}
          onBlur={() => {
            // If input loses focus, picker is definitely closed
            isPickerOpenRef.current = false;
          }}
          readOnly={readOnly}
          className="bg-[var(--input-bg)] border-[var(--input-border)] text-[var(--input-text)] placeholder:text-[var(--input-placeholder)] hover:bg-[var(--input-hover-bg)] focus:bg-[var(--input-focused-bg)] focus:text-[var(--input-focused-text)]"
        />
        <InputError message={errors[name]?.[0]} />
      </div>
    </InputWrapper>
  );
}
