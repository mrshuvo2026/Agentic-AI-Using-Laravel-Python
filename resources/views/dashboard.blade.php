<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- 👇 স্ট্যাটস কার্ড সেকশন -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- মোট ইউজার কার্ড -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-700">Total Users</h3>
                    <p class="text-4xl font-extrabold text-blue-600 mt-2">{{ $totalUsers }}</p>
                </div>

                <!-- মোট কোর্স কার্ড -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-700">Total Courses</h3>
                    <p class="text-4xl font-extrabold text-green-600 mt-2">{{ $totalCourses }}</p>
                </div>

                <!-- মোট লেসন কার্ড -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-700">Total Lessons</h3>
                    <p class="text-4xl font-extrabold text-purple-600 mt-2">{{ $totalLessons }}</p>
                </div>

            </div>
            <!-- 👆 স্ট্যাটস কার্ড সেকশন শেষ -->

        </div>
    </div>
</x-app-layout>
