import React from "react";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import InputError from "@/components/input-error";
import HelpTooltip from "./input-help-tool";
import { InputDivProps } from "./input-types";
import { InputWrapper } from "./input-wrapper";

export default function InputText({
  label,
  name = "",
  type,
  required,
  help,
  inputDivData,
  readOnly,
  className,
  ...props
}: InputDivProps) {
  const { data, setData, errors } = inputDivData || { data: {}, setData: () => {}, errors: {} };

  return (
    <InputWrapper className={className}>
      <Label htmlFor={name}>
        {label}
        {required && <span className="text-red-500 font-bold text-xl">*</span>}
      </Label>
      {help && <HelpTooltip help={help} />}
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
