import React from "react";
import InputError from "@/components/input-error";
import { Label } from "@/components/ui/label";
import type { InputDivProps } from "../container/input-types";
import { InputWrapper } from "../container/input-wrapper";

export default function InputSwitch({
  label,
  name,
  inputDivData,
  required,
  className,
}: InputDivProps) {
  const { data, setData, errors } = inputDivData;

  // normalize boolean: handles 1, "1", true
  const value =
    data?.[name] === 1 || data?.[name] === "1" || data?.[name] === true;

  const handleToggle = () => {
    setData(name, value ? 0 : 1);
  };

  return (
    <InputWrapper className={className}>
      <Label htmlFor={name}>
        {label}
        {required && (
          <span className="text-red-500 font-bold text-xl">*</span>
        )}
      </Label>

      <div className="space-y-2">
        <button
          type="button"
          role="switch"
          aria-checked={value}
          onClick={handleToggle}
          className={`relative inline-flex h-8 w-24 items-center rounded-full transition-colors focus:outline-none cursor-pointer ${
            value ? "bg-green-500" : "bg-input-border"
          }`}
        >
          <span
            className={`inline-block h-8 w-8 transform rounded-full bg-input-bg transition-transform ${
              value ? "translate-x-16" : "translate-x-0"
            }`}
          />
        </button>
      </div>

      <InputError message={errors[name]?.[0]} />
    </InputWrapper>
  );
}
