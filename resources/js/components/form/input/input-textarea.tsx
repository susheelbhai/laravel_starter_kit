import React from "react";
import { Label } from "@/components/ui/label";
import InputError from "@/components/input-error";
import { cn } from "@/lib/utils";
import { InputWrapper } from "../container/input-wrapper";
import { InputDivProps } from "../container/input-types";

export default function InputTextarea({
  label,
  name,
  inputDivData,
  required,
  readOnly,
  className,
  placeholder,
}: InputDivProps) {
  const { data, setData, errors } = inputDivData;

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
          "flex w-full rounded-md border-2 border-primary bg-white px-3 py-2 text-sm text-gray-900",
          "placeholder:text-gray-400",
          "focus:outline-none focus:border-secondary/60",
          "disabled:cursor-not-allowed disabled:opacity-50",
          className
        )}
        rows={5}
        placeholder={placeholder || ""}
      />
      <InputError message={errors[name]?.[0]} />
    </InputWrapper>
  );
}
