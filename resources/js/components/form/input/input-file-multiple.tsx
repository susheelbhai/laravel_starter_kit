import React, { useRef, useState } from "react";
import InputError from "@/components/input-error";
import { Label } from "@/components/ui/label";
import type { InputDivProps } from "../container/input-types";
import { InputWrapper } from "../container/input-wrapper";

export default function InputMultiFile({
  label,
  name,
  inputDivData,
  required,
  className,
}: InputDivProps) {
  const { data, setData, errors } = inputDivData;

  const [fileNames, setFileNames] = useState<string[]>([]);
  const [dragging, setDragging] = useState(false);
  const fileInputRef = useRef<HTMLInputElement>(null);

  const handleFiles = (files: FileList | File[]) => {
    const filesArray = Array.from(files);
    if (!filesArray.length) return;

    setData(name, filesArray);
    setFileNames(filesArray.map((file) => file.name));
  };

  const handleDrop = (e: React.DragEvent<HTMLDivElement>) => {
    e.preventDefault();
    setDragging(false);
    if (e.dataTransfer.files && e.dataTransfer.files.length > 0) {
      handleFiles(e.dataTransfer.files);
      e.dataTransfer.clearData();
    }
  };

  // Handle pre-filled existing files from backend
  const valueFromData = data?.[name];
  let existingFiles: string[] = [];

  if (Array.isArray(valueFromData)) {
    existingFiles = valueFromData.map((v) => String(v));
  } else if (typeof valueFromData === "string" && valueFromData !== "") {
    existingFiles = [valueFromData];
  }

  const showFiles = fileNames.length > 0 ? fileNames : existingFiles;
  const fileCount = showFiles.length;

  return (
    <InputWrapper className={className}>
      <Label htmlFor={name}>
        {label}
        {required && <span className="text-red-500 font-bold text-xl">*</span>}
      </Label>

      <div className="space-y-2">
        <input
          ref={fileInputRef}
          id={name}
          name={name}
          type="file"
          multiple
          onChange={(e) => {
            if (e.target.files && e.target.files.length > 0) {
              handleFiles(e.target.files);
            }
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
          className={`relative flex h-40 w-150 cursor-pointer items-center justify-center overflow-auto rounded-md border-2 border-dashed transition-colors ${
            dragging
              ? "border-blue-500 bg-blue-100"
              : "border-input-border bg-input-bg hover:bg-input-focused-bg"
          }`}
        >
          <div className="text-center text-foreground px-2 py-2">
            {fileCount > 0 ? (
              <>
                <p className="font-semibold text-sm mb-1">
                  {fileCount} file{fileCount > 1 ? "s" : ""} uploaded:
                </p>

                <ol className="list-decimal list-inside text-xs text-left space-y-1">
                  {showFiles.map((fname, idx) => (
                    <li key={idx}>{fname}</li>
                  ))}
                </ol>
              </>
            ) : (
              <p className="text-sm font-medium">
                Drag & drop or click to upload (multiple files allowed)
              </p>
            )}
          </div>
        </div>
      </div>

      <InputError message={errors[name]?.[0]} />
    </InputWrapper>
  );
}
