import React, { useEffect, useRef, useState } from "react";
import { Label } from "@/components/ui/label";
import InputError from "@/components/input-error";
import { InputWrapper } from "../container/input-wrapper";
import { InputDivProps } from "../container/input-types";

export default function InputMultiImage({
  label,
  name,
  inputDivData,
  required,
  className,
  widthMultiplier = 2,
  heightMultiplier = 0.5,
}: InputDivProps) {
  const { data, setData, errors } = inputDivData;
  const value =
    Array.isArray(data?.[name]) && data[name] ? data[name] : [];

  const [previews, setPreviews] = useState<string[]>([]);
  const [dragging, setDragging] = useState(false);
  const fileInputRef = useRef<HTMLInputElement>(null);
  const deletedIdsRef = useRef<number[]>([]);

  const width = 240 * widthMultiplier; // same proportions as your original
  const height = width * heightMultiplier;

  useEffect(() => {
    if (!Array.isArray(value)) {
      if (previews.length > 0) setPreviews([]);
      return;
    }

    const newUrls: string[] = [];
    const blobsToRevoke: string[] = [];

    value.forEach((item) => {
      if (typeof item === "string") newUrls.push(item);
      else if (item instanceof File) {
        const url = URL.createObjectURL(item);
        newUrls.push(url);
        blobsToRevoke.push(url);
      } else if (item && typeof item === "object" && "url" in item)
        newUrls.push(item.url);
    });

    if (
      previews.length !== newUrls.length ||
      !previews.every((u, i) => u === newUrls[i])
    ) {
      setPreviews(newUrls);
    }

    return () => blobsToRevoke.forEach(URL.revokeObjectURL);
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [value]);

  const handleFiles = (files: FileList) => {
    const newFiles = Array.from(files);
    const updatedFiles = [...value, ...newFiles];
    setData(name, updatedFiles);
  };

  const handleDrop = (e: React.DragEvent<HTMLDivElement>) => {
    e.preventDefault();
    setDragging(false);
    if (e.dataTransfer.files?.length) handleFiles(e.dataTransfer.files);
  };

  const handleRemove = (index: number) => {
    const current = value || [];
    const removedItem = current[index];
    const updated = current.filter((_, i) => i !== index);
    setData(name, updated);

    if (previews[index]?.startsWith("blob:"))
      URL.revokeObjectURL(previews[index]);

    setPreviews(previews.filter((_, i) => i !== index));

    if (removedItem && typeof removedItem === "object" && "id" in removedItem) {
      if (!deletedIdsRef.current.includes(removedItem.id)) {
        deletedIdsRef.current.push(removedItem.id);
        setData(`deleted_${name}_ids`, [...deletedIdsRef.current]);
      }
    }
  };

  return (
    <InputWrapper className={className}>
      <Label htmlFor={name}>
        {label}
        {required && (
          <span className="text-red-500 font-bold text-xl">*</span>
        )}
      </Label>

      {/* Hidden file input */}
      <input
        ref={fileInputRef}
        id={name}
        type="file"
        accept="image/*"
        multiple
        onChange={(e) => {
          if (e.target.files) handleFiles(e.target.files);
        }}
        className="hidden"
      />

      {/* Upload Box */}
      <div
        onClick={() => fileInputRef.current?.click()}
        onDragOver={(e) => {
          e.preventDefault();
          setDragging(true);
        }}
        onDragLeave={() => setDragging(false)}
        onDrop={handleDrop}
        className={`relative cursor-pointer flex items-center justify-center overflow-hidden 
          rounded-md border-2 border-dashed transition-colors
          ${dragging ? "border-blue-500 bg-blue-100" : "border-gray-400 bg-gray-100"}`}
        style={{ height, width, maxWidth: "100%" }}
      >
        <div className="text-center text-gray-500">
          <p className="text-sm font-medium">
            Click or drag to upload multiple images
          </p>
        </div>
      </div>

      {/* Preview Grid */}
      {previews.length > 0 && (
        <div
          className="grid gap-2 mt-2 overflow-y-auto"
          style={{
            gridTemplateColumns: `repeat(auto-fit, minmax(100px, 1fr))`,
            maxHeight: height, // same fixed height — doesn’t expand the box
          }}
        >
          {previews.map((url, idx) => (
            <div
              key={idx}
              className="relative group rounded-md overflow-hidden border border-gray-300"
              style={{ width: "100%", height: "100px" }}
            >
              <img
                src={url}
                alt={`Preview ${idx}`}
                className="w-full h-full object-cover"
              />
              <button
                onClick={() => handleRemove(idx)}
                type="button"
                className="absolute top-1 right-1 bg-black bg-opacity-60 text-white text-xs px-2 py-0.5 rounded opacity-0 group-hover:opacity-100 transition"
              >
                ✕
              </button>
            </div>
          ))}
        </div>
      )}

      <InputError message={errors[name]?.[0]} />
    </InputWrapper>
  );
}
