import { useEffect, useRef } from 'react';

// Declare CKEDITOR types for window object
declare global {
    interface Window {
        CKEDITOR: any;
    }
}

// CKEditor Style Configuration
const CKEDITOR_STYLES = {
    borderRadius: '0rem',
    headerBgCssVar: '--background2',
    footerBgCssVar: '--primary',
    defaultHeight: 300
};

interface CkEditor4ComponentProps {
    value: string;
    onChange: (data: string) => void;
    id?: string;
    height?: number;
    uiColor?: string;
    customEditorCss?: string; // Path to custom CSS file for editor UI styling
}

export default function CkEditor4Component({ 
    value, 
    onChange, 
    id = 'editor1', 
    height = CKEDITOR_STYLES.defaultHeight,
    uiColor,
    customEditorCss
}: CkEditor4ComponentProps) {
    const editorRef = useRef<HTMLTextAreaElement>(null);

    useEffect(() => {
        // Load custom editor UI CSS if provided
        if (customEditorCss) {
            const linkElement = document.createElement('link');
            linkElement.rel = 'stylesheet';
            linkElement.href = customEditorCss;
            linkElement.id = `ckeditor-custom-css-${id}`;
            document.head.appendChild(linkElement);
        }

        // Get primary color from CSS variables if uiColor is not provided
        let editorUiColor = uiColor;
        let primaryColorValue = '';
        let backgroundColorValue = '';
        
        if (!editorUiColor) {
            try {
                const computedStyle = getComputedStyle(document.documentElement);
                const primaryColor = computedStyle.getPropertyValue(CKEDITOR_STYLES.footerBgCssVar)?.trim();
                const backgroundColor = computedStyle.getPropertyValue(CKEDITOR_STYLES.headerBgCssVar)?.trim();
                
                if (primaryColor) {
                    primaryColorValue = primaryColor;
                    // Convert CSS variable format to hex if needed
                    editorUiColor = primaryColor.startsWith('#') ? primaryColor : `hsl(${primaryColor})`;
                }
                
                if (backgroundColor) {
                    backgroundColorValue = backgroundColor;
                }
            } catch (error) {
                console.warn('Could not read primary color from CSS variables:', error);
            }
        }

        // Inject dynamic CSS for CKEditor UI elements using primary color
        if (primaryColorValue || uiColor) {
            const styleId = `ckeditor-dynamic-style-${id}`;
            const existingStyle = document.getElementById(styleId);
            
            if (!existingStyle) {
                const styleElement = document.createElement('style');
                styleElement.id = styleId;
                const primaryToUse = uiColor || (primaryColorValue.startsWith('#') ? primaryColorValue : `hsl(${primaryColorValue})`);
                const backgroundToUse = backgroundColorValue.startsWith('#') ? backgroundColorValue : `hsl(${backgroundColorValue})`;
                
                styleElement.textContent = `
                    #cke_${id} {
                        border-radius: ${CKEDITOR_STYLES.borderRadius} !important;
                        overflow: hidden !important;
                    }
                    #cke_${id} .cke_bottom {
                        background: ${primaryToUse} !important;
                    }
                    #cke_${id} .cke_top {
                        background: ${backgroundToUse || primaryToUse} !important;
                        border-top-left-radius: ${CKEDITOR_STYLES.borderRadius} !important;
                        border-top-right-radius: ${CKEDITOR_STYLES.borderRadius} !important;
                    }
                    #cke_${id} .cke_bottom {
                        border-bottom-left-radius: ${CKEDITOR_STYLES.borderRadius} !important;
                        border-bottom-right-radius: ${CKEDITOR_STYLES.borderRadius} !important;
                    }
                `;
                document.head.appendChild(styleElement);
            }
        }

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
                const config: any = {
                    height: height,
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
                };

                // Add uiColor if available
                if (editorUiColor) {
                    config.uiColor = editorUiColor;
                }

                window.CKEDITOR.replace(id, config);

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
            
            // Remove custom CSS link if it was added
            if (customEditorCss) {
                const linkElement = document.getElementById(`ckeditor-custom-css-${id}`);
                if (linkElement) {
                    linkElement.remove();
                }
            }
            
            // Remove dynamic style element
            const styleElement = document.getElementById(`ckeditor-dynamic-style-${id}`);
            if (styleElement) {
                styleElement.remove();
            }
        };
    }, [id, height, uiColor, customEditorCss, onChange, value]);

    return <textarea ref={editorRef} id={id} defaultValue={value}></textarea>;
}
