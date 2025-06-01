import { useRef, useState } from 'react';

export default function FileUploader({
  name,
  value1,
  setData,
}: {
  name: string;
  value1: string;
  setData: (name: string, value: any) => void;
}) {
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

  return (
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
          dragging ? 'border-blue-500 bg-blue-100' : 'border-gray-400 bg-gray-100'
        }`}
      >
        <div className="text-center text-gray-600">
          {fileName ? (
            <p className="text-sm font-medium">Selected File: {fileName}</p>
          ) : value1 ? (
            <p className="text-sm font-medium">Uploaded File: {value1}</p>
          ) : (
            <p className="text-sm font-medium">Drag & drop or click to upload</p>
          )}
        </div>
      </div>
    </div>
  );
}
