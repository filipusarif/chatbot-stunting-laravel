@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Pengaturan Profil</h2>

    <div class="space-y-8">
        <div class="p-6 md:p-10 bg-white shadow-sm border border-gray-100 rounded-[2.5rem]">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-6 md:p-10 bg-white shadow-sm border border-gray-100 rounded-[2.5rem]">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-6 md:p-10 bg-red-50 shadow-sm border border-red-100 rounded-[2.5rem]">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection