import React from "react";
import { Label } from "@/components/ui/label";
import InputError from "@/components/input-error";
import { InputWrapper } from "./input-wrapper";
import { InputDivProps } from "./input-types";

export default function InputMultiCheckbox({
  label,
  name,
  inputDivData,
  options,
  required,
  className,
}: InputDivProps) {
  const { data, setData, errors } = inputDivData;

  // normalize current value to array of strings
  const raw = data?.[name];
  const selectedValues: string[] = Array.isArray(raw)
    ? raw.map(String)
    : raw
    ? [String(raw)]
    : [];

  const handleToggle = (optionValue: string, checked: boolean) => {
    let updated: string[];
    if (checked) {
      // add value if checked
      updated = Array.from(new Set([...selectedValues, optionValue]));
    } else {
      // remove if unchecked
      updated = selectedValues.filter((v) => v !== optionValue);
    }

    // If your backend expects numbers, you can parseInt here instead
    const numeric = updated.map((v) =>
      /^\d+$/.test(v) ? Number(v) : v
    );

    setData(name, numeric);
  };

  return (
    <InputWrapper className={className}>
      <Label htmlFor={name}>
        {label}
        {required && (
          <span className="text-red-500 font-bold text-xl">*</span>
        )}
      </Label>

      <div className="flex flex-col gap-2 border-2 border-primary rounded-md p-3 bg-white">
        {(options ?? []).map((option: any) => {
          const value = String(option.id ?? option.value ?? option);
          const title = String(option.title ?? option.name ?? value);
          const checked = selectedValues.includes(value);

          return (
            <label
              key={value}
              className="flex items-center gap-2 cursor-pointer select-none text-gray-800"
            >
              <input
                type="checkbox"
                className="h-4 w-4 accent-secondary cursor-pointer"
                checked={checked}
                onChange={(e) =>
                  handleToggle(value, e.target.checked)
                }
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
