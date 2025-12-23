import { InputHTMLAttributes } from "react";

export interface InputDivProps extends InputHTMLAttributes<HTMLInputElement> {
  type: string;
  label?: string;
  help?: string;
  inputDivData: {
    data: Record<string, any>;
    setData: (key: string, value: any) => void;
    errors: Record<string, string[]>;
  };
  name: string;
  children?: React.ReactNode;
  options?: any[];
  widthMultiplier?: number;
  heightMultiplier?: number;
  readOnly?: boolean;
  placeholder?: string;
  className?: string;
}
