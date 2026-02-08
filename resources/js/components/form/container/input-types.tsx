import type { InputHTMLAttributes } from "react";

export interface InputDivProps extends InputHTMLAttributes<HTMLInputElement> {
  type: string;
  label?: string;
  help?: string;
  inputDivData?: {
    data: Record<string, any>;
    setData: (key: string, value: any) => void;
    errors: Record<string, string[]>;
  };
  name?: string;
  children?: React.ReactNode;
  options?: any[];
  widthMultiplier?: number;
  heightMultiplier?: number;
  readOnly?: boolean;
  placeholder?: string;
  className?: string;
  editorHeight?: number; // For CKEditor height
  editorContentsCss?: string | string[]; // For CKEditor custom CSS
  editorUiColor?: string; // For CKEditor UI background color
  editorCustomCss?: string; // Path to custom CSS file for CKEditor UI styling
  editorType?: 'tinymce' | 'ckeditor'; // Editor type selector
  timeFormat?: '12' | '24'; // For TimePicker: 12-hour or 24-hour format
}
