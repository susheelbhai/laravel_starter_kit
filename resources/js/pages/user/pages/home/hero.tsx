export default function HeroSection(props: any) {
    const appName = props.data?.appData?.name;

    return (
        <section
            id="home"
            className="relative overflow-hidden bg-[#F5F6FA] py-20 text-left md:py-32"
            style={{
                backgroundImage: "url('/storage/images/custom_uploads/banner3.jpg')",
                backgroundRepeat: "no-repeat",
                backgroundSize: "cover",      // full width cover
                backgroundPosition: "center", // image center-balanced
            }}
        >
            <div className="mx-auto grid max-w-[1320px] items-center gap-8 px-4 md:grid-cols-2 md:px-6">
                
                {/* LEFT: CONTENT */}
                <div>
                    <p className="mb-4 font-semibold text-primary">
                        Welcome to {appName}
                    </p>

                    <h1 className="text-4xl leading-tight font-bold md:text-6xl">
                        Smart Solutions For <br />
                        Your Business Needs
                    </h1>

                    <p className="mt-6 max-w-md text-[#6B7280]">
                        We are a team of talented designers making websites with Bootstrap
                    </p>

                    <div className="mt-8 flex space-x-4">
                        <button className="rounded-md bg-primary px-6 py-3 font-semibold text-white hover:bg-primary/80">
                            Get Started
                        </button>
                        <button className="rounded-md border border-primary px-6 py-3 font-semibold text-primary hover:bg-primary hover:text-white">
                            Learn More
                        </button>
                    </div>
                </div>

                {/* RIGHT: EMPTY SPACER */}
                <div className="h-[260px] md:h-[360px]"></div>
            </div>
        </section>
    );
}
