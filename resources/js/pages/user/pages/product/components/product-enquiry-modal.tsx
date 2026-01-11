import { InputDiv } from '@/components/form/container/input-div';
import { Button } from '@/components/ui/button';
import { useFormHandler } from '@/lib/use-form-handler';
import { X, Loader2 } from 'lucide-react';

interface ProductEnquiryModalProps {
    isOpen: boolean;
    onClose: () => void;
    productId: number;
    productTitle: string;
}

type FormType = {
    name: string;
    email: string;
    phone: string;
    message: string;
    product_id: number;
};

export default function ProductEnquiryModal({
    isOpen,
    onClose,
    productId,
    productTitle,
}: ProductEnquiryModalProps) {
    const initialValues: FormType = {
        name: '',
        email: '',
        phone: '',
        message: '',
        product_id: productId,
    };

    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('product.enquiry'),
        initialValues,
        method: 'POST',
        onSuccess: () => {
            onClose();
        },
    });

    if (!isOpen) return null;

    return (
        <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
            <div className="relative w-full max-w-md rounded-lg bg-background p-6 shadow-xl">
                {/* Close Button */}
                <button
                    onClick={onClose}
                    className="absolute right-4 top-4 text-muted-foreground hover:text-foreground"
                    type="button"
                >
                    <X className="h-5 w-5" />
                </button>

                {/* Header */}
                <h2 className="mb-2 text-2xl font-bold text-foreground">
                    Product Enquiry
                </h2>
                <p className="mb-6 text-sm text-muted-foreground">
                    Interested in {productTitle}? Fill out the form below and
                    we'll get back to you soon.
                </p>

                {/* Form */}
                <form onSubmit={submit} className="space-y-4">
                    <InputDiv
                        type="text"
                        label="Name"
                        name="name"
                        inputDivData={inputDivData}
                        required
                    />

                    <InputDiv
                        type="email"
                        label="Email"
                        name="email"
                        inputDivData={inputDivData}
                        required
                    />

                    <InputDiv
                        type="tel"
                        label="Phone"
                        name="phone"
                        inputDivData={inputDivData}
                        required
                    />

                    <InputDiv
                        type="textarea"
                        label="Message"
                        name="message"
                        inputDivData={inputDivData}
                        required
                    />

                    <Button
                        type="submit"
                        disabled={processing}
                        className="w-full"
                    >
                        {processing ? (
                            <>
                                <Loader2 className="h-4 w-4 animate-spin" />
                                Processing...
                            </>
                        ) : (
                            'Submit Enquiry'
                        )}
                    </Button>
                </form>
            </div>
        </div>
    );
}
