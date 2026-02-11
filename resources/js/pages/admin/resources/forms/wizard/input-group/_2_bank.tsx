import { InputDiv } from '@/components/form/container/input-div';
import InputFieldset from '@/components/form/container/input-fieldset';
// Define InputDivData locally if not exported from '@/types'
type InputDivData = {
    data: Record<string, unknown>;
    setData: (key: string, value: unknown) => void;
    errors: Record<string, string[]>;
};

type Props = {
    inputDivData: InputDivData;
};

export default function BankDetail({ inputDivData }: Props) {
    return (
        <InputFieldset
            legend="Bank Details"
            description="Provide your bank details for payout."
        >
            <div className="grid grid-cols-1 gap-x-4 md:grid-cols-2">
                <InputDiv
                    type="text"
                    label="Account Holder Name"
                    name="bank_account_holder_name"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="Account Number"
                    name="bank_account_number"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="IFSC Code"
                    name="bank_ifsc"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="text"
                    label="UPI ID"
                    name="bank_upi_id"
                    inputDivData={inputDivData}
                />
            </div>

            <InputDiv
                type="file"
                label="Proof of Address / Incorporation (Optional)"
                name="proof_of_address"
                inputDivData={inputDivData}
            />
        </InputFieldset>
    );
}
