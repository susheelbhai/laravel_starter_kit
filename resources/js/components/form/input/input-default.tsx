import React from "react";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import InputError from "@/components/input-error";
import { InputWrapper } from "../container/input-wrapper";
import { InputDivProps } from "../container/input-types";

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
        {...props}
      />
      <InputError message={errors[name]?.[0]} />
    </InputWrapper>
  );
}
