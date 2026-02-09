import React from "react";
import InputError from "@/components/input-error";
import { Label } from "@/components/ui/label";
import type { InputDivProps } from "../container/input-types";
import { InputWrapper } from "../container/input-wrapper";

export default function InputCheckbox({
  label,
  name,
  inputDivData,
  required,
  className,
}: InputDivProps) {
  const { data, setData, errors } = inputDivData;

  // Normalize to boolean
  const checked =
    data?.[name] === true ||
    data?.[name] === 1 ||
    data?.[name] === "1";

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setData(name, e.target.checked ? 1 : 0);
  };

  return (
    <InputWrapper className={className}>
      <div className="flex items-center gap-2">
        <input
          id={name}
          type="checkbox"
          checked={checked}
          onChange={handleChange}
          required={required}
          className="
            h-5 w-5
            accent-secondary
            border-2 border-input-border
            rounded-md
            cursor-pointer
            appearance-auto
            checked:bg-secondary checked:border-input-border
            focus:ring-2 focus:ring-secondary focus:ring-offset-0 focus:ring-offset-input-bg
            bg-input-bg
            transition
          "
        />
        <Label htmlFor={name} className="cursor-pointer text-foreground">
          {label}
          {required && (
            <span className="text-red-500 font-bold text-xl">*</span>
          )}
        </Label>
      </div>

      <InputError message={errors[name]?.[0]} />
    </InputWrapper>
  );
}
