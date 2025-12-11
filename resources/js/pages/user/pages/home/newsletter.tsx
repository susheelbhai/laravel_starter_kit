import { useEffect, useRef } from "react";
import { Button } from "@/components/ui/button";
import { useFormHandler } from "@/lib/use-form-handler";

type NewsletterForm = {
    email: string;
};

export default function NewsletterSection() {
    const { submit, inputDivData, processing } = useFormHandler<NewsletterForm>({
        url: route("newsletter"),
        initialValues: {
            email: "",
        },
        method: "POST",
        onSuccess: () => console.log("Newsletter subscribed!"),
        // preserveScroll: true, // you can keep or remove this; effect below will handle it
    });

    const { data, setData, errors } = inputDivData;

    const sectionRef = useRef<HTMLElement | null>(null);

    // 🔥 Whenever there is an email error after submit, scroll back to this section
    useEffect(() => {
        if (errors.email && sectionRef.current) {
            sectionRef.current.scrollIntoView({
                behavior: "smooth",
                block: "center",
            });
        }
    }, [errors.email]);

    return (
        <section
            id="newsletter"
            ref={sectionRef}
            className="bg-white py-20 md:py-28"
        >
            <div className="mx-auto max-w-[700px] px-4 text-center md:px-6">
                <span className="text-sm font-semibold text-primary uppercase">
                    Newsletter
                </span>
                <h2 className="mt-2 mb-6 text-3xl font-bold md:text-5xl">
                    Stay Updated With Our Latest News
                </h2>
                <p className="mb-8 text-[#6B7280]">
                    Subscribe to receive the latest updates and offers from Finbiz.
                </p>

                <form onSubmit={submit} className="mx-auto max-w-md">
                    <div className="flex w-full items-stretch overflow-hidden rounded-full border border-primary bg-white">
                        <input
                            type="email"
                            name="email"
                            value={data.email}
                            onChange={(e) => setData("email", e.target.value)}
                            placeholder="Enter your email"
                            className="flex-1 border-none bg-transparent px-4 py-2.5 text-sm text-gray-700 placeholder:text-gray-400 outline-none focus:outline-none focus:ring-0"
                        />

                        <Button
                            type="submit"
                            disabled={processing}
                            className="
                                m-0 
                                h-full 
                                rounded-none rounded-r-full 
                                bg-primary 
                                px-6 
                                text-sm font-semibold text-white 
                                hover:bg-primary/90
                                border-2 border-primary
                                hover:border-primary/90
                                focus:border-primary/90
                                active:border-primary/90
                            "
                        >
                            {processing ? "…" : "Subscribe"}
                        </Button>
                    </div>

                    {errors.email && (
                        <p className="mt-2 text-sm text-red-500">
                            {errors.email}
                        </p>
                    )}
                </form>
            </div>
        </section>
    );
}
