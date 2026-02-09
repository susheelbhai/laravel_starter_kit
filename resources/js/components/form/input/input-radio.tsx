import React from "react";
import InputError from "@/components/input-error";
import { Label } from "@/components/ui/label";
import type { InputDivProps } from "../container/input-types";
import { InputWrapper } from "../container/input-wrapper";

export default function InputRadio({
  label,
  name,
  inputDivData,
  options,
  required,
  className,
}: InputDivProps) {
  const { data, setData, errors } = inputDivData;

  const currentValue =
    data?.[name] !== undefined && data?.[name] !== null
      ? String(data[name])
      : "";

  const handleChange = (value: string) => {
    // If value is numeric string, convert to number
    const parsedValue = /^\d+$/.test(value) ? Number(value) : value;
    setData(name, parsedValue);
  };

  return (
    <InputWrapper className={className}>
      <Label htmlFor={name}>
        {label}
        {required && (
          <span className="text-red-500 font-bold text-xl">*</span>
        )}
      </Label>

      <div className="flex flex-col gap-2 border-2 border-input-border rounded-md p-3 bg-input-bg focus-within:bg-input-focused-bg focus-within:border-secondary/60 transition-colors">
        {(options ?? []).map((option: any) => {
          const value = String(option.id ?? option.value ?? option);
          const title = String(option.title ?? option.name ?? value);

          return (
            <label
              key={value}
              className="flex items-center gap-2 cursor-pointer select-none text-foreground"
            >
              <input
                type="radio"
                name={name}
                value={value}
                checked={currentValue === value}
                onChange={() => handleChange(value)}
                className="h-4 w-4 accent-blue-600 cursor-pointer"
              />
              <span>{title}</span>
            </label>
          );
        })}
      </div>

      <InputError message={errors[name]?.[0]} />
    </InputWrapper>
  );
}
