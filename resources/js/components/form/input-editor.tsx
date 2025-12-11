import React from "react";
import { Label } from "@/components/ui/label";
import InputError from "@/components/input-error";
import HelpTooltip from "./input-help-tool";
import { InputWrapper } from "./input-wrapper";
import { InputDivProps } from "./input-types";
import CkEditor4Component from "../CkEditor4Component";

export default function InputEditor({
  label,
  name,
  required,
  help,
  inputDivData,
  className,
}: InputDivProps) {
  const { data, setData, errors } = inputDivData;

  return (
    <InputWrapper className={className}>
      <Label htmlFor={name}>
        {label}
        {required && <span className="text-red-500 font-bold text-xl">*</span>}
      </Label>
      {help && <HelpTooltip help={help} />}

      <CkEditor4Component
        value={data?.[name]}
        onChange={(newData) => setData(name, newData)}
        id={name}
      />
      <InputError message={errors[name]?.[0]} />
    </InputWrapper>
  );
}
