import { useForm, router } from "@inertiajs/react";

/**
 * Smart FormData builder
 */
function appendValue(fd: FormData, key: string, value: any) {
    if (value instanceof File) {
        fd.append(key, value);
        return;
    }

    if (Array.isArray(value)) {
        value.forEach((item) => appendValue(fd, `${key}[]`, item));
        return;
    }

    if (value instanceof Date) {
        fd.append(key, value.toISOString());
        return;
    }

    if (typeof value === "object" && value !== null) {
        fd.append(key, JSON.stringify(value));
        return;
    }

    if (value !== undefined && value !== null) {
        fd.append(key, String(value));
    }
}

export function useFormHandler<T extends Record<string, any>>(options: {
    url: string;
    initialValues: T;
    method?: "POST" | "PUT" | "PATCH" | "DELETE";
    onlyDirty?: boolean;
    extraData?: Record<string, any>;
    onSuccess?: () => void;
    onError?: (errors: Record<string, string[]>) => void;
}) {
    const {
        data,
        setData,
        errors,
        setError,
        clearErrors,
        processing,
        reset,
    } = useForm<T>(options.initialValues);

    const submit = (e: React.FormEvent) => {
        e.preventDefault();

        const method = options.method || "POST";

        const merged = { ...data, ...(options.extraData || {}) };
        const fd = new FormData();

        Object.entries(merged).forEach(([key, value]) => {
            if (options.onlyDirty && value === options.initialValues[key]) return;
            appendValue(fd, key, value);
        });

        if (method !== "POST") fd.append("_method", method);

        clearErrors();

        router.post(options.url, fd, {
            forceFormData: true,
            onSuccess: () => {
                if (options.onSuccess) options.onSuccess();
                reset();
            },
            onError: (err) => {
                setError(err as any);
                if (options.onError) options.onError(err as any);
            },
        });
    };

    return {
        submit,
        data,
        setData,
        errors,
        processing,
        reset,
        inputDivData: {
            data,
            setData,
            errors: Object.fromEntries(
                Object.entries(errors).map(([k, v]) => [
                    k,
                    Array.isArray(v) ? v : v ? [v] : [],
                ])
            ) as Record<string, string[]>,
        },
    };
}
