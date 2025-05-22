import { useRef, useState } from 'react';

export default function ImageUploader({name, value1, setData }: { name: string;  value1: string; setData: (name: string, key: string, value: any) => void }) {
  const [previewUrl, setPreviewUrl] = useState<string | null>(null);
  const [dragging, setDragging] = useState(false);
  const fileInputRef = useRef<HTMLInputElement>(null);

  const handleFile = (file: File) => {
    setData(name, file);
    setPreviewUrl(URL.createObjectURL(file));
  };

  console.log('value', value1);

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
        className={`relative flex h-72 w-150 cursor-pointer items-center justify-center overflow-hidden rounded-md border-2 border-dashed ${
          dragging ? 'border-blue-500 bg-blue-100' : 'border-gray-400 bg-gray-100'
        }`}
      >
        {previewUrl ? (
          <img src={previewUrl} alt="Preview" className="h-full w-full object-cover" />
        ) : value1 ? (
          <img src={`/storage/${value1}`} alt="Uploaded" className="h-full w-full object-cover" />
        ) : (
          <div className="text-center text-gray-500">
            <p className="text-sm font-medium">Drag & drop or click to upload</p>
          </div>
        )}
      </div>

    </div>
  );
}
