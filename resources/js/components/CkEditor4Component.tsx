import { useEffect, useRef } from 'react';

export default function CkEditor4Component({ value, onChange, id = 'editor1' }: { value: string; onChange: (data: string) => void; id?: string }) {
    const editorRef = useRef<HTMLTextAreaElement>(null);

    useEffect(() => {
        const loadEditor = async () => {
            // Load the CKEditor script dynamically
            if (!window.CKEDITOR) {
                const script = document.createElement('script');
                script.src = '/themes/ck_editor/vendor_components/ckeditor/ckeditor.js';
                script.onload = () => {
                    initEditor();
                };
                document.body.appendChild(script);
            } else {
                initEditor();
            }
        };

        const initEditor = () => {
            if (editorRef.current && window.CKEDITOR) {
                window.CKEDITOR.replace(id, {
                    height: 300,
                    toolbar: [
                        { name: 'document', items: ['Source', 'Save', 'NewPage', 'Preview', 'Print'] },
                        { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'Undo', 'Redo'] },
                        { name: 'editing', items: ['Find', 'Replace', 'SelectAll'] },
                        { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
                        { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv'] },
                        { name: 'alignment', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                        { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
                        { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar'] },
                        { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
                        { name: 'colors', items: ['TextColor', 'BGColor'] },
                        { name: 'tools', items: ['Maximize', 'ShowBlocks'] },
                    ],
                });

                window.CKEDITOR.instances[id].on('change', function () {
                    const data = window.CKEDITOR.instances[id].getData();
                    onChange(data);
                });

                window.CKEDITOR.instances[id].setData(value);
            }
        };

        loadEditor();

        // Cleanup
        return () => {
            if (window.CKEDITOR?.instances?.[id]) {
                window.CKEDITOR.instances[id].destroy();
            }
        };
    }, [id]);

    return <textarea ref={editorRef} id={id} defaultValue={value}></textarea>;
}
