import React from "react";
import { Input } from "@/components/ui/input";
import { InputDivProps } from "../container/input-types";

export default function InputHidden({ name, inputDivData }: InputDivProps) {
  const { data, setData } = inputDivData;

  return (
    <Input
      id={name}
      type="hidden"
      value={data[name]}
      onChange={(e) => setData(name, e.target.value)}
    />
  );
}
