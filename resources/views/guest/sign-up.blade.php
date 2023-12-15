<x-layout>

    <div class="flex">
        <div class="flex flex-col w-1/2 h-screen justify-center items-center">
            <h1 class="text-4xl font-bold mb-6">Sign Up</h1>
            <form action="#" method="post">
                <x-form.input type='text' name='username' labelText='Username' placeholder='@username' />
                <x-form.input type='email' name='email' labelText='Email' placeholder='example@mail.com' />
                <x-form.input type='password' name='password' labelText='Password' placeholder='Password' />
                <x-form.input type='password' name='password_confirm' labelText='Password Confirm' placeholder='Password Confirm' />
                <input type="submit" value="SIGN UP" class="w-full h-10 mt-2 rounded-md text-white font-bold text-xl bg-cyan-500">
            </form>
            <p class="text-sm mt-2">Do you already have an account? <a href="/sign-in" class="text-cyan-600 font-semibold">Sign In</a> </p>
        </div>
        <img src="https://images.pexels.com/photos/4526473/pexels-photo-4526473.jpeg?cs=srgb&dl=pexels-screen-post-4526473.jpg&fm=jpg&w=1920&h=2880" class="w-1/2 h-screen object-cover" alt="">
    </div>

    <div class="w-screen absolute bottom-0 opacity-40 -z-40">
        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
            xmlns:svgjs="http://svgjs.dev/svgjs" width="1920" height="600" preserveAspectRatio="none"
            viewBox="0 0 1920 600">
            <g mask="url(&quot;#SvgjsMask1009&quot;)" fill="none">
                <path
                    d="M-93.61 162.03C102.62 164.95 256.53 393.82 653.82 402.03 1051.12 410.24 1199.96 696.82 1401.26 702.37"
                    stroke="rgba(51,121,194,0.58)" stroke-width="2"></path>
                <path
                    d="M-317.8 230.86C-150.15 234.92-25.87 463.19 308.57 470.86 643.02 478.53 768.14 697.59 934.95 701.2"
                    stroke="rgba(51,121,194,0.58)" stroke-width="2"></path>
                <path
                    d="M-130.71 282.09C109.06 283.61 438.52 500.21 802.34 504.09 1166.16 507.97 1144.14 678.26 1268.86 681.21"
                    stroke="rgba(51,121,194,0.58)" stroke-width="2"></path>
                <path
                    d="M-222.64 243.12C-50.37 242.32 176.81 90.34 451.22 99.12 725.63 107.9 643.28 590.91 788.15 672.49"
                    stroke="rgba(51,121,194,0.58)" stroke-width="2"></path>
                <path
                    d="M-223.23 488.24C-81.62 488.41 57.49 563.24 338.21 563.24 618.94 563.24 618.11 488.18 899.66 488.24 1181.2 488.3 1315.09 647.67 1461.1 649.25"
                    stroke="rgba(51,121,194,0.58)" stroke-width="2"></path>
            </g>
            <defs>
                <mask id="SvgjsMask1009">
                    <rect width="1920" height="600" fill="#ffffff"></rect>
                </mask>
            </defs>
        </svg>
    </div>

</x-layout>