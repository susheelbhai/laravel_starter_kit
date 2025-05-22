// resources/js/components/CKEditorField.tsx

import { CKEditor } from '@ckeditor/ckeditor5-react';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { useEffect, useState } from 'react';

type Props = {
  value: string;
  onChange: (data: string) => void;
};

export default function CKEditorField({ value, onChange }: Props) {
  const [editorLoaded, setEditorLoaded] = useState(false);

  useEffect(() => {
    setEditorLoaded(true);
  }, []);

  return (
    <div className="border rounded-md">
      {editorLoaded ? (
        <CKEditor
          editor={ClassicEditor}
          data={value}
          config={{
            licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3Nzg1NDM5OTksImp0aSI6IjgxMDY0MTg5LTc3YjUtNDZhOS04NTIwLTgzYmQ3NTUxMTY4YiIsImxpY2Vuc2VkSG9zdHMiOlsiMTI3LjAuMC4xIiwibG9jYWxob3N0IiwiMTkyLjE2OC4qLioiLCIxMC4qLiouKiIsIjE3Mi4qLiouKiIsIioudGVzdCIsIioubG9jYWxob3N0IiwiKi5sb2NhbCJdLCJ1c2FnZUVuZHBvaW50IjoiaHR0cHM6Ly9wcm94eS1ldmVudC5ja2VkaXRvci5jb20iLCJkaXN0cmlidXRpb25DaGFubmVsIjpbImNsb3VkIiwiZHJ1cGFsIl0sImxpY2Vuc2VUeXBlIjoiZGV2ZWxvcG1lbnQiLCJmZWF0dXJlcyI6WyJEUlVQIl0sInZjIjoiMWQyZjU5NmEifQ.GCh9KpedrKLKwdfJ36RdxooFS3y7U6svWiawiutq_jrs0UvlEETJjrhpTOIXlelGYsztgkJTXFtjPTsQa_F5PQ', // Your real API key
            toolbar: [
              'heading', '|',
              'bold', 'italic', 'underline', 'link', 'bulletedList', 'numberedList', '|',
              'insertTable', 'blockQuote', 'undo', 'redo', '|',
              'fontColor', 'fontBackgroundColor', 'alignment',
            ],
          }}
          onChange={(_, editor) => {
            const data = editor.getData();
            onChange(data);
          }}
        />
      ) : (
        <p>Loading editor…</p>
      )}
    </div>
  );
}
