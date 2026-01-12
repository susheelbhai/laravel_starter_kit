import { InputDiv } from '@/components/form/container/input-div';
import InputFieldset from '@/components/form/container/input-fieldset';

export default function BasicDetails({ inputDivData }: { inputDivData: any }) {
    return (
        <InputFieldset legend="Basic Details" description="Tell us about you.">
            <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
                <InputDiv
                    type="text"
                    label="Name"
                    name="name"
                    inputDivData={inputDivData}
                    required
                    placeholder="Rohit Sharma"
                />
                <InputDiv
                    type="email"
                    label="Email"
                    name="email"
                    inputDivData={inputDivData}
                    required
                    placeholder="rohit@example.com"
                />
                <InputDiv
                    type="tel"
                    label="Phone"
                    name="phone"
                    inputDivData={inputDivData}
                    required
                    placeholder="+1234567890"
                />
                <InputDiv
                    type="text"
                    label="Address Line 1"
                    name="address1"
                    inputDivData={inputDivData}
                    required
                    placeholder="123 Main St"
                />
                <InputDiv
                    type="text"
                    label="Address Line 2"
                    name="address2"
                    inputDivData={inputDivData}
                    placeholder="Apt, Suite, etc. (optional)"
                />
                <InputDiv
                    type="text"
                    label="City"
                    name="city"
                    inputDivData={inputDivData}
                    required
                    placeholder="New York"
                />
                <InputDiv
                    type="text"
                    label="State"
                    name="state"
                    inputDivData={inputDivData}
                    required
                    placeholder="NY"
                />
                <InputDiv
                    type="text"
                    label="Country"
                    name="country"
                    inputDivData={inputDivData}
                    required
                    placeholder="USA"
                />
                <InputDiv
                    type="text"
                    label="Pin Code"
                    name="pin_code"
                    inputDivData={inputDivData}
                    required
                    placeholder="10001"
                />
                <div className="flex gap-4">
                    <InputDiv
                        className=""
                        widthMultiplier={0.75}
                        heightMultiplier={0.8}
                        type="image"
                        label="Photo "
                        name="profile_pic"
                        inputDivData={inputDivData}
                        required
                    />
                    <div className="pt-8">
                        Upload an image (3:4 aspect ratio) for your profile pic.
                        <br /> <br />
                        <label
                            className="cursor-pointer rounded-lg bg-indigo-300 p-2 text-sm font-medium text-gray-700"
                            htmlFor="logo"
                        >
                            Upload Logo
                        </label>
                    </div>
                </div>
            </div>
        </InputFieldset>
    );
}
