import React, { useRef, useState } from "react";
import { Label } from "@/components/ui/label";
import InputError from "@/components/input-error";
import { InputWrapper } from "./input-wrapper";
import { InputDivProps } from "./input-types";

export default function InputFile({
  label,
  name,
  inputDivData,
  required,
  className,
}: InputDivProps) {
  const { data, setData, errors } = inputDivData;

  const [fileName, setFileName] = useState<string | null>(null);
  const [dragging, setDragging] = useState(false);
  const fileInputRef = useRef<HTMLInputElement>(null);

  const handleFile = (file: File) => {
    setData(name, file);
    setFileName(file.name);
  };

  const handleDrop = (e: React.DragEvent<HTMLDivElement>) => {
    e.preventDefault();
    setDragging(false);
    const file = e.dataTransfer.files?.[0];
    if (file) handleFile(file);
  };

  const value1 = typeof data?.[name] === "string" ? data[name] : "";

  return (
    <InputWrapper className={className}>
      <Label htmlFor={name}>
        {label}
        {required && <span className="text-red-500 font-bold text-xl">*</span>}
      </Label>

      <div className="space-y-2">
        <input
          ref={fileInputRef}
          type="file"
          onChange={(e) => {
            const file = e.target.files?.[0];
            if (file) handleFile(file);
          }}
          className="hidden"
        />

        <div
          onClick={() => fileInputRef.current?.click()}
          onDragOver={(e) => {
            e.preventDefault();
            setDragging(true);
          }}
          onDragLeave={() => setDragging(false)}
          onDrop={handleDrop}
          className={`relative flex h-32 w-150 cursor-pointer items-center justify-center overflow-hidden rounded-md border-2 border-dashed ${
            dragging
              ? "border-blue-500 bg-blue-100"
              : "border-gray-400 bg-gray-100"
          }`}
        >
          <div className="text-center text-gray-600">
            {fileName ? (
              <p className="text-sm font-medium">Selected File: {fileName}</p>
            ) : value1 ? (
              <p className="text-sm font-medium">Uploaded File: {value1}</p>
            ) : (
              <p className="text-sm font-medium">
                Drag & drop or click to upload
              </p>
            )}
          </div>
        </div>
      </div>

      <InputError message={errors[name]?.[0]} />
    </InputWrapper>
  );
}
