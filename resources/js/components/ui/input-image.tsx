import { useRef, useState } from 'react';

export default function ImageUploader({
  name,
  value1,
  setData,
  heightMultiplier = 1,
  widthMultiplier = 2,
}: {
  name: string;
  value1: string;
  setData: (name: string, value: any) => void;
  heightMultiplier?: number;
  widthMultiplier?: number;
}) {
  const [previewUrl, setPreviewUrl] = useState<string | null>(null);
  const [dragging, setDragging] = useState(false);
  const fileInputRef = useRef<HTMLInputElement>(null);

  const height = 288*heightMultiplier; // Tailwind h-72 = 288px
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

  return (
    <div className="space-y-2">
      <input
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
        className={`relative cursor-pointer flex items-center justify-center overflow-hidden rounded-md border-2 border-dashed ${
          dragging ? 'border-blue-500 bg-blue-100' : 'border-gray-400 bg-gray-100'
        }`}
        style={{ height, width }}
      >
        {previewUrl ? (
          <img src={previewUrl} alt="Preview" className="h-full w-full object-contain" />
        ) : value1 ? (
          <img src={value1} alt="Uploaded" className="h-full w-full object-contain" />
        ) : (
          <div className="text-center text-gray-500">
            <p className="text-sm font-medium">Drag & drop or click to upload</p>
          </div>
        )}
      </div>
    </div>
  );
}
