import { router } from '@inertiajs/react';
import Swal from 'sweetalert2';

// Helper function to get CSS variable value
const getCSSVariable = (variable: string): string => {
    return getComputedStyle(document.documentElement).getPropertyValue(variable).trim();
};

export const handleDelete = (action: string): void => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: getCSSVariable('--destructive') || '#dc2626',
        cancelButtonColor: getCSSVariable('--muted-foreground') || '#64748b',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(action, {
                onSuccess: (): void => {
                    Swal.fire('Deleted!', 'Record has been deleted.', 'success');
                },
                onError: (): void => {
                    Swal.fire('Error!', 'Failed to delete the record.', 'error');
                },
            });
        }
    });
};

export const handleSubmit = (action: string): void => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: getCSSVariable('--primary') || '#dc2626',
        cancelButtonColor: getCSSVariable('--muted-foreground') || '#64748b',
        confirmButtonText: 'Yes, Submit it!',
    }).then((result) => {
        if (result.isConfirmed) {
            router.post(
                action,
                {},
                {
                    onSuccess: (): void => {
                        Swal.fire('Submitted!', 'Record has been submitted.', 'success');
                    },
                    onError: (): void => {
                        Swal.fire('Error!', 'Failed to submit the record.', 'error');
                    },
                },
            );
        }
    });
};
