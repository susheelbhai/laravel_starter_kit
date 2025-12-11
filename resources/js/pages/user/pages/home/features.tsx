export default function FeatureSection() {
    return (
        <section id="features" className="bg-background py-20 md:py-28">
            <div className="mx-auto grid max-w-[1320px] items-center gap-12 px-4 md:grid-cols-2 md:px-6">
                
                <div>
                    <span className="text-sm font-semibold tracking-wider text-primary uppercase">
                        Why Choose Us
                    </span>
                    <h2 className="mt-4 mb-6 text-3xl leading-tight font-bold md:text-5xl">
                        We're Ready To Grow <br /> Your Business With Us
                    </h2>
                    <p className="mb-6 text-[#6B7280]">
                        Finbiz helps you grow your business through effective
                        strategy and a professional support system tailored to
                        your industry.
                    </p>
                    <div className="grid grid-cols-2 gap-4 text-left">
                        <div>
                            <h4 className="mb-1 text-lg font-semibold">
                                Quality Services
                            </h4>
                            <p className="text-sm text-[#6B7280]">
                                Best-in-class strategic advice and services.
                            </p>
                        </div>
                        <div>
                            <h4 className="mb-1 text-lg font-semibold">
                                Expert Team
                            </h4>
                            <p className="text-sm text-[#6B7280]">
                                Experienced consultants for every project.
                            </p>
                        </div>
                        <div>
                            <h4 className="mb-1 text-lg font-semibold">
                                100% Secure
                            </h4>
                            <p className="text-sm text-[#6B7280]">
                                Your data and privacy are always protected.
                            </p>
                        </div>
                        <div>
                            <h4 className="mb-1 text-lg font-semibold">
                                24/7 Support
                            </h4>
                            <p className="text-sm text-[#6B7280]">
                                Always available to solve your problems.
                            </p>
                        </div>
                    </div>
                </div>

                <div className="relative">
                    <img
                        src="/storage/images/custom_uploads/about2.png"
                        alt="About"
                        className="w-full rounded-md"
                    />
                </div>
            </div>
        </section>
    );
}
