import React from "react";
import InputError from "@/components/input-error";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import type { InputDivProps } from "../container/input-types";
import { InputWrapper } from "../container/input-wrapper";

export default function InputDefault({
  label,
  name,
  inputDivData,
  type,
  readOnly,
  required,
  className,
  ...props
}: InputDivProps) {
  const { data, setData, errors } = inputDivData;

  return (
    <InputWrapper className={className}>
      <Label htmlFor={name}>
        {label}
        {required && <span className="text-red-500 font-bold text-xl">*</span>}
      </Label>
      <Input
        id={name}
        type={type}
        value={data[name]}
        onChange={(e) => setData(name, e.target.value)}
        readOnly={readOnly}
        className="bg-[var(--input-bg)] border-[var(--input-border)] text-[var(--input-text)] placeholder:text-[var(--input-placeholder)] hover:bg-[var(--input-hover-bg)] focus:bg-[var(--input-focused-bg)] focus:text-[var(--input-focused-text)]"
        {...props}
      />
      <InputError message={errors[name]?.[0]} />
    </InputWrapper>
  );
}
