<x-app
    :title="'dfjkdjf'"
    :des="'dfjkdjf'"
    :key="'dfjkdjf'"
    :titleTwitter="'dfjkdjf'"></x-app>

<!-- Container -->
<div class="min-h-screen flex items-center justify-center px-4 py-12 bg-emerald-50 dark:bg-slate-900/30">
    <div class="max-w-4xl w-full bg-white rounded-2xl shadow-lg p-8 md:p-12  dark:bg-slate-700 ">

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold dark:text-gray-100 mb-2">Contact Us</h1>
            <p class="dark:text-gray-200">Have questions or suggestions? We'd love to hear from you!</p>
        </div>

        <!-- Form Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Contact Info -->
            <div class="flex flex-col justify-center">
                <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-100 mb-4">Get in Touch</h2>
                <p class="text-gray-700 dark:text-gray-200 mb-6">You can reach out to us via email or fill out the form. We aim to respond within 24 hours.</p>
                <ul class="space-y-4 dark:text-gray-200">
                    <li class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0l4-4m0 8l-4-4" />
                        </svg>
                        <span>Email: support@calculators.com</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m0 4v12m0-12h12" />
                        </svg>
                        <span>Phone: +1 (555) 123-4567</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c2.5 0 4.5-2 4.5-4.5S14.5 2 12 2 7.5 4 7.5 6.5 9.5 11 12 11zM12 11v10" />
                        </svg>
                        <span>Address: 123 Calculator Street, Math City</span>
                    </li>
                </ul>
            </div>

            <!-- Contact Form -->
            <div>
                <form class="space-y-6" method="post" action="{{ route('contact.store')  }}">
                    @csrf
                    <div>
                        <label class="block text-gray-700 dark:text-gray-200 font-medium mb-2" for="name">Full Name</label>
                        <input name="name" class="w-full px-4 py-3 text-gray-900 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" type="text" id="name" placeholder="Your Name">
                    </div>
                    <div>
                        <label class="block text-gray-700 dark:text-gray-200 font-medium mb-2" for="email">Email</label>
                        <input name="email" class="w-full text-gray-900 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" type="email" id="email" placeholder="Your Email">
                    </div>
                    <div>
                        <label class="block text-gray-700 dark:text-gray-200 font-medium mb-2" for="message">Message</label>
                        <textarea name="message" class="w-full px-4 py-3 text-gray-900 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" id="message" rows="5" placeholder="Your Message"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg shadow-md transition duration-300">Send Message</button>
                </form>
            </div>

        </div>

    </div>
</div>



<x-appfooter></x-appfooter>