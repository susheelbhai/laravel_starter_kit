
import { useEffect, useRef } from 'react';

// Global promise to ensure TinyMCE script loads only once
let tinyMceScriptPromise: Promise<void> | null = null;

// Declare TinyMCE types for window object
declare global {
    interface Window {
        tinymce: any;
    }
}

const TINYMCE_STYLES = {
    borderRadius: '1rem',
    headerBgCssVar: '--background2',
    footerBgCssVar: '--primary',
    defaultHeight: 480,
    primaryColor: 'var(--primary)',
    primaryForeground: 'var(--primary-foreground)',
    bodyForDark: 'var(--input-bg)',
};

interface TinyMceComponentProps {
    value: string;
    onChange: (data: string) => void;
    id?: string;
    height?: number;
    uiColor?: string;
    customEditorCss?: string; // Path to custom CSS file for editor UI styling
}

export default function TinyMceComponent({
    value,
    onChange,
    id = 'tinymce1',
    height = TINYMCE_STYLES.defaultHeight,
    uiColor,
    customEditorCss
}: TinyMceComponentProps) {
    const editorRef = useRef<HTMLTextAreaElement>(null);
    const editorInstanceRef = useRef<any>(null);

    // Initialize TinyMCE only once
    useEffect(() => {
        let isMounted = true;
        // Inject custom UI styles for TinyMCE
        const styleId = `tinymce-dynamic-style-${id}`;
        let styleElement = document.getElementById(styleId);
        if (!styleElement) {
            styleElement = document.createElement('style');
            styleElement.id = styleId;
            // You can adjust these colors/variables as needed
            styleElement.textContent = `
                .tox .tox-menubar+.tox-toolbar, .tox .tox-menubar+.tox-toolbar-overlord .tox-toolbar__primary {
                    border-top: .1rem solid ${TINYMCE_STYLES.primaryColor} !important;
                    border-bottom: .1rem solid ${TINYMCE_STYLES.primaryColor} !important;
                }
                .tox.tox-tinymce {
                    border-radius: ${TINYMCE_STYLES.borderRadius} !important;
                    border: 1.5px solid ${TINYMCE_STYLES.primaryColor} !important;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
                    overflow: hidden !important;
                }
                .tox .tox-toolbar, .tox .tox-menubar {
                    background: var(${TINYMCE_STYLES.headerBgCssVar}) !important;
                }
                .tox .tox-statusbar {
                    background: ${TINYMCE_STYLES.primaryColor} !important;
                }
                .tox .tox-statusbar__text,
                .tox .tox-statusbar__branding,
                .tox .tox-statusbar a,
                .tox .tox-statusbar__path-item,
                .tox .tox-statusbar__wordcount,
                .tox .tox-statusbar :not(svg):not(rect) {
                    color: ${TINYMCE_STYLES.primaryForeground} !important;
                    font-weight: 600 !important;
                    text-shadow: 0 1px 2px rgba(0,0,0,0.18) !important;
                    opacity: 1 !important;
                }
                .tox .tox-statusbar{height: 2rem !important;}
                
                /* Dropdown Menu Styling - Light Mode */
                .tox .tox-menu,
                .tox .tox-collection,
                .tox .tox-collection--list,
                .tox .tox-menu.tox-menu,
                .tox .tox-collection.tox-collection {
                    background: white !important;
                    border: 1px solid #e1e5e9 !important;
                }
                
                .tox .tox-collection__item,
                .tox .tox-menu__item,
                .tox .tox-collection__item.tox-collection__item,
                .tox .tox-menu__item.tox-menu__item {
                    color: #3c4146 !important;
                    background: transparent !important;
                }
                
                .tox .tox-collection__item:hover,
                .tox .tox-menu__item:hover,
                .tox .tox-collection__item--active,
                .tox .tox-menu__item--active {
                    background: ${TINYMCE_STYLES.primaryColor} !important;
                    color: ${TINYMCE_STYLES.primaryForeground} !important;
                }
                
                .tox .tox-mbtn:hover{
                 background: ${TINYMCE_STYLES.primaryColor} !important;
                    color: ${TINYMCE_STYLES.primaryForeground} !important;
                }

                
                .tox .tox-mbtn:hover{
                 background: ${TINYMCE_STYLES.primaryColor} !important;
                    color: ${TINYMCE_STYLES.primaryForeground} !important;
                }

                .tox .tox-collection__item--state-disabled,
                .tox .tox-menu__item--state-disabled {
                    color: #a6a6a6 !important;
                }

                

                /* Dark mode editable area background */
                .dark .tox :not(svg):not(rect){
                    color: ${TINYMCE_STYLES.primaryForeground} !important;
                }
                .dark .tox .tox-toolbar, .dark .tox .tox-toolbar__overflow, .dark .tox .tox-toolbar__primary {
                    background: ${TINYMCE_STYLES.bodyForDark} !important;
                }
                .dark .tox .tox-edit-area iframe {
                    background: ${TINYMCE_STYLES.bodyForDark} !important;
                }
                
                /* Dropdown Menu Styling - Dark Mode */
                .dark .tox .tox-menu,
                .dark .tox .tox-collection,
                .dark .tox .tox-collection--list {
                    background: #2d3748 !important;
                    border: 1px solid #4a5568 !important;
                }
                
                .dark .tox .tox-collection__item,
                .dark .tox .tox-menu__item {
                    color: #e2e8f0 !important;
                    background: transparent !important;
                }
                
                .dark .tox .tox-collection__item:hover,
                .dark .tox .tox-menu__item:hover,
                .dark .tox .tox-collection__item--active,
                .dark .tox .tox-menu__item--active {
                    background: ${TINYMCE_STYLES.primaryColor} !important;
                    color: #e2e8f0 !important;
                }
                
                .dark .tox .tox-collection__item--state-disabled,
                .dark .tox .tox-menu__item--state-disabled {
                    color: #718096 !important;
                }
            `;
            document.head.appendChild(styleElement);
        }

        const loadTinyMceScript = () => {
            if (window.tinymce) return Promise.resolve();
            if (!tinyMceScriptPromise) {
                tinyMceScriptPromise = new Promise((resolve) => {
                    const script = document.createElement('script');
                    script.src = '/themes/tinymce/tinymce.min.js';
                    script.onload = () => resolve();
                    document.body.appendChild(script);
                });
            }
            return tinyMceScriptPromise;
        };

        const initEditor = () => {
            if (editorRef.current && window.tinymce && !editorInstanceRef.current) {
                window.tinymce.init({
                    target: editorRef.current,
                    height: height,
                    width: '100%',
                    menubar: true,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste code help wordcount'
                    ],
                    toolbar:
                        'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
                    setup: (editor: any) => {
                        editorInstanceRef.current = editor;
                        editor.on('Change KeyUp', () => {
                            onChange(editor.getContent());
                        });
                        editor.on('init', () => {
                            editor.setContent(value || '');
                        });
                    },
                });
            }
        };

        loadTinyMceScript().then(() => {
            if (isMounted) {
                initEditor();
            }
        });

        // Cleanup
        return () => {
            isMounted = false;
            if (window.tinymce && editorInstanceRef.current) {
                window.tinymce.remove(editorInstanceRef.current);
                editorInstanceRef.current = null;
            }
            // Remove dynamic style element
            const styleElement = document.getElementById(styleId);
            if (styleElement) {
                styleElement.remove();
            }
        };
    }, [id, height, onChange, value]);

    // Update content if value changes
    useEffect(() => {
        if (window.tinymce && editorInstanceRef.current) {
            const currentContent = editorInstanceRef.current.getContent();
            if (value !== currentContent) {
                editorInstanceRef.current.setContent(value || '');
            }
        }
    }, [value]);

    return (
        <div style={{ minHeight: 350, width: '100%' }}>
            <textarea
                ref={editorRef}
                id={id}
                defaultValue={value}
                style={{ minHeight: 300, width: '100%' }}
            ></textarea>
        </div>
    );
}