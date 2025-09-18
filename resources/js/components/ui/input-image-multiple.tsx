import { useEffect, useRef, useState } from 'react';

export default function MultiImageUploader({
  name,
  value = [],
  setData,
  data,
  widthMultiplier = 2,
  heightMultiplier = .5,
}: {
  name: string;
  value?: (File | string | { id: number; url: string })[];
  setData: (name: string, value: any) => void;
  data?: Record<string, any>;
  heightMultiplier?: number;
  widthMultiplier?: number;
}) {
  const [previews, setPreviews] = useState<string[]>([]);
  const [dragging, setDragging] = useState(false);
  const fileInputRef = useRef<HTMLInputElement>(null);

  const deletedIdsRef = useRef<number[]>([]); // 🔁 persist across renders

   const width = 240 * widthMultiplier; // Tailwind w-72 = 240px
  const height = width * heightMultiplier;

  useEffect(() => {
    if (!value || !Array.isArray(value)) {
      if (previews.length > 0) setPreviews([]);
      return;
    }

    const newUrls: string[] = [];
    const blobsToRevoke: string[] = [];

    value.forEach((item) => {
      if (typeof item === 'string') {
        newUrls.push(item);
      } else if (item instanceof File) {
        const url = URL.createObjectURL(item);
        newUrls.push(url);
        blobsToRevoke.push(url);
      } else if (item && typeof item === 'object' && 'url' in item) {
        newUrls.push(item.url);
      }
    });

    const isSame =
      previews.length === newUrls.length &&
      previews.every((url, i) => url === newUrls[i]);

    if (!isSame) {
      setPreviews(newUrls);
    }

    return () => {
      blobsToRevoke.forEach((url) => URL.revokeObjectURL(url));
    };
  }, [value]);

  const handleFiles = (files: FileList) => {
    const newFiles = Array.from(files);
    const updatedFiles = [...(value || []), ...newFiles];
    setData(name, updatedFiles);
  };

  const handleDrop = (e: React.DragEvent<HTMLDivElement>) => {
    e.preventDefault();
    setDragging(false);
    if (e.dataTransfer.files.length) {
      handleFiles(e.dataTransfer.files);
    }
  };

  const handleRemove = (index: number) => {
    const current = value || [];
    const removedItem = current[index];
    const updated = current.filter((_, i) => i !== index);

    setData(name, updated);

    // ✅ Store deleted ID in ref
    if (removedItem && typeof removedItem === 'object' && 'id' in removedItem) {
      if (!deletedIdsRef.current.includes(removedItem.id)) {
        deletedIdsRef.current.push(removedItem.id);
      }
    }
  };

  // ✅ Flush deleted IDs to form on unmount or before submit
  useEffect(() => {
    const deletedKey = `deleted_${name}_ids`;
    setData(deletedKey, deletedIdsRef.current);

    return () => {
      setData(deletedKey, deletedIdsRef.current); // also on cleanup
    };
  }, []); // optional: or empty array to call just once

  return (
    <div className="space-y-2">
      <input
        ref={fileInputRef}
        type="file"
        accept="image/*"
        multiple
        onChange={(e) => {
          if (e.target.files) handleFiles(e.target.files);
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
        style={{ height, width, maxWidth:"100%" }}
      >
        <div className="text-center text-gray-500">
          <p className="text-sm font-medium">Click or drag to upload multiple images</p>
        </div>
      </div>

      {previews.length > 0 && (
        <div
          className="grid gap-2 mt-2"
          style={{
            gridTemplateColumns: 'repeat(auto-fill, minmax(100px, 1fr))',
            maxHeight: height,
            overflowY: 'auto',
          }}
        >
          {previews.map((url, idx) => (
            <div key={idx} className="relative group">
              <img
                src={url}
                alt={`Preview ${idx}`}
                className="w-full h-24 object-cover rounded-md border"
              />
              <button
                onClick={() => handleRemove(idx)}
                type="button"
                className="absolute top-1 right-1 bg-black bg-opacity-50 text-white text-xs px-2 py-0.5 rounded opacity-0 group-hover:opacity-100 transition"
              >
                Remove
              </button>
            </div>
          ))}
        </div>
      )}
    </div>
  );
}
