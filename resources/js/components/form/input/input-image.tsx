import React, { useRef, useState } from "react";
import InputError from "@/components/input-error";
import { Label } from "@/components/ui/label";
import type { InputDivProps } from "../container/input-types";
import { InputWrapper } from "../container/input-wrapper";

export default function InputImage({
  label,
  name,
  inputDivData,
  required,
  className,
  widthMultiplier = 2,
  heightMultiplier = 1,
}: InputDivProps) {
  const { data, setData, errors } = inputDivData;

  const [previewUrl, setPreviewUrl] = useState<string | null>(null);
  const [dragging, setDragging] = useState(false);
  const fileInputRef = useRef<HTMLInputElement>(null);

  const height = 288 * heightMultiplier; // Tailwind h-72 = 288px
  const width = height * widthMultiplier;

  const handleFile = (file: File) => {
    setData(name, file);
    setPreviewUrl(URL.createObjectURL(file));
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
          id={name}
          ref={fileInputRef}
          type="file"
          accept="image/*"
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
          className={`relative flex cursor-pointer items-center justify-center overflow-hidden rounded-md border-2 border-dashed bg-[var(--input-bg)] border-[var(--input-border)] hover:bg-[var(--input-hover-bg)] ${
            dragging
              ? "border-secondary bg-[var(--input-focused-bg)]"
              : ""
          }`}
          style={{ height, width, maxWidth: "100%" }}
        >
          {previewUrl ? (
            <img
              src={previewUrl}
              alt="Preview"
              className="h-full w-full object-contain"
            />
          ) : value1 ? (
            <img
              src={value1}
              alt="Uploaded"
              className="h-full w-full object-contain"
            />
          ) : (
            <div className="text-center text-[var(--input-placeholder)]">
              <p className="text-sm font-medium">
                Drag & drop or click to upload
              </p>
            </div>
          )}
        </div>
      </div>

      <InputError message={errors[name]?.[0]} />
    </InputWrapper>
  );
}
