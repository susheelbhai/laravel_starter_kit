import React from "react";
import InputError from "@/components/input-error";
import { Label } from "@/components/ui/label";
import { cn } from "@/lib/utils";
import type { InputDivProps } from "../container/input-types";
import { InputWrapper } from "../container/input-wrapper";

export default function InputTextarea({
  label,
  name = '',
  inputDivData,
  required,
  readOnly,
  className,
  placeholder,
}: InputDivProps) {
  const { data, setData, errors } = inputDivData || { data: {}, setData: () => {}, errors: {} };

  return (
    <InputWrapper className={className}>
      <Label htmlFor={name}>
        {label}
        {required && <span className="text-red-500 font-bold text-xl">*</span>}
      </Label>

      <textarea
        id={name}
        value={data?.[name]}
        onChange={(e) => setData(name, e.target.value)}
        readOnly={readOnly}
        className={cn(
          "flex w-full rounded-md border-2 bg-input-bg border-input-border px-3 py-2 text-sm text-input-text placeholder:text-input-placeholder hover:bg-input-hover-bg",
          "focus:outline-none focus:border-secondary/60 focus:bg-input-focused-bg focus:text-input-focused-text",
          "disabled:cursor-not-allowed disabled:opacity-50",
          className
        )}
        rows={5}
        placeholder={placeholder || ""}
      />
      <InputError message={errors?.[name]?.[0]} />
    </InputWrapper>
  );
}
